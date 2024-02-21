<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Block\Adminhtml\Tab;

use Magento\Catalog\Model\Product\Visibility;
use Magento\Framework\App\ObjectManager;
use Magento\Store\Model\Store;
use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Helper\Data;
use Magento\Catalog\Model\ProductFactory;
use Vegam\Homepage\Model\ResourceModel\Block\CollectionFactory;
use Magento\Framework\Registry;
use Magento\Framework\Module\Manager;
use Magento\Store\Model\StoreManagerInterface;
use Vegam\Homepage\Api\BlockRepositoryInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Vegam\Homepage\Model\Config\Status;
use Vegam\Homepage\Model\Config\VisibilityStatus;

class Productgrid extends Extended
{

    /**
     * @var Registry
     */
    private $coreRegistry = null;

    /**
     * @var ProductFactory
     */
    private $productFactory;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var BlockRepositoryInterface
     */
    private $blockRepository;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var Status
     */
    private $status;

    /**
     * @var VisibilityStatus
     */
    private $visibilityStatus;

    /**
     * @param Context                  $context
     * @param Data                     $backendHelper
     * @param ProductFactory           $productFactory
     * @param CollectionFactory        $collectionFactory
     * @param Registry                 $coreRegistry
     * @param Manager                  $moduleManager
     * @param StoreManagerInterface    $storeManager
     * @param BlockRepositoryInterface $blockRepository
     * @param SerializerInterface      $serializer
     * @param Visibility|null          $visibility
     * @param Status                   $status
     * @param VisibilityStatus         $visibilityStatus
     * @param array                    $data
     */
    public function __construct(
        Context                  $context,
        Data                     $backendHelper,
        ProductFactory           $productFactory,
        CollectionFactory        $collectionFactory,
        Registry                 $coreRegistry,
        Manager                  $moduleManager,
        StoreManagerInterface    $storeManager,
        BlockRepositoryInterface $blockRepository,
        SerializerInterface      $serializer,
        Visibility               $visibility = null,
        Status                   $status,
        VisibilityStatus         $visibilityStatus,
        array $data = []
    ) {
        $this->productFactory = $productFactory;
        $this->collectionFactory = $collectionFactory;
        $this->coreRegistry = $coreRegistry;
        $this->moduleManager = $moduleManager;
        $this->_storeManager = $storeManager;
        $this->blockRepository = $blockRepository;
        $this->serializer = $serializer;
        $this->visibility = $visibility ?: ObjectManager::getInstance()->get(Visibility::class);
        $this->status = $status;
        $this->visibilityStatus = $visibilityStatus;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * [_construct description]
     *
     * @return [type] [description]
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('rh_grid_products');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setUseAjax(true);
        if ($this->getRequest()->getParam('design_id')) {
            $this->setDefaultFilter(['in_products' => 1]);
        } else {
            $this->setDefaultFilter(['in_products' => 0]);
        }
        $this->setSaveParametersInSession(true);
    }

    /**
     * [get store id]
     *
     * @return Store
     */
    protected function _getStore()
    {
        $storeId = (int) $this->getRequest()->getParam('store', 0);
        return $this->_storeManager->getStore($storeId);
    }

