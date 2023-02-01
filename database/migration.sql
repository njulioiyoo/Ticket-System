CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT,
    ticket_code VARCHAR(10),
    status ENUM('available', 'claimed') DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO tickets (event_id, ticket_code, status)
VALUES (1, 'DTK01AHB89', 'available', '2023-02-01 03:02:52', null);
