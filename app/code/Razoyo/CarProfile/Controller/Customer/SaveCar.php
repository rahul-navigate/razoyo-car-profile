<?php
namespace Razoyo\CarProfile\Controller\Customer;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Razoyo\CarProfile\Model\CarFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
use Razoyo\CarProfile\Model\ResourceModel\Car\CollectionFactory;
use Magento\Customer\Model\Session;


/**
 * Class SaveCar
 * @package Razoyo\CarProfile\Controller\Customer
 */
class SaveCar extends Action
{
    /**
     * @var  PageFactory
     */
    protected PageFactory $resultPageFactory;
    
    /**
     * @var CarFactory
     */
    protected CarFactory $carFactory;

    /**
     * @var Razoyo\CarProfile\Model\ResourceModel\Car\CollectionFactory
     */
    protected CollectionFactory $collectionFactory;

    /**
     * @var Magento\Customer\Model\Session
     */
    protected Session $customerSession;

    
    /**
     * Constructor for SaveCar controller
     * 
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param CarFactory $carFactory
     * @param CollectionFactory $collectionFactory
     * @param Session $customerSession
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        CarFactory $carFactory,
        CollectionFactory $collectionFactory,
        Session $customerSession
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->carFactory = $carFactory;
        $this->collectionFactory = $collectionFactory;
        $this->customerSession = $customerSession;
        parent::__construct($context);
    }

    /**
     * Execute function for SaveCar controller
     * 
     * @return void
     */
    public function execute()
    {
        try {

            $delete = $this->getRequest()->getParam('did');
            if(!empty($delete))
            {
                $model = $this->carFactory->create();
                $model->load($delete);
                $model->delete();
                $this->messageManager->addSuccessMessage(__("Car Deleted Successfully."));
                $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                $resultRedirect->setUrl($this->_redirect->getRefererUrl());
                return $resultRedirect;
            }
            $data = (array)$this->getRequest()->getPost();
            if ($data) {

                $model = $this->carFactory->create();
                if($data['car_enid'] != '' || $data['car_enid'] != null || $data['car_enid'] != 0) 
                {
                    $model->load($data['car_enid']);
                }
                
                $model->setCarId($data['car_id']);
                $model->setCarMake($data['make']);
                $model->setCarModel($data['car_model']);
                $model->setCarYear($data['year']);
                $model->setImage($data['image']);
                $model->setCustomerId($this->customerSession->getCustomer()->getId());
                $model->save();
                $this->messageManager->addSuccessMessage(__("Car Saved Successfully."));
            }
        } catch (\Exception $e) {
           $this->messageManager->addErrorMessage($e->getMessage());
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}