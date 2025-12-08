<?php
// Système de routing simple

/**
 * Parse l'URL et retourne le contrôleur, l'action et les paramètres
 * Analyse l'URL reçue et détermine :
 * le contrôleur à utiliser
 * l’action (fonction du contrôleur) à exécuter
 * les éventuels paramètres transmis
 * @return array {controller, action, params}
 */

function parse_request_url() {
	$url = $_GET['url'] ?? '';
	$url = rtrim($url, '/');
	$url = filter_var($url, FILTER_SANITIZE_URL);
	$subdomain = str_replace(HOST_NAME, '', str_replace('.'.HOST_NAME, '', $_SERVER['HTTP_HOST']));
	if (empty($url)) {
		return ['subdomain' => $subdomain, 'controller' => empty($subdomain) ? 'home' : 'admin', 'action' => 'index', 'params' => []];
	}

	$url_parts = explode('/', $url);

	$controller = $url_parts[0] ?? 'home';
	$action = $url_parts[1] ?? 'index';
	$params = array_slice($url_parts, 2);

	return [
		'subdomain' => $subdomain,
		'controller' => $controller,
		'action' => $action,
		'params' => $params
	];
}

/**
 * Charge et exécute le contrôleur approprié
 * Analyse l’URL pour trouver le contrôleur et l’action.
 * Vérification de  l’existence du fichier contrôleur.
 * Vérificatyion de l’existence de la fonction d’action.
 * Exécution de la fonction avec les paramètres.
 * Si erreur , la page 404 est charché .
 */

function dispatch() {
	$route = parse_request_url();

	$subdirectory_name = $route['subdomain'];
	$controller_name = $route['controller'];
	$action_name = $route['action'];
	$params = $route['params'];

	// Nom du fichier contrôleur
	$controller_file = CONTROLLER_PATH . '/' . (empty($subdirectory_name) ? '' : $subdirectory_name . '/') . $controller_name . '_controller.php';

	// Vérifier si le contrôleur existe
	if (!file_exists($controller_file)) {
		if (!empty($subdirectory_name) && !in_array($subdirectory_name, ['admin'])) {
			exit();
			return;
		}
		// Si le contrôleur n'existe pas, charger le contrôleur par défaut
		$default_controller = empty($subdirectory_name) ? 'home' : 'admin';
		require_once CONTROLLER_PATH . '/' . (empty($subdirectory_name) ? '' : $subdirectory_name . '/') . $default_controller . '_controller.php';

		$action_function = $default_controller . '_' . $controller_name;

		// Ajouter l'action comme premier paramètre si ce n'est pas 'index'
		if ($action_name != 'index') {
			array_unshift($params, $action_name);
		}
		// Vérifier si l'action existe
		if (!function_exists($action_function)) {
			load_404();
			return;
		}
		call_user_func_array($action_function, $params);
		return;
	}

	// Charger le contrôleur
	require_once $controller_file;

	// Nom de la fonction d'action
	$action_function = $controller_name . '_' . $action_name;

	// Vérifier si l'action existe
	if (!function_exists($action_function)) {
		load_404();
		return;
	}

	// Exécuter l'action avec les paramètres
	call_user_func_array($action_function, $params);
}

/**
 * Charge la page 404
 */
function load_404() {
	http_response_code(404);
	require_once VIEW_PATH . '/errors/404.php';
}

