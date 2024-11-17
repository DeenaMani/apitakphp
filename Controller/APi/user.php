<?php
switch ($request) {
    case 'profile';
        login($data);
        break;
    default;
        http_response_code(404);
        jsonResponse(404, 'Route not found.');
        break;
}

function profile($data) {}
