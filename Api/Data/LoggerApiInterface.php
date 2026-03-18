<?php

namespace Phong\ApiLogger\Api\Data;

interface LoggerApiInterface
{
    const ID = 'id';
    const METHOD = 'method_rest';
    const ACTION = 'path_action';
    const INPUT = 'input_data';
    const STATUS = 'status';
    const OUTPUT = 'output_response';
    const CREATED_AT = 'created_at';

    /**
     * @return string|null
     */
    public function getId();

    /**
     * @param $id
     * @return LoggerApiInterface
     */
    public function setId($id);

    /**
     * @return string|null
     */
    public function getMethodRest();

    /**
     * @param $method
     * @return LoggerApiInterface
     */
    public function setMethodRest($method);

    /**
     * @return string|null
     */
    public function getPathAction();

    /**
     * @param $path
     * @return LoggerApiInterface
     */
    public function setPathAction($path);

    /**
     * @return string|null
     */
    public function getInputData();

    /**
     * @param $dataInput
     * @return LoggerApiInterface
     */
    public function setInputData($dataInput);

    /**
     * @return string|null
     */
    public function getStatus();

    /**
     * @param $status
     * @return LoggerApiInterface
     */
    public function setStatus($status);

    /**
     * @return string|null
     */
    public function getOutputResponse();

    /**
     * @param $outputResponse
     * @return LoggerApiInterface
     */
    public function setOutputResponse($outputResponse);

    /**
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * @param $createAt
     * @return LoggerApiInterface
     */
    public function setCreatedAt($createAt);
}
