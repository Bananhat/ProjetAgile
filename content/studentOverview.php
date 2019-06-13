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
        echo "hqllo";
        $competence = $Dbreader->getCompetencesFromStudentId($studentid);
        foreach($competence as $comp)
        {
            $count = $Dbreader->getSkillCountFromCompetenceId($comp["id"]);
            echo "<td colspan=$count>".$comp['name'].$count.'</td>';
        }?>
    </tr>
<?php /*
    <tr>
        <td></td>
        <?php
        foreach($aptitude as $apt)
        {
            echo '<td>'.$apt.'</td>';
        }?>
    </tr>

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

