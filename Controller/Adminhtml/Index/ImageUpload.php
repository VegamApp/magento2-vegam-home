<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Vegam\Homepage\Model\ImageUploader;

class ImageUpload extends Action
{
    /**
     * @var ImageUploaders
     */
    private $imageUploader;

    /**
     * Upload constructor.
     *
     * @param Context        $context
     * @param ImageUploaders $imageUploader
     */
    public function __construct(
        Context $context,
        ImageUploader $imageUploader
    ) {
        $this->imageUploader = $imageUploader;
        parent::__construct($context);
    }
    /**
     * Execute Function
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        try {
            if ($this->getRequest()->getFiles('banner_rows')) {
                $dynamicrows = $this->getRequest()->getFiles('banner_rows');
                $files = [];
                foreach ($dynamicrows as $key => $rows) {
                    $files = $dynamicrows[$key]['image'];
                }
                $result = $this->imageUploader->saveFileToTmpDir($files);
                $result['cookie'] = [
                    'name' => $this->_getSession()->getName(),
                    'value' => $this->_getSession()->getSessionId(),
                    'lifetime' => $this->_getSession()->getCookieLifetime(),
                    'path' => $this->_getSession()->getCookiePath(),
                    'domain' => $this->_getSession()->getCookieDomain()
                ];
            }
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}
