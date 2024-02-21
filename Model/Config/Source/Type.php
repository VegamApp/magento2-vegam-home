<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Type implements ArrayInterface
{
    /**
     * Option Array
     */
    public function toOptionArray()
    {
        $options = [
            0 => [
                'label' => 'Please select',
                'value' => ''
            ],
            1 => [
                'label' => 'Best Seller Product',
                'value' => 1
            ],
            2  => [
                'label' => 'Category Product',
                'value' => 2
            ],
            3  => [
                'label' => 'New Product',
                'value' => 3
            ],
            4  => [
                'label' => 'Featured Product',
                'value' => 4
            ],
            5  => [
                'label' => 'Custom Product',
                'value' => 5
            ],
            6  => [
                'label' => 'Most Popular Product',
                'value' => 6
            ],
        ];

        return $options;
    }
}
