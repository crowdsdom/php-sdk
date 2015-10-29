<?php

namespace Crowdsdom\Labor\Models;

class Task extends Base\Task
{
    const ENDPOINT = '/Tasks';

    public function create(array $data)
    {
        throw new \BadMethodCallException;
    }

    public function find()
    {
        throw new \BadMethodCallException;
    }

    public function findById($id)
    {
        throw new \BadMethodCallException;
    }

    public function approve($id)
    {
        $this->response = $this->client->getGuzzle()->request('POST', static::ENDPOINT . "/{$id}/approve", []);
        return json_decode($this->response->getBody()->getContents(), true);
    }

    public function reject($id)
    {
        $this->response = $this->client->getGuzzle()->request('POST', static::ENDPOINT . "/{$id}/reject", []);
        return json_decode($this->response->getBody()->getContents(), true);
    }
}
