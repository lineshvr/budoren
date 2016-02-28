<!DOCTYPE html>
<html>
 <head>
    
			<title>budoren</title>
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
 		

			<style type="text/css">
			.auto-style1 {
			background-color: #66AFE9;
			}
			.auto-style2 {
			color: #fff;
			text-align: right;
			}
			</style>

    </head>
      <?php
		include('dbcon.php');?>
    <body>
 
	
    <?php include('customermenu.html');?>


	
	<br><br><br>
	
    <h1>Welcome, <?php echo $_SESSION["sess_customername"] ?></h1>
	 
<?php
	 
	
	//$mysqli = new mysqli("budoren.mysql.domeneshop.no","budoren","Viqvt3vA","budoren");

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
		//	printf("Connect \n");
		}	
$tempcustomer_name= $_SESSION["sess_customername"];
//echo "sal".$tempcustomer_name;
$sqldata="select * from customer_information where customer_name='$tempcustomer_name'";
//echo "sal dsddd".$sqldata;
 	
 	if (!$mysqli->set_charset("utf8")) 
 	{
																		  
  printf("Error loading character set utf8: %s\n", $mysqli->error);
	} 
	else {
	  //  printf("Current character set: %s\n", $mysqli->character_set_name());
	}

$rs=$mysqli ->query($sqldata);

echo "sal".$rs;
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
		printf("<center>Vi finner ikke denne kombinasjonen.Sjekk at du har skrevet riktig.</center>");
		printf("<center><a href=\"loginn.html\">klick har.</a></center>");
  }
}


if (!$mysqli->set_charset("utf8")) {
printf("Error loading character set utf8: %s\n", $mysqli->error);
} else {
//printf("Current character set: %s\n", $mysqli->character_set_name());
}


	echo "<table style=\"width: 100%\" class=\"tablesstyle\">";
echo "<tr  class=\"theader-style\">";		echo "<td style=\"width: 4%\"> &nbsp;</td>";
					echo "<td style=\"width: 4%\"> &nbsp;</td>";
					echo "<td style=\"width: 6%\">Firma Navn</td>";
					echo "<td style=\"width: 10%\">Adresse</td>";
					echo "<td style=\"width: 10%\">postnummer</td>";
			
					echo "<tdstyle=\"width: 10%\">Kontaktnummer</td>";
					
					echo "<tdstyle=\"width: 10%\">Mobilenummer</td>";


					echo "<tdstyle=\"width: 10%\">E-post</td>";

					echo "</tr>";



while($rowcustdata= $rs->fetch_assoc()){
					echo "<tr>";
							echo "<td style=\"width: 4%\"> &nbsp;</td>";
					echo "<td style=\"width: 4%\"> &nbsp;</td>";
					echo "<td style=\"width: 6%\"> ";
					echo $rowcustdata['customer_name'];
					echo "</td>";
					echo "<td style=\"width: 10%\"> ";
					echo $rowcustdata['customer_postnumber'];
					echo "</td>";
					echo "</td>";
					echo "<td style=\"width: 10%\"> ";
					echo $rowcustdata['customer_contactnumber'];
					echo "</td>";
								echo "<td style=\"width: 10%\"> ";
					echo $rowcustdata['customer_mobilenumber'];
					echo "</td>";
		echo "</td>";
								echo "<td style=\"width: 10%\"> ";
					echo $rowcustdata['customer_emailid'];
					echo "</td>";

					echo "</tr>";

}


echo "</table>";
?>
    </body>
    </html>