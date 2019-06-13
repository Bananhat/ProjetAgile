<?php
include_once('../includes/utils_page.php');
include_once('../persistance/DbAptitudeWriter.php');
include_once('../persistance/DbSummaryReader.php');
include_once('../persistance/DbConnector.php');

get_header();


if(isset($_POST['submit'])){

    //validation
    $upSkill = new DbAptitudeWriter(new DbConnector());
    $stat1= $upSkill->validateAptitude($_GET['idstud'], $_GET['idskill'], $_POST['state']);
    if($stat1){
        echo 'bon1';
    }else{
        echo 'pas bon1';
    }

    //commentaire
    $upComment = new DbSummaryReader(new DbConnector());
    $stat2=$upComment->updateStudentComment($_GET['idstud']);
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