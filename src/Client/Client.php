<?php

namespace Crowdsdom\Client;

/**
 * Class Client
 * @package Crowdsdom\Client
 */
class Client
{

    /**
     * @var string
     */
    protected $host;

    /**
     * @var string
     */
    protected $version;

    /**
     * Client constructor.
     * @param $host
     * @param $version
     * @param array $guzzleOptions
     */
    public function __construct($host, $version = '', array $guzzleOptions = [])
    {
        $this->host = $host;
        $this->version = $version;

        $this->guzzle = new \GuzzleHttp\Client(array_merge([
            'base_uri' => $host . ($version ? "/$version" : '')
        ], $guzzleOptions));
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getGuzzle()
    {
        return $this->guzzle;
    }

}
