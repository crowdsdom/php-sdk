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
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function create(array $data)
    {
        return $this->client->getGuzzle()->request('POST', static::ENDPOINT, [
            'json' => $data
        ]);
    }
}
