<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception\GuzzleException;

class ClashRoyaleService
{
    private $url;
    private $token;
    private $headers;
    private $client;

    public function __construct()
    {
        $this->token = config('app.clash_royale_api');
        $this->url = config('app.clash_royale_url');
        $this->headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'content-type' => 'application/json',
            'Accept' => 'application/json'
        ];
        $this->client = new Client;
    }

    public function getClan($tag)
    {
        try {
            $response = $this->client->get($this->url . '/clans/%23' . strtoupper($tag), [
                'headers' => $this->headers
            ]);

            $response = json_decode($response->getBody()->getContents());

            return $response;
        } catch (GuzzleException $e) {
            return $e;
        }
    }

    public function getPlayer($tag)
    {
        try {
            $response = $this->client->get($this->url . '/players/%23' . strtoupper($tag), [
                'headers' => $this->headers
            ]);

            $response = $response->getBody()->getContents();
            
            return $response;
        } catch (GuzzleException $e) {
            return 'error';
        }
    }
}
