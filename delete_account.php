<?php
include_once 'dbconfig.php';
$id = $_SESSION['user_session'];
session_start();
session_unset(); 
$user->delete_account($id);
header("Location: index.php");
?>