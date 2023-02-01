<?php

class Ticket
{
    private $conn;

    public function __construct()
    {
        // Connect to database
        $this->conn = new PDO("mysql:host=192.168.0.102;port=3336;dbname=ticket_system", "root", "mysql-container");
    }

    public function create($eventId, $totalTicket)
    {
        // Generate unique ticket codes
        $codes = [];
        for ($i = 0; $i < $totalTicket; $i++) {
            $code = "DTK" . substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 7);
            $codes[] = $code;
        }

        // Insert ticket codes into database
        $query = "INSERT INTO tickets (event_id, ticket_code, status, updated_at) VALUES ";
        $values = [];
        foreach ($codes as $code) {
            $values[] = "($eventId, '$code', 'available', null)";
        }
        $query .= implode(",", $values);
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $codes;
    }

    public function getStatus($eventId, $ticketCode)
    {
        // Sanitize inputs to prevent against SQL injection
        $eventId = filter_var($eventId, FILTER_SANITIZE_SPECIAL_CHARS);
        $ticketCode = filter_var($ticketCode, FILTER_SANITIZE_SPECIAL_CHARS);

        // Get ticket status from database
        $data = [
            'event_id'      => $eventId,
            'ticket_code'   => $ticketCode,
        ];
        $query = "SELECT ticket_code, status FROM tickets WHERE event_id = :event_id AND ticket_code = :ticket_code";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($data);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if data was found
        if (!$result) {
            $result = [
                'ticket_code'   => null,
                'status'        => null,
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function updateStatus($eventId, $ticketCode, $status)
    {
        header('Content-Type: application/json');
        $validStatuses = ['available', 'claimed'];
        if (!in_array($status, $validStatuses)) {
            echo json_encode([
                'errors' => 'Invalid status, update failed'
            ]);
            die();
        }

        // Sanitize inputs to prevent against SQL injection
        $eventId = filter_var($eventId, FILTER_SANITIZE_SPECIAL_CHARS);
        $ticketCode = filter_var($ticketCode, FILTER_SANITIZE_SPECIAL_CHARS);
        $status = filter_var($status, FILTER_SANITIZE_SPECIAL_CHARS);

        // Update ticket status in database
        $query = "UPDATE tickets SET status = :status, updated_at = CURRENT_TIMESTAMP WHERE event_id = :event_id AND ticket_code = :ticket_code";
        $stmt = $this->conn->prepare($query);

        // bind values
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':event_id', $eventId);
        $stmt->bindParam(':ticket_code', $ticketCode);

        // execute the query
        if ($stmt->execute()) {
            // get the data
            $query = "SELECT ticket_code, status, updated_at FROM tickets WHERE event_id = :event_id AND ticket_code = :ticket_code";

            $stmt = $this->conn->prepare($query);

            // bind values
            $stmt->bindParam(':event_id', $eventId);
            $stmt->bindParam(':ticket_code', $ticketCode);

            // execute the query
            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // return the result
                $result = array(
                    'ticket_code'   => $row['ticket_code'],
                    'status'        => $row['status'],
                    'updated_at'    => $row['updated_at']
                );

                echo json_encode($result);
            }
        }
    }
}
