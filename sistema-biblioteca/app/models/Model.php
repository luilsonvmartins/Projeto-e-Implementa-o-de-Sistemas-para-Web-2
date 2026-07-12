<?php
/**
 * Model.php — Model base com conexão PDO
 */

abstract class Model
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }
}
