<?php

function emptyUrl($longUrl){
    $result = true;
    if(empty($longUrl)){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;
}

function invalidUrl($longUrl){
    $result = true;
    if(!filter_var($longUrl, FILTER_VALIDATE_URL)){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;
}