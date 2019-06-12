<?php
include('../includes/utils_page.php');
get_header();
$user = get_logged_user();

if($user) {


    $req = "SELECT * from user";
    $args = array($user->get('id'));

    $req_roles = "SELECT distinct(role) from user";
    $roles = $db->query_get_rows($req_roles);


    $db->prepare($req);
    $users = $db->execute_prepared_query($args);

    ?>
    <h1 class="title has-text-dark has-text-weight-bold" style="text-align:center; margin-bottom:2%;margin-top:2%;">
        Visualiser les initiateurs</h1>

    <table class="table is-bordered is-striped is-narrow" style="margin: auto; margin-bottom : 2%;">
        <thead>
        <th>Noms</th>
        <th>Role</th>
        </thead>

        <tbody>

        <?php


        foreach ($users as $user) {
            echo '<tr>';
            echo '<td>' . $user['name'] . '</td>';
            echo '<td>' . $user['role'] . '</td>';

            echo '<td>';
            echo '<form method="POST" action="">';
            echo '<input type="text" id="user" name="user" value="' . $user['id'] . '" hidden />';

            echo '<div class="select" style="margin-right:1px; "><select name="role" id="role">';
            foreach ($roles as $role) {
                echo '<option value="' . $role . '" ' . ($user['role'] == $role ? "selected" : " ") . '>' . $role . '</option>';
            }
            echo '</select> </div>';

            echo '<input class="button is-dark" type="submit" id="submit" name="submit" value="Mettre à jour" />';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }

        ?>

        </tbody>
    </table>

    <?php
}
get_footer();