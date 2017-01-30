<?php

/**
 * Cybage Multifilter Layered Navigation Plugin
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * It is available on the World Wide Web at:
 * http://opensource.org/licenses/osl-3.0.php
 * If you are unable to access it on the World Wide Web, please send an email
 * To: Support_ecom@cybage.com.  We will send you a copy of the source file.
 *
 * @category   Multifilter Layered Navigation Plugin
 * @package    Cybage_Multifilter
 * @copyright  Copyright (c) 2014 Cybage Software Pvt. Ltd., India
 *             http://www.cybage.com/pages/centers-of-excellence/ecommerce/ecommerce.aspx
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author     Cybage Software Pvt. Ltd. <Support_ecom@cybage.com>
 */

namespace Tailored\LocationBasedStore\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_publicIp;
    /*protected $_userLocation;
    protected $_viewStoreCode;
    protected $_allowStores = array('SE','en','nb','DE');
    protected $_defaultArray = array(
        '1'=>'en',
        '2'=>'fr',
        '3'=>'ge',
        '4'=>'da',
        '5'=>'fi',
        '6'=>'es',
        '7'=>'sv',
        '8'=>'nb',
        );
*/
    /**
     * Retrieve User Public ip address
     *
     * @return $_publicIp
     */
    public function getPublicIp(){

        // $externalContent = file_get_contents('http://checkip.dyndns.com/');



        // preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);

        // $this->_publicIp = $m[1];

        // return $this->_publicIp;

        $this->_publicIp = $_SERVER['REMOTE_ADDR'];
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info( $this->_publicIp);
        return $this->_publicIp;
    }

    /**
     * Retrieve User location based on ip
     *
     * @param  $ip
     * @return $_userLocation
     */
    public function getUserLocation($ip){

        $url = 'http://www.geoplugin.net/php.gp?ip='.$ip;

        $this->_userLocation = unserialize(file_get_contents($url));

        return $this->_userLocation;
    }


    /**
     * Retrieve User country code from location
     *
     * @param $location Array
     * @return country code
     */
    public function getCountryCode($location){

        return isset($location['geoplugin_countryCode']) ? $location['geoplugin_countryCode'] : '' ;
    }


    /**
     * Retrieve country associated to store
     *
     * @param $code
     * @return countries
     */
    public function getCountryFromStoreCode($code){

        $string = 'location_configuration/location_'.$code.'/country';
        Mage::log($string,null,'sstore.log');
        $countries = Mage::getStoreConfig($string);

        return explode(',', $countries);
    }


    /**
     * Return Default Store Code if no store found
     *
     * @return Default store code
     */
   /* public function getDefaultStoreCode(){

        $storeCode = Mage::getStoreConfig('location_configuration/location_general/default_store');
        return $this->_defaultArray[$storeCode];
    }*/


    /**
     * Retrieve store code by country
     *
     * @param $countryCode
     * @return store code
     */
   /* public function getStoreCode($countryCode){


        foreach ($this->_allowStores as $index => $store) {

            $countries_array = $this->getCountryFromStoreCode($store);
            Mage::log('store: '.$store,null,'sstore.log');
            Mage::log($countries_array,null,'sstore.log');
            if(in_array($countryCode, $countries_array)){


                $this->_viewStoreCode = $store;

                break;
            }
        }*/

       /* if($this->_viewStoreCode != ''){
            Mage::log('if',null,'sstore.log');
            return $this->_viewStoreCode;
        }
        else{
            Mage::log('else',null,'sstore.log');
            return $this->getDefaultStoreCode();

        }*/

}