<?php include "auth.php"; ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>ContabileOne</title>
    <style>
        body, html {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100%;
            background-color: #f9f9f9;
        }

        main {
            flex-grow: 1;
        }

        footer {
            margin-top: auto;
        }
       
        header {
            background-color: #007BFF;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: center;
        }

        header h1 {
            margin: 0;
            font-size: 22px;
            text-align: center;
            flex: 1;
        }


        
        nav a.logout {
            background-color: white;
            color: #007BFF;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.2s, color 0.2s;
        }

        nav a.logout:hover {
            background-color: #0056b3;
            color: white;
        }

        
        a.button {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            transition: 0.2s;
        }

        a.new-fattura { background-color: #28a745; }
        a.new-fattura:hover { background-color: #218838; }

        a.pdf { background-color: #17a2b8; }
        a.pdf:hover { background-color: #138496; }

        a.edit { background-color: #ffc107; color: black; }
        a.edit:hover { background-color: #e0a800; }

        a.clienti { background-color: #007BFF; }
        a.clienti:hover { background-color: #0056b3; }

        
        .home-bg {
            background-image: url('img/home-bg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: calc(100vh - 60px);
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }

        .home-content {
            background-color: rgba(0,0,0,0.6);
            padding: 40px;
            border-radius: 15px;
            max-width: 500px;
        }

        .home-content h1 {
            margin-bottom: 20px;
        }

        .home-content a.button {
            margin: 10px 5px;
        }

    
    </style>
</head>
<body>

<header>
    <div class="hamburger-icon" onclick="toggleMenu()">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <h1>ContabileOne</h1>
    <nav>
        <a href="logout.php" class="logout">Logout</a>
    </nav>
</header>


</body>
</html>
