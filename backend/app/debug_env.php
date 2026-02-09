<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'api/db/db.php';

echo "<h2>Debug Info</h2>";

echo "<h3>MySQL Env Vars:</h3>";
echo "MYSQL_USER: " . getenv('MYSQL_USER') . "<br>";

echo "<h3>getDBConfig() Result:</h3>";
$config = getDBConfig();
var_dump($config);

echo "<h3>Trying Connection...</h3>";
$pdo = getDBConnection();
if ($pdo) {
    echo "Connection OK!<br>";
    $stmt = $pdo->query("SELECT count(*) FROM film");
    $count = $stmt->fetchColumn();
    echo "Rows in film table: $count";
} else {
    echo "Connection FAILED.";
}
?>