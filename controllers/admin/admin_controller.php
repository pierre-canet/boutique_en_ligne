<?php
require_admin();
function admin_index()
{
    $data = [];

    load_view_with_layout('admin/index', $data, 'admin_layout');
}
function admin_product_management()
{
    $data = [
        'title' => 'gestion produits',
        'products' => get_all_products_infos(),
        'categories' => get_all_categories()
    ];

    if (is_post()) {
        $product_name = clean_input($_POST['name']);
        $product_desc = clean_input($_POST['description']);
        $product_price = clean_input($_POST['price']);
        $product_stock = clean_input($_POST['stock']);
        $product_category = clean_input($_POST['category_id']);


        if (empty($product_name) || empty($product_desc) || empty($product_price) || empty($product_stock) || empty($product_category)) {
            set_flash('error', 'Tous les champs du formulaire sont obligatoires.');
            redirect('product_management', true);
            exit;
        }
        if (get_product_by_name($product_name)) {
            set_flash('error', 'Ce nom est déjà pris');
            redirect('product_management', true);
            exit;
        }
        if (!isset($_FILES['product_image']) || $_FILES['product_image']['error'] !== UPLOAD_ERR_OK) {
            set_flash('error', "Erreur lors de l'upload de l'image.");
            redirect('product_management', true);
            exit;
        }
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $ext = strtolower(pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed_ext)) {
            set_flash('error', "Extension d'image non autorisée.");
            redirect('product_management', true);
            exit;
        }
        $filename = uniqid("product_") . "." . $ext;
        $filename = uniqid("product_") . "." . $ext;
        $upload_dir = __DIR__ . "/../../public/assets/images/";
        $target = $upload_dir . $filename;
        if (!move_uploaded_file($_FILES['product_image']['tmp_name'], $target)) {
            set_flash('error', "Impossible d'enregistrer l'image.");
            redirect('product_management', true);
            exit;
        }
        $image_path = "/assets/images/" . $filename;
        $product_id = create_product($product_name, $product_desc, $image_path, $product_category);
        create_product_item($product_id, $product_stock, $product_price);
        set_flash('success', "Produit ajouté avec succès !");
        redirect('product_management', true);
        exit;
    };

    load_view_with_layout('admin/product_management', $data, 'admin_layout');
}
function admin_users_list()
{
    $data = [
        'title' => 'Gestion des utilisateurs',
        'user_list' => get_all_users($limit = null, $offset = 0)
    ];

    load_view_with_layout('admin/users_list', $data, 'admin_layout');
}
