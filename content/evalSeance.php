<?php
include_once('../includes/utils_page.php');
include_once('../persistance/DbAptitudeWriter.php');
include_once('../persistance/DbSummaryReader.php');
include_once('../persistance/DbConnector.php');

get_header();


if(isset($_POST['submit'])){

    $db = new DbConnector();
    try
    {
        $pdo = $db->getConnection();

    }
    catch(Exception $e)
    {
        return false;
    }

    $req = $pdo->prepare('SELECT COUNT(*) as nb from studendtrials where student_id = :idstud and skill_id = :idskill and date= :date');
    $req->execute(array (
       ':idstud' => $_GET['idstud'],
        ':idskill' => $_GET['idskill'],
        ':date' => $_GET['date']
    ));

    $result = $req->fetch();
    if($result['nb'] != 0)
    {
        //validation
        $upSkill = new DbAptitudeWriter(new DbConnector());
        $stat1= $upSkill->validateAptitude($_GET['idstud'], $_GET['idskill'], $_POST['state'], $_GET['date']);
        if($stat1){
            echo 'bon1';
        }else{
            echo 'pas bon1';
        }

        //commentaire
        $upComment = new DbSummaryReader(new DbConnector());
        $stat2=$upComment->updateStudentComment($_GET['idstud'], $_POST['commentaire'], $_GET['idskill'], $_GET['date']);
        if($stat2){
            echo 'bon2';
        }
        else{
            echo 'pas bon2';
        }
        if($stat1 && $stat2){
            header('Location: studentOverview.php?id='.$_GET['idstud']);
        }

    }
    else{
        $addSkill = new DbAptitudeWriter(new DbConnector());
        $suc = $addSkill->addApt($_GET['idskill'], $_GET['idstud'], $_POST['state'], $_POST['commentaire'], $_GET['date']);
        if($suc){
            header('Location: studentOverview.php?id='.$_GET['idstud']);
        }
        else{
            echo 'pasbon';
        }

    }


}
?>
    <h4 class="title has-text-dark has-text-weight-bold" style="text-align:center; margin-bottom:2%;margin-top:2%;">
        Evaluer  l'aptitude durant la séance du <?php echo $_GET['date'] ?></h4>



<form method="POST" action="" style="width:25%;">

    <label for="textarea1">Commentaire</label>
    <textarea placeholder="Entrez un commentaire..." name="commentaire" id="textarea1" class="materialize-textarea"></textarea>

    <label id="state">Evaluation de l'aptitude</label>
    <select id="state" name="state">
        <option value="2">En cours</option>
        <option value="1">Acquis</option>
    </select>
    <input class="btn waves-effect waves-light" type="submit" name="submit" />

</form>
<?php
get_footer();