<?php 

// Either use commposer, either include this file:
include_once 'hquery.php';

// Optionally use namespaces (PHP >= 5.3.0 only)
use duzun\hQuery;

// Set the cache path - must be a writable folder
hQuery::$cache_path = "cache";



$doc = hQuery::fromUrl('https://aws.amazon.com',array('Accept' => 'text/html,application/xhtml+xml;q=0.9,*/*;q=0.8'));

var_dump($doc->headers); // See response headers
var_dump(hQuery::$last_http_result); // See response details of last request
?>