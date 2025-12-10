<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= isset($title) ? esc($title) . ' - Admin - ' . APP_NAME : 'Admin - ' . APP_NAME ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="<?= url('assets/css/admin.css') ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
	<?php include __DIR__ . '/../admin/partials/sidebar.php'; ?>
	<main class="admin-main">
		<?php include __DIR__ . '/../admin/partials/header.php'; ?>
		<?php flash_messages(); ?>
		<?= $content ?? '' ?>
	</main>
</body>
</html>