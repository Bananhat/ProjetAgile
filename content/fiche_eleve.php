<?php
include('../includes/utils_page.php');
include('../persistance/DbConnector.php');
include('../persistance/DbUserUpdater.php');
include('../persistance/DbStudentWriter.php');
include('../settings.php');
get_header();

$user = get_logged_user();
try {
    $db = getInstanceOfDb();
} catch (Exception $e) {
    echo "Pas d'instance de BDD";
    return false;
}
if($user) {

    if ($_POST['submit'])
    {

        $userId = $_GET['id'];
         $nom = $_POST['name'];
         $prenom = $_POST['prenom'];

        $userUpdate = new DbStudentWriter(new DbConnector());
        $suc = $userUpdate->updateStudentName($userId, $prenom, $nom);
        if($suc)
        {
            echo 'mise a jour!';
        }else{
            echo 'erreur';
        }
    }

    $req = 'SELECT * FROM student WHERE id=:id';
    $reqStudent = $db->prepare($req);
    $reqStudent->execute(array('id' => $_GET['id']));


    foreach ($reqStudent as $rowStudent)
    {
        echo '<form method="POST" action="fiche_eleve.php?id='.$_GET['id'] .'"> 
        <input type="text" placeholder="' . $rowStudent['firstName'] . '" name="firstName" />
        <input type="text" placeholder="' . $rowStudent['name'] . '" name="name" />
        <input class="btn waves-effect waves-light" type="submit" id="submit" name="submit" value="Modifier" />
        </form>
        ';
    }
}
?>


<?php include('footer.php') ?>