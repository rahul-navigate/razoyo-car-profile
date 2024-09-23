<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class Car
 * @package Razoyo\CarProfile\Model
 */
class Car extends AbstractModel
{
    /**
     * Car constructor
     */
    protected function _construct()
    {
        $this->_init('Razoyo\CarProfile\Model\ResourceModel\Car');
    }
}