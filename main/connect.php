<?php
/* Database config */
$db_host		= 'localhost';
$db_user		= 'root';
$db_pass		= '';
$db_database	= 'dev_sugamgunam'; 

/* End config */


     date_default_timezone_set("Asia/Kolkata");
     
$db = new PDO('mysql:host='.$db_host.';dbname='.$db_database, $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$connection = mysqli_connect('localhost','root','') or die(mysqli_error());
$database = mysqli_select_db($connection,'dev_sugamgunam') or die(mysqli_error());

?>