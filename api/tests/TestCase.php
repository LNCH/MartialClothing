<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tymon\JWTAuth\Contracts\JWTSubject;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    protected $apiBase = 'api';

    protected $apiVersion = 'v1';

    protected function shouldDropViews()
    {
        return true;
    }

    public function jsonGetAs(JWTSubject $user, $uri, $data = [], $headers = [])
    {
        return $this->json('GET', 'api/v1/'.$uri, $data, array_merge($headers, [
            'Authorization' => 'Bearer ' . auth()->tokenById($user->id)
        ]));
    }

    public function jsonPostAs(JWTSubject $user, $uri, $data = [], $headers = [])
    {
        return $this->json('POST', 'api/v1/'.$uri, $data, array_merge($headers, [
            'Authorization' => 'Bearer ' . auth()->tokenById($user->id)
        ]));
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
