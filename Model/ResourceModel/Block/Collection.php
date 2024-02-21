<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Model\ResourceModel\Block;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $idFieldName = 'design_id';

    /**
     * Collection initialisation
     */
    protected function _construct()
    {
        $this->_init(
            \Vegam\Homepage\Model\Block::class,
            \Vegam\Homepage\Model\ResourceModel\Block::class
        );
    }
}
