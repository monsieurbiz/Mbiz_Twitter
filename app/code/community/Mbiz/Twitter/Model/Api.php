<?php
/**
 * This file is part of Mbiz_Twitter for Magento.
 *
 * @license GPL-3.0
 * @author Jacques Bodin-Hullin <@jacquesbh> <j.bodinhullin@monsieurbiz.com> <@jacquesbh>
 * @category Mbiz
 * @package Mbiz_Twitter
 * @copyright Copyright (c) 2016 Monsieur Biz (http://monsieurbiz.com/)
 */

/**
 * Api Model
 * @package Mbiz_Twitter
 */
class Mbiz_Twitter_Model_Api extends Mage_Core_Model_Abstract
{

    /**
     * Oauth access token config path
     * @const XML_CONFIG_OAUTH_ACCESS_TOKEN string
     */
    const XML_CONFIG_OAUTH_ACCESS_TOKEN = 'mbiz_twitter/general/oauth_access_token';

    /**
     * Oauth access token secret config path
     * @const XML_CONFIG_OAUTH_ACCESS_TOKEN_SECRET string
     */
    const XML_CONFIG_OAUTH_ACCESS_TOKEN_SECRET = 'mbiz_twitter/general/oauth_access_token_secret';

    /**
     * Consumer key config path
     * @const XML_CONFIG_CONSUMER_KEY string
     */
    const XML_CONFIG_CONSUMER_KEY = 'mbiz_twitter/general/consumer_key';

    /**
     * Consumer secret config path
     * @const XML_CONFIG_CONSUMER_SECRET string
     */
    const XML_CONFIG_CONSUMER_SECRET = 'mbiz_twitter/general/consumer_secret';

// Monsieur Biz Tag NEW_CONST

    protected $_settings;

// Monsieur Biz Tag NEW_VAR

    protected function _construct()
    {
        parent::_construct();

        // Init the settings
        $this->_settings = [
            'oauth_access_token'        => Mage::getStoreConfig('mbiz_twitter/general/oauth_access_token'),
            'oauth_access_token_secret' => Mage::getStoreConfig('mbiz_twitter/general/oauth_access_token_secret'),
            'consumer_key'              => Mage::getStoreConfig('mbiz_twitter/general/consumer_key'),
            'consumer_secret'           => Mage::getStoreConfig('mbiz_twitter/general/consumer_secret'),
        ];
    }

    /**
     * Make a call
     * @param string $httpMethod GET|POST
     * @param string $apiAction
     * @param array $params
     * @return object JSON response
     */
    protected function _call($httpMethod, $apiAction, $params = [])
    {
        $httpMethod = strtoupper($httpMethod);
        $url = 'https://api.twitter.com/1.1/' . $apiAction . '.json';
        $twitter = new TwitterAPIExchange($this->_settings);

        switch ($httpMethod) {
            case 'GET':
                $twitter->setGetfield('?' . http_build_query($params));
                break;
            case 'POST':
                $twitter->setPostfields($params);
                break;
        }

        $response = $twitter
            ->buildOauth($url, $httpMethod)
            ->performRequest()
        ;

        return json_decode($response);
    }

    /**
     * Tweet a message
     * @param string $message
     * @return $this
     * @see https://dev.twitter.com/rest/reference/post/statuses/update
     */
    public function tweet($message)
    {
        return $this->_call('POST', 'statuses/update', [
            'status' => $message,
        ]);
    }

// Monsieur Biz Tag NEW_METHOD

}