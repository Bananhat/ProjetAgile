<?php
include_once('../includes/utils_page.php');
include_once('../persistance/DbStudentWriter.php');
include('../persistance/DbConnector.php');
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

        $userId = $_GET['id'];
        $prenom = $_POST['firstName'];
        $nom = $_POST['name'];


        $userUpdate = new DbStudentWriter(new DbConnector());
        $suc = $userUpdate->updateStudentName($userId, $prenom, $nom);
        if($suc)
        {
            echo 'mise a jour!';
            header('Location: GererEleve.php');
        }else{
            echo 'erreur';
        }
    }

    $req = 'SELECT * FROM student WHERE id_student=:id';
    $reqStudent = $db->prepare($req);
    $reqStudent->execute(array('id' => $_GET['id']));
?>

    <h4 class="title has-text-dark has-text-weight-bold" style="text-align:center; margin-bottom:2%;margin-top:2%;">
        Modifier les eleves</h4>

    <?php

    foreach ($reqStudent as $rowStudent)
    {
        echo '<form method="POST" action="fiche_eleve.php?id='.$_GET['id'] .'"> 
        <input type="text" value="' . $rowStudent['firstName'] . '" name="firstName" />
        <input type="text" value="' . $rowStudent['name'] . '" name="name" />
        <input class="btn waves-effect waves-light" type="submit" id="submit" name="submit" value="Modifier" />
        </form>
        ';
    }
}
?>


<?php include('footer.php') ?>