<?php
include "auth.php";
include "connessione.php";


if (!isset($_GET['id'])) {
    die("ID cliente non specificato");
}

$id = intval($_GET['id']);


$stmt = $conn->prepare("DELETE FROM clienti WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();


header("Location: clienti.php");
exit;
?>
