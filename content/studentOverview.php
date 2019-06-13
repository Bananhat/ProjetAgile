<?php
include '../persistance/DbConnector.php';
include '../persistance/DbSummaryReader.php';
include_once '../settings.php';
include_once('../includes/utils_page.php');
get_header();

$Dbreader = new DbSummaryReader(new DbConnector());
$result = $Dbreader->readSummaryFromStudentId(3);

$html = "";?>
<h3 class="title has-text-dark has-text-weight-bold" style="text-align:center;margin-bottom : 5%;"> Tableau de l'élève </h3>
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
                $trial = $Dbreader->getTrialsFromDate($dat['date'],$apt['id']);

                if(!$trial[0]["validated"])
                {
                    $trial[0]["validated"] = 0;
                }

                if($trial[0]["validated"] == 1)
                {
                    if(!$trial[0]["commentaire"])
                    {
                        echo '<td id="tableau" style="background-color: green">Acquis</td>';
                    }
                    else
                    {
                        echo '<td id="tableau" class="lienSurvol" style="background-color: green">Acquis<span id="tableau" class="popup">'.$trial[0]['commentaire'].'</span></td>';
                    }
                }
                else if($trial[0]["validated"] == 2)
                {
                    if(!$trial[0]["commentaire"])
                    {
                        echo '<td id="tableau" style="background-color: orange">En Cours</td>';
                    }
                    else
                    {
                        echo '<td id="tableau" class="lienSurvol" style="background-color: orange">En Cours<span id="tableau" class="popup">'.$trial[0]['commentaire'].'</span></td>';
                    }
                }
                else
                {
                    echo '<td id="tableau"> </td>';
                }
            }
        }
        echo '</tr>';
        }
        $olddat = $dat;
    }?>
</table>
<?php get_footer()?>

