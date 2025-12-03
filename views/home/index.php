<div class="hero hero-image" style="background-image: url('<?php echo asset('assets/images/chatgpt_image_2025_12_03_00_12_09.png'); ?>'); background-size: cover; background-position: center;">
    <div class="hero-content">
        <h1><?php e($message); ?></h1>
        <p class="hero-subtitle">GET YOUR DAILY DOSE OF SWEET CHAOS !</p>
        <?php if (!is_logged_in()): ?>
            <div class="hero-buttons">
                <a href="<?php echo url('auth/register'); ?>" class="btn btn-primary">SHOP NOW -></a>
                <!-- <a href="<?php echo url('auth/login'); ?>" class="btn btn-secondary">Se connecter</a> -->
            </div>
        <?php else: ?>
            <p class="welcome-message">
                <i class="fas fa-user"></i> 
                Bienvenue, <?php e($_SESSION['user_name']); ?> !
            </p>
        <?php endif; ?>
    </div>
</div>

<section class="features">
    <div class="container">
        <h1>FRESH DROPS !</h1>
        <div class="features-grid">
            <?php $display_features = is_array($features) ? array_slice($features, 0, 4) : []; ?>
            <?php foreach ($display_features as $index => $feature): ?>
                <?php if ($index === 3): ?>
                    <div class="feature-card">
                        <a class="feature-link" href="<?php echo url('box/composer'); ?>">
                            <div class="feature-media">
                                <img src="<?php echo asset('assets/images/chatgpt_image_2025_12_02_22_55_37.png'); ?>" alt="Box à composer" class="feature-image" />
                            </div>
                        </a>
                    </div>
                    <?php continue; ?>
                <?php endif; ?>
                <div class="feature-card">
                    <?php if (is_array($feature) && isset($feature['image']) && !empty($feature['image']) && isset($feature['url'])): ?>
                        <a class="feature-link" href="<?php echo url($feature['url']); ?>">
                            <div class="feature-media">
                                <img src="<?php echo asset($feature['image']); ?>" alt="<?php e($feature['label'] ?? ''); ?>" class="feature-image" />
                            </div>
                        </a>
                    <?php elseif (is_array($feature) && isset($feature['image']) && !empty($feature['image'])): ?>
                        <div class="feature-media">
                            <img src="<?php echo asset($feature['image']); ?>" alt="<?php e($feature['label'] ?? ''); ?>" class="feature-image" />
                        </div>
                    <?php else: ?>
                        <div class="feature-content">
                            <i class="fas fa-check-circle"></i>
                            <?php if (is_array($feature) && isset($feature['label']) && isset($feature['url'])): ?>
                                <h3><a href="<?php echo url($feature['url']); ?>"><?php e($feature['label']); ?></a></h3>
                            <?php elseif (is_array($feature) && isset($feature['label'])): ?>
                                <h3><?php e($feature['label']); ?></h3>
                            <?php else: ?>
                                <h3><?php e($feature); ?></h3>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="getting-started">
    <div class="container">
        <h2>Commencer rapidement</h2>
        <div class="steps">
            <div class="step">
                <div class="step-number">1</div>
                <h3>Configuration</h3>
                <p>Configurez votre base de données dans <code>config/database.php</code></p>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <h3>Développement</h3>
                <p>Créez vos contrôleurs, modèles et vues dans leurs dossiers respectifs</p>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <h3>Déploiement</h3>
                <p>Uploadez votre application sur votre serveur web</p>
            </div>
        </div>
    </div>
</section> 
 