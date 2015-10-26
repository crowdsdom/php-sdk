<?php

namespace Crowdsdom\Labor\Models;

class Job extends Base\Job
{
    const ENDPOINT = '/Jobs';

    /**
     * @param $id
     * @return array|null
     * @throws \RuntimeException
     */
    public function accept($id)
    {
        $response = $this->client->getGuzzle()->request('POST', static::ENDPOINT . "/{$id}/accept", []);
        return json_decode($response->getBody()->getContents(), true);
    }
}
