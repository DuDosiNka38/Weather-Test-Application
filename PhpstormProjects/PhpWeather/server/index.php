<?php
require  __DIR__ . '/api/api.php';

error_log("Server started!!!");

$api = new ApiBase();
$api->apiRequest();


