<?php

function get_all_products($limit = 20, $offset = 0)
{
    $query = "SELECT * FROM product ORDER BY id DESC LIMIT :limit OFFSET :offset";
    return db_select($query, ['limit' => (int)$limit, 'offset' => (int)$offset]);
}

function get_product_by_id($id)
{
    $query = "SELECT * FROM product WHERE id = :id";
    return db_select_one($query, ['id' => $id]);
}

function get_all_categories()
{
    $query = "SELECT * FROM product_category ORDER BY category_name";
    return db_select($query);
}

function get_products_by_category($category_id, $limit = 20, $offset = 0)
{
    $query = " SELECT * FROM product WHERE category_id = :cat_direct UNION SELECT p.* FROM product p INNER JOIN product_category pc ON p.category_id = pc.id WHERE pc.parent_category_id = :cat_parent LIMIT :limit OFFSET :offset";

    return db_select($query, ['cat_direct' => $category_id,'cat_parent' => $category_id,'limit' =>(int)$limit,'offset'=> (int)$offset]);
}


function get_products_by_category_direct($category_id, $limit = 20, $offset = 0)
{
    $query = "SELECT * FROM product WHERE category_id = :category_id LIMIT :limit OFFSET :offset";
    return db_select($query, ['category_id' => $category_id, 'limit' => (int)$limit, 'offset' => (int)$offset]);
}

/**
 * Recherche des produits.
 */
function search_products($search, $limit = 8)
{
    $query = "SELECT * FROM product WHERE name LIKE :search OR description LIKE :search LIMIT :limit";
    return db_select($query, ['search' => "%$search%", 
    'limit' => (int)$limit]);
}

/**
 * Récupère des produits liés.
 */
function get_related_products($category_id, $exclude_id, $limit = 4)
{
    $query = "SELECT * FROM product WHERE category_id = :category_id AND id != :exclude_id LIMIT :limit";
    return db_select($query, [
        'category_id'=> $category_id,
        'exclude_id' => $exclude_id,
        'limit'=> (int)$limit
    ]);
}

/**
 *Récupère les sous-catégories.
 */
function get_subcategories($parent_id)
{
    $query = "SELECT * FROM product_category WHERE parent_category_id = :parent_id ORDER BY category_name";
    return db_select($query, ['parent_id' => $parent_id]);
}
function get_product_price($product_id)
{
    $query = "SELECT price FROM product_item WHERE product_id = ? LIMIT 1";
    $result = db_select_one($query, [$product_id]);
    return $result ? $result['price'] : null;
}

/**
 * Récupère le nom d'une catégorie par son ID.
 */
function get_category_name($category_id)
{
    $query = "SELECT category_name FROM product_category WHERE id = ?";
    $result = db_select_one($query, [$category_id]);
    return $result ? $result['category_name'] : null;
}

/**
 * Récupère les informations complètes des produits
 */
function get_all_products_infos()
{
    $query = "
        SELECT 
            p.id AS product_id,
            p.name,
            p.description,
            p.product_image,

            c.id AS category_id,
            c.category_name,

            i.id AS item_id,
            i.price,
            i.stock

        FROM product p
        LEFT JOIN product_category c ON p.category_id = c.id
        LEFT JOIN product_item i ON p.id = i.product_id
        ORDER BY p.id
    ";
    return db_select($query);
}

/**
 * Récupère un produit par son nom
 */
function get_product_by_name($product_name)
{
    $query = "SELECT * FROM product WHERE name = ? LIMIT 1";
    return db_select_one($query, [$product_name]);
}

/**
 * Crée un produit
 */

function create_product($name, $description, $image_url, $category_id)
{
    $query = "INSERT INTO product (name, description, product_image, category_id)
              VALUES (?, ?, ?, ?)";

    if (db_execute($query, [$name, $description, $image_url, $category_id])) {
        return db_last_insert_id();
    }

    return false;
}
/**
 * Crée le prix et le stock du produit
 */
function create_product_item($product_id, $price, $stock)
{
    $query = "INSERT INTO product_item (product_id, price, stock)
              VALUES (?, ?, ?)";

    if (db_execute($query, [$product_id, $price, $stock])) {
        return db_last_insert_id();
    }

    return false;
}
