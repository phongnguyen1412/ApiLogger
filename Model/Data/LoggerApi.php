<?php

namespace Phong\ApiLogger\Model\Data;

use Magento\Framework\Api\AbstractExtensibleObject;
use Phong\ApiLogger\Api\Data\LoggerApiInterface;

class LoggerApi extends AbstractExtensibleObject implements LoggerApiInterface
{

    /**
     * @return string|null
     */
    public function getMethodRest()
    {
        return $this->_get(self::METHOD);
    }

    /**
     * @param $method
     * @return LoggerApiInterface
     */
    public function setMethodRest($method)
    {
        return $this->setData(self::METHOD, $method);
    }

    /**
     * @return string|null
     */
    public function getPathAction()
    {
        return $this->_get(self::ACTION);
    }

    /**
     * @param $path
     * @return LoggerApiInterface
     */
    public function setPathAction($path)
    {
        return $this->setData(self::ACTION, $path);
    }

    /**
     * @return string|null
     */
    public function getInputData()
    {
        return $this->_get(self::INPUT);
    }

    /**
     * @param $dataInput
     * @return LoggerApiInterface
     */
    public function setInputData($dataInput)
    {
        return $this->setData(self::INPUT, $dataInput);
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->_get(self::STATUS);
    }

    /**
     * @param $status
     * @return LoggerApiInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * @return string|null
     */
    public function getOutputResponse()
    {
        return $this->_get(self::OUTPUT);
    }

    /**
     * @param $outputResponse
     * @return LoggerApiInterface
     */
    public function setOutputResponse($outputResponse)
    {
        return $this->setData(self::OUTPUT, $outputResponse);
    }

    /**
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->_get(self::CREATED_AT);
    }

    /**
     * @param $createAt
     * @return LoggerApiInterface
     */
    public function setCreatedAt($createAt)
    {
        return $this->setData(self::CREATED_AT, $createAt);
    }

    /**
     * @return string|null
     */
    public function getId()
    {
        return $this->_get(self::ID);
    }

    /**
     * @param $id
     * @return LoggerApiInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }
}
