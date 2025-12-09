<div class="product-detail">
    <img src="<?php echo $product['product_image']; ?>" alt="<?php echo $product['name']; ?>">
    <h1><?php echo $product['name']; ?></h1>
    <p><?php echo $product['description']; ?></p>
    <button class="add-to-cart" data-id="<?php echo $product['id']; ?>">GRAB IT!</button>

    <h3>Related Products</h3>
    <div class="related-grid">
        <?php foreach ($related as $rel): ?>
            <div class="related-card">
                <img src="<?php echo $rel['product_image']; ?>" alt="<?php echo $rel['name']; ?>">
                <h4><?php echo $rel['name']; ?></h4>
                <a href="<?php echo url('product/show/' . $rel['id']); ?>">DETAILS</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="<?php echo url('assets/js/products.js'); ?>"></script>