<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Block\Adminhtml;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Json\EncoderInterface;
use Vegam\Homepage\Model\ResourceModel\Block\CollectionFactory;
use Vegam\Homepage\Api\BlockRepositoryInterface;
use Magento\Framework\Serialize\SerializerInterface;

class AssignProducts extends \Magento\Backend\Block\Template
{
    /**
     * Block template
     *
     * @var string
     */
    public $_template = 'products/assign_products.phtml';

    /**
     * @var Product
     */
    private $blockGrid;

    /**
     * @var Registry
     */
    private $registry;

    /**
     * @var EncoderInterface
     */
    private $jsonEncoder;

    /**
     * @var CollectionFactory
     */
    private $productFactory;

    /**
     * @var BlockRepositoryInterface
     */
    private $blockRepository;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @param Context                  $context
     * @param Registry                 $registry
     * @param EncoderInterface         $jsonEncoder
     * @param BlockRepositoryInterface $blockRepository
     * @param SerializerInterface      $serializer
     * @param array                    $data
     */
    public function __construct(
        Context                  $context,
        Registry                 $registry,
        EncoderInterface         $jsonEncoder,
        BlockRepositoryInterface $blockRepository,
        SerializerInterface      $serializer,
        array                    $data = []
    ) {
        $this->registry = $registry;
        $this->jsonEncoder = $jsonEncoder;
        $this->blockRepository = $blockRepository;
        $this->serializer = $serializer;
        parent::__construct($context, $data);
    }

    /**
     * Retrieve instance of grid block
     *
     * @return \Magento\Framework\View\Element\BlockInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getBlockGrid()
    {
        if (null === $this->blockGrid) {
            $this->blockGrid = $this->getLayout()->createBlock(
                \Vegam\Homepage\Block\Adminhtml\Tab\Productgrid::class,
                'category.product.grid'
            );
        }
        return $this->blockGrid;
    }

    /**
     * Return HTML of grid block
     *
     * @return string
     */
    public function getGridHtml()
    {
        return $this->getBlockGrid()->toHtml();
    }

    /**
     * Get Productsjson
     *
     * @return string
     */
    public function getProductsJson()
    {
        $design_id = $this->getRequest()->getParam('design_id');
        $result = [];
        try {
            if ($design_id !=null) {
                $block = $this->blockRepository->getById($design_id);
                $productIds = $this->serializer->unserialize($block->getProductIds());
                $productIds = array_keys($productIds);
                if (!empty($productIds)) {
                    foreach ($productIds as $pIds) {
                        $result[$pIds] = '';
                    }
                        return $this->jsonEncoder->encode($result);
                }
            }
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            return __($e->getMessage());
        }
        return '{}';
    }
}
