<?php

namespace Phong\ApiLogger\Plugin;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Webapi\Rest\Response;
use Magento\Webapi\Controller\Rest;
use Phong\ApiLogger\Helper\SaveLoggerApi;
use Psr\Log\LoggerInterface;

class ApiLogger
{
    /** @var LoggerInterface */
    protected $logger;
    
    /**
     * @var SaveLoggerApi
     */
    protected $saveLoggerApi;
    
    /**
     * ApiLogger constructor.
     * @param LoggerInterface $logger
     * @param SaveLoggerApi $saveLoggerApi
     */
    public function __construct(
        LoggerInterface $logger,
        SaveLoggerApi   $saveLoggerApi
    ) {
        $this->logger = $logger;
        $this->saveLoggerApi = $saveLoggerApi;
    }
    
    /**
     * @param Rest $subject
     * @param RequestInterface $request
     */
    public function beforeDispatch(Rest $subject, RequestInterface $request) {
        $this->logger->info('SOURCE: ' . $request->getClientIp());
        $this->logger->info('METHOD: ' . $request->getMethod());
        $this->logger->info('PATH: ' . $request->getPathInfo());
        $this->logger->info('CONTENT: ' . PHP_EOL . $request->getContent() . PHP_EOL);
        $this->saveLoggerApi->dataRequestApi($request);
    }
    
    /**
     * @param Response $subject
     * @param $result
     * @return mixed
     * @throws LocalizedException
     */
    public function afterSendResponse(Response $subject, $result) {
        $this->logger->info('STATUS: ' . $subject->getStatusCode());
        $this->logger->info('RESPONSE: ' . PHP_EOL . $subject->getBody() . PHP_EOL);
        $dataConfig = $this->saveLoggerApi->getIsEnable();
        $this->saveLoggerApi->saveDataResponseApi($subject, $dataConfig);
        return $result;
    }
}
