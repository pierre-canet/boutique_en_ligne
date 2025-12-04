<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1><?php e($title); ?></h1>
            <p>Créez votre compte</p>
        </div>

        <form method="POST" class="auth-form">
            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">

            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input type="text" id="firstname" name="firstname" required
                    value="<?php echo escape(post('firstname', '')); ?>"
                    placeholder="Votre prénom">
            </div>
            <div class="form-group">
                <label for="lastname">Nom</label>
                <input type="text" id="lastname" name="lastname" required
                    value="<?php echo escape(post('lastname', '')); ?>"
                    placeholder="Votre nom de famille">
            </div>

            <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" required
                    value="<?php echo escape(post('email', '')); ?>"
                    placeholder="votre@email.com">
            </div>
            <div class="form-group">
                <label for="phone_number">Téléphone</label>
                <input type="phone_number" id="phone_number" name="phone_number"
                    value="<?php echo escape(post('phone_number', '')); ?>"
                    placeholder="0726...">
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required
                    placeholder="Au moins 6 caractères">
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirmer le mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password" required
                    placeholder="Confirmez votre mot de passe">
            </div>

            <button type="submit" class="btn btn-primary btn-full">
                <i class="fas fa-user-plus"></i>
                S'inscrire
            </button>
        </form>

        <div class="auth-footer">
            <p>Déjà un compte ?
                <a href="<?php echo url('auth/login'); ?>">Se connecter</a>
            </p>
        </div>
    </div>
</div>