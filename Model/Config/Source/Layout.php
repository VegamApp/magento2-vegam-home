<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Layout implements ArrayInterface
{
    /**
     * Option Array
     */
    public function toOptionArray()
    {
        $layouts = [
            0 => [
                'label' => 'Please select',
                'value' => 0
            ],
            1 => [
                'label' => '1 Column',
                'value' => 1
            ],
            2  => [
                'label' => '2 Column',
                'value' => 2
            ],
            3  => [
                'label' => '3 Column',
                'value' => 3
            ],
            4  => [
                'label' => '4 Column',
                'value' => 4
            ],
            6  => [
                'label' => '6 Column',
                'value' => 6
            ],
            
        ];
        return $layouts;
    }
}
