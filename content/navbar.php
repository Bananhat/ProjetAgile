

<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>

<nav>
    <div class="nav-wrapper">
        <div class="#1e88e5 blue darken-1">

            <a class="waves-effect waves-light btn">Inscrire utilisateur</a>
            <a class="waves-effect waves-light btn right" href="signin.php?disconnect">Déconnexion</a>
            <a class="wave-effect waves-light btn">Modifier les rôles</a>
            <?php $user = get_logged_user();
            if($user) {
                if (is_admin($user)) {
                    echo '<a class="waves-effect waves-light btn">Inscrire utilisateur</a>';
                }
            }?>
        </div>
    </div>
</nav>