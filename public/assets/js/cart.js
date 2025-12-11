document.addEventListener('DOMContentLoaded', function () {
    // Helper to send POST JSON
    function postJson(url, data) {
        return fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        }).then(r => r.json());
    }

    // Add-to-cart buttons on products pages
    document.querySelectorAll('.add-to-cart').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            // Try to get product data from nearest .product-card, then from button dataset, then from common selectors (show page)
            const card = btn.closest('.product-card');
            const id = (card && card.dataset.id) || btn.dataset.id || btn.getAttribute('data-id');
            let name = (card && card.dataset.name) || btn.dataset.name || btn.getAttribute('data-name');
            let price = parseFloat((card && card.dataset.price) || btn.dataset.price || btn.getAttribute('data-price')) || 0;
            let image = (card && card.dataset.image) || btn.dataset.image || btn.getAttribute('data-image');

            // Fallbacks for product show page structure
            if (!name) {
                const titleEl = document.querySelector('.detail-title');
                name = titleEl ? titleEl.textContent.trim() : name;
            }
            if (!price) {
                const priceEl = document.querySelector('.detail-price') || document.querySelector('.price');
                if (priceEl) {
                    const txt = priceEl.textContent.replace(/[^0-9.,]/g, '').replace(',', '.');
                    price = parseFloat(txt) || 0;
                }
            }
            if (!image) {
                const imgEl = document.querySelector('.product-image-large img') || document.querySelector('.product-image img');
                image = imgEl ? imgEl.src : (image || '');
            }

            if (!id) {
                console.warn('Missing product id for add-to-cart');
                return;
            }

            postJson('/cart/add', { id: id, qty: 1 })
                .then(resp => {
                    if (resp && resp.success) {
                        const counter = document.getElementById('cart-count');
                        if (counter) counter.textContent = resp.count || 0;
                        const original = btn.textContent;
                        btn.textContent = 'Ajouté';
                        setTimeout(() => btn.textContent = original, 900);
                    } else {
                        alert(resp.message || 'Erreur ajout panier');
                    }
                }).catch(err => {
                    console.error(err);
                    alert('Erreur réseau');
                });
        });
    });

    // Cart page interactions (update qty, remove)
    const cartItems = document.getElementById('cart-items');
    if (cartItems) {
        cartItems.addEventListener('change', function (e) {
            if (e.target.classList.contains('cart-qty')) {
                const row = e.target.closest('tr');
                const id = row.dataset.id;
                const qty = parseInt(e.target.value) || 1;
                postJson('/cart/update', { id: id, qty: qty }).then(resp => {
                    if (resp && resp.success) {
                        // update sub and total
                        const priceText = row.querySelector('.cart-price').textContent.replace('$','').trim();
                        const price = parseFloat(priceText) || 0;
                        row.querySelector('.cart-sub').textContent = '$' + (price * qty).toFixed(2);
                        const totalEl = document.getElementById('cart-total');
                        if (totalEl) totalEl.textContent = '$' + (resp.total || 0).toFixed(2);
                        const counter = document.getElementById('cart-count');
                        if (counter) counter.textContent = resp.count || 0;
                    }
                }).catch(err => console.error(err));
            }
        });

        cartItems.addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-remove')) {
                const row = e.target.closest('tr');
                const id = row.dataset.id;
                if (!confirm('Supprimer ce produit du panier ?')) return;
                postJson('/cart/remove', { id: id }).then(resp => {
                    if (resp && resp.success) {
                        row.remove();
                        const totalEl = document.getElementById('cart-total');
                        if (totalEl) totalEl.textContent = '$' + (resp.total || 0).toFixed(2);
                        const counter = document.getElementById('cart-count');
                        if (counter) counter.textContent = resp.count || 0;
                        // if cart empty, show message
                        if (!document.querySelectorAll('#cart-items tr').length) {
                            document.getElementById('cart-container').innerHTML = '<p>Votre panier est vide.</p>';
                        }
                    }
                }).catch(err => console.error(err));
            }
        });
    }
});
