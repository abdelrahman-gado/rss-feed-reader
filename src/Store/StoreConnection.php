<?php

declare(strict_types=1);

namespace RssFeedReader\Store;

class StoreConnection
{
    const STORE_FILE_PATH = './store/store.csv';
    private static ?StoreConnection $instance = null;
    private $conn;

    private function __construct()
    {
        $this->conn = fopen(self::STORE_FILE_PATH, 'a+');

        if ($this->conn === false) {
            throw new \Exception('Cannot Open File');
        }
    }

    public static function getInstance(): StoreConnection
    {
        if (self::$instance === null) {
            self::$instance = new StoreConnection();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }


    public function __destruct()
    {
        fclose($this->conn);
    }
}