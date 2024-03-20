<?php
$servername = "localhost";
$username = "id21048547_reddyj699";
$password = "2{UEXhlm_+D[#JtB";
$dbname = "id21048547_jaswanth";

try {
    $conn = new mysqli($servername, $username, $password, $dbname); // Change $mysqli to $conn
    if ($conn->connect_errno) {
        die("Error connecting: " . $conn->connect_error);
    }
} catch(Exception $e) {
    die("Error connecting: " . $e->getMessage());
}
?>
