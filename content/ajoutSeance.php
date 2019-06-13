<?php
include('../includes/utils_page.php');
include('../persistance/DbConnector.php');
include('../settings.php');
include '../persistance/DbSeanceWriter.php';
include '../persistance/DbSummaryReader.php';

get_header();

if(isset($_POST['submit']))
{
    $non_remplis = array();

    foreach($_POST as $key=>$value){
        if(empty($value))
            $non_remplis[] = $key;
    }

    if(count($non_remplis) > 0)
    {
        echo 'Veuillez remplir ces champs : <br />';

        foreach($non_remplis as $non_rempli)
        {
            echo $non_rempli.'<br />';
        }
    }
    else
    {
        $jour = $_POST['jour'];
        $mois = $_POST['mois'];
        $annee = $_POST['annee'];
        $verif = true;

        switch ($mois)
        {
            case('janvier'):$date = $jour.'/01/'.$annee;break;
            case('fevrier'):$date = $jour.'/02/'.$annee;if($jour>28){$verif=false;};break;
            case('mars'):$date = $jour.'/03/'.$annee;break;
            case('avril'):$date = $jour.'/04/'.$annee;if($jour>30){$verif=false;};break;
            case('mai'):$date = $jour.'/05/'.$annee;break;
            case('juin'):$date = $jour.'/06/'.$annee;if($jour>30){$verif=false;};break;
            case('juillet'):$date = $jour.'/07/'.$annee;break;
            case('aout'):$date = $jour.'/08/'.$annee;break;
            case('septembre'):$date = $jour.'/09/'.$annee;if($jour>30){$verif=false;};break;
            case('octobre'):$date = $jour.'/10/'.$annee;break;
            case('novembre'):$date = $jour.'/11/'.$annee;if($jour>30){$verif=false;};break;
            case('décembre'):$date = $jour.'/12/'.$annee;break;
        }
        if($date<10)
        {
            $date = '0'.$date;
        }
        if($verif) {
            $skill1 = $_POST['id1'];
            $skill2 = $_POST['id2'];
            $skill3 = $_POST['id3'];
            $student_id = $_GET['id'];

            $pdo = (new DbConnector())->getConnection();
            $idskill = $pdo->prepare('select * from skill where skill=:skill');
            $idskill->bindParam(':skill', $skill1);
            $suc = $idskill->execute();
            $resultat = $idskill->fetch()['id'];
            $id1 = $resultat['id'];

            $pdo = (new DbConnector())->getConnection();
            $idskill = $pdo->prepare('select * from skill where skill=:skill');
            $idskill->bindParam(':skill', $skill2);
            $suc = $idskill->execute();
            $resultat = $idskill->fetch()['id'];
            $id2 = $resultat['id'];

            $pdo = (new DbConnector())->getConnection();
            $idskill = $pdo->prepare('select * from skill where skill=:skill');
            $idskill->bindParam(':skill', $skill3);
            $suc = $idskill->execute();
            $resultat = $idskill->fetch()['id'];
            $id3 = $resultat['id'];

            $userWriter = new DbSeanceWriter(new DbConnector());
            $suc = $userWriter->writeNewSeance($student_id, $date, $id1, $id2, $id3);
            if ($suc) {
                echo "okay";
            } else {
                echo 'pas bon';
            }
        }
        else
        {
            echo $jour;
            echo $mois;
            echo $annee;
            echo ' --> ';
            echo "La date entrée n'existe pas";
        }
    }
}

$studentid = $_GET['id'];
$pdo = (new DbConnector())->getConnection();
$statement = $pdo->prepare('select name from student where id_student=:id');
$statement->bindParam(':id',$studentid);
$suc = $statement->execute();
$res = $statement->fetch();

$Dbreader = new DbSummaryReader(new DbConnector());
$competence = $Dbreader->getCompetencesFromStudentId($studentid);
?>
    <h3 class="title has-text-dark has-text-weight-bold" style="text-align:center;margin-bottom : 5%;">
        Ajouter une séance à <?php echo $res['name'];?></h3>

    <?php echo '<form method="POST" action="ajoutSeance.php?id='.$_GET['id'].'">';?>
        <div class="formulaire" style="margin-left: 30%; width: 25%;">
            <label for ="Date"><b>Date</b></label>
            <!--<input type ="text" placeholder="Date" name="Date" required>-->
            <?php
                echo '<table><tr><td><div class="select" style="margin-right:1px; "><select name="jour" id="jour">';
                for($i=1; $i<32; $i++)
                {
                    echo '<option selected="selected" value="'.$i.'">'.$i.'</option>';
                }
                echo '</select></div></td>';
                echo '<td><div class="select" style="margin-right:1px; "><select name="mois" id="mois">';
                echo '<option selected="selected" value="janvier">janvier</option>';
                echo '<option selected="selected" value="fevrier">fevrier</option>';
                echo '<option selected="selected" value="mars">mars</option>';
                echo '<option selected="selected" value="avril">avril</option>';
                echo '<option selected="selected" value="mai">mai</option>';
                echo '<option selected="selected" value="juin">juin</option>';
                echo '<option selected="selected" value="juillet">juillet</option>';
                echo '<option selected="selected" value="aout">aout</option>';
                echo '<option selected="selected" value="septembre">septembre</option>';
                echo '<option selected="selected" value="octobre">octobre</option>';
                echo '<option selected="selected" value="novembre">novembre</option>';
                echo '<option selected="selected" value="décembre">décembre</option>';
                echo '</select></div></td>';
                echo '<td><div class="select" style="margin-right:1px; "><select name="annee" id="annee">';
                for($i=0; $i<10; $i++)
                {
                    $an = Date(Y)+$i;
                    echo '<option selected="selected" value="'.$an.'">'.$an.'</option>';
                }
                echo '</select></div></td></tr></table>';?>

            <label for="id1"><b>aptitude 1</b></label>
            <?php
                    echo '<div class="select" style="margin-right:1px; "><select name="id1" id="id1">';
                    foreach($competence as $comp)
                    {
                        $skill = $Dbreader->getSkillsFromCompetenceId($comp['competence_id']);
                        foreach ($skill as $sk)
                        {
                            echo '<option selected="selected" value="'.$sk['skill'].'">'.$sk['skill'].'</option>';
                        }
                    }
                    echo '</select> </div>';?>

            <label for="id2"><b>aptitude 2</b></label>
            <?php
            echo '<div class="select" style="margin-right:1px; "><select name="id2" id="id2">';
            foreach($competence as $comp)
            {
                $skill = $Dbreader->getSkillsFromCompetenceId($comp['competence_id']);
                foreach ($skill as $sk)
                {
                    echo '<option selected="selected" value="'.$sk['skill'].'">'.$sk['skill'].'</option>';
                }
            }
            echo '</select> </div>';?>

            <label for="id3"><b>aptitude 3</b></label>
            <?php
            echo '<div class="select" style="margin-right:1px; "><select name="id3" id="id3">';
            foreach($competence as $comp)
            {
                $skill = $Dbreader->getSkillsFromCompetenceId($comp['competence_id']);
                foreach ($skill as $sk)
                {
                    echo '<option selected="selected" value="'.$sk['skill'].'">'.$sk['skill'].'</option>';
                }
            }
            echo '</select> </div>';?>

            <input class="btn waves-effect waves-light" type="submit" name="submit" />
            </button>
        </div>
    </form>

<?php
get_footer();
?>