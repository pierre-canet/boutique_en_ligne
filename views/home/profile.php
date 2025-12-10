<div class="page-header">
    <div class="container">
        <h1><?php e($title); ?></h1>
    </div>
</div>

<section class="content">
    <div class="container">
        <div class="content-grid">
            <div class="content-main">
                <h2><?php e($message); ?></h2>

                <?php
                // Le contrôleur fournit $user
                $first_name = $user['firstname'] ?? '';
                $last_name  = $user['lastname']  ?? '';
                $email      = $user['email']      ?? '';
                $phone_number = $user['phone_number'] ?? '';
                ?>

                <form method="POST" action="<?php echo url('home/profile'); ?>">
                    <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

                    <div class="form-group">
                        <label for="firstname">Prénom</label>
                        <input type="text" id="firstname" name="firstname" value="<?php e($first_name); ?>">
                    </div>

                    <div class="form-group">
                        <label for="lastname">Nom</label>
                        <input type="text" id="lastname" name="lastname" value="<?php e($last_name); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="phone_number">Numéro de téléphone</label>
                        <input type="text" id="phone_number" name="phone_number" value="<?php e($phone_number); ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <input type="email" id="email" name="email" value="<?php e($email); ?>">
                    </div>

                    <div class="form-group">
                        <label for="password">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
                        <input type="password" id="password" name="password">
                        <small class="muted">
                            Au moins 8 caractères, 1 minuscule, 1 majuscule, 1 chiffre et 1 caractère spécial.
                        </small>
                    </div>

                    <button type="submit" class="btn btn-primary btn-full">Modifier</button>

                </form>
            </div>
        </div>
    </div>
</section>