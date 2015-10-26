<?php

namespace Crowdsdom;

class Crowdsdom
{

    const DEFAULT_AUTH_HOST = 'https://account.crowdsdom.com';
    const DEFAULT_API_HOST = 'https://api.crowdsdom.com';

    /**
     * @var string
     */
    protected $authHost;

    /**
     * @var string
     */
    protected $apiHost;

    /**
     * Crowdsdom constructor.
     * @param string $authHost
     * @param string $apiHost
     */
    public function __construct(
        $authHost = self::DEFAULT_AUTH_HOST,
        $apiHost = self::DEFAULT_API_HOST
    ) {
        $this->authHost = $authHost;
        $this->apiHost = $apiHost;
    }
}