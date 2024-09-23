<?php
namespace Razoyo\CarProfile\Model\ResourceModel\Car;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Razoyo\CarProfile\Model\Car as CarModel;
use Razoyo\CarProfile\Model\ResourceModel\Car as CarResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(CarModel::class, CarResourceModel::class);
    }
}