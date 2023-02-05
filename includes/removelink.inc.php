<?php

include_once 'dbh.inc.php';

if(isset($_POST["removelink"])){

$shortUrl = $_POST["shortlinkremove"];
$query = "DELETE FROM url_map WHERE short_url = '$shortUrl';";
mysqli_query($conn, $query);



header("location: ../index.php");
exit();

}else{
    header("location: ../index.php");
    exit();
}