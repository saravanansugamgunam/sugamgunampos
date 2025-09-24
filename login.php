<?php
	//Start session
	session_start();
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	
$connection = mysqli_connect('localhost','root','') or die(mysqli_error());
$database = mysqli_select_db($connection,'dev_sugamgunam') or die(mysqli_error());


 

	 
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {

$connection = mysqli_connect('localhost','root','') or die(mysqli_error());
$database = mysqli_select_db($connection,'dev_sugamgunam') or die(mysqli_error());


		$str = @trim($str);
		// if(get_magic_quotes_gpc()) {
			// $str = stripslashes($str);
		// }
		return mysqli_real_escape_string($connection, $str);
	}
	//Sanitize the POST values
	$login = clean($_POST['username']);
	$password = clean($_POST['password']);
	$Location = clean($_POST['cmbLocation']);
	
	
	//Input Validations
	// if($login == '') {
		// $errmsg_arr[] = 'Username missing';
		// $errflag = true;
	// }
	// if($password == '') {
		// $errmsg_arr[] = 'Password missing';
		// $errflag = true;
	// }
	
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: index.php");
		exit();
	}
	
//Create query
	// $qry="SELECT * FROM user as a join locationmaster as b  on a.location=b.locationcode JOIN pos_usergroupmapping AS c ON a.id=c.userid 
	// 	WHERE username='$login' AND password='$password' ";
 

  
$qry="SELECT * FROM `usermaster` AS a JOIN pos_usergroupmapping AS c ON a.userid=c.userid 
JOIN uselocationmapping AS b ON a.userid=b.userid  JOIN locationmaster AS d ON b.locationid=d.locationcode 
  WHERE b.locationid ='$Location' AND  username='$login' AND password='$password' ";


	$result=mysqli_query($connection,$qry);
	
	//Check whether the query was successful or not
	if($result) {
		if(mysqli_num_rows($result) > 0) {
			//Login Successful
			session_regenerate_id();
			$member = mysqli_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID'] = $member['userid'];
			$_SESSION['SESS_FIRST_NAME'] = $member['username'];
			$_SESSION['SESS_LAST_NAME'] = $member['userid'];
			$_SESSION['SESS_LOCATION'] = $member['locationcode']; 
			$_SESSION['SESS_LOCATIONNAME'] = $member['locationname'];
			$_SESSION['SESS_GROUP_ID'] = $member['groupid']; 
			$_SESSION['SESS_DOCTORFLAG'] = 0; 
			$_SESSION['SESS_DOCTORNAME'] = '-';
			//$_SESSION['SESS_PRO_PIC'] = $member['profImage'];
			session_write_close();
			header("location: main/index.php");
			exit();
		}else {
			//Login failed
                        echo 'Wrong login details';
						header("location: main/index.php");
			
		}
	}else {
		die("Query failed");
	}
?>