<?php

//Initiates connectin to Lions Database
$conn = include_once('connect.php');

//Uses $_GET to get variables from Genertal Control  
$fName = $_GET['firstname'];
$mName = $_GET['middleinit'];
$lName = $_GET['lastname'];
$Gender = $_GET['gender_radio'];
$Club = $_GET['club'];
$Position = $_GET['position'];
$Country = $_GET['country'];
$Email = $_GET['Email'];
$cellNum = $_GET['cell'];
$telNum = $_GET['tel'];
$hostCountry = $_GET['host_country'];
$DOA = $_GET['arrival_date'];
$TOA = $_GET['arrival_time'];
$arrivalAirline = $_GET['arr_airline'];
$DOD = $_GET['dep_date'];
$TOD = $_GET['dep_time'];
$depAirline = $_GET['dest_airline'];
$RR= $_GET['roomrate'];

//Prepare Query to check for duplicat applicant
$query = "SELECT * FROM applicants WHERE first_name = '$fName' and last_name = '$lName' and middle_initial = '$mName' and gender = '$Gender'";   

//Q1 - Queries lions database, applicants table for current applicant.
$results = mysqli_query($conn, $query);
$check = mysqli_num_rows($results);

if ($check == 0){
   //Prepares query to insert new applicant data
    $new_applicant = "INSERT INTO applicants(first_name,last_name,middle_initial
                    ,gender, club, position, country, email, cell, tel, host, 
                    time_of_arrival, time_of_departure, date_of_arrival,
                    date_of_departure, arrival_airline, depature_airline, 
                    rate) VALUES('$fName','$lName', '$mName', '$Gender',
                    '$Club', '$Position', '$Country', '$Email', '$cellNum', 
                    '$telNum', '$hostCountry', '$TOA', '$TOD', '$DOA' , '$DOD', 
                    '$arrivalAirline', '$depAirline', '$RR')";
    
    //Q2 - Inserts new applicant into applicants table
    $insert_result = mysqli_query($conn, $new_applicant);
    
    if($insert_result){
        $rows1 = mysqli_num_rows(mysqli_query($conn, "SELECT applicant_id FROM applicants"));
        $query2 = "SELECT applicant_id FROM applicants WHERE applicant_id = '$rows1'";
        $results1 = mysqli_query($conn, $query2);
        $array = mysqli_fetch_all($results1, MYSQLI_ASSOC);
        foreach ($array as $row){
                $array2 = $row['applicant_id'];
        }
        header("Location: https://lions-60-system-rand2016.c9users.io/status_success.html?conf=".(string)$array2); //Directs user to Confirmation page
    }else{
        header('Location: https://lions-60-system-rand2016.c9users.io/error/error.html?msg=Q2failed');
    } 
}else{
    header('Location: https://lions-60-system-rand2016.c9users.io/error/error.html?msg=Q1failed');
}


?>