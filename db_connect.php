<?php
function db(){
    global $link;
    $link = mysqli_connect("localhost", "root", "", "leave") or die("couldn't connect to database");
    return $link;
}