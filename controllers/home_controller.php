<?php
// Contrôleur pour la page d'accueil

/**
 * Page d'accueil
 */
function home_index()
{
    $data = [
        'title' => 'Accueil',
        'message' => ' BIENVENUE !',
        'features' => [
            [
                'label' => 'Bonbon',
                'url' => 'category/mvc',
                'image' => 'assets/images/ChatGPT Image 27 nov. 2025, 17_26_29.png'
            ],
            [
                'label' => 'Système de routing simple',
                'url' => 'category/routing',
                'image' => 'assets/images/image(2).jpg'
            ],
            [
                'label' => 'Templating HTML/CSS',
                'url' => 'category/templates',
                'image' => 'assets/images/IMG_9713.jpeg'
            ],
            'Gestion de base de données',
            'Sécurité intégrée'
        ]
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
        'content' => 'Cette application est un starter kit PHP MVC développé avec une approche procédurale.'
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
    // Rediriger non connecté
    if (!is_logged_in()) {
        set_flash('error', 'Vous devez être connectés pour accéder à votre profil.');
        redirect('home');
    } else {
        $data = [
            'title' => 'Profil',
            'message' => 'Bienvenue sur votre profil',
            'content' => 'Sur cette page vous allez pouvoir accéder à votre profil ainsi que le modifier',
            'user' => '',
        ];
        if (is_logged_in()) {
            $id = $_SESSION['user_id'];
            $user = get_user_by_id($id);
            $data['user'] = $user;
        } else {
            redirect('home');
        };
        if (isset($_POST['submit'])) {
            $login = clean_input(post('loginChange'));
            $password = post('passwordChange');
            $confirm_password = post('passwordConfirm');
            $update_success = '';
            if (!empty($_POST['loginChange'])) {


                if (get_user_by_login($login)) {
                    set_flash('error', 'Ce login est déjà utilisé.');
                } else {
                    update_user_login($id, $login);
                    $update_success = 1;
                }
            };

            if (!empty($_POST['passwordChange']) && !empty($_POST['passwordConfirm'])) {
                if (strlen($password) < 6) {
                    set_flash('error', 'Le mot de passe doit contenir au moins 6 caractères.');
                } elseif ($password !== $confirm_password) {
                    set_flash('error', 'Les mots de passe ne correspondent pas.');
                } else {
                    update_user_password($id, $password);
                    $update_success = 1;
                };
            }


            if ($update_success === 1) {
                set_flash('success', 'Modifications réussie ! Vous pouvez maintenant continuer à profiter du site !');
                redirect('home/profile');
            }
        };
    }


    load_view_with_layout('home/profile', $data);
}
