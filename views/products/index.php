<!-- views/products/index.php -->
<div class="shop-page">
    <div class="hero hero-image" style="background-image: url('<?php echo asset('assets/images/ban-p2.png'); ?>'); object-fit: contain; margin-top: 0px; box-shadow: 8px 8px 0 #000000"></div>
    
    <div class="shop-header">
        <h1>SHOP ALL!</h1>
        <p><?php echo count($products); ?> ITEMS READY TO GRAB</p>
    </div>

    <div class="shop-content">
        <aside class="filters">
    <a href="<?= url('products') ?>" id="clear-filters" class="clear-filters">X</a>
    <div class="filter-header"><h4>Categories</h4></div>
    <div class="category-list">
        <a href="<?= url('products') ?>" 
           class="category-btn main-cat <?= !$current_category_id ? 'active' : '' ?>">
            Toutes
        </a>
        <?php foreach ($categories as $cat): ?>
            <?php if ($cat['parent_category_id'] == null || $cat['parent_category_id'] == 0): ?>
                <a href="?category=<?= $cat['id'] ?>"
                   class="category-btn main-cat <?= ($current_category_id == $cat['id']) ? 'active' : '' ?>">
                    <?= htmlspecialchars($cat['category_name']) ?>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</aside>

        <div class="products-grid" id="products-grid">
            <?php foreach ($products as $p): ?>
                <div class="product-card" data-id="<?= $p['id'] ?>">
                    <div class="product-image">
                        <img src="<?php echo url($p['product_image']); ?>" 
                             alt="<?= htmlspecialchars($p['name']) ?>"
                             onerror="this.src='<?php echo url('assets/images/default.jpg'); ?>'">
                    </div>
                    <h4><?= htmlspecialchars($p['name']) ?></h4>
                    <p class="price">
                        <?php
                        $item = db_select_one("SELECT price FROM product_item WHERE product_id = ?", [$p['id']]);
                        echo $item ? '$' . number_format($item['price'], 2) : '$?.??';
                        ?>
                    </p>
                    <div class="product-actions">
                        <a href="#modal-<?= $p['id'] ?>" class="btn-details modal-trigger">DETAILS</a>
                        <button class="btn-grab add-to-cart">GRAB IT!</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Modals -->
<?php foreach ($products as $p): ?>
<div id="modal-<?= $p['id'] ?>" class="modal-overlay" style="display:none;">
    <div class="modal">
        <div class="left">
            <div class="product-image-large">
                <img src="<?php echo url($p['product_image']); ?>" 
                     onerror="this.src='<?php echo url('assets/images/default.jpg'); ?>'"
                     alt="<?= htmlspecialchars($p['name']) ?>">
            </div>
        </div>
        <div class="right">
            <a href="#" class="close-btn">×</a>
            <h2 class="modal-title"><?= htmlspecialchars($p['name']) ?></h2>
            <div class="price">
                <?php
                $item = db_select_one("SELECT price FROM product_item WHERE product_id = ?", [$p['id']]);
                echo $item ? '$' . number_format($item['price'], 2) : 'Prix indisponible';
                ?>
            </div>
            <div class="description">
                <?= nl2br(htmlspecialchars($p['description'] ?: 'Aucune description disponible.')) ?>
            </div>
            <div class="modal-actions">
                <button class="btn-grab add-to-cart">+ Ajouter</button>
                <a href="<?php echo url('product/show/' . $p['id']); ?>" class="btn-details modal-open-full">Voir tout</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!--JS pour le modal -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.modal-trigger').forEach(a => {
        a.addEventListener('click', e => {
            e.preventDefault();
            document.querySelector(a.getAttribute('href')).style.display = 'flex';
        });
    });
    document.querySelectorAll('.modal-overlay, .close-btn').forEach(el => {
        el.addEventListener('click', e => {
            if (e.target === el || e.target.classList.contains('close-btn')) {
                el.closest('.modal-overlay').style.display = 'none';
            }
        });
    });
});
</script>

<!-- CSS مودال — بدون تغییر style.css اصلی -->
<!-- <style>
.modal-overlay {display:none;position:fixed;top:0;left:0;width:50%;height:100%;background:rgba(107, 106, 106, 0.47);align-items:center;justify-content:center;z-index:9999;}
.modal-overlay[style*="flex"] {display:flex!important;}
.modal {background:#fff;max-width:1000px;width:90%;max-height:90vh;overflow:auto;display:flex;border:8px solid #000;box-shadow:15px 15px 0 #000000ff;}
.modal .left,.modal .right {padding:30px;}
.modal .left {background:#f9f9f9;flex:1;}
.modal .right {flex:1;position:relative;}
.close-btn {position:absolute;top:5px;right:5px;font-size:10px;color:#000;text-decoration:none;font-weight:bold;}
</style> -->