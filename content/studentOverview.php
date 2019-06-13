<?php
include '../persistance/DbConnector.php';
include '../persistance/DbSummaryReader.php';
include_once '../settings.php';

$Dbreader = new DbSummaryReader(new DbConnector());
$result = $Dbreader->readSummaryFromStudentId(3);

$html = "";?>

<table>
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
    <?php /*
    <?php
    foreach($date as $dat)
    {
        echo '<tr>';
        foreach($aptitude as $apt)
        {
            echo '<td>'..'</td>';
        }
        echo '</tr>';
    }*/?>
</table>

