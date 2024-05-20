<?php

function Post()
{
    if ($_SERVER['REQUEST_METHOD'] != "POST") {
        return null;
    }

    $content_type = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';

    if (strpos($content_type, 'application/json') !== false) {
        $postData = json_decode(file_get_contents('php://input'));
    } else {
        $postData = (object)$_POST;
    }

    return $postData;
}

function Get()
{
    if ($_SERVER['REQUEST_METHOD'] != "GET") {
        return null;
    }

    $queryString = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';

    parse_str($queryString, $queryParams);

    return (object)$queryParams;
}

function verify_post_method()
{
    if ($_SERVER['REQUEST_METHOD'] != "POST") echo json_encode(["error" => "invalid_method"]);
    return;
}
function verify_get_method()
{
    if ($_SERVER['REQUEST_METHOD'] != "GET") echo json_encode(["error" => "invalid_method"]);
    return;
}

function TreatedJson($arr)
{
    $json = json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return json_last_error_msg();
    }
    return $json;
}
