<table>
    <tr>
        <th>Email</th>
        <th>Numéro de téléphone</th>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Rôle</th>
        <th></th>
    </tr>
    <?php foreach ($user_list as $user) : ?>
        <tr>
            <td><?php e($user['email']) ?></td>
            <td><?php e($user['phone_number']) ?></td>
            <td><?php e($user['firstname']) ?></td>
            <td><?php e($user['lastname']) ?></td>
            <td>
                <form method="post" class="role_update">
                    <select name="role">
                        <?php foreach ($roles as $role) : ?>
                            <option value="<?php e($role) ?>"
                                <?php if ($role === $user['role']) echo "selected"; ?>>
                                <?php e($role) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <input type="hidden" name="user_id" value="<?php e($user['id']) ?>">
            </td>
            <td>
                <button type="submit">Modifier</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
</table>