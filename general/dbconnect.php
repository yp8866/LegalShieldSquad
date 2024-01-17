<?php

    $conn=mysqli_connect("localhost","root","","legal_shield_squad");
        if(!$conn)
        {
            die("could not connect".mysqli_error());
        }

?>