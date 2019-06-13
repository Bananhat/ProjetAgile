

<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>

<nav>
    <div class="nav-wrapper">
        <div class="#1e88e5 blue darken-1">

            <a class="waves-effect waves-light btn" href="index.php">Acceuil</a>
            <?php
            $user = get_logged_user();
            if(!$user){
                echo '<a class="waves-effect waves-light btn" href="signin.php">Connexion</a>';
            }
            ?>

            <?php
            if($user) {
                echo '<a class="waves-effect waves-light btn right" style="margin-top: 1%;" href="signin.php?disconnect">Déconnexion</a>';
                if(is_admin($user->get('id'))){
                    echo ' <a class="wave-effect waves-light btn" href="changerLesRoles.php">Listes des initiateurs</a>';
                    echo ' <a class="wave-effect waves-light btn" href="signup_initiateur.php">Inscrire des initiateurs</a>';
                }
            }
            ?>

<?php
            if($user) {
                if (is_admin($user->get('id'))) {
                    echo '<a class="waves-effect waves-light btn" href="signup_initiateur.php">Inscrire initiateur</a>';
                }
            }
            ?>
        </div>
    </div>
</nav>