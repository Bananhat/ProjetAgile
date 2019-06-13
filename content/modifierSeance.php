<?php
include_once('../includes/utils_page.php');
include('../persistance/DbConnector.php');
include('../persistance/DbSeanceWriter.php');
get_header();

$user = get_logged_user();
try {
    $db = getInstanceOfDb();
} catch (Exception $e) {
    echo "Pas d'instance de BDD";
    return false;
}
if($user) {

    if (isset($_POST['submit']))
    {
        $seanceId = $_GET['id'];
        $date = $_POST['date'];
        $Dbwriter = new DbSeanceWriter(new DbConnector());

        $res = $Dbwriter->updateSeanceName($seanceId,$date,null,null,null);

        if($res)
        {
            echo 'mise a jour!';
            header('Location: modifierSeance.php?id='.$_GET['id']);
        }else{
            echo 'erreur';
        }
    }

    echo '<h4 class="title has-text-dark has-text-weight-bold" style="text-align:center; margin-bottom:2%;margin-top:2%;">
        Modifier Séance</h4>
        <form method="POST" action="modifierSeance.php?id='.$_GET['id'].'"> 

        <input type="text" value="date" name="date"/>
        <input class="btn waves-effect waves-light" type="submit" id="submit" name="submit" value="Modifier" />
        </form>';
}
?>

<?php get_footer();