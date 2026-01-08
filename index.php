<?php
include "auth.php";
include "header.php"; 
?>

<div class="home-bg" id="home-bg">
    <div class="theme-selector-container">
        <label for="theme-select">🎨 Cambia tema:</label>
        <select id="theme-select">
            <option value="default">🟢 Predefinito</option>
            <option value="natale">🎄 Natale</option>
            <option value="halloween">🎃 Halloween</option>
            <option value="pasqua">🐣 Pasqua</option>
            <option value="agosto">☀️ Agosto</option>
        </select>
    </div>

    <div class="home-content" id="home-content">
        <h1>BENVENUT* <?php echo $_SESSION['username']; ?>!</h1>
        <p>Qui puoi gestire le tue fatture e clienti.</p>
    </div>
</div>

<?php
include "footer.php";
?>

<style>

.home-bg {
    background-image: url('img/home-bg.jpg'); 
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: calc(100vh - 60px); 
    position: relative; 
    display: flex;
    justify-content: center;
    align-items: center;
    transition: background-color 0.3s;
}

.home-content {
    background-color: rgba(0, 0, 0, 0.49); 
    padding: 40px;
    border-radius: 15px;
    text-align: center;
    transition: background-color 0.3s, color 0.3s;
}


.theme-selector-container {
    position: absolute;
    top: 20px;    
    right: 20px;  
    background-color: rgba(255, 255, 255, 0.3); 
    padding: 8px 12px;
    border-radius: 8px;
    backdrop-filter: blur(5px); 
    z-index: 100;
}

#theme-select {
    padding: 6px 10px;
    font-size: 14px;
    border-radius: 6px;
    border: 1px solid #ccc;
    cursor: pointer;
}


body.default { background-color: #f9f9f9; color: #333; }
body.natale { background-color: #ffe6e6; color: #8B0000; }
body.halloween { background-color: #1b1b1b; color: #ff9900; }
body.pasqua { background-color: #fff0f5; color: #663399; }
body.agosto { background-color: #fff3cd; color: #333; }


header.default { background-color: #007BFF; color: white; }
header.natale { background-color: #FF0000; color: white; }
header.halloween { background-color: #ff6600; color: white; }
header.pasqua { background-color: #8A2BE2; color: white; }
header.agosto { background-color: #f0ad4e; color: black; }
</style>


<script>
const themeSelect = document.getElementById('theme-select');
const headerEl = document.querySelector('header');


function applyTheme(theme) {
    
    document.body.className = '';
    headerEl.className = '';

    
    document.body.classList.add(theme);
    headerEl.classList.add(theme);

    
    localStorage.setItem('selectedTheme', theme);
}


const savedTheme = localStorage.getItem('selectedTheme') || 'default';
applyTheme(savedTheme);
themeSelect.value = savedTheme;


themeSelect.addEventListener('change', function() {
    applyTheme(this.value);
});
</script>

<link rel="stylesheet" href="css/themes.css">
<script src="js/theme.js"></script>
