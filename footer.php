<footer>
    &copy; <?php echo date("Y"); ?> ContabileOne. Tutti i diritti riservati.
</footer>

<style>
footer {
    text-align: center;
    padding: 15px 0;
    background-color: #f0f0f0;
    position: relative; 
    width: 100%;
    margin-top: 20px;
    font-size: 14px;
    color: #333;
}

html, body {
    height: 100%;
}

body {
    display: flex;
    flex-direction: column;
}

main {
    flex: 1; 
}
</style>

<?php
// 🔹 ASSISTENTE VIRTUALE
include "chat_assistente.php";
?>
