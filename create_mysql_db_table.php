<?php

// Database connection details
$host = 'localhost';
$dbname = 'logger';
$username = 'root';
$password = '';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected to MySQL successfully!<br>";

    // SQL to create table
    $sql = '
        CREATE TABLE IF NOT EXISTS logs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            level VARCHAR(50) NOT NULL,
            message TEXT NOT NULL,
            context TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ';

    // Execute the query
    $pdo->exec($sql);
    echo 'Logs table created successfully!';

} catch (PDOException $e) {
    exit('Error: '.$e->getMessage());
}
