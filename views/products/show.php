
<div class="shop-page shop-page-padding">
    
    <div class="container back-btn-container">
        <a href="<?php echo url('product'); ?>" class="category-btn back-btn-custom">
            &larr; RETOUR AU SHOP
        </a>
    </div>

    <div class="container product-show-wrapper">
        <div class="product-detail-card">
            
            <div class="detail-left">
                <div class="product-image-large">
                    <img src="<?php echo url($product['product_image']); ?>" 
                         alt="<?php e($product['name']); ?>"
                         onerror="this.onerror=null; this.src='<?php echo url('assets/images/default.jpg'); ?>'">
                </div>
            </div>

            <div class="detail-right">
                
                <h1 class="detail-title">
                    <?php e($product['name']); ?>
                </h1>

                <div class="detail-price">
                    <?php echo $product['price'] ? '$' . number_format($product['price'], 2) : 'Prix indisponible'; ?>
                </div>

                <div class="detail-description">
                    <?php echo nl2br(esc($product['description'])); ?>
                </div>

                <button class="btn-grab-large add-to-cart" data-id="<?php echo $product['id']; ?>">
                    GRAB IT NOW!
                </button>
            </div>
        </div>
    </div>

    <?php if (!empty($related)): ?>
    <div class="container related-products-container">
        
        <h1 class="related-title">
            VOUS POURRIEZ AUSSI AIMER...
        </h1>

        <div class="products-grid related-grid">
            <?php foreach ($related as $rel): ?>
                <div class="product-card" onclick="window.location.href='<?php echo url('product/show/' . $rel['id']); ?>'">
                    <div class="product-image">
                        <img src="<?php echo url($rel['product_image']); ?>" 
                             alt="<?php e($rel['name']); ?>"
                             onerror="this.onerror=null; this.src='<?php echo url('assets/images/default.jpg'); ?>'">
                    </div>
                    <h4><?php e($rel['name']); ?></h4>
                    <p class="price">
                        <?php echo isset($rel['price']) && $rel['price'] ? '$' . number_format($rel['price'], 2) : '$?.??'; ?>
                    </p>
                    <div class="product-actions">
                        <a href="<?php echo url('product/show/' . $rel['id']); ?>" class="btn-details" style="width:100%">DETAILS</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

</div>

<script src="<?php echo asset('assets/js/produits.js'); ?>"></script>