<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Vegam\Homepage\Model\BlockFactory;
use Vegam\Homepage\Api\Data\BlockInterface;
use Vegam\Homepage\Model\ResourceModel\Block;
use Vegam\Homepage\Api\Data\BlockInterfaceFactory;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Reflection\DataObjectProcessor;
use Vegam\Homepage\Model\ResourceModel\Block\CollectionFactory;

class BlockRepository implements \Vegam\Homepage\Api\BlockRepositoryInterface
{
    /**
     * @var blockFactory
     */
    private $blockFactory;
    /**
     * @var ResourceModel\Block
     */
    private $blockResource;
    /**
     * @var \Vegam\Homepage\Api\Data\BlockInterfaceFactory
     */
    private $blockDataFactory;
    /**
     * @var \Magento\Framework\Api\ExtensibleDataObjectConverter
     */
    private $dataObjectConverter;
    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;
    /**
     * @var DataObjectProcessor
     */
    private $dataObjectProcessor;
    /**
     * @var SearchResultsInterfaceFactory
     */
    private $searchResultFactory;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * BlockRepository constructor.
     *
     * @param BlockFactory                       $blockFactory
     * @param Block                              $blockResource
     * @param BlockInterfaceFactory              $blockDataFactory
     * @param ExtensibleDataObjectConverter      $dataObjectConverter
     * @param DataObjectHelper                   $dataObjectHelper
     * @param SearchResultsInterfaceFactory      $searchResultFactory
     * @param DataObjectProcessor                $dataObjectProcessor
     * @param CollectionProcessorInterface       $collectionProcessor
     * @param CollectionFactory                  $collectionFactory
     */
    public function __construct(
        BlockFactory $blockFactory,
        Block $blockResource,
        BlockInterfaceFactory $blockDataFactory,
        ExtensibleDataObjectConverter $dataObjectConverter,
        DataObjectHelper $dataObjectHelper,
        SearchResultsInterfaceFactory $searchResultFactory,
        DataObjectProcessor $dataObjectProcessor,
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $collectionFactory
    ) {
        $this->blockFactory = $blockFactory;
        $this->blockResource = $blockResource;
        $this->blockDataFactory = $blockDataFactory;
        $this->dataObjectConverter = $dataObjectConverter;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->searchResultFactory = $searchResultFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->collectionProcessor = $collectionProcessor;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Function Get By Id
     *
     * @param  int $design_id
     * @return BlockInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($design_id)
    {
        $blockObj = $this->blockFactory->create();
        $this->blockResource->load($blockObj, $design_id);
        if (!$blockObj->getId()) {
            throw new NoSuchEntityException(__('Item with id "%1" does not exist.', $design_id));
        }
        $data = $this->blockDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $data,
            $blockObj->getData(),
            BlockInterface::class
        );
        $data->setId($blockObj->getId());

        return $data;
    }

    /**
     * Save Block Data
     *
     * @param  string $block
     * @return BlockInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(BlockInterface $block)
    {
        try {
            /**
             * @var BlockInterface|\Magento\Framework\Model\AbstractModel $data
             */
            $this->blockResource ->save($block);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __(
                    'Could not save the data: %1',
                    $exception->getMessage()
                )
            );
        }
        return $block;
    }

    /**
     * Delete the Block by Block id
     *
     * @param  int $blockId
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($blockId)
    {
        $blockObj = $this->blockFactory->create();
        $this->blockResource->load($blockObj, $blockId);
        $this->blockResource->delete($blockObj);
        if ($blockObj->isDeleted()) {
            return true;
        }
        return false;
    }

    /**
     * Get List
     *
     * @param  SearchCriteriaInterface $searchCriteria
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}
