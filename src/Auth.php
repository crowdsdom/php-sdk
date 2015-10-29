<?php

namespace Crowdsdom;

use Crowdsdom\Client\Exceptions\AuthException;
use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\RequestInterface;

/**
 * Class Auth
 * @package Crowdsdom\Client
 */
class Auth
{

    const ENDPOINT = '/oauth/token';
    const GRANT_TYPE = 'client_credentials';

    /**
     * @var string
     */
    protected $host;

    /**
     * TODO: adapt an oauth2 library
     * @var array
     */
    protected $accessToken;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * Auth constructor.
     * @param string $host
     * @param string $clientId
     * @param string $clientSecret
     */
    public function __construct($host, $clientId, $clientSecret)
    {
        $this->host = $host;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }


    public function getAccessToken()
    {
        // lazy load
        if (!isset($this->accessToken)) {
            $guzzle = new GuzzleClient([
                'verify' => !getenv('CROWDSDOM_TESTING')
            ]);
            $response = $guzzle->request('POST', $this->host . self::ENDPOINT, [
                'json' => [
                    'grant_type' => self::GRANT_TYPE,
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                ]
            ]);

            if ($response->getStatusCode() !== 200) {
                throw AuthException::make($response);
            }

            $this->accessToken = json_decode($response->getBody()->getContents(), true);
        }

        return $this->accessToken;
    }

    public function authMiddleware()
    {
        $accessToken = $this->getAccessToken();
        return function (callable $handler) use ($accessToken) {
            return function (RequestInterface $request, array $options) use ($handler, $accessToken) {
                $request = $request->withHeader('Authorization', $accessToken['access_token']['id']);
                return $handler($request, $options);
            };
        };
    }
}
