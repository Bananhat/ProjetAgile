<?php
include_once('../includes/utilis_pages.php');
get_header();
try {
    $db = getInstanceOfDb();
} catch (Exception $e) {
    return false;
}

if ($user){
    $reqCompetences = $db -> query("SELECT * FROM FORMATION");

}

?>

<h1 class="title has-text-dark has-text-weight-bold" style="text-align:center; margin-bottom:2%;margin-top:2%;"> Visualiser les compétences</h1>';
<div>
    <table class="table is-bordered is-striped is-narrow">
        <thead>
        <th>Niveau 1</th>
        <th>Niveau 2</th>
        <th>Niveau 3</th>

        <tbody>
        <?php

<<<<<<< HEAD
<?php
=======
        foreach ($reqCompetences as $rowCompetences) {
            echo '<tr>';
            echo '<td>' . $rowCompetences['Description'] . '</td>';
            echo '<td>' . $rowCompetences['id_skill'] . '</td>';
            if($user=='formateur')
            {
                echo '<td><a class="waves-effect waves-light btn">Ajouter competence</a></td>'
            }

>>>>>>> 3619f19cb5d6e843e88ccd300f4d076c693119ef

get_footer();
