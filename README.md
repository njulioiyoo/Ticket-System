# Ticket Management System
Table of Contents
1. Introduction
2. Prerequisites
3. Installation
4. Php-Cli
5. Check Ticket Code API
6. Update Ticket Status API
7. Conclusion

## Introduction
Ticket Management System is a system that helps in managing the creation and management of ticket codes. This system has a feature to create a number of ticket codes based on Event ID and has APIs to check the status of ticket codes and APIs to change the ticket code status.

## Prerequisites
- PHP >= 7.0
- MySQL/PgSQL
- Terminal/Command Prompt

## Installation
1. Clone this repository or download as a zip file
2. Open Terminal/Command Prompt and navigate to the project directory
3. Create a new database named `ticket_system`
4. Import the `database/migration.sql` file into the newly created database
5. Change the database connection settings in the `app/config/database.php` and `app/models/Ticket.php` file

## Php-Cli
Example PHP generate-ticket.php {event_id} {total_ticket}:
```sh
cd public
php generate-ticket.php 2 3000
```
The above example will create unique ticket codes for up to 3000 tickets against event_id 2 in the database. The ticket code format consists of a total of 10 characters (3 prefix & 7 random AlphaNumeric).

## Check Ticket Code API
This API is used to check the status of the ticket code. The required parameters are event_id and ticket_code. The result response consists of ticket_code and status.

## Update Ticket Status API
This API is used to change the status of the ticket code. The required parameters are event_id, ticket_code, and status. The result response consists of ticket_code, status, and updated_at (timestamp).

## Conclusion
By using the Ticket Management System, it helps to make it easier in the creation and management of ticket codes.