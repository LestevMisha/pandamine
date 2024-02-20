<?php
$serverConfig = array(
    'srv_id' => 1,
    'servers' => array(
        array(
            'rcon_ip' => '51.77.177.161',
            'rcon_port' => 33333,
            'rcon_pass' => 'adyh1d89asjkrSAs',
        ),
    ),
    'db' => array(
        'mysql_host' => '178.32.198.155',
        'mysql_db' => 'surv',
        'mysql_user' => 'surv',
        'mysql_pass' => '0XqFejdtGVdHLZjJ',
    ),
);

// Extract the database configuration
$dbConfig = $serverConfig['db'];

// Create a database connection
$mysqli = new mysqli(
    $dbConfig['mysql_host'],
    $dbConfig['mysql_user'],
    $dbConfig['mysql_pass'],
    $dbConfig['mysql_db']
);

// Check if the connection was successful
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}
