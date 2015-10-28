<?php

namespace Crowdsdom\Tests\Integration\Labor\Models;

use Crowdsdom\Tests\Integration\TestCase;
use Crowdsdom\Labor\Models\Task;

class TaskTest extends TestCase
{

    public function testApprove()
    {
        try {
            $task = new Task($this->client);
            $task->approve("abc");
        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            $this->assertEquals(404, $exception->getResponse()->getStatusCode());
        }
    }

    public function testReject()
    {
        try {
            $task = new Task($this->client);
            $task->reject("abc");
        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            $this->assertEquals(404, $exception->getResponse()->getStatusCode());
        }
    }

}