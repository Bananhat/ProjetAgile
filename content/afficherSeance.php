<?php
include_once('../includes/utils_page.php');
include('../persistance/DbConnector.php');
include('../persistance/DbSeanceWriter.php');
include '../persistance/DbSkillReader.php';

get_header();

$user = get_logged_user();
try {
    $db = getInstanceOfDb();
} catch (Exception $e) {

    return false;
}
if ($user) {

    if($_GET['supp'] == 'del')
    {
        $seanceID = $_GET['id'];
        $skillUp = new DbSeanceWriter(new DbConnector());
        $suc = $skillUp->deleteSeance($seanceID);
        header('Location: afficherSeance.php?id='.$_GET['idstud']);
    }

    $reqSeance = $db->prepare("SELECT * FROM seance where student_id=:id");
    $reqSeance->bindParam(':id',$_GET['id']);
    $reqSeance->execute();

    $pdo = (new DbConnector())->getConnection();
    $statement = $pdo->prepare('select name from student where id_student=:id');
    $statement->bindParam(':id',$_GET['id']);
    $suc = $statement->execute();
    $res = $statement->fetch();

    ?>

    <h3 class="title has-text-dark has-text-weight-bold" style="text-align:center; margin-bottom:2%;margin-top:2%;">
        Séance de <?php echo $res['name'];?></h3>

    <div>
        <table class="table striped">
            <thead>
            <th>date</th>
            <th>Compétence(s) à travailler</th>
            <?php echo '<td><a class="waves-effect waves-light btn" href="ajoutSeance.php?id='.$_GET['id'].'">Ajouter Séance</a></td>'?>
            </thead>

            <tbody>

    <?php
    foreach ($reqSeance as $rowSeance) {
        echo '<tr>';
        echo '<td>' . $rowSeance['date'] . '</td>';
        $Dbreader = new DbSkillReader(new DbConnector());
        $skill1 = $Dbreader->getSkillFromId($rowSeance['id_skill1']);
        $skill2 = $Dbreader->getSkillFromId($rowSeance['id_skill2']);
        $skill3 = $Dbreader->getSkillFromId($rowSeance['id_skill3']);
        echo '<td><table><tr><td id="nospace">' . $skill1[0]['skill'].'</td></tr><tr><td id="nospace">'. $skill2[0]['skill'] .'</td></tr><tr><td id="nospace">'. $skill3[0]['skill'] . '</td></tr></table></td>';

        echo '<td>';
        echo '<td><a class="waves-effect waves-light btn" href="afficherSeance.php?supp=del&id='.$rowSeance['id_seance'].'&idstud='.$_GET['id'].'">Supprimer</a></td>';
        echo '</td>';

        echo '</tr>';
    }
}?>
            </tbody>
    </table>
    </div>
<?php get_footer();