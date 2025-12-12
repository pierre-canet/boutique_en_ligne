<?php
// Contrôleur pour la page d'accueil

/**
 * Page d'accueil
 */
function home_index()
{
    // charger le modèle de produit est chargé

    if (!function_exists('get_product_by_id')) {
        if (!defined('MODELS_PATH')) {
            define('MODELS_PATH', dirname(__DIR__) . '/models');
        }
        require_once MODELS_PATH . '/products_model.php';
    }

    $fresh_drops = get_all_products(3, 3); 

    $hot_picks   = get_all_products(3, 0);   


    // les prix

    $add_price = function(&$products) {
        foreach ($products as &$p) {
            $p['price'] = get_product_price($p['id']);
        }
    };

    // Ajouter des prix

    $add_price($fresh_drops);
    $add_price($hot_picks);


    //categorie 

    $candy_categories = [
        [
            'label' => 'Bonbons & Gélifiés',
            'url'   => 'product/index?category=11', 
            'image' => 'assets/images/ChatGPT Image 27 nov. 2025, 17_26_29.png'
        ],
        [
            'label' => 'Chocolat',
            'url'   => 'product/index?category=12', 
            'image' => 'assets/images/image(2).jpg'
        ],
        [
            'label' => 'Sucettes',
            'url'   => 'product/index?category=13', 
            'image' => 'assets/images/chatgpt_image_2025_12_02_22_55_37.png'
        ],
        [
            'label' => 'Guimauves',
            'url'   => 'product/index?category=14', 
            'image' => 'assets/images/Guimauves-2.png'
        ]
    ];

    // 5. Envoyer des données à la vue

    $data = [
        'title'            => 'Accueil',
        'message'          => 'BIENVENUE !',
        'fresh_drops'      => $fresh_drops,
        'hot_picks'        => $hot_picks,
        'candy_categories' => $candy_categories
    ];

    load_view_with_layout('home/index', $data);
}

/**
 * Page à propos
 */
function home_about()
{
    $data = [
        'title' => 'À propos',
        'content' => 'Bienvenue à Candyland, LA référence en matière de vente de confiseries en tous genres !'
    ];

    load_view_with_layout('home/about', $data);
}

/**
 * Page contact
 */
function home_contact()
{
    $data = [
        'title' => 'Contact'
    ];

    if (is_post()) {
        $name = clean_input(post('name'));
        $email = clean_input(post('email'));
        $message = clean_input(post('message'));

        // Validation simple
        if (empty($name) || empty($email) || empty($message)) {
            set_flash('error', 'Tous les champs sont obligatoires.');
        } elseif (!validate_email($email)) {
            set_flash('error', 'Adresse email invalide.');
        } else {
            // Ici vous pourriez envoyer l'email ou sauvegarder en base
            set_flash('success', 'Votre message a été envoyé avec succès !');
            redirect('home/contact');
        }
    }

    load_view_with_layout('home/contact', $data);
}


/**
 * Page profile
 */
function home_profile()
{
    // Rediriger si non connecté
    if (!is_logged_in()) {
        set_flash('error', 'Vous devez être connectés pour accéder à votre profil.');
        redirect('home');
    }

    $user_id = $_SESSION['user_id'];
    $user = get_user_by_id($user_id);

    // Traiter le formulaire POST
    if (is_post()) {
        // Vérifier le token CSRF
        if (!verify_csrf_token(post('csrf_token'))) {
            set_flash('error', 'Token de sécurité invalide.');
            redirect('home/profile');
        }

        $firstname = clean_input(post('firstname'));
        $lastname = clean_input(post('lastname'));
        $email = clean_input(post('email'));
        $phone_number = clean_input(post('phone_number'));
        $password = post('password');

        // Validation
        if (empty($firstname) || empty($lastname) || empty($email)) {
            set_flash('error', 'Les champs obligatoires doivent être remplis.');
        } elseif (!validate_email($email)) {
            set_flash('error', 'Adresse email invalide.');
        } else {
            // Vérifier si l'email est unique (sauf pour l'utilisateur actuel)
            if (email_exists($email, $user_id)) {
                set_flash('error', 'Cette adresse email est déjà utilisée.');
            } else {
                // Mettre à jour les infos de base
                $ok = update_user($user_id, $firstname, $lastname, $email, $phone_number);

                if ($ok) {
                    // Si un nouveau mot de passe est fourni, le mettre à jour
                    if (!empty($password)) {
                        if (strlen($password) < 6) {
                            set_flash('warning', 'Le mot de passe n\'a pas été changé (minimum 6 caractères).');
                        } else {
                            update_user_password($user_id, $password);
                            set_flash('success', 'Profil et mot de passe mis à jour avec succès.');
                        }
                    } else {
                        set_flash('success', 'Profil mis à jour avec succès.');
                    }

                    // Mettre à jour la session
                    $_SESSION['user_name'] = $firstname . ' ' . $lastname;
                    $_SESSION['user_email'] = $email;

                    redirect('home/profile');
                } else {
                    set_flash('error', 'Erreur lors de la mise à jour du profil.');
                }
            }
        }
    }

    // Préparer les données pour la vue
    $data = [
        'title' => 'Profil',
        'message' => 'Bienvenue sur votre profil',
        'user' => $user,
    ];

    load_view_with_layout('home/profile', $data);
}

/**
 * Page Mentions Légales
 */
function home_mentions_legales()
{
    $data = [
        'title' => 'Mentions Légales',
    ];

    load_view_with_layout('home/mentions_legales', $data);
}
