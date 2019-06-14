<?php

include '../persistance/DbConnector.php';
include '../persistance/DbSummaryReader.php';
include_once '../settings.php';
# include_once('../includes/utils_page.php');
# get_header();


$template = '
<table border="1">
    <tr>
        <td> Student / Competences </td>
        <!--competences-->
    </tr>
    <tr>
        <td></td>
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
    $skillCount = count($skills[0]);
    # var_dump($skills);

    foreach ($skills as $skill) {
        $skillHtml = $skillHtml . "<td>" . $skill['skill'] . "</td>";
        $allSkills[] = $skill['id'];
    }

    var_dump($skillHtml);

    # var_dump($students);
    $competence['name'];
    $htmlString = $htmlString . "<td colspan='" . $skillCount . "'>" . $competence['name'] . "</td>";
}



//sorting the trials after date
function date_compare($element1, $element2) {
    $e1 = str_replace('/', '-', $element1['date']);
    $e2 = str_replace('/', '-', $element2['date']);
    $datetime1 = strtotime($e1);
    $datetime2 = strtotime($e2);
    return $datetime1 - $datetime2;
}


//Building the student rows
$stHtml = "";
foreach ($students as $student) {

    $stHtml =  $stHtml . "<tr>";
    $stHtml = $stHtml . "<td>" .  $student['name'] . "</td>";

    foreach ($allSkills as $skill) {
        $trials = $dbReader->getStudentTrialsFromIdAndSkillId($student['id_student'], $skill['id']);
        if (count($trials) < 3) {
            $status = "En Cours";
        } else {
            $status = "En Cours";
            uasort($trials, 'date_compare');
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
                    $status = "Acquis";
                    break;
                }
            }
        }
        $stHtml = $stHtml .  "<td> $status </td>";
    }

    $stHtml = $stHtml . "</tr>";
}


$html = str_replace('<!--competences-->', $htmlString, $template);
$html = str_replace('<!--skills-->', $skillHtml, $html);
$html = str_replace('<!--a-->', $stHtml, $html);

echo $html;

