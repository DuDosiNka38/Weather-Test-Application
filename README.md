# Weather Export Tool

A small PHP application that retrieves weather data for a selected city and exports it to an Excel (`.xlsx`) file.

---

## Requirements
- PHP 8.0+
- OpenWeather API key
- Composer dependencies (already included if `vendor/` exists)

Dependency used:
```json
{
  "require": {
    "phpoffice/phpspreadsheet": "^5.3"
  }
}
```

If the `vendor/` folder is missing, run:
```
composer install
```

---

## How to run
From the project root:

```
php -S localhost:8000
```

Open in browser:
```
http://localhost:8000/app/index.html
```

---

## Usage
Enter a **city** and **date**.  
On submit, the application downloads an Excel file with weather data.

Backend endpoint:
```
/api/getWeather?city=CityName&date=YYYY-MM-DD
```

---

## Output
- Success: Excel file `weather_<city>.xlsx`
- Error: JSON response with an error message

---

## Important note about the date parameter
The project uses the **free OpenWeather API tier**, which does **not support date-based weather requests**.  
Although the system accepts a date, the API always returns current weather data.

The application logic fully supports date-based requests.  
If the API URL in `OpenWeatherApiService` is changed to a newer OpenWeather API version and a valid paid API key is provided, date-based weather retrieval will work correctly without further code changes.
