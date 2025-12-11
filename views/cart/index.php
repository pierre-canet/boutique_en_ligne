<div class="cart-page">
    <h1>Votre panier</h1>

    <div id="cart-container">
        <?php if (empty($cart)): ?>
            <p>Votre panier est vide.</p>
        <?php else: ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Sous-total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="cart-items">
                    <?php foreach ($cart as $item): ?>
                        <tr data-id="<?= $item['id'] ?>">
                            <td class="cart-product">
                                <img src="<?= url($item['image']) ?>" alt="<?= e($item['name']) ?>" width="80" onerror="this.src='<?= url('assets/images/default.jpg') ?>'">
                                <div><?= e($item['name']) ?></div>
                            </td>
                            <td class="cart-price">$<?= number_format($item['price'], 2) ?></td>
                            <td>
                                <input type="number" class="cart-qty" value="<?= $item['qty'] ?>" min="1" style="width:60px;">
                            </td>
                            <td class="cart-sub">$<?= number_format($item['price'] * $item['qty'], 2) ?></td>
                            <td>
                                <button class="btn-remove">Supprimer</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="cart-summary">
                <strong>Total: </strong> <span id="cart-total">$<?= number_format($total, 2) ?></span>
            </div>
        <?php endif; ?>
    </div>

    <script src="<?= asset('assets/js/cart.js') ?>"></script>
</div>
