<?php

namespace Crowdsdom\Tests\Integration\Labor\Models;

use Crowdsdom\Labor\Models\Job;

class JobTest extends ModelTest
{
    protected $model = Job::class;

    public function testAccept()
    {
        try {
            $job = new Job($this->client);
            $job->accept("abc");
        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            $this->assertEquals(401, $exception->getResponse()->getStatusCode());
        }
    }

}