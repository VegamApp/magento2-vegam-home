<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Plugin;

use Magento\Ui\Model\UrlInput\ConfigInterface;

class Url
{
    /**
     * Fuction aftergetConfig
     */
    public function aftergetConfig(): array
    {
        return [
            'label' => __('External URL'),
            'component' => 'Magento_Ui/js/form/element/abstract',
            'template' => 'ui/form/element/input',
            'sortOrder' => 20,
        ];
    }
}
