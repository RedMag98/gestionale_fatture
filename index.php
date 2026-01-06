<?php
include "auth.php";
include "header.php";
?>


<div class="home-bg">
    <div class="home-content">
        <h1>BENVENUT* <?php echo $_SESSION['username']; ?>!</h1>
        <p>Qui puoi gestire le tue fatture e clienti.</p>

        
    </div>
</div>

<?php
include "footer.php";
?>
