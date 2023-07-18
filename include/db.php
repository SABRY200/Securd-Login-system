<?php

    define("DB_HOST","localhost");
    define("DB_USER","root");
    define("DB_PASS","");
    define("DB_NAME","registertion");

###########Database Connection##############
$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$connection) {
    die("Database Connection Failed" . mysqli_error());
}