<?php

// Allow CORS
// cors();

// Parse input
$input = getInput(__FILE__);

// Process input
if ($input === 'new') {
  
  $url = validateInput($input);
  $short_url = minify($url);
  
  $response = [
    'original_url' => $url,
    'short_url' => $short_url
  ];
  
  // don't escape url forward slashes
  $options = JSON_UNESCAPED_SLASHES;
  
  sendResponse($response, $options); 
    
}
else {

  // get minified url and return a rediect
  if ($id = intval($input)) {

    $short_url = R::load('shorturl', $id);
    
    if ($short_url->id !== 0) {
      redirect($short_url->original_url);
    }
    
  }
  
  // if not found, 404
  return404();
  
}


// Helper functions
function validateInput($input) {
  
  $url = $_POST['url'];
  
  $pattern = '/^https?:\/\/(?:[\w-]+\.)+\w+/';
  
  if (preg_match($pattern, $url)) {
    return $url;
  }
  
  $response = ['error' => 'invalid url'];
  sendResponse($response);
  
}

function minify($url) {
  
  $short_url = R::dispense('shorturl');
  $short_url->original_url = $url;

  $id = R::store($short_url);

  return $id;
  
}

function redirect($url, $statusCode = 303) {
   
  header('Location: ' . $url, true, $statusCode);
  exit;
  
}