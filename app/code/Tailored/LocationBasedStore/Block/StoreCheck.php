<?php
namespace Tailored\LocationBasedStore\Block;

/**
* Baz block
*/
class StoreCheck extends \Magento\Framework\View\Element\Template
{
   
	public function __construct(
         
          /*\Magento\Framework\ObjectManagerInterface $objectManager,
          \Magento\Framework\App\Response\RedirectInterface $redirect,
          \Magento\Framework\App\ActionFlag $actionFlag*/
    ) {
          
         /* $this->_objectManager = $objectManager;
           $this->redirect = $redirect;
          $this->actionFlag = $actionFlag;*/
    }
	public function checkstore()
    {
      	 /*$storeManager =  $this->_objectManager->get('Magento\Store\Model\StoreManagerInterface');
          $storeName= $storeManager->getStore()->getName();
          return $storeName;*/
    }
}