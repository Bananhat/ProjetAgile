<?php
<<<<<<< HEAD
include('../includes/utils_page.php');
get_header();

=======
    function getall()
    {
        global $db;
        $req = "select * from user";
        foreach ($req as $user)
        {
            echo '$user->get()';
        }
    }?>
>>>>>>> 19c3d2c3e9ec5db3de6869c86fb7018f82e0c512
