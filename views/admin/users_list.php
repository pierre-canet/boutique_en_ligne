<table>
    <tr>
        <th>Email</th>
        <th>Numéro de téléphone</th>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Rôle</th>
    </tr>
    <?php foreach ($user_list as $user) : ?>
        <tr>
            <td><?php e($user['email']) ?></td>
            <td><?php e($user['phone_number']) ?></td>
            <td><?php e($user['firstname']) ?></td>
            <td><?php e($user['lastname']) ?></td>
            <td><?php e($user['role']) ?></td>
        </tr>
    <?php endforeach ?>
</table>