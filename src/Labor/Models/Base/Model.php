<?php

namespace Crowdsdom\Labor\Models\Base;

use Crowdsdom\Client\Client;

abstract class Model
{
    const ENDPOINT = "";

    /**
     * @var Client
     */
    protected $client;

    /**
     * Model constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param array $data
     * @return array|null
     */
    public function create(array $data)
    {
        $response = $this->client->getGuzzle()->request('POST', static::ENDPOINT, [
            'json' => $data
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @return array|null
     * @throws \RuntimeException
     */
    public function find()
    {
        $response = $this->client->getGuzzle()->request('GET', static::ENDPOINT);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $id
     * @return array|null
     * @throws \RuntimeException
     */
    public function findById($id)
    {
        $response = $this->client->getGuzzle()->request('GET', static::ENDPOINT . "/$id");
        return json_decode($response->getBody()->getContents(), true);
    }
}
