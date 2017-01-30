<?php
namespace Magento\SamplePaymentGateway\Observer;
use Magento\Framework\Event\ObserverInterface;
class Checkstore implements ObserverInterface
{
	public function __construct(
		\Magento\Framework\ObjectManagerInterface $objectManager,
		\Magento\Config\Model\ResourceModel\Config $resourceConfig	
    ) 
    {
		$this->_objectManager = $objectManager;
		$this->resourceConfig = $resourceConfig;
    }
	public function execute(\Magento\Framework\Event\Observer $observer)
    {
		$storeManager =  $this->_objectManager->get('Magento\Store\Model\StoreManagerInterface');
		$storeName= $storeManager->getStore()->getName();
		if($storeName=='Mongolian'){
			$this->resourceConfig->saveConfig('payment/sample_gateway/can_use_checkout', '1', 'default', 0);
		}
		else{
			$this->resourceConfig->saveConfig('payment/sample_gateway/can_use_checkout', '0', 'default', 0);
		}
    } 
}
