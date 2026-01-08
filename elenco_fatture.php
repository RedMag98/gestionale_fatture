<?php
include "auth.php";
include "header2.php";
include "connessione.php";

$sql = "SELECT fatture.*, clienti.nome, fatture.descrizione, fatture.quantita, fatture.prezzo_unitario, fatture.modalita_pagamento 
        FROM fatture 
        JOIN clienti ON fatture.cliente_id = clienti.id
        ORDER BY data DESC";

$result = $conn->query($sql);

if (!$result) {
    die("<p style='color:red'>Errore query: " . $conn->error . "</p>");
}
?>

<h1 style="text-align:center; margin-bottom:20px;">ELENCO FATTURE</h1>

<div style="text-align:center; margin-bottom:20px;">
    <a href="index.php" class="button home">🏠 Home</a>
    <a href="nuova_fattura.php" class="button new-fattura">➕ Nuova Fattura</a>
</div>

<?php if ($result->num_rows > 0) { ?>
<table style="width:100%; border-collapse:collapse; text-align:left;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Numero Fattura</th>
            <th>Data</th>
            <th>Importo</th>
            <th>IVA</th>
            <th>Totale</th>
            <th>Descrizione</th>
            <th>Quantità</th>
            <th>Prezzo Unitario</th>
            <th>Modalità di Pagamento</th>
            <th>Azioni</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['nome']); ?></td>
                <td><?php echo $row['data']; ?></td>
                <td><?php echo number_format($row['importo'],2); ?> €</td>
                <td><?php echo $row['iva']; ?> %</td>
                <td><strong><?php echo number_format($row['totale'],2); ?> €</strong></td>
                <td><?php echo $row['numero_fattura']; ?></td>
                <td><?php echo $row['descrizione']; ?></td>
                <td><?php echo $row['quantita']; ?></td>
                <td><?php echo number_format($row['prezzo_unitario'], 2); ?> €</td>
                <td><?php echo $row['modalita_pagamento']; ?></td>
                <td>
                    <a href="modifica_fattura.php?id=<?php echo $row['id']; ?>" class="button edit">✏️ Modifica</a>
                    <a href="elimina_fattura.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Sei sicuro di voler eliminare questa fattura?')" class="button delete">🗑 Elimina</a>
                    <a href="pdf_fattura.php?id=<?php echo $row['id']; ?>" target="_blank" class="button pdf">📄 PDF</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php } else { ?>
<p style="text-align:center;">Non ci sono fatture nel database.</p>
<?php } ?>

<?php include "footer.php"; ?>

<style>
.button {
    display: inline-block;
    text-decoration: none;
    padding: 8px 15px;
    border-radius: 6px;
    font-weight: bold;
    transition: background 0.3s, transform 0.2s;
    color: white;
    margin: 3px;
}

.button.home { background-color: #4CAF50; }
.button.home:hover { background-color: #45a049; transform: scale(1.05); }

.button.new-fattura { background-color: #28a745; }
.button.new-fattura:hover { background-color: #218838; transform: scale(1.05); }

.button.edit { background-color: #1E90FF; }
.button.edit:hover { background-color: #187bcd; transform: scale(1.03); }

.button.delete { background-color: #FF4C4C; }
.button.delete:hover { background-color: #e03c3c; transform: scale(1.03); }

.button.pdf { background-color: #17a2b8; }
.button.pdf:hover { background-color: #138496; transform: scale(1.03); }

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #ccc;
    padding: 8px;
}

th {
    background-color: #f0f0f0;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

footer {
    text-align:center;
    padding:15px;
    background-color:#f0f0f0;
    margin-top:20px;
}
</style>

<script src="js/theme.js"></script>
<link rel="stylesheet" href="css/themes.css">

