<?php
// Contrôleur d'authentification

/**
 * Page d'accueil du module auth/admin
 * Alias de la page de connexion.
 * @return void
 */


function auth_index()
{
	auth_login();
}


/**
 * Page de connexion
 * @return void
 */


function auth_login()
{

	// Rediriger si déjà connecté
	if (is_logged_in()) {
		redirect('admin', true);
	}

	$data = [
		'title' => 'Connexion',
		'admin' => true,
	];

	if (is_post()) {
		if (!verify_csrf_token(post('csrf_token'))) {
			set_flash('error', 'Token CSRF invalide');
		} else {
			$email = clean_input(post('email'));
			$password = post('password');

			if (empty($email) || empty($password)) {
				set_flash('error', 'Email et mot de passe obligatoires.');
			} else {
				// Rechercher l'utilisateur
				$user = get_user_by_email($email);

				if ($user && verify_password($password, $user['password']) && ($user['role'] === 'admin' || $user['role'] === 'superadmin')) {

					// Connexion réussie
					$_SESSION['user_id'] = $user['id'];
					$_SESSION['user_lastname'] = $user['lastname'];
					$_SESSION['user_firstname'] = $user['firstname'];
					$_SESSION['user_email'] = $user['email'];
					$_SESSION['user_role'] = $user['role'];

					set_flash('success', 'Connexion réussie !');
					redirect('admin', true);
				} else {
					set_flash('error', 'Erreur.');
				}
			}
		}
	}

	load_view('admin/login', $data);
}


/**
 * Déconnexion
 * détruit la session en cours
 * @return void
 */

function auth_logout()
{
	logout();
}
