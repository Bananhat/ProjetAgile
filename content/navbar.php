
<!--
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
<link rel = "stylesheet"
    href = "https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel = "stylesheet"
    href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
<script type = "text/javascript"
    src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>           
<script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js">
</script>-->

<nav>
    <div class="nav-wrapper">
        <div class="#1e88e5 blue darken-1">
        <?php
            $user = get_logged_user();
            if(!$user){
                echo '<a class="waves-effect waves-light btn" href = "index.php">Accueil</a>  ';
                echo '<a class="waves-effect waves-light btn" href="signin.php">Connexion</a>';
            }
            ?>

            <?php
            if($user) {
                    echo '<a class="waves-effect waves-light btn right" style="margin-top: 1%;" href="signin.php?disconnect">Déconnexion</a>';
                    echo '<ul id = "dropdown" class = "dropdown-content">';
                    echo '<li><a href = "index.php">Accueil</a></li>';
                    if(is_admin($user->get('id'))) {
                        echo '<li><a href = "changerLesRoles.php">Liste des initiateurs</a></li>';  }
                        if (is_admin($user->get('id')) || $user->get('role') == 'responsable' ||  $user->get('role') == 'initiateur') {
                            echo '<li><a href = "GererEleve.php">Liste des élèves</a></li>';
                            echo '<li><a href = "afficherSeance.php">Liste des séances à venir</a></li>';
                        }
                    if($user->get('role') == 'responsable'){
                        echo '<li><a href = "competences.php">Gerer les compétences</a></li>';
                    }

        if(is_admin($user->get('id'))) {
            echo '<li><a href = "signup_initiateur.php">Inscrire initiateur</a></li>';
        }

                    echo '</ul>';
                  
                    echo '<a class = "btn dropdown-button" data-constrainWidth="false" href = "#" data-activates = "dropdown">Menu<i class = "mdi-navigation-arrow-drop-down"></i></a>';

            }
            ?>
        </div>
    </div>
</nav>