    /**
     * Prepare Collection
     */
    protected function _prepareCollection()
    {
        $store = $this->_getStore();
        $collection = $this->productFactory->create()->getCollection();
        $collection->addAttributeToSelect(
            'sku'
        )->addAttributeToSelect(
            'name'
        )->addAttributeToSelect(
            'attribute_set_id'
        )->addAttributeToSelect(
            'type_id'
        )->setStore(
            $store
        );

        if ($this->moduleManager->isEnabled('Magento_CatalogInventory')) {
            $collection->joinField(
                'qty',
                'cataloginventory_stock_item',
                'qty',
                'product_id=entity_id',
                '{{table}}.stock_id=1',
                'left'
            );
        }
        if ($store->getId()) {
            $collection->setStoreId($store->getId());
            $collection->addStoreFilter($store);
            $collection->joinAttribute(
                'name',
                'catalog_product/name',
                'entity_id',
                null,
                'inner',
                Store::DEFAULT_STORE_ID
            );
            $collection->joinAttribute(
                'status',
                'catalog_product/status',
                'entity_id',
                null,
                'inner',
                $store->getId()
            );
            $collection->joinAttribute(
                'visibility',
                'catalog_product/visibility',
                'entity_id',
                null,
                'inner',
                $store->getId()
            );
            $collection->joinAttribute('price', 'catalog_product/price', 'entity_id', null, 'left', $store->getId());
        } else {
            $collection->addAttributeToSelect('price');
            $collection->joinAttribute('status', 'catalog_product/status', 'entity_id', null, 'inner');
            $collection->joinAttribute('visibility', 'catalog_product/visibility', 'entity_id', null, 'inner');
        }
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    
    /**
     * Add column Filter to collection
     *
     * @param Column $column
     */
    protected function _addColumnFilterToCollection($column)
    {
        if ($column->getId() == 'in_products') {
            $productIds = $this->getSelectedProducts();
            if (empty($productIds)) {
                $productIds = 0;
            }
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('entity_id', ['in' => $productIds]);
            } else {
                if ($productIds) {
                    $this->getCollection()->addFieldToFilter('entity_id', ['nin' => $productIds]);
                }
            }
        } else {
            parent::_addColumnFilterToCollection($column);
        }
        return $this;
    }

    /**
     * Prepare Columns
     *
     * @return Extended
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'in_products',
            [
                'type' => 'checkbox',
                'html_name' => 'products_id',
                'required' => true,
                'values' => $this->getSelectedProducts(),
                'align' => 'center',
                'index' => 'entity_id',
            ]
        );

        $this->addColumn(
            'entity_id',
            [
                'header' => __('ID'),
                'width' => '50px',
                'index' => 'entity_id',
                'type' => 'number',
            ]
        );
        $this->addColumn(
            'name',
            [
                'header' => __('Name'),
                'index' => 'name',
                'header_css_class' => 'col-type',
                'column_css_class' => 'col-type',
            ]
        );
        $this->addColumn(
            'sku',
            [
                'header' => __('SKU'),
                'index' => 'sku',
                'header_css_class' => 'col-sku',
                'column_css_class' => 'col-sku',
            ]
        );
        $store = $this->_getStore();
        $this->addColumn(
            'price',
            [
                'header' => __('Price'),
                'type' => 'price',
                'currency_code' => $store->getBaseCurrency()->getCode(),
                'index' => 'price',
                'header_css_class' => 'col-price',
                'column_css_class' => 'col-price',
            ]
        );
        $this->addColumn(
            'visibility',
            [
                'header' => __('Visibility'),
                'index' => 'visibility',
                'type' => 'options',
                'options' => $this->visibilityStatus->getOptionArray(),
            ]
        );
        $this->addColumn(
            'status',
            [
                'header' => __('Status'),
                'index' => 'status',
                'type' => 'options',
                'options' => $this->status->getOptionArray(),
            ]
        );
        $this->addColumn(
            'position',
            [
                'header' => __('Position'),
                'name' => 'position',
                'width' => 60,
                'type' => 'number',
                'validate_class' => 'validate-number',
                'index' => 'position',
                'editable' => true,
                'edit_only' => true,
            ]
        );
        return parent::_prepareColumns();
    }

    /**
     * Get Grid url
     *
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/product/grids', ['_current' => true]);
    }

    /**
     * Get selected products
     *
     * @return array
     */
    public function getSelectedProducts()
    {
        $id = $this->getRequest()->getParam('design_id');
        $grids = [];
        try {
            if ($id != null) {
                $block = $this->blockRepository->getById($id);
                $productIds = $block->getProductIds();
                if ($productIds != null) {
                    $unserialize = $this->serializer->unserialize($productIds);
                    $unserialize = array_keys($unserialize);
                    foreach ($unserialize as $key => $value) {
                        $grids[] = $value;
                    }
                }
            }
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            return $e->getMessage();
        }
        return $grids;
    }
}
