<?php

namespace Crowdsdom;

use Crowdsdom\Client\API;
use Crowdsdom\Labor\Models\Job;
use Crowdsdom\Labor\Models\JobType;
use Crowdsdom\Labor\Models\Task;

class Labor extends API
{

    /**
     * @return Job
     */
    public function job()
    {
        return new Job($this->client);
    }

    /**
     * @return Task
     */
    public function task()
    {
        return new Task($this->client);
    }

    /**
     * @return JobType
     */
    public function jobType()
    {
        return new JobType($this->client);
    }

}