<?php

$route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
switch ($route) {
    case '/api/check-ticket-status':
        require_once __DIR__ . '/../app/views/check-ticket-status.php';
        break;

    case '/api/update-ticket-status':
        require_once __DIR__ . '/../app/views/update-ticket-status.php';
        break;

    default:
        die('404');
        break;
}
