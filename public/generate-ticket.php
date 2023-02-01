<?php

require_once '../app/controllers/TicketController.php';

$event_id = $argv[1];
$total_ticket = $argv[2];

$controller = new TicketController();
$controller->generateTicket($event_id, $total_ticket);