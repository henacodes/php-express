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

    public function status(int $code)
    {
        switch ($code) {
            case 100:
                header("HTTP/1.1 100 Continue");
                break;
            case 200:
                header("HTTP/1.1 200 OK");
                break;
            case 201:
                header("HTTP/1.1 201 Created");
                break;
            case 204:
                header("HTTP/1.1 204 No Content");
                break;
            case 301:
                header("HTTP/1.1 301 Moved Permanently");
                break;
            case 304:
                header("HTTP/1.1 304 Not Modified");
                break;
            case 400:
                header("HTTP/1.1 400 Bad Request");
                break;
            case 401:
                header("HTTP/1.1 401 Unauthorized");
                break;
            case 403:
                header("HTTP/1.1 403 Forbidden");
                break;
            case 404:
                header("HTTP/1.1 404 Not Found");
                break;
            case 500:
                header("HTTP/1.1 500 Internal Server Error");
                break;
            case 503:
                header("HTTP/1.1 503 Service Unavailable");
                break;
                // Add more cases for other status codes as needed
            default:
                header("HTTP/1.1 $code");
                break;
        }
    }
}
