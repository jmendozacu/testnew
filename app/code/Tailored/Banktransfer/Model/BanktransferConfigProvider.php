<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Tailored\Banktransfer\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\Escaper;
use Magento\Payment\Helper\Data as PaymentHelper;

class BanktransferConfigProvider implements ConfigProviderInterface
{
    /**
     * @var string[]
     */
    protected $methodCode = Banktransfer::PAYMENT_METHOD_BANKTRANSFER_CODE;
    const PAGES = 'payment/banktransfer/pages';
     const SRC = 'payment/banktransfer/upload_image_id';
    /**
     * @var Checkmo
     */
    protected $method;

    /**
     * @var Escaper
     */
    protected $escaper;
     protected $scopeConfig;
  
    /**
     * @param PaymentHelper $paymentHelper
     * @param Escaper $escaper
     */
     
    public function __construct(PaymentHelper $paymentHelper,Escaper $escaper,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,\Magento\Framework\App\Filesystem\DirectoryList $directory_list,\Magento\Framework\UrlInterface $url
    ) {
        $this->escaper = $escaper;
        $this->method = $paymentHelper->getMethodInstance($this->methodCode);
        $this->scopeConfig = $scopeConfig;
        $this->directory_list = $directory_list;
        $this->_url = $url;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->method->isAvailable() ? [
            'payment' => [
                'banktransfer' => [
                    'url' => $this->geturl(),
                    'paymentAcceptanceMarkSrc' =>$this->_url->getUrl().'pub/media/Paymentlogo/'.$this->scopeConfig->getValue(self::SRC, $storeScope),
                 
                ],
            ],
        ] : [];
    }

    /**
     * Get mailing address from config
     *
     * @return string
     */
    public function geturl()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $pg=$this->scopeConfig->getValue(self::PAGES, $storeScope);
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $cmsPage = $objectManager->get('Magento\Cms\Model\Page')->load($pg);
        return $cmsPage->getIdentifier();
    }
}
