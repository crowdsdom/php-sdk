<?php

namespace Crowdsdom\Labor\Models;

use Crowdsdom\Client\Client;
use GuzzleHttp\Psr7\Response;

abstract class Model
{
    const ENDPOINT = "";

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

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
        $this->response = $this->client->getGuzzle()->request('POST', static::ENDPOINT, [
            'json' => $data
        ]);
        return json_decode($this->response->getBody()->getContents(), true);
    }

    /**
     * @return array|null
     * @throws \RuntimeException
     */
    public function find()
    {
        $this->response = $this->client->getGuzzle()->request('GET', static::ENDPOINT);
        return json_decode($this->response->getBody()->getContents(), true);
    }

    /**
     * @param string $id
     * @return array|null
     * @throws \RuntimeException
     */
    public function findById($id)
    {
        $this->response = $this->client->getGuzzle()->request('GET', static::ENDPOINT . "/$id");
        return json_decode($this->response->getBody()->getContents(), true);
    }
}
