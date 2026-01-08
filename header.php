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
            background-color: #030303ff;
        }

      
        header {
            background-color: #007BFF;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        header h1 {
            margin: 0;
            font-size: 22px;
            text-align: center;
            flex: 1;
        }

       
        .hamburger-icon {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 25px;
            height: 20px;
            cursor: pointer;
            z-index: 1000;
        }

        .hamburger-icon div {
            background-color: white;
            height: 3px;
            width: 100%;
            border-radius: 5px;
        }

       
        .menu-hamburger {
            display: none; 
            flex-direction: column;
            align-items: flex-start;
            position: absolute;
            top: 60px;
            left: 0;
            background-color: rgba(0,0,0,0); 
            padding: 10px;
            width: 100%;
            z-index: 999;
        }

        
        .menu-hamburger.show {
            display: flex; 
            animation: slideIn 0.5s ease-in-out forwards;
        }

      
        .menu-hamburger a {
            margin: 5px 0;
            color: white;
            text-decoration: none;
            font-weight: bold;
            opacity: 0; 
            animation: fadeIn 0.5s ease-out forwards;
        }

        .menu-hamburger a:nth-child(1) {
            animation-delay: 0.2s; 
        }

        .menu-hamburger a:nth-child(2) {
            animation-delay: 0.4s; 
        }

        .menu-hamburger a:nth-child(3) {
            animation-delay: 0.6s; 
        }

       
        @keyframes fadeIn {
            to {
                opacity: 1; 
                transform: translateX(0);
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px); 
            }
            to {
                transform: translateY(0); 
            }
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

        
        @media(max-width:768px) {
            
            .menu-hamburger.show {
                display: flex;
            }
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


<?php if(basename($_SERVER['PHP_SELF']) == 'index.php'): ?>
    <div class="menu-hamburger" id="menu">
        <a href="nuova_fattura.php" class="button new-fattura">➕ Nuova Fattura</a>
        <a href="elenco_fatture.php" class="button pdf">📄 Elenco Fatture</a>
        <a href="clienti.php" class="button clienti">👥 Clienti</a>
    </div>
<?php endif; ?>

<script>
    
    function toggleMenu() {
        var menu = document.getElementById("menu");
        menu.classList.toggle("show"); 
    }
</script>

</body>
</html>
