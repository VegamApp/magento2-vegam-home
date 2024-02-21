<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Model;

use Magento\Framework\Exception\LocalizedException as CoreException;
use Magento\MediaStorage\Helper\File\Storage\Database;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\Filesystem\Io\File;
use Magento\Framework\UrlInterface;

class ImageUploader
{
    /**
     * @var coreFileStorageDatabase
     */
    private $coreFileStorageDatabase;
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var mediaDirectory
     */
    private $mediaDirectory;
    /**
     * @var uploaderFactory
     */
    private $uploaderFactory;
    /**
     * @var storeManager
     */
    private $storeManager;
    /**
     * @var logger
     */
    private $logger;
    /**
     * @var baseTmpPath
     */
    public $baseTmpPath;
    /**
     * @var basePath
     */
    public $basePath;
    /**
     * @var allowedExtensions
     */
    public $allowedExtensions;
    /**
     * @var imageFactory
     */
    private $imageFactory;
    /**
     * @var File
     */
    private $file;

    /**
     * Upload constructor.
     *
     * @param Database                     $coreFileStorageDatabase
     * @param Filesystem                   $filesystem
     * @param UploaderFactory              $uploaderFactory
     * @param StoreManagerInterface        $storeManager
     * @param LoggerInterface              $logger
     * @param AdapterFactory               $imageFactory
     * @param File                         $file
     */
    public function __construct(
        Database $coreFileStorageDatabase,
        Filesystem $filesystem,
        UploaderFactory $uploaderFactory,
        StoreManagerInterface $storeManager,
        LoggerInterface $logger,
        AdapterFactory $imageFactory,
        File $file
    ) {
        $this->coreFileStorageDatabase = $coreFileStorageDatabase;
        $this->mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $this->uploaderFactory = $uploaderFactory;
        $this->storeManager = $storeManager;
        $this->logger = $logger;
        $this->imageFactory = $imageFactory;
        $this->filesystem = $filesystem;
        $this->file = $file;
        $this->baseTmpPath = "vegam/homepage/images";
        $this->basePath = "homepage/images";
        $this->allowedExtensions= ['jpg', 'jpeg', 'gif', 'png'];
    }
    /**
     * Set BaseTmpPath
     *
     * @param string $baseTmpPath
     */
    public function setBaseTmpPath($baseTmpPath)
    {
        $this->baseTmpPath = $baseTmpPath;
    }
    /**
     * Set BasePath
     *
     * @param string $basePath
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }
    /**
     * Set AllowedExtensions
     *
     * @param string $allowedExtensions
     */
    public function setAllowedExtensions($allowedExtensions)
    {
        $this->allowedExtensions = $allowedExtensions;
    }
    /**
     * Get BaseTmpPath
     */
    public function getBaseTmpPath()
    {
        return $this->baseTmpPath;
    }
    /**
     * Get BasePath
     */
    public function getBasePath()
    {
        return $this->basePath;
    }
    /**
     * Get AllowedExtensions
     */
    public function getAllowedExtensions()
    {
        return $this->allowedExtensions;
    }
    /**
     * Get FilePath
     *
     * @param string $path
     * @param string $imageName
     */
    public function getFilePath($path, $imageName)
    {
        return rtrim($path, '/') . '/' . ltrim($imageName, '/');
    }
    /**
     * Function moveFileFromTmp
     *
     * @param string $imageName
     * return $imageName
     */
    public function moveFileFromTmp($imageName)
    {
        $baseTmpPath = $this->getBaseTmpPath();
        $basePath = $this->getBasePath();
        $baseImagePath = $this->getFilePath($basePath, $imageName);
        $baseTmpImagePath = $this->getFilePath($baseTmpPath, $imageName);
        try {
            $this->coreFileStorageDatabase->copyFile(
                $baseTmpImagePath,
                $baseImagePath
            );
            $this->mediaDirectory->renameFile(
                $baseTmpImagePath,
                $baseImagePath
            );
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('Something went wrong while saving the file(s).')
            );
        }
        return $imageName;
    }
    /**
     * Function saveFileToTmpDir
     *
     * @param int $fileId
     * return $result
     */
    public function saveFileToTmpDir($fileId)
    {
        $baseTmpPath = $this->getBaseTmpPath();
        $uploader = $this->uploaderFactory->create(['fileId' => $fileId]);
        $uploader->setAllowedExtensions($this->getAllowedExtensions());
        $uploader->setAllowRenameFiles(true);
        $result = $uploader->save($this->mediaDirectory->getAbsolutePath($baseTmpPath));
        if (!$result) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('File can not be saved to the destination folder.')
            );
        }

        $result['tmp_name'] = str_replace('\\', '/', $result['tmp_name']);
        $result['path'] = str_replace('\\', '/', $result['path']);
        $result['url'] = $this->storeManager
                ->getStore()
                ->getBaseUrl(
                    \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                ) . $this->getFilePath($baseTmpPath, $result['file']);
        $result['name'] = $result['file'];
        if (isset($result['file'])) {
            try {
                $relativePath = rtrim($baseTmpPath, '/') . '/' . ltrim($result['file'], '/');
                $this->coreFileStorageDatabase->saveFile($relativePath);
            } catch (\Exception $e) {
                $this->logger->critical($e);
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('Something went wrong while saving the file(s).')
                );
            }
        }
        return $result;
    }
    /**
     * Resize image
     *
     * @param string $image
     * @param int $width
     * @param Int $height
     * @return array
     */
    public function resize($image, $width, $height)
    {
        $baseTmpPath = $this->getBaseTmpPath();
        $absolutePath = $this->mediaDirectory->getAbsolutePath($baseTmpPath.'/').$image;
        if (!$this->file->fileExists($absolutePath)) {
            return false;
        }
        $resizedPath = 'vegam/homepage/images/resized/'.$width.'_'.$height.'/';
        $imageResized = $this->mediaDirectory->getAbsolutePath($resizedPath).$image;
        if (!$this->file->fileExists($imageResized)) {
            $imageResize = $this->imageFactory->create();
            $imageResize->open($absolutePath);
            $imageResize->constrainOnly(true);
            $imageResize->keepTransparency(true);
            $imageResize->keepFrame(false);
            $imageResize->keepAspectRatio(true);
            $imageResize->resize($width, $height);
            $destination = $imageResized;
            $imageResize->save($destination);
        }
        $resizedURL = $this->storeManager->getStore()
        ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA).$resizedPath.$image;
        return $resizedURL;
    }
}
