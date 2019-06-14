<?php
include '../persistance/DbConnector.php';
include '../persistance/DbSummaryReader.php';
include_once '../settings.php';
include_once('../includes/utils_page.php');

get_header();

$Dbreader = new DbSummaryReader(new DbConnector());
$result = $Dbreader->readSummaryFromStudentId(3);

$html = "";?>
<h3 class="" style="text-align:center; margin-top:2%;">
    Competence de l'eleve</h3>
<h5 class="" style="font-size: 1.2em; color: grey; text-align:center; margin-bottom:2%">
    Cliquez sur la case d'une aptitude pour l'evaluer..</h5>
<table class="striped centered" id="tableau">
    <tr>
        <td id="tableau"></td>
        <?php
        $studentid = $_GET['id'];
        $competence = $Dbreader->getCompetencesFromStudentId($studentid);
        foreach($competence as $comp)
        {
            $count = $Dbreader->getSkillCountFromCompetenceId($comp["competence_id"]);
            echo "<td id='tableau' colspan=".$count[0]["count(*)"].">".$comp['name'].'</td>';
        }?>
    </tr>

    <tr>
        <td id="tableau"></td>
        <?php
        foreach($competence as $comp)
        {
            $aptitude = $Dbreader->getSkillsFromCompetenceId($comp['competence_id']);
            foreach($aptitude as $apt)
            {
                echo '<td id="tableau">'.$apt['skill'].'</td>';
            }
        }?>
    </tr>

    <?php
    $date = $Dbreader->getDates($studentid);
    $olddat = 0;
    foreach($date as $dat)
    {
        if($dat != $olddat) {
            echo '<tr>';
            echo '<td id="tableau">' . $dat['date'] . '</td>';


        foreach($competence as $comp)
        {
            $aptitude = $Dbreader->getSkillsFromCompetenceId($comp['competence_id']);
            foreach($aptitude as $apt)
            {
                $trial = $Dbreader->getTrialsFromDate($dat['date'],$apt['id'],$studentid);

                if(!$trial[0]["validated"])
                {
                    $trial[0]["validated"] = 0;
                }

                if($trial[0]["validated"] == 1)
                {
                    if(!$trial[0]["commentaire"])
                    {
                        echo '<td id="tableau" style="background-color: green"><a href="evalSeance.php?date='.$dat['date'].'&idskill='.$apt['id'].'&idstud='.$_GET['id'].'" >Acquis</a></td>';
                    }
                    else
                    {
                        echo '<td id="tableau" class="lienSurvol" style="background-color: green"><a href="evalSeance.php?date='.$dat['date'].'&idskill='.$apt['id'].'&idstud='.$_GET['id'].'" >Acquis</a><span id="tableau" class="popup">'.$trial[0]['commentaire'].'</span></td>';
                    }
                }
                else if($trial[0]["validated"] == 2)
                {
                    if(!$trial[0]["commentaire"])
                    {
                        echo '<td id="tableau" style="background-color: orange"><a href="evalSeance.php?date='.$dat['date'].'&idskill='.$apt['id'].'&idstud='.$_GET['id'].'" >En Cours</a></td>';
                    }
                    else
                    {
                        echo '<td id="tableau" class="lienSurvol" style="background-color: orange"><a href="evalSeance.php?date='.$dat['date'].'&idskill='.$apt['id'].'&idstud='.$_GET['id'].'" >En Cours</a><span id="tableau" class="popup">'.$trial[0]['commentaire'].'</span></td>';
                    }
                }
                else
                {
                    echo '<td  id="tableau" ><a href="evalSeance.php?date='.$dat['date'].'&idskill='.$apt['id'].'&idstud='.$_GET['id'].'" style="display: block; height: 100%; width: 100%;">&nbsp;</a></td>
';
                }
            }
        }
        echo '</tr>';
        }
        $olddat = $dat;
    }?>
</table>
<?php get_footer()?>

