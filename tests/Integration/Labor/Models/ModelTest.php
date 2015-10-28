<?php

namespace Crowdsdom\Tests\Integration\Labor\Models;

use Crowdsdom\Tests\Data;
use Crowdsdom\Tests\Integration\TestCase;

abstract class ModelTest extends TestCase
{
    protected $model;

    public function testCreate()
    {
        try {
            $model = new $this->model($this->client);
            $model->create(Data::job('create'));
        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            $this->assertEquals(422, $exception->getResponse()->getStatusCode());
        }
    }

    public function testFind()
    {
        $model = new $this->model($this->client);
        $models = $model->find();
        $this->assertInternalType('array', $models);
    }

    public function testFindById()
    {
        try {
            $model = new $this->model($this->client);
            $model->findById("abc");
        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            $this->assertEquals(404, $exception->getResponse()->getStatusCode());
        }
    }
}