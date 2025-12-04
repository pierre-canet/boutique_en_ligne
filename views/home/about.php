<div class="page-header">
    <div class="container">
        <h1><?php e($title); ?></h1>
    </div>
</div>

<section class="content">
    <div class="container">
        <div class="content-grid">
            <div class="content-main">
                <h2>À propos de cette application</h2>
                <p><?php e($content); ?></p>

                <h3>Un catalogue immense !</h3>
                <p>Notre site vous propose un catalogue fourni parmi de nombreuses catégories :</p>
                <ul>
                    <li>
                        <strong>Confiseries classiques</strong> : serpentins, dragibus, carambars,
                        tous les grands classiques de la confiseries sont présents, parfait pour une
                        fête, un anniversaire ou juste pour une envie de sucreries !
                    </li>
                    <li>
                        <strong>Confiseries adaptées</strong> : sucreries végan, confiseries Halal,
                        bobons sans sucre, tout est là pour permettre à chacun de profiter de
                        confiseries adaptées à son mode vie
                    </li>
                    <li>
                        <strong>Confiseries d'antan</strong> : Car en sac, rondoudous, berlingots,
                        les confiseries favorites de nos parents et de nos grands-parents se sont
                        données rendez-vous dans notre boutique pour vous permettre de partager
                        d'inoubliables moments en famille !
                    </li>
                    <li>
                        <strong>Chocolats</strong> : tablettes, chocolats fourrés à la liqueur ou non,
                        chocolats de fêtes, chocolat noir, noir intense, au lait ou blanc, les fans
                        du cacao trouveront leur bonheur chez nous !
                    </li>
                    <li>
                        <strong>Boissons</strong> : Sodas, boissons énergisantes, thés glacés, boissons
                        aux fruits, Cia Kombucha, si vous avez une petite soif, vous trouverez ici de
                        quoi l'étancher.
                    </li>
                    <li>
                        <strong>Box personnalisée</strong> : Vous avez envie de plusieurs confiseries
                        différentes en même temps ? Alors composez vous-même la box de vos rêves à des
                        prix avantageux !
                    </li>
                </ul>
                <h3>Nos fondateurs</h3>
                <p>Mais la conception de ce site n'aurait pas pu être possible sans la collaboration de :</p>
                <ul>
                    <li><strong>Jawad</strong> : Designer et concepteur de notre catalogue !</li>
                    <li><strong>Mehdi</strong> : Développeur de notre page d'accueil</li>
                    <li><strong>Adam</strong> : Développeur de notre page profil !</li>
                    <li><strong>Pierre</strong> : Concepteur du back-office et des pages connexion et inscription</li>
                    <li><strong>Ivan</strong> : le Designer des maquettes du site !</li>
                </ul>

                <h3>Qui sommes-nous ?</h3>
                <p>Nous sommes une équipe d'étudiants en formation pour devenir Développeurs Web et Web mobile</p>
            </div>

            <div class="sidebar">
                <div class="info-box">
                    <h4>Informations système</h4>
                    <p><strong>Version PHP :</strong> <?php echo phpversion(); ?></p>
                    <p><strong>Version app :</strong> <?php echo APP_VERSION; ?></p>
                    <p><strong>Base URL :</strong> <code><?php echo BASE_URL; ?></code></p>
                </div>
            </div>
        </div>
    </div>
</section>