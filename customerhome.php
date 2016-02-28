<!DOCTYPE html>
<html>
 <head>
    
			<title>BUD O REN</title>
			<meta charset="utf-8">
			<script type="text/javascript" src="js/loginvalidation.js"></script>
			<script type="text/javascript" src="js/script.js"></script>
						<script type="text/javascript" src="js/jquery-1.3.2.js"></script>

    <?php
    //Start session
    session_start();
/*if( isset($_SESSION['LAST_REQUEST']) &&
    (time() - $_SESSION['LAST_REQUEST'] > 10) ) {
    session_unset();
    session_destroy();
    header('/login?sessionExpired');
    exit();
}
 
$_SESSION['LAST_REQUEST'] = time();*/
    //Check whether the session variable sess_customername is present or not
    if(!isset($_SESSION['sess_customername']) || (trim($_SESSION['sess_customerid']) == ''))
    		{
				header("location: loginn.html");
				exit();
    		}
    		
      	?>
 		

    </head>
      <?php
		include('dbcon.php');?>
    <body>
 
	
    <?php include('customermenu.html');?>


	
	<br><br><br>
	  <div class="text-left">
    <h1>Velkommen, <?php echo $_SESSION["sess_customername"] ?></h1>
	  </div>
	<!-- <?php
	 
		$tmp_customername= $_SESSION['sess_customername'];
		$tmp_customerid= $_SESSION['sess_customerid'];
	$mysqli = new mysqli("budoren.mysql.domeneshop.no","budoren","Viqvt3vA","budoren");

		if (mysqli_connect_errno()) 
		{
			printf("<br>");
			printf("<br>");
			printf("<br>");
			printf("<br>");
			printf("<br>");
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		else
		{
			printf("Connect \n");
		}	

$sql="select film_name,film_entrydate,film_language from film_data fd ,customer_information ci where ci.customer_id=fd.customer_id and ci.customer_id='$tmp_customerid' group by film_name desc";
//$sql="SELECT * FROM customer_information WHERE customer_emailid='$tmp_login' and customer_password='$tmp_password'";
$rs=$mysqli ->query($sql); 

if($rs == false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else 
{
  $rows_returned = $rs->num_rows;
  if($rows_returned==0)
  {
		printf("<br>");
		printf("<br>");
		printf("<br>");
		printf("<br>");
		printf("<br>");
		printf("<center>Vi finner ikke denne kombinasjonen av e-postadresse og passord. Sjekk at du har skrevet riktig.</center>");
		printf("<center><a href=\"loginn.html\">Trykk her.</a></center>");
  }
}


if (!$mysqli->set_charset("utf8")) {
printf("Error loading character set utf8: %s\n", $mysqli->error);
} else {
//printf("Current character set: %s\n", $mysqli->character_set_name());
}


	echo "<table style=\"width: 100%\">";


while($rowcustdata= $rs->fetch_assoc()){
				echo "<tr>";
				echo "<td style=\"width: 4%\"> &nbsp;</td>";
				echo "<td style=\"width: 6%\"> ";
				echo $rowcustdata['film_name'];
				echo "</td>";
				echo "<td style=\"width: 10%\"> ";
				echo $rowcustdata['film_entrydate'];
				echo "</td>";
				echo "</tr>";

}


echo "</table>";
?>

-->    </body>
    </html>