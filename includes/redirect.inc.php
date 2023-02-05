<?php
include_once 'dbh.inc.php';

$shortUrl = $_POST["shorturlredirect"];

$query = "SELECT long_url FROM url_map WHERE short_url = '$shortUrl'";
$result = mysqli_query($conn, $query);
$longUrl = mysqli_fetch_assoc($result)['long_url'];

header("Location: $longUrl");
exit();