<?php

$handle = @fopen("nbapi.log", "r");

if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {

        $array1 = explode("|", $buffer);
        // var_dump ($array1);

    if ($array1[4] == 'REQUEST') {
                $json_array = json_decode($array1[5],true);
                // var_dump($json_array);
                // echo $json_array["operation"];
                $operation = $json_array["operation"];
                $phonenumber = $json_array["msisdn"];



                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "selfcareapp";

            // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "INSERT INTO reqdealy (dateandtime, userid, transid, operation_type, phonenumber, json_string)
                VALUES ($array1[1], $array1[3], $array1[4], $operation, $phonenumber, $array1[5])";

                mysqli_query($conn, $sql);

    }else{

    }

        exit;

    }
    

  


}
?>