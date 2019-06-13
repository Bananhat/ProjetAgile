<?php
include('../includes/utils_page.php');
include('../persistance/DbConnector.php');
include('../settings.php');
include '../persistance/DbSeanceWriter.php';

get_header();

if(isset($_POST['submit']))
{
    $non_remplis = array();

    foreach($_POST as $key=>$value){
        if(empty($value))
            $non_remplis[] = $key;
    }

    if(count($non_remplis) > 0)
    {
        echo 'Veuillez remplir ces champs : <br />';

        foreach($non_remplis as $non_rempli)
        {
            echo $non_rempli.'<br />';
        }
    }
    else
    {
        $date = $_POST['Date'];
        $id1 = $_POST['id1'];
        $id2 = $_POST['id2'];
        $id3= $_POST['id3'];

        $userWriter = new DbSeanceWriter(new DbConnector());
        $suc = $userWriter->writeNewSeance($date, $id1, $id2, $id3);
        if($suc) {
            echo "okay";
        }
        else{
            echo'pas bon';
        }
    }
}
?>
    <h3 class="title has-text-dark has-text-weight-bold" style="text-align:center;margin-bottom : 5%;">
        Enregistrer un initiateur</h3>

    <form method="POST" action="ajoutSeance.php">
        <div class="formulaire" style="margin-left: 30%; width: 25%;">
            <label for ="Date"><b>Date</b></label>
            <input type ="text" placeholder="Date" name="Date" required>

            <label for="id1"><b>aptitude 1</b></label>
            <input type="text" placeholder="aptitude 1" name="id1" required>

            <label for="id2"><b>aptitude 2</b></label>
            <input type="text" placeholder="aptitude 2" name="id2" required>

            <label for="id3"><b>aptitude 3</b></label>
            <input type="text" placeholder="aptitude 3" name="id3" required>

            <input class="btn waves-effect waves-light" type="submit" name="submit" />
            </button>
        </div>
    </form>

<?php
get_footer();
?>