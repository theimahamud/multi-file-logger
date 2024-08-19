<?php

//sqlite database path
$databasePath = __DIR__ . '/database/database.sqlite';

// Check if the database file exists
if (!file_exists($databasePath)) {
    die("Database file not found at $databasePath");
}

// Create a new PDO connection for sqlite
$pdo = new PDO("sqlite:$databasePath");

// Set error mode for exception handle
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// SQL statement to create the logs table
$sql = "
    CREATE TABLE IF NOT EXISTS logs (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        level TEXT NOT NULL,
        message TEXT NOT NULL,
        context TEXT,
        created_at TEXT NOT NULL
    )
";

// Execute the SQL statement
try {
    $pdo->exec($sql);
    echo "Table 'logs' created successfully.";
} catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}
