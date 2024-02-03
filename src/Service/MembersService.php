<?php

namespace App\Service;

use App\Service\APIService;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MembersService
{
    private $client;
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    const API_URL = APIService::BASE_URL . '/members/';

    public function getMembersStats($clubId)
    {
        $url = self::API_URL . "stats" . APIService::CLUBID . $clubId . APIService::PLATFORM;
        $response = $this->client->request(
            'GET',
            $url,
            [
                'http_version' => '1.1',
                'headers' => [
                    'Accept' => 'application/json',
                    'Referer' => 'https://proclubs.ea.com/',
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
                ]
            ]
        )->getContent();
        return json_decode($response, true);
    }

    public function getMembersCareer($clubId)
    {
        $url = self::API_URL . "career/stats" . APIService::CLUBID . $clubId . APIService::PLATFORM;
        $response = $this->client->request(
            'GET',
            $url,
            [
                'http_version' => '1.1',
                'headers' => [
                    'Accept' => 'application/json',
                    'Referer' => 'https://proclubs.ea.com/',
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
                ]
            ]
        )->getContent();
        return json_decode($response, true);
    }
}
