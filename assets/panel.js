document.querySelectorAll('.sidebar-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        // Oculta todos los paneles
        document.querySelectorAll('#main-content > .tab-panel').forEach(div => div.classList.add('hidden'));
        
        // Muestra el panel seleccionado
        const target = btn.getAttribute('data-target');
        document.getElementById(target).classList.remove('hidden');
    });
});
