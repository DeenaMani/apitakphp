<?php

function getConnection()
{
    $host = 'localhost';
    $database = 'task_php';
    $user = 'root';
    $password = '';

    try {
        return new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode([
            500,
            'Database connection failed',
            $e->getMessage(),
        ]);
        exit;
    }
}
