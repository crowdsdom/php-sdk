<?php

namespace Crowdsdom\Labor\Models;

class Job extends Base\Job
{
    const ENDPOINT = '/Jobs';

    public function tasks($id)
    {
        $this->response = $this->client->getGuzzle()->request('GET', static::ENDPOINT . "/{$id}/tasks", []);
        return json_decode($this->response->getBody()->getContents(), true);
    }
}
