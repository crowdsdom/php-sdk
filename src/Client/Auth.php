<?php

namespace Crowdsdom\Client;

use Crowdsdom\Client\Exceptions\AuthException;
use GuzzleHttp\Client as GuzzleClient;

/**
 * Class Auth
 * @package Crowdsdom\Client
 */
class Auth
{

    const ENDPOINT = '/oauth/token';
    const GRANT_TYPE = 'client_credentials';

    /**
     * @var Client
     */
    protected $client;

    /**
     * TODO: adapt an oauth2 library
     * @var array
     */
    protected $accessToken;

    /**
     * @var GuzzleClient
     */
    protected $guzzle;

    /**
     * Auth constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->guzzle = new GuzzleClient([
            'base_uri' => $client->getAuthHost()
        ]);
    }

    public function getAccessToken()
    {
        // lazy load
        if (isset($this->accessToken)) {
            return $this->accessToken;
        }

        $response = $this->guzzle->request('POST', self::ENDPOINT, [
            'json' => [
                'grant_type' => self::GRANT_TYPE,
                'client_id' => $this->client->getClientId(),
                'client_secret' => $this->client->getClientSecret(),
            ]
        ]);

        if ($response->getStatusCode() !== 200) {
            throw AuthException::make($response);
        }

        $this->accessToken = json_decode($response->getBody()->getContents(), true);

        return $this->accessToken;
    }
}
