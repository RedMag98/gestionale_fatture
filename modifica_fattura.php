<?php
include "auth.php";
include "connessione.php";
include "header2.php";

$id = $_GET['id'];


$sql = "SELECT * FROM fatture WHERE id='$id'";
$result = $conn->query($sql);
$f = $result->fetch_assoc();


$clienti = $conn->query("SELECT * FROM clienti");


if ($_POST) {
    
    $cliente_id = $_POST['cliente_id'];
    $data = $_POST['data'];
    $importo = $_POST['importo'];
    $iva = $_POST['iva'];
    $quantita = $_POST['quantita'];
    $prezzo_unitario = $_POST['prezzo_unitario'];
    $descrizione = $_POST['descrizione'];

   
    $totale = $importo + ($importo * $iva / 100);

    
    $conn->query("UPDATE fatture 
                  SET cliente_id='$cliente_id', data='$data', importo='$importo', iva='$iva', totale='$totale', 
                      quantita='$quantita', prezzo_unitario='$prezzo_unitario', descrizione='$descrizione'
                  WHERE id='$id'");

    
    header("Location: elenco_fatture.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>MODIFICA FATTURA</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
            color: #007BFF;
        }

        form {
            background-color: white;
            padding: 20px;
            width: 400px;
            margin: 0 auto;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 12px;
            border-radius: 6px;
            border: none;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        a {
            text-decoration: none;
            color: #ffffff;
            display: inline-block;
            text-align: center;
            margin-top: 20px;
            background-color: red;
            padding: 12px;
            border-radius: 6px;
            font-size: 16px;
            width: auto;  
            margin: 0 auto;  
        }

        a:hover {
            text-decoration: underline;
            background-color: #0056b3;
        }

        .form-section {
            margin-bottom: 15px;
        }

        .form-section input, .form-section select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .form-section label {
            font-size: 14px;
        }
    </style>
</head>
<body>

<h1>MODIFICA FATTURA</h1>

<form method="post">
    <div class="form-section">
        <label>Cliente:</label>
        <select name="cliente_id" required>
            <?php while ($c = $clienti->fetch_assoc()) { ?>
                <option value="<?php echo $c['id']; ?>" <?php if($c['id'] == $f['cliente_id']) echo "selected"; ?>>
                    <?php echo $c['nome']; ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div class="form-section">
        <label>Data:</label>
        <input type="date" name="data" value="<?php echo $f['data']; ?>" required>
    </div>

    <div class="form-section">
        <label>Descrizione:</label>
        <input type="text" name="descrizione" value="<?php echo $f['descrizione']; ?>" required>
    </div>

    <div class="form-section">
        <label>Quantità:</label>
        <input type="number" name="quantita" value="<?php echo $f['quantita']; ?>" step="1" required>
    </div>

    <div class="form-section">
        <label>Prezzo Unitario (€):</label>
        <input type="number" name="prezzo_unitario" value="<?php echo $f['prezzo_unitario']; ?>" step="0.01" required>
    </div>

    <div class="form-section">
        <label>IVA (%):</label>
        <input type="number" name="iva" value="<?php echo $f['iva']; ?>" step="0.01" required>
    </div>

    <button type="submit">Salva Modifica</button>
</form>

<a href="elenco_fatture.php">🔙 Torna all’elenco</a>

</body>
</html>

<script src="js/theme.js"></script>
<link rel="stylesheet" href="css/themes.css">

