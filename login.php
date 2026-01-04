<?php
session_start();
include "connessione.php";

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

 
    $stmt = $conn->prepare("SELECT * FROM utenti WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: index.php");
            exit;
        } else {
            $error = "Username o password sbagliati";
        }
    } else {
        $error = "Username o password sbagliati";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>ContabileOne - Login</title>

    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #007BFF, #00c6ff);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background: white;
            padding: 40px;
            border-radius: 12px;
            width: 360px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
        }

        .login-box h1 {
            margin-bottom: 10px;
            color: #007BFF;
        }

        .login-box p {
            color: #555;
            margin-bottom: 25px;
        }

        .login-box input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
            box-sizing: border-box;
        }

        .login-box button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .login-box button:hover {
            background-color: #0056b3;
        }

        .error {
            background-color: #ffe5e5;
            color: #c0392b;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        footer {
            margin-top: 20px;
            font-size: 13px;
            color: #999;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h1>ContabileOne</h1>
    <p>Accesso al gestionale</p>

    <?php if (!empty($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>

    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Accedi</button>
    </form>

    <footer>
        © <?php echo date("Y"); ?> ContabileOne
    </footer>
</div>

</body>
</html>
