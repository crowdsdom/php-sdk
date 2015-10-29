<?php

namespace Crowdsdom\Tests\Integration\Labor\Models;

use Crowdsdom\Auth;
use Crowdsdom\Client\Client;
use Crowdsdom\Crowdsdom;
use Crowdsdom\Tests\Data;
use Crowdsdom\Tests\Integration\TestCase;

abstract class ModelTest extends TestCase
{
    protected $model;

    protected $data;

    protected $skipCreate = false;

    protected $createModel;

    public function setUp()
    {
        parent::setUp();

        if (!isset($this->auth) || !isset($this->client)) {
            $this->auth = $this->getAuth();
            $this->client = $this->getClient();
        }

        if (!$this->skipCreate && !isset($this->createModel)) {
            $data = $this->data;
            $model = new $this->model($this->client);
            $this->createModel = $model->create(call_user_func([Data::class, $data], 'create'));
            $this->assertEquals(200, $model->getResponse()->getStatusCode());
        }
    }

    public function testCreate()
    {
        $this->assertInternalType('array', $this->createModel);
    }

    public function testFind()
    {
        $model = new $this->model($this->client);
        $models = $model->find();
        $this->assertInternalType('array', $models);
        $this->assertEquals(200, $model->getResponse()->getStatusCode());
    }

    public function testFindById()
    {
        $model = new $this->model($this->client);
        $this->assertInternalType('array', $model->findById($this->createModel['id']));
        $this->assertEquals(200, $model->getResponse()->getStatusCode());
    }
}