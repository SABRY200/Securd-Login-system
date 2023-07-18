<?php

function escape($string){
    global $connection;
    mysqli_escape_string($connection,$string);
}


?>