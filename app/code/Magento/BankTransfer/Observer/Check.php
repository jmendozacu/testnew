<?php
namespace Magento\BankTransfer\Observer;
use Magento\Framework\Event\ObserverInterface;
class Check implements ObserverInterface
{
	/*public function __construct(
		\Magento\Framework\ObjectManagerInterface $objectManager,
		\Magento\Config\Model\ResourceModel\Config $resourceConfig	
    ) 
    {
		$this->_objectManager = $objectManager;
		$this->resourceConfig = $resourceConfig;
    }*/
	public function execute(\Magento\Framework\Event\Observer $observer)
    {
		$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
		$logger = new \Zend\Log\Logger();
		$logger->addWriter($writer);
		$logger->info('Your text message');
		/*$storeManager =  $this->_objectManager->get('Magento\Store\Model\StoreManagerInterface');
		$storeName= $storeManager->getStore()->getName();
		if($storeName=='Mongolian'){
			$this->resourceConfig->saveConfig('payment/sample_gateway/can_use_checkout', '1', 'default', 0);
		}
		else{
			$this->resourceConfig->saveConfig('payment/sample_gateway/can_use_checkout', '0', 'default', 0);
		}*/
    } 
}
