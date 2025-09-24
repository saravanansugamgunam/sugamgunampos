<?php
session_start();
unset($_SESSION['SESS_LOCATION']);
unset($_SESSION['SESS_LOCATIONNAME']);
unset($_SESSION['SESS_FIRST_NAME']);
header("Location:../index.php");
?>