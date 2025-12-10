document.addEventListener('DOMContentLoaded', function () {
    const triggerBtn = document.getElementById('cat-trigger-btn');
    const popupContent = document.getElementById('cat-popup-content');
    const closeBtn = document.getElementById('close-popup-btn');

    function toggleMenu() {
        if (popupContent.style.display === 'block') {
            popupContent.style.display = 'none';
            // triggerBtn.style.backgroundColor = '#FF1493';
        } else {
            popupContent.style.display = 'block';
            // triggerBtn.style.backgroundColor = '#8A2BE2';
        }
    }

    triggerBtn.addEventListener('click', function(e) {
        e.stopPropagation(); 
        toggleMenu();
    });

    closeBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        popupContent.style.display = 'none';
    });

    // Fermez le menu en cliquant dessus

    document.addEventListener('click', function(event) {
        if (!popupContent.contains(event.target) && !triggerBtn.contains(event.target)) {
            popupContent.style.display = 'none';
        }
    });
});
    // ---------------------------------------------
document.addEventListener('DOMContentLoaded', function () {
    // Ouvrir le modal
    document.querySelectorAll('.modal-trigger').forEach(a => {
        a.addEventListener('click', e => {
            e.preventDefault();
            const target = document.querySelector(a.getAttribute('href'));
            if(target) target.style.display = 'flex';
        });
    });
    // Fermer le modal
    document.querySelectorAll('.modal-overlay, .close-btn').forEach(el => {
        el.addEventListener('click', e => {
            if (e.target === el || e.target.classList.contains('close-btn')) {
                el.closest('.modal-overlay').style.display = 'none';
            }
        });
    });
});