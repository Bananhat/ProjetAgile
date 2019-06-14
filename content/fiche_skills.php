<?php
include_once('../includes/utils_page.php');
include_once('../persistance/DbSkillUpdater.php');
include_once('../persistance/DbSkillWriter.php');
include_once('../persistance/DbConnector.php');
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

        $skillId = $_GET['id'];
        $nom = $_POST['name'];


        $userUpdate = new DbSkillUpdater(new DbConnector());
        $suc = $userUpdate->updateSkillName($skillId, $nom);

        if($suc)
        {
            echo 'mise a jour!';
            header('Location: skills.php?competence_id='.$_GET['competence_id']);
        }else{
            echo 'erreur';
        }
    }

    $req = 'SELECT * FROM skill WHERE id=:id';
    $reqSkill = $db->prepare($req);
    $reqSkill->execute(array('id' => $_GET['id']));
    ?>

    <h4 class="title has-text-dark has-text-weight-bold" style="text-align:center; margin-bottom:2%;margin-top:2%;">
        Modifier aptitude</h4>

    <?php

    foreach ($reqSkill as $row)
    {
        echo '<form method="POST" action="fiche_skills.php?competence_id='.$_GET['competence_id'].'&id='.$_GET['id'] .'"> 
 
        <input type="text" value="' . $row['skill'] . '" name="name" />
        <input class="btn waves-effect waves-light" type="submit" id="submit" name="submit" value="Modifier" />
        </form>
        ';
    }
}
?>


<?php include('footer.php') ?>