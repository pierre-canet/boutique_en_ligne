<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? esc($title) . ' - ' . APP_NAME : APP_NAME; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Comic+Neue:wght@700&family=Fredoka+One&display=swap" rel="stylesheet">
    <?php
        $cssPath = PUBLIC_PATH . '/assets/css/style.css';
        $ver = file_exists($cssPath) ? filemtime($cssPath) : (defined('APP_VERSION') ? APP_VERSION : time());
    ?>
    <link rel="stylesheet" href="<?php echo url('assets/css/style.css') . '?v=' . $ver; ?>">
    <?php if (!empty($is_admin)): ?>
        <?php
            $adminCss = PUBLIC_PATH . '/assets/css/admin.css';
            $adminVer = file_exists($adminCss) ? filemtime($adminCss) : $ver;
        ?>
        <link rel="stylesheet" href="<?php echo url('assets/css/admin.css') . '?v=' . $adminVer; ?>">
    <?php endif; ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <main class="main-container">
    <?php if (!isset($hide_nav)): ?>  <!-- Masquer le header si $hide_nav est défini -->
    <header class="header">
       <nav class="navbar">
            <div class="nav-brand"><a href="<?php echo url(); ?>"><img src="<?= url('assets/images/candy.png'); ?>" alt="Logo"> <?php echo APP_NAME; ?></a></div>
        <input type="checkbox" id="menu-toggle" class="menu-toggle">
        <label for="menu-toggle" class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </label>
            <ul class="nav-menu">
                <li><a href="<?php echo url(); ?>">Accueil</a></li>
                <li><a href="<?php echo url('product/index'); ?>">produits</a></li>
                <li><a href="<?php echo url('home/about'); ?>">À propos</a></li>
                <li><a href="<?php echo url('home/contact'); ?>">Contact</a></li>

                <?php if (is_logged_in()): ?>
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                        <li class="dropdown-container">
                            <a href="<?php echo url('admin/dashboard'); ?>">Administration <i class="fas fa-chevron-down"></i></a>
                            <ul class="dropdown">
                                <li><a href="<?php echo url('admin/media'); ?>">Gestion des produits</a></li>
                                <li><a href="<?php echo url('admin/users'); ?>">Gestion des utilisateurs</a></li>
                                <li><a href="<?php echo url('admin/loans'); ?>">Gestion des achats</a></li>
                                <li><a href="<?php echo url('admin/dashboard'); ?>">Tableau de bord</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <li class="dropdown-container">
                        <a href="#"><i class="fas fa-user"></i><i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown">
                            <li><a href="<?php echo url('home/profile'); ?>">Profil</a></li>
                            <li><a href="<?php echo url('auth/logout'); ?>">Déconnexion</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="<?php echo url('cart'); ?>">
                            <i class="fas fa-shopping-cart"></i> <span id="cart-count">0</span>
                        </a>
                    </li>

                <?php else: ?>
                    <li>
                        <a href="<?php echo url('auth/login'); ?>">
                            <i class="fas fa-user"></i>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo url('cart'); ?>">
                            <i class="fas fa-shopping-cart"></i> <span id="cart-count">0</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <?php endif; ?>

    <main class="main-content">
        <?php flash_messages(); ?>
        <?php echo $content ?? ''; ?>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="newsletter">
                <h3>DON'T MISS OUT!</h3>
                <p>SUBSCRIBE FOR EXPLOSIVE DEALS & SUGAR RUSHES.</p>
                <form>
                    <input type="email" placeholder="YOUR EMAIL..." required>
                    <button type="submit">Send</button>
                </form>
            </div>
            <div class="links">
                <h4>QUICK LINKS</h4>
                <a href="<?php echo url('home/about'); ?>">À PROPOS</a>
                <a href="<?php echo url('home/contact'); ?>">CONTACT</a>
                <a href="<?php echo url('home/shipping'); ?>">LIVRAISON</a>
                <a href="<?php echo url('home/faq'); ?>">FAQ</a>
                <a href="<?php echo url('home/returns'); ?>">RETOURS</a>
                <a href="<?php echo url('home/mentions_legales'); ?>">MENTIONS LÉGALES</a>
            </div>
            <div class="social">
                <h4>FOLLOW THE FUN</h4>
                <div class="social-icons">
                    <a href="#"><img src="<?= url('assets/images/i.png'); ?>" alt="Instagram">
</a>
                    <a href="#"><img src="<?= url('assets/images/f.png'); ?>" alt="Facebook"></a>
                    <a href="#"><img src="<?= url('assets/images/t.png'); ?>" alt="TikTok"></a>
                </div>
            </div>
        </div>
        <div class="copyright">
           <h4>© 2025 CANDY LAND INC. · CANDY LAND v0.0</h4> 
        <div class="condition">
            <p><a href="<?php echo url('home/mentions_legales'); ?>">MENTIONS LÉGALES</a></p>
           <p>Politique de Confidentialité</p>
           <p>Conditions d'Utilisation</p>
           <p>FAQ</p></div>
        </div>
    </footer>
    </main>
    <script src="<?php echo url('assets/js/app.js'); ?>"></script>
    <script src="<?php echo url('assets/js/cart.js'); ?>"></script>
</body>
</html>