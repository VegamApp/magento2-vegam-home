<?php
/**
 * @package Vegam_Homepage
 */
declare(strict_types=1);

namespace Vegam\Homepage\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Vegam\Homepage\Api\BlockRepositoryInterface;

class Duplicate extends Action
{
    /**
     * @var BlockRepositoryInterface
     */
    private $blockRepository;
    
    /**
     * Constructor parameters
     *
     * @param Action\Context $context
     * @param BlockRepositoryInterface $blockRepository
     */
    public function __construct(
        Action\Context $context,
        BlockRepositoryInterface $blockRepository
    ) {
        $this->blockRepository = $blockRepository;
        parent::__construct($context);
    }

    /**
     * Execute
     */
    public function execute()
    {
        $designId = $this->getRequest()->getParam('id');
        $controller = $this->getRequest()->getParam('controller');

        $originalBlock = $this->blockRepository->getById($designId);
        $newBlock = clone $originalBlock;
        $newBlock->setDesignId(null);
        $newBlock->setBlockStatus(0);
        $this->blockRepository->save($newBlock);
        $newDesignId = $newBlock->getDesignId();
        $this->messageManager->addSuccessMessage(__('Block duplicated successfully.'));
        $redirectPath = "*/".$controller."/addnew";
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)
                    ->setPath($redirectPath, ['design_id' => $newDesignId]);
    }
}
