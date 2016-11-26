<?php
    /*$conn = include_once("connect.php");
        $query =mysqli_query($conn,"SELECT applicant_id FROM applicants");
        $rows1 = mysqli_num_rows($query);
    
    header("Location: https://lions-60-system-rand2016.c9users.io/models/confirmed.html?conf=".(string)$rows1);*/
    $var ='Javed';
    if (strcmp(strtolower("javed"), strtolower($var)) == 0){
        echo 'true';
        echo strtolower("Javed");
    }
?>