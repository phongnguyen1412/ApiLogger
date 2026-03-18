<?php

namespace Phong\ApiLogger\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\RequestInterface;
use Phong\ApiLogger\Api\Data\LoggerApiInterfaceFactory;
use Phong\ApiLogger\Api\LoggerApiRepositoryInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class SaveLoggerApi extends AbstractHelper
{
    /**
     * @var array
     */
    protected $dataArrayRest = [];

    /**
     * @var LoggerApiInterfaceFactory
     */
    protected $loggerApiFactory;

    /**
     * @var LoggerApiRepositoryInterface
     */
    protected $loggerApiRepository;

    /** @var RequestInterface  */
    protected $requestInterface;

    const ENABLE_MODULE_LOGGER = 'logger/general/enable';

    /**
     * SaveLoggerApi constructor.
     * @param Context $context
     * @param LoggerApiInterfaceFactory $loggerApiInterfaceFactory
     * @param LoggerApiRepositoryInterface $loggerApiRepository
     */
    public function __construct(
        Context $context,
        LoggerApiInterfaceFactory $loggerApiInterfaceFactory,
        LoggerApiRepositoryInterface $loggerApiRepository
    ) {
        $this->loggerApiFactory= $loggerApiInterfaceFactory;
        $this->loggerApiRepository = $loggerApiRepository;
        parent::__construct($context);
    }

    /**
     * @param \Magento\Webapi\Controller\Rest $request
     * @return array
     */
    public function dataRequestApi($request)
    {
        $this->dataArrayRest['method'] = $request->getMethod();
        $this->dataArrayRest['path'] = $request->getPathInfo();
        $this->dataArrayRest['content'] = $request->getContent();
        return $this->dataArrayRest;
    }

    /**
     * @param $response
     * @param $enableConfig
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function saveDataResponseApi($response, $enableConfig)
    {
        if ($enableConfig == 1) {
            $arrayDataResponse = $this->dataArrayRest;
            $arrayDataResponseStatus = $response->getStatusCode();
            $arrayDataResponseBody = $response->getBody();

            $loggerData = $this->loggerApiFactory->create();
            $loggerData->setMethodRest($arrayDataResponse['method']);
            $loggerData->setPathAction($arrayDataResponse['path']);
            $loggerData->setInputData($arrayDataResponse['content']);
            $loggerData->setStatus($arrayDataResponseStatus);
            $loggerData->setOutputResponse($arrayDataResponseBody);
            $this->loggerApiRepository->save($loggerData);
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function getIsEnable()
    {
        $scopeStore = ScopeInterface::SCOPE_STORE;
        return (bool)$this->scopeConfig->getValue(self::ENABLE_MODULE_LOGGER, $scopeStore);
    }
}
