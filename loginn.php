<?php

if(isset($_POST['submit']))
{

ob_start();
session_start();
/*if( isset($_SESSION['LAST_REQUEST']) &&
    (time() - $_SESSION['LAST_REQUEST'] > 10) ) {
    session_unset();
    session_destroy();
    header('/loginn.php?sessionExpired');
    exit();
}
 
$_SESSION['LAST_REQUEST'] = time();
*/// Create temporary variables
   $tmp_login = $_POST['username'];
//printf("username  %s\n",  $tmp_login);
   $tmp_password = $_POST['pwd1'];
 // printf("tmp_password  %s\n", $tmp_password);
      $tmp_loginntype = $_POST['loginntype'];
 //  printf("loginntype  %s\n", $tmp_loginntype);
// Create sql


$mysqli = new mysqli("budoren.mysql.domeneshop.no","budoren","Viqvt3vA","budoren");

if (!$mysqli->set_charset("utf8")) {
printf("Error loading character set utf8: %s\n", $mysqli->error);
} else {
//printf("Current character set: %s\n", $mysqli->character_set_name());
}


if (mysqli_connect_errno()) {
		printf("<br>");
		printf("<br>");
		printf("<br>");
		printf("<br>");
		printf("<br>");
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
}else{
//printf("Connect \n");
}
//echo($tmp_loginntype);
if($tmp_loginntype=="customer")
$sql="SELECT * FROM customer_information WHERE customer_emailid='$tmp_login' and customer_password='$tmp_password'";
 else
 $sql="SELECT * FROM user_information WHERE user_emailid='$tmp_login' and user_password='$tmp_password'";

//echo("sql".$sql);

$rs=$mysqli ->query($sql); 


if($rs === false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
  $rows_returned = $rs->num_rows;
  if($rows_returned==0){
		printf("<br>");
		printf("<br>");
		printf("<br>");
		printf("<br>");
		printf("<br>");
		printf("<center>Vi finner ikke denne kombinasjonen av e-postadresse og passord. Sjekk at du har skrevet riktig.</center>");
		printf("<center><a href=\"loginn.html\">klick har.</a></center>");
  }
}

$rs->data_seek(0);
while($row = $rs->fetch_assoc()){
if($tmp_loginntype=="customer")
	{
		
					if($row['newcustomer']=='true')
			{
			printf("Velkommen %s \n",$row['customer_name']);
			session_regenerate_id();
			$_SESSION['sess_customername'] = $row['customer_name'];
			$_SESSION['sess_customerid'] = $row['customer_id'];
			session_write_close();
			header('Location: newcustomerhome.php');	
			}
		else 
			{

			printf("Velkommen %s \n",$row['customer_name']);
			session_regenerate_id();
			$_SESSION['sess_customername'] = $row['customer_name'];
			$_SESSION['sess_customerid'] = $row['customer_id'];
			session_write_close();
			header('Location: customerhome.php');


			}	}
	else
	{
			if($row['user_admin']=="true")
				{
					session_regenerate_id();
					echo "data".$row['user_admin'];
					$_SESSION['sess_admmin'] = $row['user_admin'];
					$_SESSION['sess_admfirstname'] = $row['first_name'];
					$_SESSION['sess_admlastname'] = $row['last_name'];
		printf("Velkommen %s \n",$row['user_admin']);

					session_write_close();
					header('Location: adminhome.php');
				}
			else{
				//	printf("Velkommen %s \n",$row['first_name']);
					session_regenerate_id();
					$_SESSION['sess_firstname'] = $row['first_name'];
					$_SESSION['sess_lastname'] = $row['last_name'];
					session_write_close();
					header('Location: userhome.php');
					exit;
				}

	}

}
  
ob_end_flush(); 
$mysqli->close();
}

?>


