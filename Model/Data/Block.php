<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Model\Data;

use Vegam\Homepage\Api\Data\BlockInterface;
use Magento\Framework\Model\AbstractModel;

class Block extends \Vegam\Homepage\Model\Block implements BlockInterface
{
    /**
     * Get the Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::DESIGN_ID);
    }

    /**
     * Set the Id
     *
     * @param  int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::DESIGN_ID, $id);
    }

     /**
      * Get type
      *
      * @return string
      */
    public function getType()
    {
        return $this->getData(BlockInterface::TYPE);
    }

    /**
     * Set type
     *
     * @param  string $type
     * @return $this
     */
    public function setType($type)
    {
        return $this->setData(BlockInterface::TYPE, $type);
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getData(BlockInterface::NAME);
    }

    /**
     * Set Name
     *
     * @param  string $name
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(BlockInterface::NAME, $name);
    }

     /**
      * Get Description
      *
      * @return string
      */
    public function getDescription()
    {
        return $this->getData(BlockInterface::DESCRIPTION);
    }

    /**
     * Set Description
     *
     * @param  string $description
     * @return $this
     */
    public function setDescription($description)
    {
        return $this->setData(BlockInterface::DESCRIPTION, $description);
    }

    /**
     * Get Store
     *
     * @return string
     */
    public function getStore()
    {
        return $this->getData(BlockInterface::STORE);
    }

    /**
     * Set Store
     *
     * @param  int $store
     * @return $this
     */
    public function setStore($store)
    {
        return $this->setData(BlockInterface::STORE, $store);
    }
    
    /**
     * Get CategoryId
     *
     * @return int
     */
    public function getCategoryId()
    {
        return $this->getData(BlockInterface::CATEGORY_ID);
    }

    /**
     * Set CategoryId
     *
     * @param  int $categoryId
     * @return int
     */
    public function setCategoryId($categoryId)
    {
        return $this->setData(BlockInterface::CATEGORY_ID, $categoryId);
    }

    /**
     * Get ProductCount
     *
     * @return string
     */
    public function getProductCount()
    {
        return $this->getData(BlockInterface::PRODUCT_COUNT);
    }

    /**
     * Set ProductCount
     *
     * @param  int $productCount
     * @return int
     */
    public function setProductCount($productCount)
    {
        return $this->setData(BlockInterface::PRODUCT_COUNT, $productCount);
    }

    /**
     * Get Show Title
     *
     * @return string
     */
    public function getShowTitle()
    {
        return $this->getData(BlockInterface::SHOW_TITLE);
    }

    /**
     * Set Show Title
     *
     * @param  string $showTitle
     * @return $this
     */
    public function setShowTitle($showTitle)
    {
        return $this->setData(BlockInterface::SHOW_TITLE, $showTitle);
    }

    /**
     * Get Banner Serialized
     *
     * @return string
     */
    public function getBannerSerialized()
    {
        return $this->getData(BlockInterface::BANNER_SERIALIZE);
    }

    /**
     * Set Banner Serialized
     *
     * @param  string $bannerSerialized
     * @return $this
     */
    public function setBannerSerialized($bannerSerialized)
    {
        return $this->setData(BlockInterface::BANNER_SERIALIZE, $bannerSerialized);
    }

    /**
     * Get Block Status
     *
     * @return int
     */
    public function getBlockStatus()
    {
        return $this->getData(BlockInterface::BLOCK_STATUS);
    }

    /**
     * Set Block Status
     *
     * @param  int $blockStatus
     * @return int
     */
    public function setBlockStatus($blockStatus)
    {
        return $this->setData(BlockInterface::BLOCK_STATUS, $blockStatus);
    }

    /**
     * Get Status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->getData(BlockInterface::STATUS);
    }

    /**
     * Set Status
     *
     * @param  int $status
     * @return int
     */
    public function setStatus($status)
    {
        return $this->setData(BlockInterface::STATUS, $status);
    }

    /**
     * Get Mobile Status
     *
     * @return int
     */
    public function getMobileStatus()
    {
        return $this->getData(BlockInterface::MOBILE_STATUS);
    }

    /**
     * Set Mobile Status
     *
     * @param  int $mobileStatus
     * @return int
     */
    public function setMobileStatus($mobileStatus)
    {
        return $this->setData(BlockInterface::MOBILE_STATUS, $mobileStatus);
    }

    /**
     * Get Viewall Status
     *
     * @return int
     */
    public function getViewallStatus()
    {
        return $this->getData(BlockInterface::VIEWALL_STATUS);
    }

    /**
     * Set Viewall Status
     *
     * @param  int $viewallStatus
     * @return int
     */
    public function setViewallStatus($viewallStatus)
    {
        return $this->setData(BlockInterface::VIEWALL_STATUS, $viewallStatus);
    }

    /**
     * Get Position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->getData(BlockInterface::POSITION);
    }

    /**
     * Set Position
     *
     * @param  string $position
     * @return $this
     */
    public function setPosition($position)
    {
        return $this->setData(BlockInterface::POSITION, $position);
    }
    /**
     * Get ProductType
     *
     * @return string
     */
    public function getProductType()
    {
        return $this->getData(BlockInterface::PRODUCT_TYPE);
    }
    /**
     * Set ProductType
     *
     * @param  string $productType
     * @return $this
     */
    public function setProductType($productType)
    {
        return $this->setData(BlockInterface::PRODUCT_TYPE, $productType);
    }

    /**
     * Get Product Ids
     *
     * @return Int
     */
    public function getProductIds()
    {
        return $this->getData(BlockInterface::PRODUCT_IDS);
    }

    /**
     * Set Product Ids
     *
     * @param  int $productIds
     * @return $this
     */
    public function setProductIds($productIds)
    {
        return $this->setData(BlockInterface::PRODUCT_IDS, $productIds);
    }

    /**
     * Get Banner Template
     *
     * @return string
     */
    public function getBannerTemplate()
    {
        return $this->getData(BlockInterface::BANNER_TEMPLATE);
    }

    /**
     * Set Banner Template
     *
     * @param  String $bannerTemplate
     * @return $this
     */
    public function setBannerTemplate($bannerTemplate)
    {
        return $this->setData(BlockInterface::BANNER_TEMPLATE, $bannerTemplate);
    }

    /**
     * Get Display Style
     *
     * @return string
     */
    public function getDisplayStyle()
    {
        return $this->getData(BlockInterface::DISPLAY_STYLE);
    }

    /**
     * Set Display Style
     *
     * @param  String $displayStyle
     * @return $this
     */
    public function setDisplayStyle($displayStyle)
    {
        return $this->setData(BlockInterface::DISPLAY_STYLE, $displayStyle);
    }
}
