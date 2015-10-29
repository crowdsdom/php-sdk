<?php

namespace Crowdsdom\Tests\Integration\Labor\Models;

use Crowdsdom\Labor\Models\Job;

class JobTest extends ModelTest
{
    protected $model = Job::class;
    protected $data = 'job';

    public function testTasks()
    {
        $job = new Job($this->client);
        $tasks = $job->tasks($this->createModel['id']);
        $this->assertInternalType('array', $tasks);
        $this->assertEquals(200, $job->getResponse()->getStatusCode());
    }

}