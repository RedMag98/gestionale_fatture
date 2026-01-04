<?php
include "auth.php";
include "header2.php";
include "connessione.php";

$successMessage = '';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $cliente_id = $_POST['cliente_id'];
    $data = $_POST['data']; 
    $iva = $_POST['iva'];
    $numero_fattura = $_POST['numero_fattura'];
    $modalita_pagamento = $_POST['modalita_pagamento'];
    $descrizione = $_POST['descrizione'];
    $quantita = $_POST['quantita'];
    $prezzo_unitario = $_POST['prezzo_unitario'];

   
    $importo = $quantita * $prezzo_unitario;
    $totale = $importo + ($importo * $iva / 100);

    
    $data = date('Y-m-d', strtotime($data)); 

    
    $stmt = $conn->prepare("INSERT INTO fatture (cliente_id, data, importo, iva, totale, numero_fattura, descrizione, quantita, prezzo_unitario, modalita_pagamento) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("issdddsdss", $cliente_id, $data, $importo, $iva, $totale, $numero_fattura, $descrizione, $quantita, $prezzo_unitario, $modalita_pagamento);

    if ($stmt->execute()) {
        $successMessage = "<p id='successMessage' style='color:green; text-align:center; margin-top:20px;'>Fattura creata con successo!</p>";  // Messaggio di successo
    } else {
        $successMessage = "<p style='color:red; text-align:center; margin-top:20px;'>Errore: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

?>

<div style="display: flex; justify-content: center; align-items: center; min-height: 70vh; margin-top: 80px;">
   
    <form method="post" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); width: 400px; text-align: center;">
        <h2 style="margin-bottom:25px;">NUOVA FATTURA</h2>

        <?php
        $res = $conn->query("SELECT * FROM clienti ORDER BY nome ASC");
        ?>

        <div style="margin-bottom:15px; text-align:left;">
            <label>Cliente:</label><br>
            <select name="cliente_id" required style="width:100%; padding:10px; box-sizing:border-box;">
                <option value="">-- Seleziona Cliente --</option>
                <?php while($c = $res->fetch_assoc()) {
                    echo "<option value='".$c['id']."'>".$c['nome']."</option>";
                } ?>
            </select>
        </div>

        <div style="margin-bottom:15px; text-align:left;">
            <label>Data:</label><br>
            <input type="date" name="data" required style="width:100%; padding:10px; box-sizing:border-box;">
        </div>

        <div style="margin-bottom:15px; text-align:left;">
            <label>Descrizione:</label><br>
            <input type="text" name="descrizione" required style="width:100%; padding:10px; box-sizing:border-box;">
        </div>

        <div style="margin-bottom:15px; text-align:left;">
            <label>Quantità:</label><br>
            <input type="number" name="quantita" step="1" required style="width:100%; padding:10px; box-sizing:border-box;">
        </div>

        <div style="margin-bottom:15px; text-align:left;">
            <label>Prezzo Unitario (€):</label><br>
            <input type="number" name="prezzo_unitario" step="0.01" required style="width:100%; padding:10px; box-sizing:border-box;">
        </div>

        <div style="margin-bottom:15px; text-align:left;">
            <label>IVA (%):</label><br>
            <input type="number" name="iva" value="22" step="0.01" required style="width:100%; padding:10px; box-sizing:border-box;">
        </div>

        <div style="margin-bottom:15px; text-align:left;">
            <label>Modalità di Pagamento:</label><br>
            <select name="modalita_pagamento" required style="width:100%; padding:10px; box-sizing:border-box;">
                <option value="Contante">Contante</option>
                <option value="Bonifico">Bonifico</option>
                <option value="Carta di credito">Carta di credito</option>
                <option value="PayPal">PayPal</option>
            </select>
        </div>

        <div style="margin-bottom:20px; text-align:left;">
            <label>Numero Fattura:</label><br>
            <input type="text" name="numero_fattura" required style="width:100%; padding:10px; box-sizing:border-box;">
        </div>

        <button type="submit" class="button new-fattura">➕ Crea Fattura</button>
        <button type="button" onclick="location.href='index.php'" class="button home">🏠 Home</button>

        <?php echo $successMessage; ?>
    </form>
</div>



<style>
.button {
    display: block;
    width: 100%;
    text-decoration: none;
    border-radius: 6px;
    font-weight: bold;
    transition: background 0.3s, transform 0.2s;
    color: white;
    margin: 8px 0;
    padding: 12px;
    font-size: 16px;
    border: none; 
    cursor: pointer;
    box-sizing: border-box;
}

.button.new-fattura {
    background-color: #ffc107; 
    color: black; 
}
.button.new-fattura:hover { 
    background-color: #e0a800; 
    transform: scale(1.05); 
}

.button.home {
    background-color: #4CAF50; 
}
.button.home:hover { 
    background-color: #45a049; 
    transform: scale(1.05); 
}

#successMessage {
    font-size: 16px;
    margin-top: 20px;
    color: green;
}

</style>

<script>

setTimeout(function() {
    var successMessage = document.getElementById('successMessage');
    if (successMessage) {
        successMessage.style.display = 'none';
    }
}, 4000);
</script>
