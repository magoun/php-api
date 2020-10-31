<?php

// Load helper functions
require_once('./src/helpers.php');

// Load db
require_once('./rb.php');
R::setup('sqlite:./database/sqlite.db');

$route = $_SERVER['REQUEST_URI'];

$pieces = explode('/', $route);

if ($pieces[1] === 'api') {
  
  $endpoint = $pieces[2];
  
  if ($endpoint === 'timestamp') {
    require_once('./src/timestamp.php');
  }
  
  if ($endpoint === 'whoami') {
    require_once('./src/whoami.php');
  }
  
  if ($endpoint === 'shorturl') {
    require_once('./src/shorturl.php');
  }
  
}

echo 'Invalid API endpoint.';
