<?php

namespace Crowdsdom;

use Crowdsdom\Client\API;
use Crowdsdom\Client\Client;
use Crowdsdom\Client\Exceptions\AuthException;
use Psr\Http\Message\RequestInterface;

/**
 * Class Auth
 * @package Crowdsdom\Client
 */
class Auth extends API
{

    const ENDPOINT = '/oauth/token';
    const GRANT_TYPE = 'client_credentials';

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
     * @param Client $client
     * @param string $clientId
     * @param string $clientSecret
     */
    public function __construct(Client $client, $clientId, $clientSecret)
    {
        parent::__construct($client);
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }


    public function getAccessToken()
    {
        // lazy load
        if (isset($this->accessToken)) {
            return $this->accessToken;
        }

        $response = $this->client->getGuzzle()->request('POST', self::ENDPOINT, [
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
