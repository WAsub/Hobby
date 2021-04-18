<?php
    require_once('Hobby_1_2_customM.php');
    $M = new Hobby_1_2_customM();
    $M->DataPOST();
    $M->DBupdate();
    
    header('Location:Hobby_1_2_custom.php');