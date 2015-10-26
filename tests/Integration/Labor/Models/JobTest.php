<?php

namespace Crowdsdom\Tests\Integration\Labor\Models;

use Crowdsdom\Labor\Models\Job;
use Crowdsdom\Tests\Data;
use Crowdsdom\Tests\Integration\TestCase;

class JobTest extends TestCase
{

    public function testCreate()
    {
        try {
            $job = new Job($this->client);
            $job->create(Data::job('create'));
        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            $this->assertEquals(422, $exception->getResponse()->getStatusCode());
        }
    }

}