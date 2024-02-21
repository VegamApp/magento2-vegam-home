<?php
/**
 * @package Vegam_Homepage
 */
namespace Vegam\Homepage\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Vegam\Homepage\Model\BlockFactory;

class DeleteButton extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;
    /**
     * @var BlockFactory
     */
    private $blockFactory;

    /**
     * Constructor parameter
     *
     * @param Context        $context
     * @param PageFactory    $resultPageFactory
     * @param BlockFactory   $blockFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        BlockFactory $blockFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->blockFactory = $blockFactory;
        parent::__construct($context);
    }
    /**
     * Execute
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->blockFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Deleted Successfully!'));
                return $resultRedirect->setPath('*/*/');
            } catch (Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/addnew', ['id' => $id]);
            }

            $this->messageManager->addError(__('We can\'t find data to delete.'));
            return $resultRedirect->setPath('*/*/');
        }
    }
}
