<?php

namespace Phong\ApiLogger\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Phong\ApiLogger\Api\Data\LoggerApiInterface;
use Phong\ApiLogger\Api\Data\LoggerApiSearchResultsInterfaceFactory;
use Phong\ApiLogger\Api\LoggerApiRepositoryInterface;
use Phong\ApiLogger\Api\Data\LoggerApiInterfaceFactory;
use Phong\ApiLogger\Model\LoggerApiFactory;
use Phong\ApiLogger\Model\ResourceModel\LoggerApi as ResourceLoggerApi;
use Phong\ApiLogger\Model\ResourceModel\LoggerApi\CollectionFactory as LoggerCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\ExtensibleDataObjectConverter;

class LoggerApiRepository implements LoggerApiRepositoryInterface
{
    /** @var ResourceLoggerApi  */
    protected $resourceLoggerApi;

    /** @var LoggerCollectionFactory  */
    protected $loggerCollectionFactory;

    /** @var LoggerApiSearchResultsInterfaceFactory  */
    protected $searchResultsFactory;

    protected $loggerApiFactory;
    protected $dataObjectHelper;
    protected $loggerApiInterfaceFactory;
    protected $dataObjectProcessor;
    protected $storeManager;
    protected $collectionProcessor;
    protected $extensionAttributesJoinProcessor;
    protected $extensibleDataObjectConverter;


    /**
     * @param ResourceLoggerApi $resourceLoggerApi
     * @param LoggerApiFactory $loggerApiFactory
     * @param LoggerApiInterfaceFactory $loggerApiInterfaceFactory
     * @param LoggerCollectionFactory $collectionFactory
     * @param LoggerApiSearchResultsInterfaceFactory $searchResultsInterfaceFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceLoggerApi $resourceLoggerApi,
        LoggerApiFactory $loggerApiFactory,
        LoggerApiInterfaceFactory $loggerApiInterfaceFactory,
        LoggerCollectionFactory $collectionFactory,
        LoggerApiSearchResultsInterfaceFactory $searchResultsInterfaceFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resourceLoggerApi = $resourceLoggerApi;
        $this->loggerApiFactory = $loggerApiFactory;
        $this->loggerCollectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsInterfaceFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->loggerApiInterfaceFactory = $loggerApiInterfaceFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * @param LoggerApiInterface $loggerApi
     * @return
     * @throws CouldNotSaveException
     */
    public function save(LoggerApiInterface $loggerApi)
    {
        /* if (empty($id->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $id->setStoreId($storeId);
        } */
        $loggerApiData = $this->extensibleDataObjectConverter->toNestedArray(
            $loggerApi,
            [],
            LoggerApiInterface::class
        );
        $loggerApiModel = $this->loggerApiFactory->create()->setData($loggerApiData);
        try {
            $this->resourceLoggerApi->save($loggerApiModel);
        } catch (\Exception $exception) {
            throw new  CouldNotSaveException(__(
                'Could not save the logger: $1',
                $exception->getMessage()
            ));
        }
        return $loggerApiModel->getDataModel();
    }

    /**
     * @param $loggerId
     * @return LoggerApiInterface
     * @throws LocalizedException
     */
    public function getById($loggerId)
    {
        $loggerApiModel = $this->loggerApiFactory->create();
        $this->resourceLoggerApi->load($loggerApiModel, $loggerId);
        if (!$loggerApiModel->getId()) {
            throw new NoSuchEntityException(__('Logger with id "%1" does not exist.', $loggerId));
        }
        return $loggerApiModel;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Phong\ApiLogger\Api\Data\LoggerApiSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->loggerCollectionFactory->create();
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            LoggerApiInterface::class
        );
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResult = $this->searchResultsFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        $searchResult->setItems($items);
        $searchResult->setTotalCount($collection->getSize());

        return $searchResult;
    }

    /**
     * @param LoggerApiInterface $loggerApi
     * @return boolean
     * @throws LocalizedException
     */
    public function delete(LoggerApiInterface $loggerApi)
    {
        try {
            $loggerModel = $this->loggerApiFactory->create();
            $this->resourceLoggerApi->load($loggerModel, $loggerApi->getId());
            $this->resourceLoggerApi->delete($loggerModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Log: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @param $loggerId
     * @return boolean
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($loggerId)
    {
        return $this->delete($this->getById($loggerId));
    }
}
