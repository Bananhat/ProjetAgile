<?php
include_once('../includes/utils_page.php');
include('../persistance/DbConnector.php');
include('../persistance/DbSeanceWriter.php');
get_header();

$user = get_logged_user();
try {
    $db = getInstanceOfDb();
} catch (Exception $e) {

    return false;
}

if ($user) {

    if ($_GET['id']) {

        $seanceID = $_GET['id']
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

            $addSeance = new DbSeanceWriter(new DbConnector());
            echo $seanceID;
            $res = $addSeance->updateSeanceName($seanceID,$date, null, null, null);

            if (!$res) {
                echo 'Erreur';
            } else {
                header('Location:  changerLesRoles.php');
            }

        }
    }

    ?>

    <form method="POST" action="modifierSeance.php">
        <div class="formulaire" style="margin-top: 10%; margin-left: 30%; width: 25%;">
            <label for="date"><b>date</b></label>
            <input type="text" placeholder="date" name="date" required/>

            <input class="btn waves-effect waves-light" type="submit" name="submit" value="valider"/>
        </div>
    </form>


    <?php
}
 get_footer();