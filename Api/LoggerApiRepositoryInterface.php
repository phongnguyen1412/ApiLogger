<?php

namespace Phong\ApiLogger\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Phong\ApiLogger\Api\Data\LoggerApiInterface;
use Phong\ApiLogger\Api\Data\LoggerApiSearchResultsInterface;

interface LoggerApiRepositoryInterface
{
    /**
     * @param LoggerApiInterface $loggerApi
     * @return LoggerApiInterface
     * @throws LocalizedException
     */
    public function save(LoggerApiInterface $loggerApi);

    /**
     * @param $loggerId
     * @return LoggerApiInterface
     * @throws LocalizedException
     */
    public function getById($loggerId);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return LoggerApiSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param LoggerApiInterface $loggerApi
     * @return boolean
     * @throws LocalizedException
     */
    public function delete(LoggerApiInterface $loggerApi);

    /**
     * @param $loggerId
     * @return boolean
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($loggerId);
}
