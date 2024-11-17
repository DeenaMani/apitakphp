<?php
function jsonResponse($status, $message, $data = null)
{
    $response = [
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ];
    echo json_encode($response);
    exit;
}

function hashData($data)
{
    return password_hash($data, PASSWORD_BCRYPT);
}

function verifyHash($password, $hashPassword)
{
    return password_verify($password, $hashPassword);
}

function generateToken()
{
    return bin2hex(random_bytes(32));
}
