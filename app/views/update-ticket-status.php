<?php

require_once(__DIR__ . '/../controllers/TicketController.php');
require_once(__DIR__ . '/../helpers/URL.php');

$output = parse_url_query_string();

$eventId = $output['eventId'];
$ticketCode = $output['ticketCode'];
$status = $output['status'];

$ticketController = new TicketController();
return $ticketController->updateTicketStatus($eventId, $ticketCode, $status);
