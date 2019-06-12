<?php




$req = "SELECT * from USER where role='initiateur'";
$args = array($user->get('id'));

$req_etats = "SELECT * FROM etats_commandes";
$etats = $db->query_get_rows($req_etats);


$db->prepare($req);
$commandes = $db->execute_prepared_query($args);

?>
<h1 class="title has-text-dark has-text-weight-bold" style="text-align:center; margin-bottom:2%;margin-top:2%;">Visualiser les initiateurs</h1>

<table class="table is-bordered is-striped is-narrow" style="margin: auto; margin-bottom : 2%;">
    <thead>
        <th>Noms</th>
        <th>Role</th>
    </thead>

    <tbody>

    <?php



    foreach($commandes as $commande){
        echo '<tr>';
        echo '<td>'.$commande['nom_cafe'].'</td>';
        echo '<td>'.$commande['nom_pays'].'</td>';
        echo '<td>'.$commande['nom_importateur'].'</td>';
        echo '<td>'.$commande['etat'].'</td>';

        echo '<td>';
        echo '<form method="POST" action="">';
        echo '<input type="text" id="commande" name="commande" value="'.$commande['id'].'" hidden />';

        echo '<div class="select" style="margin-right:1px; "><select name="etat" id="etat">';
        foreach($etats as $etat){
            echo '<option value="'.$etat['id'].'" '.($commande['etat_id'] == $etat['id'] ? "selected" : " " ).'>'.$etat['nom'].'</option>';
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