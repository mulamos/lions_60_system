<?php
//Start session
session_start();

$host = getenv('IP');
$username = getenv('C9_USER');
$password = '';
$dbname = 'lions';

try {
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
}
catch (PDOException $e) {echo $e;}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    //user to be added
    $fname = $_POST["firstname"];
    $lname = $_POST["lastname"];
    $uname = $_POST["username"];
    $pword = $_POST["password"];
    $cpos = $_POST["cposition"];
    
    //applicant to be added
    $firstname = $_POST["fname"];
    $initial = $_POST["middleinit"];
    $lastname = $_POST["lname"];
    $gender = $_POST["gender_radio"];
    $club = $_POST["club"];
    $position = $_POST["position"];
    $country = $_POST["country"];
    $email = $_POST["email"];
    $cel = $_POST["cell"];
    $tel = $_POST["tel"];
    $host = $_POST["host_country"];
    $arrival_date = $_POST["arrival_date"];
    $arrival_time = $_POST["arrival_time"];
    $arr_airline = $_POST["arr_airline"];
    $dep_date = $_POST["dep_date"];
    $dep_time = $_POST["dep_time"];
    $dest_airline = $_POST["dest_airline"];
    $roomrate = $_POST["roomrate"];
    
    //login
    $logname = $_POST["logname"];
    $logpass = $_POST["logpass"];
    
    //indicate logout
    $lout = $_POST["logout"];
    
    //add a user
    if (isset($uname) && isset($pword) && isset($fname) && isset($lname) && isset($cpos)) {
        $sql = "INSERT INTO chairperson (first_name, last_name, user_name, user_password, cposition) VALUES ('$fname', '$lname', '$uname', '$pword', '$cpos');";
        $stmt = $conn->query($sql);
        echo "Successfully Added User";
    };
    
    //login
    if(isset($logname) && isset($logpass)) {
        $sql = "SELECT * FROM chairperson WHERE user_name = '$logname' AND user_password = '$logpass';";
        $stmt = $conn->query($sql);
        $res = $stmt->fetch();
        
        if($res != null){
            $_SESSION["u_name"] = $res["user_name"];
            $_SESSION["c_pos"] = $res["cposition"];
            echo "User Found";
        }
        else{
            echo "No User Found";
        }
    };
    
    //logout
    if($lout == "true"){
        session_unset();
        session_destroy();
    };
    
    //add applicant
    if (isset($firstname) && isset($initial) && isset($lastname) && isset($gender) && isset($club) && isset($position) && isset($country) && isset($email) && isset($cel) && isset($tel) && isset($host) && isset($arrival_date) && isset($arrival_time) && isset($arr_airline) && isset($dep_date) && isset($dep_time) && isset($dest_airline) && isset($roomrate)){
        $sql = "INSERT INTO applicants(first_name, middle_initial, last_name, gender, club, position, country, email, cell, tel, host, date_of_arrival, time_of_arrival, arrival_airline, date_of_departure, time_of_departure, depature_airline, rate) VALUES('$firstname', '$initial', '$lastname', '$gender', '$club', '$position', '$country', '$email', '$cel', '$tel', '$host', '$arrival_date', '$arrival_time', '$arr_airline', '$dep_date', '$dep_time', '$dest_airline', '$room_rate');";
        $stmt = $conn->query($sql);
        $last_id = $conn->lastInsertId();
        echo "<body id='node'>" .
                "<div class='header'>" .
                  "<img id='regis_img' src='https://crestonlions.files.wordpress.com/2014/12/crestonlions2.jpg'></img>" .
                  "<div class='bottom-right'><h1>MD60 MID-YEAR CONFERENCE</h1></div>" .
                "</div>".
            
                "<div class='w-form'>" .
                    "<fieldset>" .
                      "<legend><h2>Form Submission Status</h2></legend>" .
                          "<p style='color:red;'><img id='regis_img' src='https://cdn4.iconfinder.com/data/icons/flat-icons-for-web-and-seo/341/18-128.png'></img>Registration form was submitted successfully. <span style='font-size:1.5em;'>YOUR APPLICATION #: " .$last_id. "</span></p>" .
                    "</fieldset><br>" .
            
                  "<div id='result'>" .
                  "</div>" .
              "</body>";
    }/*else {
        echo "<body id='node'>" .
                "<div class='header'>" .
                  "<img id='regis_img' src='https://crestonlions.files.wordpress.com/2014/12/crestonlions2.jpg'></img>" .
                  "<div class='bottom-right'><h1>MD60 MID-YEAR CONFERENCE</h1></div>" .
                "</div>".
            
                "<div class='w-form'>" .
                    "<fieldset>" .
                      "<legend><h2>Form Submission Status</h2></legend>" .
                          "<p style='color:red;'><img id='regis_img' src='https://upload.wikimedia.org/wikipedia/commons/f/f6/White_X_in_red_background.png'></img>An Error has occured while submitting this form.  </p>" .
                    "</fieldset><br>" .
            
                  "<div id='result'>" .
                  "</div>" .
              "</body>";
    }*/

};

