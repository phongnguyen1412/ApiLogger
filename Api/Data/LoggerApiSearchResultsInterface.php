<?php

namespace Phong\ApiLogger\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface LoggerApiSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return LoggerApiInterface[]
     */
    public function getItems();

    /**
     * @param LoggerApiInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
