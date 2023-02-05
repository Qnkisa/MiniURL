<?php

if(isset($_POST["submit"])){
    $longUrl = $_POST['link'];

    include_once 'dbh.inc.php';
    include_once 'functions.inc.php';

    if(emptyUrl($longUrl) !== false){
        header("location: ../index.php?error=emptyurl");
        exit();
    }

    if(invalidUrl($longUrl) !== false){
        header("location: ../index.php?error=invalidurl");
        exit();
    }

    // Generate a unique short URL
    function generateShortUrl($conn) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        // Check if the short URL is already in the database, if so generate another
        $query = "SELECT * FROM url_map WHERE short_url = '$randomString'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            return generateShortUrl($conn);
        }
        return $randomString;
    }

    $shortUrl = "localhost:3000/includes/redirect.inc.php?shorturl=" . generateShortUrl($conn);

    // Store the mapping between the long and short URLs
    function storeMapping($conn, $longUrl, $shortUrl) {
        $query = "INSERT INTO url_map (long_url, short_url) VALUES ('$longUrl', '$shortUrl')";
        mysqli_query($conn, $query);
    }

    storeMapping($conn, $longUrl, $shortUrl);
    header("location: ../index.php?error=none");
    exit();
}
else{
    header("location: ../index.php");
    exit();
}