<?php
$request = trim($_SERVER['REQUEST_URI'], '/');
$base_path = 'task/php/';
header('content-Type: applicaton/json');

$data = json_decode(file_get_contents('php://input'), true);

if (strpos($request, $base_path) === 0) {
    $request = substr($request, strlen($base_path));
}

require './utlis/helper.php';
require './utlis/db.php';
require './routes/api.php';
