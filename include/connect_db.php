<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "aqilahmon";

$conn = mysqli_connect($servername, $username, $password);
$conn_obj = new mysqli($servername, $username, $password);

//Test connection
if ($conn) {
    //echo "sambungan pangkalan data berjaya  <br>";
} else {

    echo "sambungan pangkalan data tidak berjaya <br>";
    die();
}
//Check database selected

?>
