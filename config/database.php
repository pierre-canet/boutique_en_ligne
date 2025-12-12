<?php
// Configuration de la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'candyland_database');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8');

// Configuration générale de l'application
define('HOST_NAME', 'localhost');
define('BASE_URL', 'http://' . HOST_NAME);
define('ADMIN_URL', 'http://admin.' . HOST_NAME);
define('APP_NAME', 'CANDYLAND');
define('APP_VERSION', '1.0.0');

// Configuration des chemins
define('ROOT_PATH', dirname(__DIR__));
define('CONFIG_PATH', ROOT_PATH . '/config');
define('CONTROLLER_PATH', ROOT_PATH . '/controllers');
define('MODEL_PATH', ROOT_PATH . '/models');
define('VIEW_PATH', ROOT_PATH . '/views');
define('INCLUDE_PATH', ROOT_PATH . '/includes');
define('CORE_PATH', ROOT_PATH . '/core');
define('PUBLIC_PATH', ROOT_PATH . '/public');

/**
 * Pour pouvoir charger le projet en local, il est nécessaire de pointer Laragon vers le dossier 
 * du projet/public
 */
