<?php
// @codingStandardsIgnoreFile

namespace Phong\ApiLogger\Model\ResourceModel\LoggerApi;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Phong\ApiLogger\Model\LoggerApi;

class Collection extends AbstractCollection
{
    /**
     * Define resource model
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            LoggerApi::class,
            \Phong\ApiLogger\Model\ResourceModel\LoggerApi::class
        );
    }
}
