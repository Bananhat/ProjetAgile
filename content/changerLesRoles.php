
<?php
    function getall()
    {
        global $db;
        $req = "select * from user where role like('%initiateur%')";
        foreach ($req as $user)
        {
            echo '$user->get()';
        }?>
    }