<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Controller\Customer;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Razoyo\CarProfile\Helper\Data as CarDataHelper;

/**
 * Class Mycar
 * @package Razoyo\CarProfile\Controller\Customer
 */
class Mycar extends Action
{
    /**
     * @var Razoyo\CarProfile\Helper\Data
     */
    protected CarDataHelper $carDataHelper;

    /**
     * Constructor for Mycar controller
     * 
     * @param Context $context
     * @param CarDataHelper $carDataHelper
     */
    public function __construct(Context $context, CarDataHelper $carDataHelper)
    {
        parent::__construct($context);
        $this->carDataHelper = $carDataHelper;
    }

    /**
     * Execute function for Mycar controller
     * 
     * @return void
     */
    public function execute()
    {
        $this->_view->loadLayout();  
        $this->_view->renderLayout();
    }
}