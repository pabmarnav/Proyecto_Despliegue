<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$host = getenv('MYSQL_HOST');
$user = getenv('MYSQL_USER');
$pass = getenv('MYSQL_PASSWORD');
$db   = getenv('MYSQL_DATABASE');

echo json_encode(["status" => "DEBUG", "host" => $host]);

try {
    $dsn = "mysql:dbname=$db;host=$host;charset=UTF8";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo json_encode(["status" => "SUCCESS", "msg" => "Conexion correcta a la BD"]);
} catch (PDOException $e) {
    echo json_encode(["status" => "ERROR", "msg" => $e->getMessage()]);
}
?>
