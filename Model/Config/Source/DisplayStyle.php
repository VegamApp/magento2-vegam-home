<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class DisplayStyle implements ArrayInterface
{
    /**
     * Option Array
     */
    public function toOptionArray()
    {
        $layouts = [
            1 => [
                'label' => 'Slider',
                'value' => 'slider'
            ],
            2  => [
                'label' => 'Block',
                'value' => 'block'
            ],
        ];
        return $layouts;
    }
}
