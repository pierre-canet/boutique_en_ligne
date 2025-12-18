<div class="hero hero-image" style="background-image: url('<?php echo asset('assets/images/chatgpt_image_2025_12_03_00_12_09.png'); ?>'); background-size: cover; background-position: center;">
    <div class="hero-content">
        <h1><?php e($message); ?></h1>
        <p class="hero-subtitle">GET YOUR DAILY DOSE OF SWEET CHAOS !</p>
        <?php if (!is_logged_in()): ?>
            <div class="hero-buttons">
                <a href="<?php echo url('auth/register'); ?>" class="btn btn-primary">SHOP NOW -></a>
            </div>
        <?php else: ?>
            <p class="welcome-message">
                <i class="fas fa-user"></i>
                Bienvenue, <?php e($_SESSION['user_firstname']); ?> !
            </p>
        <?php endif; ?>
    </div>
</div>

<!-- ========================= -->
<!--     FRESH DROPS           -->
<!-- ========================= -->
<section class="features">
    <div class="container"> 
        <h1>FRESH DROPS !</h1>
        <div class="products-grid-2">
            <?php if (!empty($fresh_drops)): ?>
                <?php foreach ($fresh_drops as $product): ?>
                <div class="product-card">
                    <div class="product-image">
                        <img src="<?php echo asset($product['product_image']); ?>" 
                             alt="<?php e($product['name']); ?>" class="feature-image" />
                    </div>
                    <h4><?php e($product['name']); ?></h4>
                    <p class="price">$<?php e($product['price']); ?></p>
                    <div class="product-actions">
                        <a href="<?php echo url('product/show/' . $product['id']); ?>" class="btn-details">DETAILS</a>
                        <button class="btn-grab add-to-cart">GRAB IT!</button>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Coming Soon...</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ========================= -->
<!--       HOT PICKS           -->
<!-- ========================= -->
<section class="getting-started">
    <div class="container">
        <h2>HOT PICKS! 🔥</h2>
        <div class="products-grid-2">
            <?php if (!empty($hot_picks)): ?>
                <?php foreach ($hot_picks as $product): ?>
                    <?php 
                        $link = url('product/show/' . $product['id']);
                        if (stripos($product['name'], 'Box') !== false) {
                            $link = url('box/composer');
                        }
                    ?>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="<?php echo asset($product['product_image']); ?>" alt="<?php e($product['name']); ?>" />
                        </div>
                        <h4><?php e($product['name']); ?></h4>
                        <p class="price">$<?php e($product['price']); ?></p>
                        <div class="product-actions">
                            <a href="<?php echo $link; ?>" class="btn-details">DETAILS</a>
                            <button class="btn-grab add-to-cart">GRAB IT!</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No Hot Picks available.</p>
            <?php endif; ?>
        </div>
</section>

<!-- ========================= -->
<!--     CANDY UNIVERSE        -->
<!-- ========================= -->
<section class="getting-started-2">
    <div class="container">
        <h2>CANDY UNIVERSE! 🌟</h2>
        <div class="steps">
            <div class="products-grid-2">
                <?php if (!empty($candy_categories)): ?>
                    <?php foreach ($candy_categories as $category): ?>
                        <div class="feature-card">
                            <a class="feature-link" href="<?php echo url($category['url']); ?>">
                                <div class="feature-media">
                                    <img src="<?php echo asset($category['image']); ?>" 
                                         alt="<?php e($category['label']); ?>" 
                                         class="feature-image" />
                                </div>
                                <div class="feature-content">
                                    <h3><?php e($category['label']); ?></h3>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Categories coming soon...</p>
                <?php endif; ?>
            </div>
        </div>
</section>
