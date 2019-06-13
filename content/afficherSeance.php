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

    if($_GET['supp'] == 'del')
    {
        $seanceID = $_GET['id'];
        $skillUp = new DbSeanceWriter(new DbConnector());
        $suc = $skillUp->deleteSeance($seanceID);
        header('Location: afficherSeance.php');
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
        Seance de <?php echo $res['name'];?></h3>

    <div>
        <table class="table striped">
            <thead>
            <th>date</th>
            <th>skill à travailler</th>
            <?php echo '<td><a class="waves-effect waves-light btn" href="ajoutSeance.php">Ajouter Séance</a></td>'?>
            </thead>

            <tbody>

    <?php
    foreach ($reqSeance as $rowSeance) {
        echo '<tr>';
        echo '<td>' . $rowSeance['date'] . '</td>';
        echo '<td>' . $rowSeance['id_skill1'] . $rowSeance['id_skill2'] . $rowSeance['id_skill3'] . '</td>';

        echo '<td>';
        echo '<td><a class="waves-effect waves-light btn" href="modifierSeance.php?id='.$rowSeance['id_seance'].'">Modifier</a></td>';
        echo '<td><a class="waves-effect waves-light btn" href="afficherSeance.php?supp=del&id='.$rowSeance['id_seance'].'">Supprimer</a></td>';
        echo '</td>';

        echo '</tr>';
    }
}?>
            </tbody>
    </table>
    </div>
<?php get_footer();