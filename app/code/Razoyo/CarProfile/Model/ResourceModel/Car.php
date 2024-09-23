<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Car
 * @package Razoyo\CarProfile\Model\ResourceModel
 */
class Car extends AbstractDb
{
    /**
     * Car constructor
     */
    protected function _construct()
    {
        $this->_init('razoyo_car_profile', 'entity_id');
    }
}