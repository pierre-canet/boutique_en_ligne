<?php
/**
 * Déconnecte l'utilisateur
 * Vide toutes les variables de session.
 * Détruition de  la session en cours.
 * Redirection vers la page de connexion.
 * @param array|null $flash
 */

function logout($flash = null) {
	session_unset();
	session_destroy();
	if ($flash) {
		session_start();
		$_SESSION['flash_messages'] = $flash;
	}
	redirect('auth/login');
}


/**
 * Régénère l'ID de session pour prévenir les attaques de fixation de session
 * 
 * @param bool $boolean Si true, détruit l'ancienne session, sinon regénère l'ID en conservant l'ancienne session
 */

function regenerate_session($boolean = false) {
	if ($boolean) {
		session_regenerate_id(true);
	}
	else {
		// New session ID is required to set proper session ID
    	// when session ID is not set due to unstable network.
		$new_session_id = session_create_id();
		$_SESSION['new_session_id'] = $new_session_id;

    	// Set destroy timestamp
		$_SESSION['destroyed'] = time();

    	// Write and close current session;
		session_commit();

    	// Start session with new session ID
		session_id($new_session_id);
		ini_set('session.use_strict_mode', 0);
		session_start();
    	// New session does not need them
		unset($_SESSION['destroyed']);
		unset($_SESSION['new_session_id']);
	}
}

/**
 * Vérifie si la session a expiré après une période d'inactivité
 * Si expirée, déconnecte l'utilisateur et redirige vers la page de connexion
 * Elle bascule sur le nouvel ID si besoin.
 */

function check_expired_session() {
	$timeout_duration = db_select_one("SELECT value FROM settings WHERE key_name = 'session_timeout'")['value'] ?? 1800; // Durée en secondes (30 minutes par défaut)

	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
		// La session a expiré
		set_flash('error', 'Votre session a expiré. Veuillez vous reconnecter.');
		logout(get_flash_messages());
	}

	$_SESSION['LAST_ACTIVITY'] = time(); // Met à jour le timestamp de la dernière activité
}

/**
 * Détruit l'ancienne session après un délai pour éviter les attaques de fixation de session
 * Assurance de la destrution définitif de la session  après 180 secondes.
 */
function destroy_old_session() {
	if (isset($_SESSION['destroyed'])) {
		if (time() - $_SESSION['destroyed'] > 180) {
			remove_all_authentication_flag_from_active_sessions($_SESSION['user_id']);
			// throw(new DestroyedSessionAccessException);
		}
		if (isset($_SESSION['new_session_id'])) {
			// Write and close current session;
			session_commit();
			session_id($_SESSION['new_session_id']);
			session_start();
		}
	}
}



/**
 * Démarre la session si elle n'est pas déjà démarrée
 * Appelle session_start().
 * Vérifie si l’utilisateur est connecté :
 * si oui, contrôle expiration de la session (inactivité).
 * Vérifie si une redirection post-login existe encore alors que l’utilisateur a quitté la page login :
 * si oui, la supprime.
 * Supprimre les anciennes sessions 
 */

function start_session() {
	session_start();
	if (is_logged_in()) {
		check_expired_session();
	}
	elseif (isset($_SESSION['redirect_after_login']) && $_SERVER['REQUEST_URI'] !== '/auth/login') {
		// unset the redirect if the user left the login page without logging in
		unset($_SESSION['redirect_after_login']);

	}

	destroy_old_session();
}