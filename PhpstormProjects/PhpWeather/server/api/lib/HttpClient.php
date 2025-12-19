<?php

class HttpClient
{

    public function get(string $url): array
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 10,]);

        $body = curl_exec($ch);

        if ($body === false) {
            $err = curl_error($ch);
            return ['status' => 0, 'body' => null, 'error' => $err];
        }

        $status = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ['status' => $status, 'body' => $body, 'error' => null];
    }

    public function getJson(string $url): array
    {
        $response = $this->get($url);
    error_log("RESPONSE:\n" . print_r($response, true));
        if ($response['status'] !== 200 || $response['body'] === null) {
            return ['status' => $response['status'], 'data' => null, 'error' => $response['error']];
        }

        $data = json_decode($response['body'], true);
        if (!is_array($data)) {
            return ['status' => $response['status'], 'data' => null, 'error' => 'Invalid JSON'];
        }

        return ['status' => $response['status'], 'data' => $data, 'error' => null];
    }
}
