<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    /**
     * Option Array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => 'Disabled'],
            ['value' => 1, 'label' => 'Enabled']
        ];
    }
}
