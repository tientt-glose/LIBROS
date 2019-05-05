<?php
function myDB() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dblibros";
    $sub = mysqli_connect($servername, $username, $password);
    mysqli_select_db($sub, $dbname);
    mysqli_query($sub, "SET NAMES 'utf8'");
    return $sub;
}
/*$sub=mysqli_connect("localhost","root","");
mysqli_select_db($sub,"dblibros");
mysqli_query($sub,"SET NAMES 'utf8'");*/
?>