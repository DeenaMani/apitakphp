<?php
//Based on the route matching acess the file
switch ($request) {
    case 'login';
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            http_response_code(405);
            jsonResponse('405', 'Method not found allowed mehtod is post for login route.');
        }
        require './Controller/APi/auth.php';
        break;
    case 'register';
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            http_response_code(405);
            jsonResponse('405', 'Method not found allowed mehtod is post for register route.');
        }
        require './Controller/APi/auth.php';
        break;
    case 'profile';
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            http_response_code(405);
            jsonResponse('405', 'Method not found allowed mehtod is post for profile route.');
        }
        require './Controller/APi/usr.php';
        break;
    default;
        http_response_code(404);
        echo json_encode(['status' => 404, 'message' => 'Route not found.']);
        break;
}
