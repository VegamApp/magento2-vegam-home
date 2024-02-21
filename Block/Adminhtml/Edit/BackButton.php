<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Block\Adminhtml\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Vegam Homeblock Admin Edit Back Button
 */
class BackButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Get botton Data
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getUrl('homeblock/index/index')),
            'class' => 'back',
            'sort_order' => 10
        ];
    }
}
