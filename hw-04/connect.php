<?php
session_start();
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=picture',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    echo 'Невозможно установить соединение с базой данных';
}
