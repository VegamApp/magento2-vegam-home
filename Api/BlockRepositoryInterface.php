<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Vegam\Homepage\Api\Data\BlockInterface;

interface BlockRepositoryInterface
{
    /**
     * Save Data
     *
     * @param BlockInterface $data
     */
    public function save(BlockInterface $data);

    /**
     * Get By Id
     *
     * @param  int $dataId
     * @return mixed
     */
    public function getById($dataId);

    /**
     * Get List
     *
     * @param  SearchCriteriaInterface $searchCriteria
     * @return \Magento\Framework\Api\SearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete By Id
     *
     * @param  int $dataId
     * @return mixed
     */
    public function deleteById($dataId);
}
