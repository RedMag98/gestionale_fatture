<?php
$conn = new mysqli("localhost", "root", "", "gestionale_fatture");

if ($conn->connect_error) {
    die("Errore di connessione");
}
?>
