<?php
include '../persistance/DbConnector.php';
include '../persistance/DbSummaryReader.php';
include_once '../settings.php';
include_once('../includes/utils_page.php');
get_header();

$Dbreader = new DbSummaryReader(new DbConnector());
$result = $Dbreader->readSummaryFromStudentId(3);

$html = "";?>

<table class="striped centered" id="tableau">
    <tr>
        <td id="tableau"></td>
        <?php
        $studentid = $_GET['id'];
        $competence = $Dbreader->getCompetencesFromStudentId($studentid);
        foreach($competence as $comp)
        {
            $count = $Dbreader->getSkillCountFromCompetenceId($comp["id"]);
            echo "<td id='tableau' colspan=".$count[0]["count(*)"].">".$comp['name'].'</td>';
        }?>
    </tr>

    <tr>
        <td id="tableau"></td>
        <?php
        foreach($competence as $comp)
        {
            $aptitude = $Dbreader->getSkillsFromCompetenceId($comp['id']);
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
            $aptitude = $Dbreader->getSkillsFromCompetenceId($comp['id']);
            foreach($aptitude as $apt)
            {
                $trial = $Dbreader->getTrialsFromDate($dat['date'],$apt['id']);

                if(!$trial[0]["validated"])
                {
                    $trial[0]["validated"] = 0;
                }

                if($trial[0]["validated"] == 1)
                {
                    echo '<td id="tableau" style="background-color: green">Acquis</td>';
                }
                else if($trial[0]["validated"] == 2)
                {
                    echo '<td id="tableau" style="background-color: orange">En Cours</td>';
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

