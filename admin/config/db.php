<?php 

$host = "localhost";
$db = "website";
$user = "root";
$password = "";

try {
    $conection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    if ($conection) {
        // echo "Conection successful";
    }
} catch (Exception $e) {
    echo $e->getMessage();
    //throw $th;
}
?>