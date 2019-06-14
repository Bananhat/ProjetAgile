<?php
include('../includes/utils_page.php');
include('../persistance/DbConnector.php');
include('../persistance/DbUserUpdater.php');
get_header();
$user = get_logged_user();
try {
    $db = getInstanceOfDb();
} catch (Exception $e) {

    return false;
}
if($user) {

    if($_POST['submit']){
    $nouveauRole = $_POST['role'];
    $userID = $_POST['user'];
    $userUpdate = new DbUserUpdater(new DbConnector());

    $suc = $userUpdate->updateUserRole($userID, $nouveauRole);

    if($suc){
        echo 'Mise a jour réussie !';
    }
    else {
        echo 'Echec de la mise a jour';
    }

    }


     $reqUser=$db->query("SELECT * FROM user;");
    ?>
    <h1 class="title has-text-dark has-text-weight-bold" style="text-align:center; margin-bottom:2%;margin-top:2%;">
        Visualiser les initiateurs</h1>

<div>
    <table class="table striped">
        <thead>
        <th>Noms</th>
        <th>Role</th>
        </thead>

        <tbody>

        <?php


        foreach ($reqUser as $rowUser) {
            echo '<tr>';
            echo '<td>' . $rowUser['name'] . ' ' . $rowUser['firstName'] . '</td>';
            if ($rowUser['role'] == 'admin') {
                echo '<td>' . 'Directeur technique' . '</td>';
            } else
            {
                echo '<td>' . $rowUser['role'] . '</td>';
            }

            echo '<td>';
            echo '<form method="POST" action="changerLesRoles.php">';
            echo '<input type="text" id="user" name="user" value=" ' . $rowUser['id'] .' " hidden />';


            echo '<div class="select" style="margin-right:1px; "><select name="role" id="role">';
            echo '<option selected="selected"  value="initiateur">Initiateur</option>';
            echo '<option value="responsable">Responsable</option>';
            echo '<option value="admin">Directeur Technique</option>';
            echo '</select> </div>';

            echo '<input class="btn waves-effect waves-light" type="submit" id="submit" name="submit" value="Mettre à jour" />';

                    echo '</form>';
                echo '</td>';

            echo '</tr>';
        }

        ?>

        </tbody>
    </table>
</div>
    <?php
}
get_footer();