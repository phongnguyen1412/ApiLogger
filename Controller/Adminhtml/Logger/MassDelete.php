<?php

namespace Phong\ApiLogger\Controller\Adminhtml\Logger;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Setup\Exception;
use Phong\ApiLogger\Model\LoggerApiFactory;
use Magento\Framework\Controller\ResultFactory;

class MassDelete extends Action
{
    /**
     * @var LoggerApiFactory
     */
    protected $loggerApiFactory;

    /**
     * MassDelete constructor.
     * @param Action\Context $context
     * @param LoggerApiFactory $loggerApiFactory
     */
    public function __construct(
        Action\Context $context,
        LoggerApiFactory $loggerApiFactory
    ) {
        $this->loggerApiFactory = $loggerApiFactory;
        parent::__construct($context);
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $loggerApiModel = $this->loggerApiFactory->create();
        $connection = $loggerApiModel->getResource()->getConnection();
        $tableName = $loggerApiModel->getResource()->getMainTable();
        try {
            $connection->truncateTable($tableName);
            $this->messageManager->addSuccess(__('All logs have been deleted.'));
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
