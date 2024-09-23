<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Block;

use Razoyo\CarProfile\Helper\Data as CarDataHelper;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Serialize\Serializer\Json;
use Razoyo\CarProfile\Model\ResourceModel\Car\CollectionFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Request\Http;

/**
 * Class Cars
 * @package Razoyo\CarProfile\Block
 */
class Cars extends \Magento\Framework\View\Element\Template
{

    /**
     * @var Magento\Framework\Serialize\Serializer\Json
     */
    protected Json $_jsonSerializer;

    /**
     * @var Razoyo\CarProfile\Helper\Data
     */
    protected CarDataHelper $carDataHelper;

    /**
     * @var Razoyo\CarProfile\Model\ResourceModel\Car\CollectionFactory
     */
    protected CollectionFactory $collectionFactory;

    /**
     * @var Magento\Customer\Model\Session
     */
    protected Session $customerSession;

    /**
     * @var Magento\Framework\App\Request\Http
     */
    protected Http $request;

    /**
     * Constructore for Cars block
     * 
     * @param Context $context
     * @param Json $jsonSerializer
     * @param CarDataHelper $carDataHelper
     * @param CollectionFactory $collectionFactory
     * @param Session $customerSession
     * @param Http $request
     */
    public function __construct(
    Context $context,
    Json $jsonSerializer,
    CarDataHelper $carDataHelper,
    CollectionFactory $collectionFactory,
    Session $customerSession,
    Http $request
    )
    {
        $this->carDataHelper = $carDataHelper;
        $this->_jsonSerializer = $jsonSerializer;
        $this->CollectionFactory = $collectionFactory;
        $this->customerSession = $customerSession;
        $this->request = $request;
        parent::__construct($context);
    }

    /**
     * Get car data
     * 
     * @return array
     */
    public function getCarData() : array
    {
        $carsArray = [];
        $carsList = $this->_jsonSerializer->unserialize($this->carDataHelper->getCarData());
        if(!empty($carsList)){
            if(array_key_exists('cars', $carsList)){
                foreach($carsList['cars'] as $car){
               
                    $carsArray[$car['id']] = $car;
                }
               
            }
        }
        return $carsArray;
    }

    /**
     * Get car details
     * 
     * @return mixed
     */
    public function getCarDetails() :mixed
    {
        return $this->_jsonSerializer->serialize($this->getCarData());
    }

    public function getCarCollection($id='')
    {
        $collection = $this->CollectionFactory->create();
        if($id != "")
        {
            $collection->addFieldToFilter('entity_id', $id);
            
        }
       
       $collection->addFieldToFilter('customer_id', $this->getCurrentCustomer());

        return $collection;
    }

    /**
     * Get current customer
     * 
     * @return mixed
     */
    public function getCurrentCustomer()
    {
        return $this->customerSession->getCustomer()->getId();
    }

    public function getCarId()
    {
        return $this->request->getParam('car_id');
    }
}