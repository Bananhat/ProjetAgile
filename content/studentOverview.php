<?php
include '../persistance/DbConnector.php';
include '../persistance/DbSummaryReader.php';
include_once '../settings.php';

$Dbreader = new DbSummaryReader(new DbConnector());
$result = $Dbreader->readSummaryFromStudentId(1);

var_dump($result);?>

<table>
    <tr>
        <?php
        foreach($competence as $comp)
        {
            echo '<td colspan=count($aptitude);>'.$comp.'</td>';
        }?>
    </tr>

    <tr>
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
            echo '<td>'.$studentTrial.'</td>';
        }
        echo '</tr>';
    }
</table>