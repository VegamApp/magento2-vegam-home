<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Block\Adminhtml\Edit;

use Magento\Backend\Block\Widget\Context;

abstract class GenericButton
{
    /**
     * @var $context
     */
    protected $context;

    /**
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        $this->context = $context;
    }
    /**
     * Generate url by route and parameters
     *
     * @param  string $route
     * @param  array  $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
    /**
     * Get Request
     *
     * @return int|null
     */
    public function getRequest()
    {
        return $this->context->getRequest()->getParam('design_id');
    }
    /**
     * Return Epp ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->context->getRequest()->getParam('design_id');
    }

    /**
     * Return controller name
     *
     * @return int|null
     */
    public function getControllerName()
    {
        return $this->context->getRequest()->getControllerName();
    }
}
