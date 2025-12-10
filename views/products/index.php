<div class="shop-page">
    <div class="hero hero-image" style="background-image: url('<?php echo url('assets/images/ban-p2.png'); ?>'); object-fit: contain; margin-top: 0px; box-shadow: 8px 8px 0 #000000"></div>
    
    <div class="shop-header">
        <h1><?php e($current_category_name); ?></h1>
        <p><?php e($message); ?></p>
    </div>

    <div class="shop-content">
       <div id="pop-art-menu-container">
    
    <button id="cat-trigger-btn" class="cat-trigger-btn">
        <span class="btn-text">CATEGORIES</span>
    </button>

    <div id="cat-popup-content" class="cat-popup-content">
        <!-- <div class="close-container">
            <button id="close-popup-btn" class="clear-filters-btn">X</button>
        </div> -->

        <!-- <div class="filter-header-box">
            <h4>CATEGORIES</h4>
        </div> -->

        <div class="category-list">
            <a href="<?= url('product') ?>" 
               class="category-btn <?= !$current_category_id ? 'active' : '' ?>">
                Toutes
            </a>
            
            <?php foreach ($categories as $cat): ?>
                <?php if ($cat['parent_category_id'] == null || $cat['parent_category_id'] == 0): ?>
                    <a href="?category=<?= $cat['id'] ?>"
                       class="category-btn <?= ($current_category_id == $cat['id']) ? 'active' : '' ?>">
                        <?= htmlspecialchars($cat['category_name']) ?>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
        <div class="products-grid" id="products-grid">
            <?php foreach ($products as $p): ?>
                <div class="product-card" data-id="<?= $p['id'] ?>">
                    <div class="product-image">
                        <img src="<?php echo url($p['product_image']); ?>" 
                             alt="<?= e($p['name']) ?>"
                             onerror="this.src='<?php echo url('assets/images/default.jpg'); ?>'">
                    </div>
                    <h4><?= e($p['name']) ?></h4>
                    <p class="price">
                        <?php echo $p['price'] ? '$' . number_format($p['price'], 2) : '$?.??'; ?>
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

<?php foreach ($products as $p): ?>
<div id="modal-<?= $p['id'] ?>" class="modal-overlay" style="display:none;">
    <div class="modal">
        <div class="left">
            <div class="product-image-large">
                <img src="<?php echo url($p['product_image']); ?>" 
                     onerror="this.src='<?php echo url('assets/images/default.jpg'); ?>'"
                     alt="<?= e($p['name']) ?>">
            </div>
        </div>
        <div class="right">
            <a href="#" class="close-btn">×</a>
            <h2 class="modal-title"><?= e($p['name']) ?></h2>
            <div class="price">
                <?php echo $p['price'] ? '$' . number_format($p['price'], 2) : 'Prix indisponible'; ?>
            </div>
            <div class="description">
                <?= nl2br(esc($p['description'] ?: 'Aucune description disponible.')) ?>
            </div>
            <div class="modal-actions">
                <button class="btn-grab add-to-cart">+ Ajouter</button>
                <a href="<?php echo url('product/show/' . $p['id']); ?>" class="btn-details modal-open-full">Voir tout</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<script src= "<?php echo asset('assets/js/produits.js'); ?>">

</script>