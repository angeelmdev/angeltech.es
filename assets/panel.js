document.querySelectorAll('.sidebar-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('#main-content > .tab-panel').forEach(div => div.classList.add('hidden'));
        
        const target = btn.getAttribute('data-target');
        document.getElementById(target).classList.remove('hidden');
    });
});

document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', async () => {
        const id = btn.dataset.id;

        if (!confirm('¿Seguro que quieres eliminar este proyecto?')) return;

        fetch(`/api/projects/${id}`, { method: 'DELETE' })
        .then(res => {
            if (res.ok) {
                window.location.reload();
            } else {
                alert('Error al eliminar el proyecto');
            }
        });
    });
});
