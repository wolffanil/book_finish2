<?php 

session_start();

$_SESSION['edit'] = '';
unset($_SESSION['edit']);

header('Location: admin.php');