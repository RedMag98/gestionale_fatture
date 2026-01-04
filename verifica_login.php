<?php
session_start();
include "connessione.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM utenti WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $_SESSION['login'] = true;
    header("Location: index.php");
} else {
    echo "Credenziali errate";
}
?>
