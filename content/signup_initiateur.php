<?php
include('../includes/utils_page.php');
include('../persistance/DbUserWriter.php');
include('../persistance/DbConnector.php');
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
            $newUserFirstName = $_POST['FirstName'];
            $newUserName = $_POST['Name'];
            $newUserEmail = $_POST['email'];
            $newUserPassword= $_POST['password'];
            $confirmPassword = $_POST['confirm'];

    if($confirmPassword == $newUserPassword) {

        $userWriter = new DbUserWriter(new DbConnector());
        $userWriter->writeNewUser($newUserFirstName, $newUserName, $newUserEmail, $newUserPassword, 'initiateur');
    }
    else {
        echo 'Les mots de passe doivent correspondre!';
    }



    }
}
?>

<form method="POST" action="signup_initiateur.php">
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

        <input class="btn waves-effect waves-light" type="submit" name="submit" />
        </button>

    </div>
</form>
