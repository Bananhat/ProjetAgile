<?php
include '../persistance/DbConnector.php';
include '../persistance/DbSummaryReader.php';
include_once '../settings.php';

$Dbreader = new DbSummaryReader(new DbConnector());
$result = $Dbreader->readSummaryFromStudentId(3);

$html = "";?>

<table border="1">
    <tr>
        <td></td>
        <?php
        $studentid = $_GET['id'];
        $competence = $Dbreader->getCompetencesFromStudentId($studentid);
        foreach($competence as $comp)
        {
            $count = $Dbreader->getSkillCountFromCompetenceId($comp["id"]);
            echo "<td colspan=".$count[0]["count(*)"].">".$comp['name'].'</td>';
        }?>
    </tr>

    <tr>
        <td></td>
        <?php
        foreach($competence as $comp)
        {
            $aptitude = $Dbreader->getSkillsFromCompetenceId($comp['id']);
            foreach($aptitude as $apt)
            {
                echo '<td>'.$apt['skill'].'</td>';
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
            echo '<td>' . $dat['date'] . '</td>';


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
                    echo '<td>Acquis</td>';
                }
                else if($trial[0]["validated"] == 2)
                {
                    echo '<td>En Cours</td>';
                }
                else
                {
                    echo '<td> </td>';
                }
            }
        }
        echo '</tr>';
        }
        $olddat = $dat;
    }?>
</table>

