<?php
include_once('../includes/utils_page.php');
get_header();
try {
    $db = getInstanceOfDb();
} catch (Exception $e) {
    return false;
}

if ($user) {
    $reqCompetences = $db->query("SELECT * FROM s");
}
?>

<h1 class="title has-text-dark has-text-weight-bold" style="text-align:center; margin-bottom:2%;margin-top:2%;"> Visualiser les aptitudes</h1>';

get_footer();