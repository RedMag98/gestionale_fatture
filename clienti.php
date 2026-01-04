<?php
include "auth.php";
include "connessione.php";
include "header2.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    $piva = $_POST['piva'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO clienti (nome, partita_iva, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $piva, $email);
    $stmt->execute();
    $stmt->close();

    header("Location: clienti.php");
    exit;
}


$result = $conn->query("SELECT * FROM clienti ORDER BY nome ASC");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Clienti</title>
    <style>
       
        .container {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        
        h1 {
            text-align: center;
            margin-bottom: 30px;
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

        .button.home { background-color: #4CAF50; }
        .button.home:hover { background-color: #45a049; transform: scale(1.05); }

        .button.edit { background-color: #1E90FF; }
        .button.edit:hover { background-color: #187bcd; transform: scale(1.03); }

        .button.delete { background-color: #FF4C4C; }
        .button.delete:hover { background-color: #e03c3c; transform: scale(1.03); }

     
        form {
            margin-bottom: 20px;
        }
        form input {
            padding: 8px;
            margin: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        table {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            border-collapse: collapse;
            text-align: left;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>CLIENTI</h1>
<a href="index.php" class="button home">🏠 Home</a>
   
    <form method="post">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="text" name="piva" placeholder="Partita IVA">
        <input type="email" name="email" placeholder="Email">
        <button type="submit" class="button edit">➕ Aggiungi Cliente</button>
    </form>

   
    

   
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>P. IVA</th>
                <th>Email</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['nome']); ?></td>
                    <td><?php echo htmlspecialchars($row['partita_iva']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td>
                        <a href="modifica_cliente.php?id=<?php echo $row['id']; ?>" class="button edit">✏️ Modifica</a>
                        <a href="elimina_cliente.php?id=<?php echo $row['id']; ?>" class="button delete" onclick="return confirm('Sei sicuro di voler eliminare questo cliente?')">🗑 Elimina</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
