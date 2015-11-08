<?php

namespace Crowdsdom\Tests\Integration\Labor\Models;

use Crowdsdom\Labor\Models\Job;

class JobTest extends ModelTest
{
    protected $model = Job::class;
    protected $data = 'job';

    protected $job;

    public function setUp()
    {
        parent::setUp();
        $this->job = new Job($this->client);
    }

    public function testTasks()
    {
        $tasks = $this->job->tasks($this->createModel['id']);
        $this->assertInternalType('array', $tasks);
        $this->assertEquals(200, $this->job->getResponse()->getStatusCode());
    }

    public function testJobType()
    {
        $this->markTestSkipped('job.jobType not implemented');

        $jobType = $this->job->jobType($this->createModel['id']);
        $this->assertInternalType('array', $jobType);
        $this->assertEquals(200, $this->job->getResponse()->getStatusCode());
    }

}
