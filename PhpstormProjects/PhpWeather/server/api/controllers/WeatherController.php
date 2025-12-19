<?php
require __DIR__ . '/../services/GeocodingApiService.php';
require __DIR__ . '/../services/OpenWeatherApiService.php';
require __DIR__ . '/../services/WeatherExporterService.php';

class Weather {

    private string $apiKey = "fa71460b38c7460e4e2223a3b75bc738";

    public function getWeather($city, $date): void {
        header('Content-Type: application/json; charset=utf-8');

        try {
            $geocodingService = new GeocodingService($this->apiKey);
            $coordinates = $geocodingService->cityToCoords($city);

            if ($coordinates === null) {
                throw new Exception("City not found");
            }

            $openWeatherService = new OpenWeatherApiService($this->apiKey);
            $weatherData = $openWeatherService->getWeatherData(
                $coordinates['lat'],
                $coordinates['lon'],
                $date
            );

            if (empty($weatherData)) {
                throw new Exception("Weather data not available");
            }

            $weatherExporter = new WeatherExporter($weatherData);
            $weatherExporter->exportWeatherDataToExel();

        } catch (Throwable $error) {
            http_response_code(400);
            echo json_encode([
                'error' => true,
                'message' => $error->getMessage(),
            ]);
            exit;
        }
    }


}