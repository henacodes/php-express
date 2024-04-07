<?php


class Response
{
    public function __construct()
    {
    }

    public function json(array $data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function sendFile(string $filePath)
    {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        readfile($filePath);
    }
}
