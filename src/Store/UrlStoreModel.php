<?php

declare(strict_types=1);

namespace RssFeedReader\Store;

class UrlStoreModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = StoreConnection::getInstance()->getConnection();
    }

    public function insertUrl(array $data): void
    {
        if ($this->validateInsertedData($data)) {
            fputcsv($this->conn, $data);
        } else {
            throw new \Exception('Problem on inserted data');
        }
    }

    public function getAllUrls(): array
    {
        $data = [];

        fseek($this->conn, 0);

        while (($url = fgetcsv($this->conn)) !== false) {
            $data[] = $url;
        }

        return $data;
    }

    private function validateInsertedData(array $data): bool
    {
        if (count($data) > 1) {
            return false;
        }

        $url = filter_var($data[0], FILTER_VALIDATE_URL);
        if ($url === false) {
            return false;
        }


        return true;
    }

}