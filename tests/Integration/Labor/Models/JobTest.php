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

    public function testFind()
    {
        $job = new Job($this->client);
        $jobs = $job->find();
        $this->assertInternalType('array', $jobs);
    }

    public function testFindById()
    {
        try {
            $job = new Job($this->client);
            $job->findById("abc");
        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            $this->assertEquals(404, $exception->getResponse()->getStatusCode());
        }
    }

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