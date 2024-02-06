<?php


namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ClubService
{
    private $client;
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    const API_URL = APIService::BASE_URL . '/clubs/';
    const SEARCH = APIService::BASE_URL . '/allTimeLeaderboard/search';

    public function getClubInfo($clubIds)
    {
        $url = self::API_URL . "info" . APIService::CLUBIDS . $clubIds . APIService::PLATFORM;
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

    public function getStats($clubId)
    {
        $url = self::API_URL . "overallStats" . APIService::CLUBIDS . $clubId . APIService::PLATFORM;
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

    public function getMatchesLeague($clubId)
    {
        $url = self::API_URL . "matches" . APIService::CLUBIDS . $clubId . APIService::PLATFORM . APIService::MATCHTYPE_LEAGUE;
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

    public function getMatchesPlayoff($clubId)
    {
        $url = self::API_URL . "matches" . APIService::CLUBIDS . $clubId . APIService::PLATFORM . APIService::MATCHTYPE_PLAYOFF;
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

    public function search($clubName)
    {
        $url = self::SEARCH . APIService::CLUBNAME . $clubName . APIService::PLATFORM;

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
