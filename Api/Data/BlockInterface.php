<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Api\Data;

interface BlockInterface
{
    public const DESIGN_ID = 'design_id';
    public const TYPE      = 'type';
    public const NAME      = 'name';
    public const DESCRIPTION   = 'description';
    public const STORE         = 'store';
    public const BANNER_TEMPLATE = 'banner_template';
    public const BANNER_SERIALIZE = 'banner_serialized';
    public const CATEGORY_ID   = 'category_id';
    public const PRODUCT_COUNT = 'product_count';
    public const PRODUCT_TYPE  = 'product_type';
    public const SHOW_TITLE    = 'show_title';
    public const PRODUCT_IDS   = 'product_ids';
    public const BLOCK_STATUS   = 'block_status';
    public const STATUS   = 'status';
    public const MOBILE_STATUS   = 'mobile_status';
    public const VIEWALL_STATUS  = 'viewall_status';
    public const POSITION = 'position';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set ID
     *
     * @param  int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get Block Name
     *
     * @return string
     */
    public function getName();

    /**
     * Set Block Name
     *
     * @param  string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Get Block type
     *
     * @return string
     */
    public function getType();

    /**
     * Set Block Type
     *
     * @param  string $type
     * @return $this
     */
    public function setType($type);

    /**
     * Get Description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set Description
     *
     * @param  string $description
     * @return $this
     */
    public function setDescription($description);

    /**
     * Get Store
     *
     * @return $this
     */
    public function getStore();

    /**
     * Set Store
     *
     * @param  int $store
     * @return $this
     */
    public function setStore($store);
    
    /**
     * Get Banner Serialized
     *
     * @return mixed
     */
    public function getBannerSerialized();

    /**
     * Set Banner Serialized
     *
     * @param  string $bannerSerialized
     * @return mixed
     */
    public function setBannerSerialized($bannerSerialized);

    /**
     * Get CategoryId
     *
     * @return int
     */
    public function getCategoryId();

    /**
     * Set CategoryId
     *
     * @param  int $categoryId
     * @return int
     */
    public function setCategoryId($categoryId);

    /**
     * Get ProductCount
     *
     * @return $this
     */
    public function getProductCount();

    /**
     * Set ProductCount
     *
     * @param  int $productCount
     * @return int
     */
    public function setProductCount($productCount);

    /**
     * Get ProductType
     *
     * @return int
     */
    public function getProductType();

    /**
     * Set ProductType
     *
     * @param  int $productType
     * @return int
     */
    public function setProductType($productType);

    /**
     * Get Product Ids
     *
     * @return string
     */
    public function getProductIds();

    /**
     * Set Product Ids
     *
     * @param  string $productIds
     * @return $this
     */
    public function setProductIds($productIds);

    /**
     * Get Show Title
     *
     * @return $this
     */
    public function getShowTitle();

    /**
     * Set Show Title
     *
     * @param  int $showTitle
     * @return $this
     */
    public function setShowTitle($showTitle);

    /**
     * Get Block Status
     *
     * @return int
     */
    public function getBlockStatus();

    /**
     * Set Block Status
     *
     * @param  int $blockStatus
     * @return int
     */
    public function setBlockStatus($blockStatus);

    /**
     * Get Status
     *
     * @return int
     */
    public function getStatus();

    /**
     * Set Status
     *
     * @param  int $status
     * @return int
     */
    public function setStatus($status);

    /**
     * Get MobileStatus
     *
     * @return int
     */
    public function getMobileStatus();

    /**
     * Set MobileStatus
     *
     * @param  int $mobileStatus
     * @return int
     */
    public function setMobileStatus($mobileStatus);

    /**
     * Get ViewallStatus
     *
     * @return int
     */
    public function getViewallStatus();

    /**
     * Set ViewallStatus
     *
     * @param  int $viewallStatus
     * @return int
     */
    public function setViewallStatus($viewallStatus);

    /**
     * Get Position
     *
     * @return int
     */
    public function getPosition();

    /**
     * Set Position
     *
     * @param  int $position
     * @return int
     */
    public function setPosition($position);
    
    /**
     * Get Banner Template
     *
     * @return int
     */
    public function getBannerTemplate();

    /**
     * Set Banner Template
     *
     * @param  int $bannerTemplate
     * @return int
     */
    public function setBannerTemplate($bannerTemplate);

    /**
     * Get Display Style
     *
     * @return string
     */
    public function getDisplayStyle();

    /**
     * Set Display Style
     *
     * @param  string $displayStyle
     * @return string
     */
    public function setDisplayStyle($displayStyle);
}
