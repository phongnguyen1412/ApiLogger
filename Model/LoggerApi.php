<?php

namespace Phong\ApiLogger\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Phong\ApiLogger\Api\Data\LoggerApiInterface;
use Phong\ApiLogger\Api\Data\LoggerApiInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Phong\ApiLogger\Model\ResourceModel\LoggerApi\Collection;

class LoggerApi extends AbstractModel
{
    public const CACHE_TAG = 'phong_logger_api';
    
    /**
     * @var string
     */
    protected $_eventPrefix = 'phong_logger_api';
    
    /**
     * @var LoggerApiInterfaceFactory
     */
    protected $loggerApiFactory;
    
    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * LoggerApi constructor.
     * @param Context $context
     * @param DataObjectHelper $dataObjectHelper
     * @param Registry $registry
     * @param LoggerApiInterfaceFactory $loggerApiInterfaceFactory
     * @param ResourceModel\LoggerApi $resource
     * @param ResourceModel\LoggerApi\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        DataObjectHelper $dataObjectHelper,
        Registry $registry,
        LoggerApiInterfaceFactory $loggerApiInterfaceFactory,
        ResourceModel\LoggerApi $resource,
        Collection $resourceCollection,
        array $data = []
    ) {
        $this->loggerApiFactory= $loggerApiInterfaceFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Get additional_data
     */
    public function getDataModel()
    {
        $idData = $this->getData();
        $idDataObject = $this->loggerApiFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $idDataObject,
            $idData,
            LoggerApiInterface::class
        );
        return $idDataObject;
    }
}
