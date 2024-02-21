<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Block\Adminhtml\Block;

use Magento\Backend\Block\Widget\Context;

class CustomActionList extends \Magento\Backend\Block\Widget\Container
{
    /**
     * Function PrepareLayout
     */
    protected function _prepareLayout()
    {
        $addButtonProps = [
            'id' => 'custom_action_list',
            'label' => __('Add New'),
            'class' => 'add',
            'button_class' => '',
            'class_name' => \Magento\Backend\Block\Widget\Button\SplitButton::class,
            'options' => $this->_getCustomActionListOptions(),
        ];
        $this->buttonList->add('add_new', $addButtonProps);

        return parent::_prepareLayout();
    }

    /**
     * Retrieve options for 'CustomActionList' split button
     *
     * @return array
     */
    protected function _getCustomActionListOptions()
    {
        /*list of button which you want to add*/
        $splitButtonOptions=[
        'action_1'=>['label'=>__('Slider (Pro)'),
        'style' => 'color: #ccc'],

        //'onclick'=>'setLocation(\'' . $this->getUrl('homeblock/sliders/addnew') . '\')'],
        'action_2'=>['label'=>__('Banner'),
        'onclick'=>'setLocation(\'' . $this->getUrl('homeblock/index/addnew') . '\')'],
        'action_3'=>['label'=>__('Content (Pro)'),
        'style' => 'color: #ccc'],
        'action_4'=>['label'=>__('Product'),
        'onclick'=>'setLocation(\'' . $this->getUrl('homeblock/product/addnew') . '\')'],
        'action_5'=>['label'=>__('Custom (Pro)'),
        'style' => 'color: #ccc'],
        'action_6'=>['label'=>__('Category'),
        'onclick'=>'setLocation(\'' . $this->getUrl('homeblock/category/addnew') . '\')'],
        'action_7'=>['label'=>__('PopUp (Pro)'),
        'style' => 'color: #ccc']
        ];
        /* in above list you can also pass others attribute of buttons*/
        return $splitButtonOptions;
    }
}
