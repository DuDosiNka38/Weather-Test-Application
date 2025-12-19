<?php
require_once __DIR__ . '/../lib/HttpClient.php';

class GeocodingService
{
    private string $apiKey;
    private HttpClient $http;

    public function __construct(string $apiKey) {
        $this->apiKey = $apiKey;
        $this->http = new HttpClient();
    }

    public function cityToCoords(string $city): ?array {
        $url = 'https://api.openweathermap.org/geo/1.0/direct?q='.urlencode($city).'&limit=1&appid='.$this->apiKey;

        error_log($url);
        $response = $this->http->getJson($url);

        if ($response['status'] != 200 || $response['data'] == null) {
            error_log("Geocoding failed: status={$response['status']} error={$response['error']}");
            return null;
        }

        $data = $response['data'];
        if (empty($data) || !isset($data[0]['lat']) ||  !isset($data[0]['lon'])) {
            return null;
        }

        return [
            'lat' => (float)$data[0]['lat'],
            'lon' => (float)$data[0]['lon'],
        ];
    }
}
