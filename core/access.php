<?php

/**
 * Vérifie que l'utilisateur est connecté.
 * Si l’utilisateur n’est pas connecté :
 * Stocke l’URL courante pour redirection après connexion.
 * Renvoie un message d’erreur 
 * Redirige vers la page de login.
 * @return void
 */
function require_login() {
	if (!is_logged_in()) {
		$_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
		set_flash('error', 'Vous devez être connecté pour accéder à cette page.');
		redirect('auth/login');
		exit(); 
	}
}


/**
 * Vérifie si l’utilisateur a un rôle administrateur.
 * Nécessite que l’utilisateur soit connecté.
 * Retourne `true` si son rôle est `admin`ou `superadmin`.
 * @return bool
 */

function is_admin() {
	if (!is_logged_in()) {
		return false;
	}
	return ($_SESSION['user_role'] === 'admin' || $_SESSION['user_role'] === 'superadmin');
}

/**
 * Vérifie si l’utilisateur a un rôle super administrateur.
 * Nécessite que l’utilisateur soit connecté.
 * Retourne `true` uniquement si son rôle est `superadmin`.
 * @return bool
 */

function is_superadmin() {
	if (!is_logged_in()) {
		return false;
	}
	return $_SESSION['user_role'] === 'superadmin';
}



/**
 * Vérifie que l’utilisateur est administrateur.
 * Si non connecté redirection vers login.
 * Si connecté mais pas admin/superadmin → redirige vers la page d’accueil.
 * Renvoie un message flash en cas de refus.
 * @return void
 */

function require_admin() {
	if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
		set_flash('error', 'Vous devez être connecté pour accéder à cette page.');
		redirect('auth/login', true);
	}
	if (!is_admin()) {
		set_flash('error', 'Accès refusé. Cette page est réservée aux administrateurs.');
		redirect('home');
	}
}