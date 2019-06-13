<?php
include_once('../includes/utils_page.php');
get_header();

$user = get_logged_user();

try {
    $db = getInstanceOfDb();
} catch (Exception $e) {

    return false;
}

if ($user) {
    $reqStudent = $db->query("SELECT * FROM student");

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
            $studentWriter->writeNewStudent($firstName,$name,$level);
        }

    } ?>

    <h1 class="title has-text-dark has-text-weight-bold" style="text-align:center; margin-bottom:2%;margin-top:2%;">
        Visualiser les élèves</h1>

    <div>
        <table class="table is-bordered is-striped is-narrow">
            <thead>
            <th>Nom</th>
            <th>Prenom</th>
            </thead>

            <tbody>
            <?php


            foreach ($reqStudent as $rowStudent) {
                echo '<tr>';
                echo '<td>' . $rowStudent['name'] . '</td>';
                echo '<td>' . $rowStudent['firstName'] . '</td>';
                if($user=='formateur')
                {
                    echo '<td><a class="waves-effect waves-light btn">Modifier</a></td>';
                    echo '<td><a class="waves-effect waves-light btn">Supprimer</a></td>';
                }
                echo '<tr>';
                echo '</tr>';
                echo '<td><label for="name"><b>nom</b></label><input type="text" placeholder="name" name="name" required></td>';
                echo '<td><label for="firstName"><b>prenom</b></label><input type="text" placeholder="firstName" name="firstName" required></td>';
                echo '<td><label for="level"><b>level</b></label><input type="text" placeholder="level" name="level" required></td>';
            } ?>
            </tbody>
        </table>
    </div>
    <?php
}
get_footer();