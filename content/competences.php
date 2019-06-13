<?php
include_once('../includes/utilis_pages.php');
get_header();
try {
    $db = getInstanceOfDb();
} catch (Exception $e) {
    return false;
}

?>

<h1 class="title has-text-dark has-text-weight-bold" style="text-align:center; margin-bottom:2%;margin-top:2%;"> Visualiser les compétences</h1>';
get_footer();