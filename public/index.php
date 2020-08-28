<?php

$route = $_SERVER['REQUEST_URI'];

$pieces = explode('/', $route);

if ($pieces[1] === 'api') {
  
  if ($pieces[2] === 'timestamp') {
    require_once('./src/timestamp.php');
  }
}

echo 'Invalid API endpoint.';
