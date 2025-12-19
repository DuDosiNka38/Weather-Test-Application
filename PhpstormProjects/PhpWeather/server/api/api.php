<?php
require __DIR__ . '/controllers/WeatherController.php';

class ApiBase {
    public function apiRequest(): void
    {

        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];
        error_log("Working");

        if ($method === 'GET' &&  $_GET['action'] === "getWeather") {
            error_log("We are here");
            $city = $_GET['city'] ?? null;
            $date = $_GET['date'] ?? null;

            if (!$city || !$date) {
                http_response_code(400);
                echo json_encode(['error' => 'Missing city or date']);
                return;
            }
            $weather = new Weather();
            error_log("Go fucking go");
            $weather->getWeather($city, $date);
        }
    }
}
