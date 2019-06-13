<?php
include('../includes/utils_page.php');
include('../settings.php');

    echo "test";
    try {
        $db = getInstanceOfDb();
    } catch (Exception $e) {
        echo "Pas d'instance de BDD";
        return false;
    }
    echo "test2";
    $req = 'SELECT * FROM student WHERE id=:id'; 

    $reqStudent=$db->prepare($req);
    $reqStudent=$db->execute(array('id' => $_GET['id']));
  
    foreach($reqStudent as $key=>$value)
    {
        
    }
?>
<?php include('footer.php') ?>