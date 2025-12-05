<div class="page-header">
    <div class="container">
        <h1><?php e($title); ?></h1>
    </div>
</div>

<section class="content">
    <div class="container">
        <div class="content-grid">
            <div class="content-main">
                <h1><?php e($message); ?></h1>
                <h2>Bonjour <?php e($user['login']); ?> </h2>
                <p><?php e($content); ?></p>

            </div>
        </div>
</section>
<section class="content">
    <div class="container">
        <div class="content-grid">
            <div class="content-main">
                <table>
                    <thead>
                        <tr>
                            <th>Login</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php e($user['login']) ?></td>
                            <td><?php e($user['email']) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
</section>
<section class="content">
    <div class="container">
        <div class="content-grid">
            <div class="content-main">
                <h2>Modifiez votre profil</h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="">Login :</label>
                        <input type="text" name="loginChange">
                    </div>
                    <div class="form-group">
                        <label for="">mot de passe :</label>
                        <input type="password" name="passwordChange"><br>
                    </div>
                    <div class="form-group">
                        <label for="">Confirmation mot de passe :</label>
                        <input type="password" name="passwordConfirm"><br>
                    </div>
                    <br>


                    <button type="submit" name="submit">Valider</button>
                </form>
            </div>
        </div>
</section>