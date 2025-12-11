<table>
    <tr>
        <th>nom</th>
        <th>Description</th>
        <th>Image</th>
        <th>Prix</th>
        <th>Catégorie</th>
        <th>Stock</th>
    </tr>
    <?php foreach ($products as $p) : ?>
        <tr>
            <td><?php e($p['name']) ?></td>
            <td><?php e($p['description']) ?></td>
            <td><img src="<?php echo url($p['product_image']); ?>"
                    alt="<?= e($p['name']) ?>"
                    onerror="this.src='<?php echo url('assets/images/default.jpg'); ?>'" height="50px" width="auto"></td>
            <td><?php e($p['price']) ?></td>
            <td><?php e($p['category_name']) ?></td>
            <td><?php e($p['stock']) ?></td>
        </tr>
    <?php endforeach ?>
</table>