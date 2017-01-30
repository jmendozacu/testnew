<?php
namespace Tailored\LocationBasedStore\Observer;
use \Magento\Framework\Event\Observer;
use \Magento\Framework\Event\ObserverInterface;

class Redirect implements ObserverInterface
{
     protected $_responseFactory;
     protected $_url;
     protected $request;
     protected $_resultFactory;
     protected $_cookieManager;
     protected $_cookieMetadataFactory;

     public function __construct(
          \Magento\Framework\App\ResponseFactory $responseFactory,
          \Magento\Framework\UrlInterface $url,
          \Magento\Framework\App\Request\Http $request,
          \Magento\Framework\Controller\ResultFactory $resultFactory,
          \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
          \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory,
          \Magento\Framework\ObjectManagerInterface $objectManager,
          \Magento\Framework\App\Response\RedirectInterface $redirect,
          \Magento\Framework\App\ActionFlag $actionFlag
    ) {
          $this->_responseFactory = $responseFactory;
          $this->_url = $url;
          $this->request = $request;
          $this->_resultFactory = $resultFactory;
          $this->_cookieManager = $cookieManager;
          $this->_cookieMetadataFactory = $cookieMetadataFactory;
          $this->_objectManager = $objectManager;
           $this->redirect = $redirect;
          $this->actionFlag = $actionFlag;
    }
    public function execute(Observer $observer)
    {
          $event = $observer->getEvent();
          //'202.9.47.35';
          $ip='180.235.160.0';
          $url ='http://www.geoplugin.net/php.gp?ip='.$ip;
          $userLocation = unserialize(file_get_contents($url));
          $storeManager =  $this->_objectManager->get('Magento\Store\Model\StoreManagerInterface');
          $storeName= $storeManager->getStore()->getName();
          $metadata = $this->_cookieMetadataFactory->createPublicCookieMetadata()
          ->setPath('/');
          $this->_cookieManager->setPublicCookie('c',$storeName,$metadata);
          $c =  $this->_cookieManager->getCookie('c');
          $om = \Magento\Framework\App\ObjectManager::getInstance();
          $app_state = $om->get('\Magento\Framework\App\State');
          $area_code = $app_state->getAreaCode();
          if($area_code != \Magento\Backend\App\Area\FrontNameResolver::AREA_CODE)
          {
               if($userLocation['geoplugin_countryName']=='Mongolia')
               {
                    if(!isset($c)){
                     // header('Location: '.$this->_url->getCurrentUrl().'?___store=mn');

                        /* $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                         $resultRedirect->setUrl($this->_url->getCurrentUrl().'?___store=mn'); */

                   $controller = $observer->getControllerAction();

                   $this->actionFlag->set('', \Magento\Framework\App\Action\Action::FLAG_NO_DISPATCH, true);
                   $this->redirect->redirect($controller->getResponse(),$this->_url->getCurrentUrl().'?___store=mn');
                    }
               }
          }
     }
}