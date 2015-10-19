<?php

namespace Crowdsdom\Client;

use GuzzleHttp\Client as GuzzleClient;

/**
 * Class Client
 * @package Crowdsdom\Client
 */
class Client
{

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var string
     */
    protected $authHost;

    /**
     * @var string
     */
    protected $apiHost;

    /**
     * @var GuzzleClient
     */
    protected $guzzle;

    /**
     * Client constructor.
     * @param string $clientId
     * @param string $clientSecret
     * @param string $version
     * @param string $authHost
     * @param string $apiHost
     */
    public function __construct(
        $clientId,
        $clientSecret,
        $version = '',
        $authHost = 'http://account.crowdsdom.com',
        $apiHost = 'https://developer.crowdsdom.com'
    ) {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->version = $version;
        $this->authHost = $authHost;
        $this->apiHost = $apiHost;

        $this->guzzle = new GuzzleClient([
            'base_uri' => $apiHost
        ]);
    }

    /**
     * @return string
     */
    public function getAuthHost()
    {
        return $this->authHost;
    }

    /**
     * @return string
     */
    public function getApiHost()
    {
        return $this->apiHost;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }
}
