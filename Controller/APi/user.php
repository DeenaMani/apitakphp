<?php
switch ($request) {
    case 'profile';
        profile($data);
        break;
    default;
        http_response_code(404);
        jsonResponse(404, 'Route not found.');
        break;
}

function profile($data)
{
    $headers = apache_request_headers();
    $token = isset($headers['Authorization']) ? trim(str_replace('Bearer', '', $headers['Authorization'])) : null;

    if (!$token) {
        jsonResponse(401, 'Token is required');
    }
    $db = getConnection();
    $stmt = $db->prepare("SELECT id, name, email FROM users WHERE token = ?");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        jsonResponse(200, 'User retrieved successfully', $user);
    } else {
        jsonResponse(401, 'Invalid or expired token');
    }
}
