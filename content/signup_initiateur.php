<?php
include('../includes/utils_page.php');
get_header();


    if(isset($_POST['submit']))
    {
    $non_remplis = array();

    foreach($_POST as $key=>$value){
        if(empty($value))
            $non_remplis[] = $key;
        }

        if(count($non_remplis) > 0)
        {
            echo 'Veuillez remplir ces champs : <br />';

            foreach($non_remplis as $non_rempli)
            {
                echo $non_rempli.'<br />';
            }
        }
    else
        {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $role = $_POST['role'];

    if($confirmPassword == $password) {
        $user_id = insert_user($username, $password, $role);
        if(!$user_id)
        {
            echo '<div class="notification is-danger">Erreur</div>';
        }

        $newUserFirstName = $_POST['newUserfirstName'];
        $newUserName = $_POST['newUserName'];
        $newUserEmail = $_POST['newUserEmail'];
        $newUserPassword= $_POST['newUserPassword'];
        $newUserRole = $_POST['newUserRole'];

        $userWriter = new DbUserWriter(new DbConnector());
        $userWriter->writeNewUser($newUserFirstName, $newUserName, $newUserEmail, $newUserPassword, $newUserRole);

    }
    else {
        echo '<div class="notification is-danger">Les mots de passe doivent correspondre!</div>';
    }


    header('Location: signup_initiateur.php');
    }
}
?>

<form method="POST" action="signup.php">
    <div class="formulaire" style="margin-top: 10%; margin-left: 30%; width: 25%;">
        <label for ="FirstName"><b>Prénom</b></label>
        <input type ="text" placeholder="Prénom" name="FirstName" required>

        <label for="Name"><b>Nom</b></label>
        <input type="text" placeholder="Nom" name="Name" required>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Email" name="email" required>

        <label for="mdp"><b>Mot de passe</b></label>
        <input type="password" placeholder="Mot de passe" name="password" required>

        <label for="confirm"><b>Confirmer le mot de passe</b></label>
        <input type="password" placeholder="Confirmer le mot de passe" name="confirm" required>

        <input type="submit" name="submit" id="submit" value="Créer le comtpe" class="button is-block is-warning has-text-black is-fullwidth has-text-weight-medium" />
        <button class="btn waves-effect waves-light" type="submit" name="submit">creer<i class="material-icons right">send</i>
        </button>

    </div>
</form>
