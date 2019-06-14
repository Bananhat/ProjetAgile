<?php

include '../persistance/DbConnector.php';
include '../persistance/DbSummaryReader.php';
include_once '../settings.php';
include_once('../includes/utils_page.php');
get_header();

echo '<h3 class="" style="text-align:center; margin-top:2%;">
    Résumer des éleve</h3>';

$template = '
<table class="striped centered" id="tableau">
    <tr>
        <td id="tableau"> Student / Competences </td>
        <!--competences-->
    </tr>
    <tr>
        <td id="tableau"></td>
        <!--skills-->
    </tr>
    <!--a-->
</table>
';

$dbReader = new DbSummaryReader(new DbConnector());
$competences = $dbReader->getCompetences();

$htmlString = "";
$skillHtml = "";
$allSkills = [];
$students = $dbReader->getStudents();

foreach ($competences as $competence) {
    $skills = $dbReader->getSkillsFromCompetenceId($competence['competence_id']);
    $skillCount = count($skills);

    foreach ($skills as $skill) {
        $skillHtml = $skillHtml . "<td id='tableau'>" . $skill['skill'] . "</td>";
        $allSkills[] = $skill['id'];
    }

<<<<<<< Updated upstream
    # var_dump($skillHtml);

=======
>>>>>>> Stashed changes
    # var_dump($students);
    $competence['name'];
    $htmlString = $htmlString . "<td id='tableau' colspan='" . $skillCount . "'>" . $competence['name'] . "</td>";
}



//sorting the trials after date
function date_compare($element1, $element2) {
    $e1 = explode('/', $element1['date']);
    $e2 = explode('/', $element2['date']);
    $e1 = $e1[1] . "/" . $e1[0] . "/" . $e1[2];
    $e2 = $e2[1] . "/" . $e2[0] . "/" . $e2[2];
    $datetime1 = strtotime($e1);
    $datetime2 = strtotime($e2);
    return $datetime1 - $datetime2;
}


//Building the student rows
$stHtml = "";
foreach ($students as $student) {

    $stHtml =  $stHtml . "<tr>";
    $stHtml = $stHtml . "<td id='tableau'>" .  $student['name'] . "</td>";

    foreach ($allSkills as $skill) {
        $trials = $dbReader->getStudentTrialsFromIdAndSkillId($student['id_student'], $skill['id']);
        if (count($trials) < 3) {
            $status = "style='background-color: orange'> En Cours";
        } else {
            $status = "style='background-color: orange'> En Cours";
            uasort($trials, 'date_compare');
            var_dump($trials);
            $valInRow = 0;
            $success = false;
            foreach ($trials as $trial) {
                if ($trial['validated'] == 2) {
                    $valInRow = 0;
                }
                if ($trial['validated'] == 1) {
                    $valInRow+=1;
                }
                if ($valInRow > 2) {
                    $success = true;
                    $status = "style='background-color: green'> Acquis";
                    break;
                }
                echo $valInRow;
            }
        }
        $stHtml = $stHtml .  "<td id='tableau' $status </td>";
    }

    $stHtml = $stHtml . "</tr>";
}


$html = str_replace('<!--competences-->', $htmlString, $template);
$html = str_replace('<!--skills-->', $skillHtml, $html);
$html = str_replace('<!--a-->', $stHtml, $html);

echo $html;
get_footer();

