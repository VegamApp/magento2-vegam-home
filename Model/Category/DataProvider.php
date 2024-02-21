<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Model\Category;
 
use Magento\Catalog\Model\Category\DataProvider as CategoryDataProvider;
 
/**
 * Class DataProvider - Customized version of Magento\Catalog\Model\Category\DataProvider
 */
class DataProvider extends CategoryDataProvider
{
    /**
     * Field name for category_id in query
     *
     * @return array
     */
    protected function getFieldsMap()
    {
        $fields = parent::getFieldsMap();
        $fields['content'][] = 'vegam_category_thumbnail';
 
        return $fields;
    }
}
