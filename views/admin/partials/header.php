<header class="admin-header">
    <h1><?= $title ?? 'Tableau de bord' ?></h1>
    <a href="<?= url('auth/logout', true) ?>" class="logout">
        <i class="fa-solid fa-right-from-bracket"></i> Déconnexion
    </a>
</header>
