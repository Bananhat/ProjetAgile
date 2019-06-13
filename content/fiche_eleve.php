<?php include('header.php') ?>
<?php
    mysql_select_db('agile1_bd',$db);
    $sql = 'SELECT name, firstname, level FROM student WHERE id=1'; 
    $req = mysql_query($sql);
    $data = mysql_fetch_assoc($req);
    if(!$req.is_null()){
        echo "<tr><td>$data.name</td><td>$data.firstname</td><td>$data.level</td></tr>";
    }
    else{
        echo 'Elève inexistant.';
    }
?>
<?php include('footer.php') ?>