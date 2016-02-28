<!DOCTYPE html>
<html>
<?php
    //Start session
session_start();



    if(isset($_SESSION['sess_admmin']))
    {
    if((!isset($_SESSION['sess_admfirstname'])) || (!isset($_SESSION['sess_admlastname']))) {
    header("location: loginn.html");
    exit();
    }

    
    }
    else{
    if((!isset($_SESSION['sess_firstname'])) || (!isset($_SESSION['sess_lastname'])))
    		{
				header("location: loginn.html");
				exit();
    		}
    }		
      	?>
 <head>
    
			<title>budoren</title>
			<meta charset="utf-8">
			<script type="text/javascript" src="js/loginvalidation.js"></script>
 
   </head>
 
       <?php
		include('dbcon.php');?>


    <body>
    <?php include('usermenu.html');?>
  <br /><br />  
     <h6>Velkommen,     <?php echo $_SESSION["sess_firstname"] ?> logged in</h6>
	 <br />
	 <?php
	 
		$tmp_username= $_SESSION['sess_firstname'];
		$tmp_userlastname= $_SESSION['sess_lastname'];
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

$sql="select * from kino_detail";
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
		printf("<center>Vi finner ikke denne kombinasjonen.Sjekk at du har skrevet riktig.</center>");
		printf("<center><a href=\"loginn.html\">Trykk her.</a></center>");
  }
}


if (!$mysqli->set_charset("utf8")) {
printf("Error loading character set utf8: %s\n", $mysqli->error);
} else {
//printf("Current character set: %s\n", $mysqli->character_set_name());
}


	echo "<table style=\"width: 100%\">";
echo "<tr>";		echo "<td style=\"width: 4%\"> &nbsp;</td>";
					echo "<td style=\"width: 4%\"> &nbsp;</td>";
					echo "<th style=\"width: 6%\">Kino Navn</th>";
					echo "<th style=\"width: 10%\">Adresse</th>";
					echo "<th style=\"width: 10%\">Postnummer</th>";
			
					echo "<th style=\"width: 10%\">Sted</th>";
					echo "</tr>";



while($rowcustdata= $rs->fetch_assoc()){
					echo "<tr>";
							echo "<td style=\"width: 4%\"> &nbsp;</td>";
					echo "<td style=\"width: 4%\"> &nbsp;</td>";
					echo "<td style=\"width: 6%\"> ";
					echo $rowcustdata['kino'];
					echo "</td>";
					echo "<td style=\"width: 10%\"> ";
					echo $rowcustdata['kino_address'];
					echo "</td>";
					echo "<td style=\"width: 10%\"> ";
					echo $rowcustdata['kino_postnumber'];
					echo "</td>";
					echo "</td>";
					echo "<td style=\"width: 10%\"> ";
					echo $rowcustdata['kino_city'];
					echo "</td>";
					echo "</tr>";

}


echo "</table>";
?>

    </body>
    </html>