<?php

// Parse input
$uri = $_SERVER['REQUEST_URI'];
$input = str_replace('/api/timestamp', '', $uri);
$input = str_replace('/', '', $input);

// Process input
if (!$input) {
  $requestTime = microtime(true);
  $d = DateTime::createFromFormat('U.u', sprintf("%.6F", $requestTime));
}
else {
  try {
    if (is_numeric($input)) {
      
      $ms = substr_replace($input, '.', -3, 0);
      $us = $ms . '000';
      $d = DateTime::createFromFormat('U.u', $us);
      
    }
    else {
      $d = new DateTime($input);
    }
  }
  catch (Exception $e) {
    // Invalid date format
  }
}

if (isset($d)) {
  $response = [
    'unix' => (int) $d->format('Uv'),
    'utc' =>  $d->format($d::RFC7231)
  ];
}
else {
  $response = [
    'error' => 'Invalid Date'
  ];
}

header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');
echo json_encode($response);
exit;