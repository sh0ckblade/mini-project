<?php
$user="root";
$mdp="";
$db="hospital";
$server="localhost";
$conn = new mysqli($server, $user, $mdp, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>