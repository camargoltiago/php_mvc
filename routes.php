<?php
global $routes;
$routes = [];
/**
 * Example
 * https://mvc/galery/123/test
 */

$routes['/galery/{id}/{title}'] = '/galery/open/:id/:title';
