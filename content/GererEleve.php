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

    $reqStudent = $db->query("SELECT * FROM student");

} ?>

    <h1 class="title has-text-dark has-text-weight-bold" style="text-align:center; margin-bottom:2%;margin-top:2%;">
        Visualiser les élèves</h1>

    <div>
        <table class="table is-bordered is-striped is-narrow">
            <thead>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Level</th>
            </thead>

            <tbody>
            <?php

            foreach ($reqStudent as $rowStudent) {
                echo '<tr>';
                echo '<td>' . $rowStudent['name'] . '</td>';
                echo '<td>' . $rowStudent['firstName'] . '</td>';
                echo '<td>' . $rowStudent['level'] . '</td>';

                echo '<td><a class="waves-effect waves-light btn" href="fiche_eleve.php?id='.$rowStudent['id'] .'">Modifier</a></td>';
                echo '<td><a class="waves-effect waves-light btn">Supprimer</a></td>';
                echo '</tr>';
            }

                echo '<tr>';
                echo '<td>';
                echo '<h4> Ajouter un eleve </h4>';
                echo '<form method="POST" action="">';

                echo '<label for="name"><b>nom</b></label><input type="text" placeholder="name" name="name" required>';
                echo '<label for="firstName"><b>prenom</b></label><input type="text" placeholder="firstName" name="firstName" required>';

                echo '
                <div class="select" style="margin-right:1px; ">
                    <select name="level">
                      <option value="" disabled selected>Niveau</option>
                      <option value="0">niveau 0</option>
                      <option value="1">niveau 1</option>
                      <option value="2">niveau 2</option>
                      <option value="3">niveau 3</option>
                    </select>
                  </div>';
                echo '<input class="btn waves-effect waves-light" type="submit" id="submit" name="submit" value="Mettre à jour"/>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            ?>
            </tbody>
        </table>
    </div>
<?php
get_footer();