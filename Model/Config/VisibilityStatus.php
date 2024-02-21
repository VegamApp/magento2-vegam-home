<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Model\Config;

class VisibilityStatus implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var Not Visible
     */
    public const NOT_VISIBLE = 1;

    /**
     * @var Catalog
     */
    public const CATALOG = 2;

    /**
     * @var Search
     */
    public const SEARCH = 3;

    /**
     * @var CatalogSearch
     */
    public const CATALOG_SEARCH = 4;
    
    /**
     * Option Array
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                self::NOT_VISIBLE => __('Not Visible Individually '),
                self::CATALOG => __('Catalog'),
                self::SEARCH => __('Search'),
                self::CATALOG_SEARCH => __('Catalog, Search'),
            ],
        ];
    }
   
    /**
     * Get option array
     *
     * @return array
     */
    public function getOptionArray()
    {
        return [
            self::NOT_VISIBLE => __('Not Visible Individually'),
            self::CATALOG => __('Catalog'),
            self::SEARCH => __('Search'),
            self::CATALOG_SEARCH => __('Catalog, Search'),
        ];
    }
}
