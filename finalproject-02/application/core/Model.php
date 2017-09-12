<?php

namespace FP2\Models;

use PDO;

abstract class Model
{
    protected $pdo;
    public function __construct()
    {
        require_once __DIR__ . '/config.php';
        $this->pdo = new PDO(
            DSN,
            USERNAME,
            PASSWORD,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
}
