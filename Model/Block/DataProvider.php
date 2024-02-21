<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Model\Block;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Vegam\Homepage\Model\ResourceModel\Block\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var CollectionFactory
     */
    private $blockFactory;
    /**
     * @var StoreManager
     */
    private $storeManager;
    /**
     * @var LoadedData
     */
    private $loadedData;
    /**
     * @var SerializerInterface
     */
    private $serializer;
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * Constructor parameters
     *
     * @param string                $name
     * @param string                $primaryFieldName
     * @param string                $requestFieldName
     * @param CollectionFactory     $blockFactory
     * @param StoreManagerInterface $storeManager
     * @param SerializerInterface   $serializer
     * @param Filesystem            $filesystem
     * @param array                 $meta
     * @param array                 $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $blockFactory,
        StoreManagerInterface $storeManager,
        SerializerInterface $serializer,
        Filesystem $filesystem,
        array $meta = [],
        array $data = []
    ) {
        $this->blockFactory = $blockFactory;
        $this->collection = $this->blockFactory->create();
        $this->storeManager = $storeManager;
        $this->serializer = $serializer;
        $this->filesystem = $filesystem;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        $mediaUrl = $this->storeManager->getStore()
             ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $mediaPath = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath();
        foreach ($items as $data) {
            $requestData = $data->getData();
            $bannerSerialized = $data->getBannerSerialized() ?
                $this->serializer->unserialize($data->getBannerSerialized()) :'';
            if (! empty($bannerSerialized)) {
                foreach ($bannerSerialized as $index => $link) {
                    $bannerSerialized[$index]['image'][0]['path'] =  $mediaPath.$link['image'][0]['path'];
                    $bannerSerialized[$index]['image'][0] ['url'] = $mediaUrl.$link['image'][0] ['url'];
                }
            }
            $requestData['banner_rows'] = $bannerSerialized;
            $requestData['banner_title'] = $bannerSerialized;
            $requestData['store'] = ($data->getStore()) ? explode(',', $data->getStore()) : null;
            $requestData['category_id'] = ($data->getCategoryId()) ? explode(',', $data->getCategoryId()) : null;
            $this->loadedData[$data->getId()] = $requestData;
        }
        return $this->loadedData;
    }
}
