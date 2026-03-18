<?php
namespace Phong\ApiLogger\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class LoggerApi extends AbstractDb
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('phong_logger_api', 'id');
    }
}
