<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Block extends AbstractDb
{
    /**
     * Resource initialisation
     */
    protected function _construct()
    {
        $this->_init('vegam_homedesign', 'design_id');
    }
}
