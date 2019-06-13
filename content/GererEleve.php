<?php
include_once('../includes/utils_page.php');
get_header();

$user = get_logged_user();

try {
    $db = getInstanceOfDb();
} catch (Exception $e) {

    return false;
}

if($user)
{
    $reqAjjStudent=$db->prepare("INSERT INTO `user`(`firstName`, `name`,'role') VALUES (:firstName,:name,'student')");
    $reqStudent=$db->query("SELECT * FROM USER WHERE role = 'student'");?>

    <h1 class="title has-text-dark has-text-weight-bold" style="text-align:center; margin-bottom:2%;margin-top:2%;">
    Visualiser les élèves</h1>

    <div>
        <table class="table is-bordered is-striped is-narrow">
            <thead>
            <th>Nom</th>
            <th>Prenom</th>
            </thead>

            <tbody>
            </tbody>
        </table>
    </div>
<?php
}
get_footer();