//$required = array($fname, $initial, $lname, $gender, $club, $position, $country, $email, $cel, $tel, $host, $arrival_date, $arrival_time, $arr_airline, $dep_date, $dep_time, $dest_airline, $room_rate);

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    
    //Function to display relevant attributes to Registration Chairperson
    function ch_display($results) {
    
        //How the applicant information is displayed to the Registration Chairperson
        
        echo '<table><tr><th>First Name</th><th>Last Name</th><th>Country</th><th>Club</th><th>Position</th></tr>';
        
        //Displays each row with applicant information
        
        foreach ($results as $row) {
            echo'<tr>'.
                '<td>'.$row['first_name']. '</td>' .
                '<td>'.$row['last_name'].'</td>'.
                '<td>'.$row['country'].'</td>'.
                '<td>'.$row['club'].'</td>'.
                '<td>'.$row['position'].'</tr>';
        }
        echo '</table>';
    }
    //Function to display relevent attributes to Accomadation and Transportation Chairperson
    function a_t_display($results) {
        //How it is displayed to the applicant information
            
            echo '<table>
                  <col>
                  <colgroup span="3"></colgroup>
                  <colgroup span="3"></colgroup>
                  <tr>
                    <td rowspan="1"></td>
                    <th colspan="3" scope="colgroup">Arrival Information</th>
                    <th colspan="3" scope="colgroup">Departure Information</th>
                  </tr>
                  <tr>
                    <th colspan="1">Lion/Leo Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Flight</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Flight</th>
                  </tr>';
            
            //Displays each row with applicant information
            
            foreach ($results as $row) {
                echo'<tr>'.
                    '<td scope="row">'.$row['first_name']. ' '.$row['last_name'].'</td>' .
                    '<td>'.$row['date_of_arrival'].'</td>' .
                    '<td>'.$row['time_of_arrival'].'</td>' .
                    '<td>'.$row['arrival_airline'].'</td>' .
                    '<td>'.$row['date_of_departure'].'</td>' .
                    '<td>'.$row['time_of_departure'].'</td>' .
                    '<td>'.$row['depature_airline'].'</td>' .
                  '</tr>';
            }
            echo '</table>';
    }
    //Function to display relevant attributes to transportation chairperson
    function t_display($results) {
        //How it is displayed to the applicant information
            
            echo '<table><tr><th>First Name</th><th>Last Name</th><th>Country</th><th>Club</th><th>Position</th><th>US$</th></tr>';
            
            //Displays each row with applicant information
            
            foreach ($results as $row) {
                if ($row['rate'] == "Single") {
                        $cost = "$245";
                    }
                    else if ($row['rate'] == "Double") {
                        $cost = "$290";
                    }
                    else{
                        $cost = "$389";
                    }
                    
                echo'<tr>'.
                    '<td>'.$row['first_name']. '</td>' .
                    '<td>'.$row['last_name'].'</td>'.
                    '<td>'.$row['country'].'</td>'.
                    '<td>'.$row['club'].'</td>'.
                    '<td>'.$row['position'].'</tr>' .
                    '<td>'.$cost.'</td>';
            }
            echo '</table>';
    }
    
    $getreport = $_GET["all"];
    $getbyID = $_GET["id_num"];
    
    //Store the position of the logged in user
    $pos = $_SESSION["c_pos"];
    
    //Check if user wants all the applicants information stored in the database
    if ($getreport == "true") {
        
        $stmt = $conn->query("SELECT * FROM applicants;");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($pos == "Registration Chairperson") {
            ch_display($results);
        }
        elseif ($pos == "Treasurer") {
            t_display($results);
        }
        else {
            a_t_display($results);
        }
        
    }
    //Checks if user wants to search database by ID
    else if ($getbyID !== "") {
        
        $stmt = $conn->query("SELECT * FROM applicants WHERE applicant_id='$getbyID';");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($pos == "Registration Chairperson") {
            ch_display($results);
        }
        elseif ($pos == "Treasurer") {
            t_display($results);
        }
        else {
            a_t_display($results);
        }
        
    }
}
