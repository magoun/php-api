<?php

// Parse input
$uri = $_SERVER['REQUEST_URI'];
$input = str_replace('/api/timestamp/', '', $uri);

// Process input
if (!input) {
  $d = new DateTime;
}
else {
  try {
    if (is_numeric($input)) {
      $d = new DateTime;
      $d->setTimestamp($input / 1000);
    }
    else {
      $d = new DateTime($input);
    }
  }
  catch (Exception $e) {
    // Invalid date format
  }
}

if ($d) {
  $response = [
    'unix' => $d->format('Uv'),
    'utc' =>  $d->format($d::RFC7231)
  ];
}
else {
  $response = [
    'Error' => 'Invalid Date'
  ];
}

header('Content-type: application/json');
echo json_encode($response);
exit;