<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Model\Config;

class Status implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var StatusEnabled
     */
    public const STATUS_ENABLED = 1;
    
    /**
     * @var StatusDisabled
     */
    public const STATUS_DISABLED = 2;
   
    /**
     * Option Array
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                self::STATUS_ENABLED => __('Enabled'),
                self::STATUS_DISABLED => __('Disabled'),
            ],
        ];
    }
    
    /**
     * Get option array
     *
     * @return array
     */
    public function getOptionArray()
    {
        return [
            self::STATUS_ENABLED => __('Enabled'),
            self::STATUS_DISABLED => __('Disabled'),
        ];
    }
}
