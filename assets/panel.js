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

document.querySelectorAll('.move-left-btn').forEach(btn => {
    btn.addEventListener('click', async () => {
        const id = btn.dataset.id;

        fetch(`/api/projects/${id}/move`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ direction: 'left' })
        })
        .then(res => {
            if (res.ok) {
                window.location.reload();
            } else {
                alert('Error al mover el proyecto');
            }
        });
    });
});

document.querySelectorAll('.move-right-btn').forEach(btn => {
    btn.addEventListener('click', async () => {
        const id = btn.dataset.id;

        fetch(`/api/projects/${id}/move`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ direction: 'right' })
        })
        .then(res => {
            if (res.ok) {
                window.location.reload();
            } else {
                alert('Error al mover el proyecto');
            }
        });
    });
});
