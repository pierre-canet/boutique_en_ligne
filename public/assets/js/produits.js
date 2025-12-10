document.addEventListener('DOMContentLoaded', function () {
    /* -------------------------------------------------------------
       1. Gestion du menu des catégories
       ------------------------------------------------------------- */
    const triggerBtn = document.getElementById('cat-trigger-btn');
    const popupContent = document.getElementById('cat-popup-content');
    const closeBtn = document.getElementById('close-popup-btn');

    if (triggerBtn && popupContent) {

        function toggleMenu() {
            if (popupContent.style.display === 'block') {
                popupContent.style.display = 'none';
            } else {
                popupContent.style.display = 'block';
            }
        }

        triggerBtn.addEventListener('click', function(e) {
            e.stopPropagation(); 
            toggleMenu();
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                popupContent.style.display = 'none';
            });
        }

        document.addEventListener('click', function(event) {
            if (popupContent.style.display === 'block' && 
                !popupContent.contains(event.target) && 
                !triggerBtn.contains(event.target)) {
                
                popupContent.style.display = 'none';
            }
        });
    }

    /* -------------------------------------------------------------
      (Product Modals
       ------------------------------------------------------------- */
    
    document.querySelectorAll('.modal-trigger').forEach(a => {
        a.addEventListener('click', e => {
            e.preventDefault();
            const targetId = a.getAttribute('href');
            if (targetId && targetId.startsWith('#')) {
                const target = document.querySelector(targetId);
                if(target) {
                    target.style.display = 'flex';
                }
            }
        });
    });

    // Fermez le modal

    document.querySelectorAll('.modal-overlay, .close-btn').forEach(el => {
        el.addEventListener('click', e => {
            //le bouton de fermeture est cliqué

            if (e.target === el || e.target.classList.contains('close-btn')) {
                // Trouvez le modal

                const modal = el.closest('.modal-overlay');
                if (modal) {
                    modal.style.display = 'none';
                }
            }
        });
    });
});