<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    protected $apiBase = 'api';

    protected $apiVersion = 'v1';

    protected function shouldDropViews()
    {
        return true;
    }

    public function getFromApi($route, $data = [])
    {
        return $this->apiCall('GET', $route, $data);
    }

    public function postToApi($route, $data = [])
    {
        return $this->apiCall('POST', $route, $data);
    }

    private function apiCall($method, $route, $data = [])
    {
        return $this->json(
            $method,
            $this->apiBase . '/'. $this->apiVersion . '/' . $route,
            $data
        );
    }
}
