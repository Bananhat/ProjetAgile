<?php
include_once('../includes/utils_page.php');
include_once('../persistance/DbStudentWriter.php');
include('../persistance/DbConnector.php');
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
        $userID = $_GET['id'];
        $studentWriter = new DbStudentWriter(new DbConnector());
        $suc = $studentWriter->deleteStudent($userID);
    }
   if (isset($_POST['submit'])) {
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
            $firstName = $_POST['firstName'];
            $name = $_POST['name'];
            $level = $_POST['level'];

            $studentWriter = new DbStudentWriter(new DbConnector());
            $suc = $studentWriter->writeNewStudent($firstName, $name, $level);
            if($suc){
                echo'bon';

            }
            else{
                echo 'pasbon';
            }
        }
    }

   $reqAdmin = $db->query("SELECT * FROM student");
    $reqStudent = $db->prepare("SELECT * FROM student where level = :level");
   $reqStudent->execute(array(
        ':level' => $user->get('levelFormation')
   ));

} ?>

    <h1 class="title has-text-dark has-text-weight-bold" style="text-align:center; margin-bottom:2%;margin-top:2%;">
        Visualiser les élèves</h1>

    <div>
        <table class="table striped" style="margin:auto; width : 50%;">
            <thead>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Niveau</th>
            </thead>

            <tbody>
            <?php
            if($user->get('role') != 'admin'){
                foreach ($reqStudent as $rowStudent) {

                    echo '<tr>';
                    echo '<td>' . $rowStudent['name'] . '</td>';
                    echo '<td>' . $rowStudent['firstName'] . '</td>';
                    echo '<td>' . $rowStudent['level'] . '</td>';
                    if ($user->get('role') == 'responsable' || $user->get('role') == 'admin') {
                        echo '<td><a class="waves-effect waves-light btn" href="fiche_eleve.php?id=' . $rowStudent['id_student'] . '">Modifier</a></td>';
                        echo '<td><a class="waves-effect waves-light btn" href="GererEleve.php?supp=del&id=' . $rowStudent['id_student'] . '">Supprimer</a></td>';
                    }
                    echo '<td><a class="waves-effect waves-light btn" href="studentOverview.php?id=' . $rowStudent['id_student'] . '">Competences</a></td>';
                    echo '</tr>';
                }
            }else{
                    foreach ($reqAdmin as $rowStudent){
                echo '<tr>';
                echo '<td>' . $rowStudent['name'] . '</td>';
                echo '<td>' . $rowStudent['firstName'] . '</td>';
                echo '<td>' . $rowStudent['level'] . '</td>';
                if($user->get('role') == 'responsable' || $user->get('role') == 'admin') {
                    echo '<td><a class="waves-effect waves-light btn" href="fiche_eleve.php?id=' . $rowStudent['id_student'] . '">Modifier</a></td>';
                    echo '<td><a class="waves-effect waves-light btn" href="GererEleve.php?supp=del&id=' . $rowStudent['id_student'] . '">Supprimer</a></td>';
                }
                echo '<td><a class="waves-effect waves-light btn" href="studentOverview.php?id='. $rowStudent['id_student'] .'">Competences</a></td>';
                echo '<td><a class="waves-effect waves-light btn" href="afficherSeance.php?id='.$rowStudent['id_student'].'">Séance</a></td>';
                echo '</tr>';
            }
                }





            ?>
            </tbody>
        </table>
        <?php
        echo '<h4 style="margin-left:2%;"> Ajouter un eleve </h4>';
        echo '<form method="POST" action="" style="width: 25%; margin-left: 2%;">';

        echo '<label for="name"><b>nom</b></label><input type="text" placeholder="nom" name="name" required>';
        echo '<label for="firstName"><b>prenom</b></label><input type="text" placeholder="prénom" name="firstName" required>';

        echo '
                <div class="select" style="margin-right:1px; ">
                    <select name="level">
                      <option value="" disabled selected>Niveau</option>
                      <option value="1">niveau 1</option>
                      <option value="2">niveau 2</option>
                      <option value="3">niveau 3</option>
                    </select>
                  </div>';
        echo '<input class="btn waves-effect waves-light" type="submit" id="submit" name="submit" value="Mettre à jour"/>';
        echo '</form>';

        ?>
    </div>
<?php
get_footer();