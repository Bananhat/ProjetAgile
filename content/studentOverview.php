<?php
include '../persistance/DbConnector.php';
include '../persistance/DbSummaryReader.php';
include_once '../settings.php';

$Dbreader = new DbSummaryReader(new DbConnector());
$result = $Dbreader->readSummaryFromStudentId(1);

var_dump($result);?>

<table>
    <tr>
        <td></td>
        <?php
        $userid = $_GET['id'];
        $competence = 
        foreach($competence as $comp)
        {
            $count = 1/*count($aptitude)*/;
            echo "<td colspan=$count>".$comp.'</td>';
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
    }?>*/?>
</table>