<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ClashRoyaleService
{
    private $token;
    private $url;
    private $headers;

    public function __contruct()
    {
        $this->token = config('clash_royale_api');
        $this->url = config('clash_royale_url');
        $this->headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'content-type' => 'application/json',
            'Accept' => 'application/json'
        ];
    }

    public function getClan($tag)
    {
        try {
            $client = new Client();
            $response = $client->get($this->url . '/clans/%' . $tag, [
                'headers' => $this->headers,
            ]);

           return $response;
        } catch (GuzzleException $e) {
            return $e;
        }
    }
}
