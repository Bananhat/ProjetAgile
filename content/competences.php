<?php
include_once('../includes/utils_page.php');
include_once('../persistance/DbCompetenceWriter.php');
include_once('../persistance/DbConnector.php');

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
        $skillUp = new DbCompetenceWriter(new DbConnector());
        $suc = $skillUp->deleteCompetence($userID);
        header('Location: competences.php');
    }

    if (isset($_POST['submit']) || isset($_GET['cid'])) {

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
            $name = $_POST['name'];
            $skillUp = new DbCompetenceWriter(new DbConnector());
            $suc = $skillUp->writeNewCompetence($name, $user->get('levelFormation'));
            if($suc){
                echo'bon';
            }
            else{
                echo 'pasbon';
            }
                header('Location: competences.php');
        }
    }


    $req = 'SELECT * FROM competences WHERE niveau=(select levelFormation from user where id=:id)';
    $reqStudent = $db->prepare($req);
    $reqStudent->execute(array('id' => $user->get('id')));

} ?>

    <h3 class="title has-text-dark has-text-weight-bold" style="text-align:center; margin-bottom:2%;margin-top:2%;">
        Gérer les compétences</h3>

    <div>
        <table class="table striped" style="margin:auto; width : 50%;">
            <thead>
            <th>Compétence</th>
            </thead>

            <tbody>

            <?php

            foreach ($reqStudent as $row) {
                echo '<tr>';
                echo '<td>' . $row['name'] . '</td>';

                echo '<td><a class="waves-effect waves-light btn" href="fiche_competence.php?id='.$row['competence_id'] .'">Modifier</a></td>';
                echo '<td><a class="waves-effect waves-light btn" href="competences.php?supp=del&id='.$row['competence_id'].'">Supprimer</a></td>';
                echo '<td><a class="waves-effect waves-light btn" href="skills.php?competence_id='. $row['competence_id'] .'">Liste Aptitudes</a></td>';
                echo '</tr>';
            }

            echo '<tr>
                
        <form method="POST" action="competences.php?cid='.$user->get('id').'">
       <td> <label for="name"><b>Compétence</b></label><input type="text" placeholder="Intitulé" name="name" required /></td>
             
            <td>      
        <input class="btn waves-effect waves-light" type="submit" id="submit" name="submit" value="Ajouter"/>
          </td>
        </form>
            </td>
            </tr>';
            ?>
            </tbody>
        </table>
    </div>
<?php
get_footer();

