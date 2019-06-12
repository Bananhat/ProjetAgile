
<?php
    function getall()
    {
        global $db;
        $req = "select * from user";
        foreach ($req as $user)
        {
            echo '$user->get()';
        }
    }?>