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
class DuplicateButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Get Button Data
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getId()) {
            $data = [
                'label' => __('Duplicate'),
                'class' => 'duplicate',
                'on_click' => sprintf(
                    "location.href = '%s';",
                    $this->getUrl(
                        '*/index/duplicate',
                        ['id' => $this->getId(),
                        'controller' => $this->getControllerName()]
                    )
                ),
                'sort_order' => 90,
            ];
        }
        return $data;
    }
}
