<?php

$response = [
  'ipaddress' => get_ip(),
  'language' => get_language(),
  'software' => get_software()
];

sendResponse($response);

// Helper functions
function get_ip() {
  
  $x_forward = $_SERVER['HTTP_X_FORWARDED_FOR'];
  $ipaddress = explode(',', $x_forward)[0];
  
  return $ipaddress;
  
}

function get_language() {
  return $_SERVER['HTTP_ACCEPT_LANGUAGE'];
}

function get_software() {
  return $_SERVER['HTTP_USER_AGENT'];
}