<?php
include_once('../includes/utils_page.php');
get_header();
if(isset($_SESSION['user'])){
    header('Location: index.php');
}
    if (isset($_GET['disconnect']))
    {
        if (get_logged_user()) {
            disconnect_current_user(); //a modif avec modele
        }
    }

    if (isset($_POST['submit'])) {
        $non_remplis = array();

        foreach ($_POST as $key => $value) {
            if (empty($value))
                $non_remplis[] = $key;
        }

        if (count($non_remplis) > 0) {
            echo 'Veuillez remplir ces champs : <br />';

            foreach ($non_remplis as $non_rempli) {
                echo $non_rempli . '<br />';
            }
        } else {
            $username = $_POST['email'];
            $password = $_POST['password'];


            $auth = authenticate_user_by_username($username, $password); //modele

            if (!$auth) {
                echo 'Erreur';
            } else {
                header('Location: signup_initiateur.php');
            }
        }

}
?>


	<form method="POST" action="signin.php">
  		<div class="formulaire" style="margin-top: 10%; margin-left: 30%; width: 25%;">
    		<label for="email"><b>Email</b></label>
    		<input type="text" placeholder="Email" name="email" required>

    		<label for="mdp"><b>Mot de passe</b></label>
    		<input type="password" placeholder="Mot de passe" name="password" required>
  			<input class="btn waves-effect waves-light" type="submit" name="submit">
  			</input>

  		</div>
		<div class="mdp" style="margin-left: 45%; width: 25%;">
    		<span class="mdp"><a href="#">Mot de passe oublié ?</a></span>
  		</div>
	</form> 

<?php include('footer.php'); ?>
