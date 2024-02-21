<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Model;

use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class Categories implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var Categories
     */
    protected $categories;
    /**
     * @var StoreManager
     */
    protected $storeManager;
    /**
     * Constructor parameters
     *
     * @param CollectionFactory     $collection
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        CollectionFactory $collection,
        StoreManagerInterface $storeManager
    ) {
        $this->categories = $collection;
        $this->storeManager = $storeManager;
    }
    /**
     * Option Array
     */
    public function toOptionArray()
    {
        $categories = $this->categories->create();
        $collection = $categories->addAttributeToSelect('*')
            ->addFieldToFilter('is_active', 1)->setStore($this->storeManager->getStore());
        $itemArray = ['value' => '', 'label' => '--Please Select--'];
        $categoryArray = [];
        $categoryArray[] = $itemArray;
        foreach ($collection as $category) {
            $categoryArray[] = ['value' => $category->getId(), 'label' => $category->getName()];
        }
        return $categoryArray;
    }
}
