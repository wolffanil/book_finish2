<?php 
    $connect = mysqli_connect('localhost', 'root', '', 'bookdb_2');

if(!$connect) {
    echo 'not connect'. mysqli_connect_error();
}