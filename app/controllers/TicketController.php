<?php

require_once(__DIR__ . '/../models/Ticket.php');

class TicketController {
    public function generateTicket($eventId, $totalTicket) {
        $ticket = new Ticket();
        return $ticket->create($eventId, $totalTicket);
    }

    public function checkTicketStatus($eventId, $ticketCode) {
        $ticket = new Ticket();
        return $ticket->getStatus($eventId, $ticketCode);
    }

    public function updateTicketStatus($eventId, $ticketCode, $status) {
        $ticket = new Ticket();
        return $ticket->updateStatus($eventId, $ticketCode, $status);
    }
}