<?php
declare(strict_types=1);

namespace App\Http;

use Auth;
use Session;
use GuzzleHttp\Client;

class RestAccess
{
    private $base = 'http://127.0.0.1:8000/api/';
    private $route;
    private $client;
    private $headers;

    public function __construct(string $route)
    {
        $this->route = $route;
        $this->client = new Client([
            'base_uri' => $this->base . $route,
            'timeout' => 2
        ]);


        if (Session::get('jwt')) {
            $this->headers = [
                'Authorization' => 'Bearer ' . $this->getJwtToken()
            ];
        }

        $this->apiAuth();
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function apiAuth()
    {
        try {
            $client = new Client([
                'base_uri' => 'http://127.0.0.1:8000/api/',
                'timeout' => 2
            ]);

            $response = $client->request('POST', 'login', [
                'form_params' => [
                    'email' => 'user@user.com',
                    'password' => '123456'
                ]
            ]);

            $data = json_decode((string)$response->getBody(), true);
            session(['jwt' => $data['access_token']]);

            $this->headers = [
                'Authorization' => 'Bearer ' . $data['access_token'],
            ];
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getJwtToken()
    {
        return Session::get('jwt');
    }

    private function makeCollection(array $data, array $columns = [])
    {
        $renderer = new RestCollection($data);
        $columns = array_combine(array_keys(array_random($data)), array_keys(array_random($data)));
        $renderer->columns($columns);
        return $renderer;
    }

    public function all()
    {
        try {
            $response = $this->client->get('', [
                'headers' => $this->headers
            ]);
            $data = json_decode((string)$response->getBody(), true);
            return $this->makeCollection($data['data']);
        } catch (\Exception $e) {
            return $this->makeCollection([]);
        }
    }

    public function get($id)
    {
        try {
            $response = $this->client->get($this->route . '/' . $id, [
                'headers' => $this->headers
            ]);
            $data = json_decode((string)$response->getBody(), true);
            return (object) $data['data'];
        } catch (\Exception $e) {
            return (object) [];
        }
    }

    public function create(array $data)
    {
        try {
            $response = $this->client->post('', [
                'headers' => $this->headers,
                'form_params' => $data
            ]);

            return $response->getStatusCode();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function update($id, array $data)
    {
        try {
            $data['_method'] = 'put';

            $response = $this->client->post($this->route . '/' . $id, [
                'headers' => $this->headers,
                'form_params' => $data
            ]);

            return $response->getStatusCode();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $response = $this->client->post($this->route . '/' . $id, [
                'headers' => $this->headers,
                'form_params' => [
                    '_method' => 'delete'
                ]
            ]);

            return $response->getStatusCode();
        } catch (\Exception $e) {
            dd($e);
            return $this->makeCollection([]);
        }
    }
}