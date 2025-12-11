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
<div class="product-upload">
    <p>Ajout de produits</p>
    <form method="post" class="upload-form">
        <div class="form-group">
            <label for="name">Nom du produit</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description du produit</label>
            <input type="text" id="description" name="description" required>
        </div>
        <div class="form-group">
            <label for="price">Prix du produit</label>
            <input type="number" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="stock">Stock de départ</label>
            <input type="number" id="stock" name="stock" required>
        </div>
        <div class="form-group">
            <label for="category">Catégorie</label>
            <select name="category" id="category" required>
                <option value="">Veuillez sélectionner une catégorie</option>
                <?php foreach ($categories as $c) : ?>
                    <option value="<?= $c['id'] ?>" ?><?= $c['category_name'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <button type="submit">Ajouter le produit</button>
    </form>
</div>
<p>var_dump</p>
<?php var_dump($categories) ?>
<p>var_dump</p>
<?php var_dump($c) ?>
<p>var_dump</p>