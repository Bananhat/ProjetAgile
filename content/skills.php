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
    return false;
}

if ($user) {

    if($_GET['supp'] == 'del')
    {
        $userID = $_GET['id'];
        $skillUp = new DbSkillUpdater(new DbConnector());

        $suc = $skillUp->deleteSkill($userID);
        header('Location: skills.php?competence_id='.$_GET['comp']);
    }

    if (isset($_POST['submit']) || isset($_GET['cid'])) {
        echo 'sub';
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
            $skillUp = new DbSkillWriter(new DbConnector());
            $suc = $skillUp->addSkill($name, $_GET['cid']);
            if($suc){
                echo'bon';
            }
            else{
                echo 'pasbon';
            }
            header('Location: skills.php?competence_id='.$_GET['cid']);
        }
    }

    $reqSkills = $db->prepare('SELECT id,skill FROM skill where competence_id = :id');
    $reqSkills->execute(array(
            ':id' => $_GET['competence_id']
    ));

} ?>

    <h3 class="title has-text-dark has-text-weight-bold" style="text-align:center; margin-bottom:2%;margin-top:2%;">
        Gerer aptitude</h3>

    <div>
        <table class="table striped" style="margin:auto; width : 50%;">
            <thead>
            <th>Aptitude</th>
            </thead>

            <tbody>

            <?php

            foreach ($reqSkills as $row) {
                echo '<tr>';
                echo '<td>' . $row['skill'] . '</td>';

                echo '<td><a class="waves-effect waves-light btn" href="fiche_skills.php?competence_id='.$_GET['competence_id'].'&id='.$row['id'] .'">Modifier</a></td>';
                echo '<td><a class="waves-effect waves-light btn" href="skills.php?supp=del&comp='.$_GET['competence_id'].'&id='.$row['id'].'">Supprimer</a></td>';
                echo '</tr>';
            }

            echo '<tr>
                
        <form method="POST" action="skills.php?cid='.$_GET['competence_id'].'">
       <td> <label for="name"><b>Aptitude</b></label><input type="text" placeholder="name" name="name" required /></td>
             
            <td>      
        <input class="btn waves-effect waves-light" type="submit" id="submit" name="submit" value="Ajouter"/>
          </td>
        </form>
            </td>
            </tr>';
            ?>
            </tbody>
        </table>
        <a class="waves-effect waves-light btn" href="competences.php">Liste Competences</a>
    </div>
<?php
get_footer();