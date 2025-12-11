<?php
// Modèle pour les utilisateurs

/**
 * Récupère un utilisateur par son email
 */
function get_user_by_email($email)
{
    $query = "SELECT * FROM users WHERE email = ? LIMIT 1";
    return db_select_one($query, [$email]);
}

/**
 * Récupère un utilisateur par son login
 */
function get_user_by_login($login)
{
    $query = "SELECT * FROM utilisateurs WHERE login = ? LIMIT 1";
    return db_select_one($query, [$login]);
}

/**
 * Récupère un utilisateur par son ID
 */
function get_user_by_id($id)
{
    $query = "SELECT * FROM users WHERE id = ? LIMIT 1";
    return db_select_one($query, [$id]);
}

/**
 * Crée un nouvel utilisateur
 */
function create_user($email, $phone_number, $firstname, $lastname,   $password)
{
    $hashed_password = hash_password($password);
    $query = "INSERT INTO users (email, phone_number, firstname, lastname, password) VALUES (?, ?, ?, ?, ?)";

    if (db_execute($query, [$email, $phone_number, $firstname, $lastname, $hashed_password])) {
        return db_last_insert_id();
    }

    return false;
}

/**
 * Met à jour un utilisateur
 */
function update_user($id, $firstname, $lastname, $email, $phone_number = '')
{
    $query = "UPDATE users SET firstname = ?, lastname = ?, email = ?, phone_number = ? WHERE id = ?";
    return db_execute($query, [$firstname, $lastname, $email, $phone_number, $id]);
}

/**
 * Met à jour un login utilisateur
 */
function update_user_login($id, $login)
{
    $query = "UPDATE utilisateurs SET login = ? WHERE id = ?";
    return db_execute($query, [$login, $id]);
}

/**
 * Met à jour le mot de passe d'un utilisateur
 */
function update_user_password($id, $password)
{
    $hashed_password = hash_password($password);
    $query = "UPDATE users SET password = ? WHERE id = ?";
    return db_execute($query, [$hashed_password, $id]);
}

/**
 * Supprime un utilisateur
 */
function delete_user($id)
{
    $query = "DELETE FROM users WHERE id = ?";
    return db_execute($query, [$id]);
}

/**
 * Récupère tous les utilisateurs
 */
function get_all_users($limit = null, $offset = 0)
{
    $query = "SELECT id, email, phone_number, firstname, lastname, role FROM users";

    if ($limit !== null) {
        $query .= " LIMIT $offset, $limit";
    }

    return db_select($query);
}

/**
 * Compte le nombre total d'utilisateurs
 */
function count_users()
{
    $query = "SELECT COUNT(*) as total FROM users";
    $result = db_select_one($query);
    return $result['total'] ?? 0;
}

/**
 * Vérifie si un email existe déjà
 */
function email_exists($email, $exclude_id = null)
{
    $query = "SELECT COUNT(*) as count FROM users WHERE email = ?";
    $params = [$email];

    if ($exclude_id) {
        $query .= " AND id != ?";
        $params[] = $exclude_id;
    }

    $result = db_select_one($query, $params);
    return $result['count'] > 0;
}
/**
 * Récupère les enum de la colonne rôle dans la table users
 */
function get_user_roles_enum()
{
    $query = "SHOW COLUMNS FROM users LIKE 'role'";
    $result = db_select_one($query);

    if (!$result) return [];

    $type = $result['Type'];

    preg_match('/enum\((.*)\)/', $type, $matches);
    $values = str_getcsv($matches[1], ',', "'");

    return $values;
}
/**
 * Modifie le rôle de l'utilisateur
 */
function update_user_role($user_id, $role)
{
    $query = "UPDATE users SET role = ? WHERE id = ?";
    return db_execute($query, [$role, $user_id]);
}
