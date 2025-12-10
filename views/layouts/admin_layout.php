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
    <link rel="stylesheet" href="<?php echo url('assets/css/admin_style.css') . '?v=' . $ver; ?>">
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
        <header class="header">
            <nav class="navbar">
                <input type="checkbox" id="menu-toggle" class="menu-toggle">
                <ul class="nav-menu">
                    <li><a href="<?php echo url(); ?>">Dashboard</a></li>
                    <li><a href="<?php echo url(''); ?>">Gestion des produits</a></li>
                    <li><a href="<?php echo url(''); ?>">Gestion des utilisateurs</a></li>
                </ul>
            </nav>
        </header>


        <main class="main-content">
            <?php flash_messages(); ?>
            <?php echo $content ?? ''; ?>
        </main>
        <?php
        $jsPath = PUBLIC_PATH . '/assets/js/app.js';
        $jsVer = file_exists($jsPath) ? filemtime($jsPath) : $ver;
        ?>
        <script src="<?php echo url('assets/js/app.js') . '?v=' . $jsVer; ?>"></script>
</body>

</html>