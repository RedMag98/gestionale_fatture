document.addEventListener('DOMContentLoaded', function() {
    const themeSelect = document.getElementById('theme-select');
    const headerEl = document.querySelector('header');

    
    const savedTheme = localStorage.getItem('theme') || 'default';

    if(headerEl) {
        headerEl.className = savedTheme;
    }
    document.body.className = savedTheme;

    
    if(themeSelect) {
        themeSelect.value = savedTheme;

       
        themeSelect.addEventListener('change', function() {
            const theme = this.value;

            document.body.className = theme;
            if(headerEl) headerEl.className = theme;

            localStorage.setItem('theme', theme);
        });
    }
});
