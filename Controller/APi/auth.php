<?php
switch ($request) {
    case 'login';
        login($data);
        break;
    case 'register';
        register($data);
        break;
    default;
        http_response_code(404);
        echo json_encode(['status' => 404, 'message' => 'Route not found.']);
        break;
}

function login($data)
{
    if (empty($data['email']) || empty($data['password'])) {
        jsonResponse(400, 'Email and Password are required');
    }

    $db = getConnection();
    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$data['email']]);
    $user = $stmt->fetch();

    if ($user && verifyHash($data['password'], $user['password'])) {
        $token = generateToken();
        $db->prepare("UPDATE users SET token = ? WHERE id = ?")->execute([$token, $user['id']]);
        jsonResponse(200, 'Login successful', ['token' => $token, 'user_id' => $user['id']]);
    } else {
        jsonResponse(401, 'Invalid Email or Password');
    }
}

function register($data)
{
    if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
        jsonResponse(400, 'Name, Email, and Password are required');
    }

    $db = getConnection();
    $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    try {
        $stmt->execute([$data['name'], $data['email'], hashData($data['password'])]);
        jsonResponse(201, 'User registered successfully');
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            jsonResponse(400, 'Email already exists');
        } else {
            jsonResponse(500, 'Server Error');
        }
    }
}
