<?php
include('../includes/utils_page.php');
include('../persistance/DbUserWriter.php');
include('../persistance/DbConnector.php');
include('../settings.php');

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
            $userRole = $_POST['role'];
            $formation = $_POST['formation'];

    if($confirmPassword == $newUserPassword) {
        $userWriter = new DbUserWriter(new DbConnector());
        $suc = $userWriter->writeNewUser($newUserFirstName, $newUserName, $newUserEmail, $newUserPassword, $userRole, $formation);
        if($suc) {
            echo "okay";
        }
        else{
            echo'pas bon';
        }
    }
    else {
        echo 'Les mots de passe doivent correspondre !';
    }



    }
}
?>
    <h3 class="title has-text-dark has-text-weight-bold" style="text-align:center;margin-bottom : 5%;">
       Enregistrer un initiateur</h3>

<form method="POST" action="signup_initiateur.php">
    <div class="formulaire" style="margin-left: 30%; width: 25%;">
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
<div>
        <label for="role"><b>Rôle</b></label>
        <select name="role" id="role" size="3">
            <option selected value="initiateur">Initiateur</option>
            <option value="reponsable">Responsable</option>
            <option value="admin">Directeur technique</option>
        </select>
</div>
<div>
        <label for="formation"><b>Formation</b></label>
        <select name="formation" id="formation" size="3">
            <option selected value="1">Niveau 1</option>
            <option value="2">Niveau 2</option>
            <option value="3">Niveau 3</option>
        </select>
</div>


        <input class="btn waves-effect waves-light" type="submit" name="submit" />
        </button>

    </div>
</form>

<?php
get_footer();
?>