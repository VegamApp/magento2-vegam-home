<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Model;

use Magento\Framework\Model\AbstractModel;
use Vegam\Homepage\Api\Data\BlockInterface;

class Block extends AbstractModel
{
    /**
     * Table Name
     * Cache tag
     */
    public const CACHE_TAG = 'vegam_homedesign';

    /**
     * Initialise resource model
     */
    protected function _construct()
    {
        $this->_init(\Vegam\Homepage\Model\ResourceModel\Block::class);
    }
}
