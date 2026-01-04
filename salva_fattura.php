<?php
include "connessione.php";

$cliente_id = $_POST['cliente_id'];
$data = $_POST['data'];
$importo = $_POST['importo'];
$iva = $_POST['iva'];

$totale = $importo + ($importo * $iva / 100);

$anno = date("Y");


$sql_last = "SELECT numero_fattura FROM fatture WHERE numero_fattura LIKE '$anno/%' ORDER BY id DESC LIMIT 1";
$result_last = $conn->query($sql_last);

if ($result_last->num_rows > 0) {
    $row_last = $result_last->fetch_assoc();
  
    $last_num = (int)explode("/", $row_last['numero_fattura'])[1];
    $progressivo = $last_num + 1;
} else {
    $progressivo = 1;
}


$numero_fattura = $anno . "/" . str_pad($progressivo, 3, "0", STR_PAD_LEFT);


$sql = "INSERT INTO fatture (cliente_id, data, importo, iva, totale, numero_fattura)
        VALUES ('$cliente_id', '$data', '$importo', '$iva', '$totale', '$numero_fattura')";



$conn->query($sql);

echo "Fattura salvata!";
?>
