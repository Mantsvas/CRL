<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\GuzzleException;

class ClashRoyaleService
{
    private $url;
    private $token;
    private $headers;
    private $client;

    public function __construct()
    {
        $this->token = config('clash_royale_api');
        $this->url = config('app.clash_royale_url');
        $this->headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'content-type' => 'application/json',
            'Accept' => 'application/json'
        ];
        $this->client = Http::withToken($this->token)->withHeaders($this->headers);
    }

    public function getClan($tag)
    {
        try {
            $response = $this->client->get($this->url . '/clans/%23' . strtoupper($tag));

           return $response;
        } catch (GuzzleException $e) {
            return $e;
        }
    }

    public function getPlayer($tag)
    {
        try {
            $response = $this->client->get($this->url . '/players/%23' . strtoupper($tag));

            dd($response);
           return $response;
        } catch (GuzzleException $e) {
            
            return 'error';
        }
    }
}
