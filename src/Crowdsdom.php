<?php

namespace Crowdsdom;

use Crowdsdom\Client\Client;

class Crowdsdom
{

    const DEFAULT_AUTH_HOST = 'https://account.crowdsdom.com';
    const DEFAULT_API_HOST = 'https://api.crowdsdom.com';
    const DEFAULT_API_VERSION = 'v1';

    /**
     * @var string
     */
    protected $authHost;

    /**
     * @var string
     */
    protected $apiHost;

    /**
     * @var string
     */
    protected $apiVersion;

    /**
     * @var Client
     */
    protected $apiClient;

    /**
     * @var Auth
     */
    protected $auth;

    /**
     * @var Labor
     */
    protected $labor;

    /**
     * Crowdsdom constructor.
     * @param string $authHost
     * @param string $apiHost
     * @param string $apiVersion
     */
    public function __construct(
        $clientId,
        $clientSecret,
        $authHost = self::DEFAULT_AUTH_HOST,
        $apiHost = self::DEFAULT_API_HOST,
        $apiVersion = self::DEFAULT_API_VERSION
    ) {
        $this->authHost = $authHost;
        $this->apiHost = $apiHost;
        $this->apiVersion = $apiVersion;

        $this->auth = new Auth($this->authHost, $clientId, $clientSecret);
        $this->apiClient = new Client($this->auth, $this->apiHost, $this->apiVersion);
    }

    public function labor()
    {
        if (!isset($this->labor)) {
            $this->labor = new Labor($this->apiClient);
        }
        return $this->labor;
    }

}