<?php

function getInput($src) : string {
  
  $endpoint = basename($src, '.php');
  
  // Parse input
  $uri = $_SERVER['REQUEST_URI'];
  $input = str_replace('/api/' . $endpoint, '', $uri);
  $input = str_replace('/', '', $input);
  
  return $input;
  
}

function sendResponse($response) : void {
  
  header("Access-Control-Allow-Origin: *");
  header('Content-type: application/json');
  echo json_encode($response);
  exit;
  
}