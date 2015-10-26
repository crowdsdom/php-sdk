<?php

namespace Crowdsdom;

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
     * Crowdsdom constructor.
     * @param string $authHost
     * @param string $apiHost
     * @param string $apiVersion
     */
    public function __construct(
        $authHost = self::DEFAULT_AUTH_HOST,
        $apiHost = self::DEFAULT_API_HOST,
        $apiVersion = self::DEFAULT_API_VERSION
    ) {
        $this->authHost = $authHost;
        $this->apiHost = $apiHost;
        $this->apiVersion = $apiVersion;
    }
}