<?php

namespace Crowdsdom\Client;

use Crowdsdom\Auth;
use GuzzleHttp\HandlerStack;
use Psr\Http\Message\RequestInterface;

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
     * @param string $host
     * @param string $version
     * @param array $guzzleOptions
     */
    public function __construct($host, $version = '', array $guzzleOptions = [])
    {
        $this->host = $host;
        $this->version = $version;

        $this->guzzle = new \GuzzleHttp\Client(array_merge([
            'base_uri' => $host
        ], $guzzleOptions));
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getGuzzle()
    {
        return $this->guzzle;
    }

    /**
     * @param Auth $auth
     * @param string $host
     * @param string $version
     * @param array $guzzleOptions
     * @return Client
     */
    public static function makeByAuth(Auth $auth, $host, $version = '', array $guzzleOptions = [])
    {
        $stack = HandlerStack::create();
        $stack->push($auth->authMiddleware());
        $stack->push(static::versionMiddleware($version));

        return new Client($host, $version, array_merge([
            'handler' => $stack
        ], $guzzleOptions));
    }

    public static function versionMiddleware($version)
    {
        return function (callable $handler) use ($version) {
            return function (RequestInterface $request, array $options) use ($handler, $version) {
                $prefix = $version ? "/$version" : '';
                $uri = $request->getUri();
                $uri = $uri->withPath($prefix . $uri->getPath());
                $request = $request->withUri($uri);
                return $handler($request, $options);
            };
        };
    }

}
