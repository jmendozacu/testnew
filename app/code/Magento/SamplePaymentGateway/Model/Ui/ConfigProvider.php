<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\SamplePaymentGateway\Model\Ui;
use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\SamplePaymentGateway\Gateway\Http\Client\ClientMock;

final class ConfigProvider implements ConfigProviderInterface
{
    const CODE = 'sample_gateway';
    protected $method;
    /**
     * Retrieve assoc array of checkout configuration
     *
     * @return array
     */
    const SRC = 'payment/sample_gateway/upload_image_id';

    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,\Magento\Framework\App\Filesystem\DirectoryList $directory_list,\Magento\Framework\UrlInterface $url)
    {
        $this->scopeConfig = $scopeConfig;
        $this->directory_list = $directory_list;
        $this->_url = $url;
    }
    public function getConfig()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $config =[
            'payment' => [
                self::CODE => [
                    'transactionResults' => [
                        ClientMock::SUCCESS => __('Success'),
                        ClientMock::FAILURE => __('Fraud')
                    ],
                    'paymentAcceptanceMarkSrc' =>$this->_url->getUrl().'pub/media/Paymentlogo/'.$this->scopeConfig->getValue(self::SRC, $storeScope)
                ]
            ]
        ];
        $config['payment']['sample_gateway']['redirectUrl']['sample_gateway']='/contact';
        return $config;
    }
     
}
