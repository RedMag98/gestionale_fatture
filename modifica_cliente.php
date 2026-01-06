<?php
include "auth.php";
include "connessione.php";
include "header2.php";


if (!isset($_GET['id'])) {
    die("ID cliente non specificato");
}

$id = intval($_GET['id']);


$result = $conn->query("SELECT * FROM clienti WHERE id = $id");
if ($result->num_rows == 0) {
    die("Cliente non trovato");
}

$cliente = $result->fetch_assoc();


$messaggio = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $piva = $_POST['piva'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE clienti SET nome=?, partita_iva=?, email=? WHERE id=?");
    $stmt->bind_param("sssi", $nome, $piva, $email, $id);
    $stmt->execute();
    $stmt->close();

    $messaggio = "✅ Cliente aggiornato con successo!";
}
?>

<div class="container">
    <h1>Modifica Cliente</h1>

    <?php if($messaggio != ""): ?>
        <p style="color:green; font-weight:bold;"><?php echo $messaggio; ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="nome">Nome e Cognome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($cliente['nome']); ?>" required>

        <label for="piva">P.IVA:</label>
        <input type="text" id="piva" name="piva" value="<?php echo htmlspecialchars($cliente['partita_iva']); ?>">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($cliente['email']); ?>">

        <button type="submit" class="button edit">💾 Salva Modifiche</button>
    </form>

    <a href="clienti.php" class="button home">🏠 Torna alla lista</a>
</div>

<?php include "footer.php"; ?>

<style>
.container {
    max-width: 600px;
    margin: 30px auto;
    text-align: center;
}

form label {
    display: block;
    margin-top: 15px;
    font-weight: bold;
    text-align: left;
    margin-left: 10%;
}

form input {
    display: block;
    width: 80%;
    padding: 8px;
    margin: 5px auto 15px auto;
    border-radius: 4px;
    border: 1px solid #ccc;
    font-size: 14px;
}

.button {
    display: inline-block;
    text-decoration: none;
    padding: 8px 15px;
    border-radius: 6px;
    font-weight: bold;
    transition: background 0.3s, transform 0.2s;
    color: white;
    margin: 5px;
}

.button.edit { background-color: #1E90FF; }
.button.edit:hover { background-color: #187bcd; transform: scale(1.03); }

.button.home { background-color: #4CAF50; }
.button.home:hover { background-color: #45a049; transform: scale(1.05); }

p {
    font-size: 16px;
}
</style>
