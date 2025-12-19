<?php
require __DIR__ . '/../../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class WeatherExporter
{

    private array $weatherData;

    public function __construct(array $weatherData)
    {
        $this->weatherData = $weatherData;
    }



    private function formatUnixToLocal(?int $timestamp, ?int $timezoneOffset): ?string
    {
        return $timestamp ? gmdate('Y-m-d H:i:s', $timestamp + $timezoneOffset) : null;
    }


    function exportWeatherDataToExel(): void {
        $w0 = $this->weatherData['weather'][0] ?? [];

        $headers = [
            'City', 'Country', 'Latitude', 'Longitude', 'Weather main', 'Weather description',
            'Temp (K)', 'Feels like (K)', 'Temp min (K)', 'Temp max (K)',
            'Pressure (hPa)', 'Humidity (%)', 'Sea level (hPa)', 'Ground level (hPa)',
            'Visibility (m)',
            'Wind speed (m/s)', 'Wind deg',
            'Clouds (%)',
            'date', 'Timezone (s)', 'Sunrise', 'Sunset',
            'City id'
        ];

        $row = [
            $this->weatherData['name'] ?? '',
            $this->weatherData['sys']['country'] ?? '',
            $this->weatherData['coord']['lat'] ?? null,
            $this->weatherData['coord']['lon'] ?? null,

            $w0['main'] ?? '',
            $w0['description'] ?? '',

            $this->weatherData['main']['temp'] ?? null,
            $this->weatherData['main']['feels_like'] ?? null,
            $this->weatherData['main']['temp_min'] ?? null,
            $this->weatherData['main']['temp_max'] ?? null,

            $this->weatherData['main']['pressure'] ?? null,
            $this->weatherData['main']['humidity'] ?? null,
            $this->weatherData['main']['sea_level'] ?? null,
            $this->weatherData['main']['grnd_level'] ?? null,

            $this->weatherData['visibility'] ?? null,

            $this->weatherData['wind']['speed'] ?? null,
            $this->weatherData['wind']['deg'] ?? null,
            $this->weatherData['clouds']['all'] ?? null,

            $this->formatUnixToLocal($this->weatherData['dt'],  $this->weatherData['timezone']) ?? null,
            $this->weatherData['timezone'] ?? null,
            $this->formatUnixToLocal($this->weatherData['sys']['sunrise'],  $this->weatherData['timezone']) ?? null,
            $this->formatUnixToLocal($this->weatherData['sys']['sunset'],  $this->weatherData['timezone']) ?? null,

            $this->weatherData['id'] ?? null
        ];


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Weather');

        $sheet->fromArray($headers, null, 'A1');
        $sheet->fromArray($row, null, 'A2');

        $lastCol = $sheet->getHighestColumn();
        $sheet->setAutoFilter("A1:{$lastCol}1");
        $sheet->getStyle("A1:{$lastCol}1")->getFont()->setBold(true);

        foreach (range('A', $sheet->getHighestColumn()) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'weather_' . preg_replace('/\s+/', '_', (string)($this->weatherData['name'] ?? 'city')) . '.xlsx';



        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }


}