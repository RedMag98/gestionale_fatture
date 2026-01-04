<?php
include "auth.php";
include "connessione.php";

$id = $_GET['id'];


$conn->query("DELETE FROM fatture WHERE id='$id'");

header("Location: elenco_fatture.php");
?>
