<?php
require_once __DIR__ . '/../lib/HttpClient.php';

class OpenWeatherApiService
{
    private string $apiKey;
    private HttpClient $http;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->http = new HttpClient();
    }

    public function getWeatherData(float $lat, float $lon, string $date): ?array
    {
        $timestamp = strtotime($date);
        error_log($timestamp." ".$date);
        $url = 'https://api.openweathermap.org/data/2.5/weather?lat='.$lat.'&lon='.$lon.'&dt='.$timestamp.'&appid='.$this->apiKey;


        error_log($url);
        $response = $this->http->getJson($url);
        if ($response['status'] != 200) {
            error_log("getWeatherData failed: response= ");
            error_log(print_r($response, true));
            return null;
        }

        return $response['data'];
    }
}
