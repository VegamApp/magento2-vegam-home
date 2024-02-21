<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Model\ResourceModel\Block\Grid;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Magento\Framework\Api;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Psr\Log\LoggerInterface as Logger;

class Collection extends SearchResult
{
    /**
     * @param EntityFactory $entityFactory
     * @param Logger $logger
     * @param FetchStrategy $fetchStrategy
     * @param EventManager $eventManager
     * @param string $mainTable
     * @param string $resourceModel
     */
    
    /**
     * Function AddFieldTOFilter
     *
     * @param string $field
     * @param string $condition
     */
    public function addFieldToFilter($field, $condition = null)
    {
        if ($field === 'store') {
            $conditionVal = $condition['eq'];
            $conditionSec[] = ['finset' =>$conditionVal];
            if ($conditionVal != 0) {
                $conditionSec[] = ['finset' => 0];
            }
            return parent::addFieldToFilter($field, $conditionSec);
        }
        return parent::addFieldToFilter($field, $condition);
    }
}
