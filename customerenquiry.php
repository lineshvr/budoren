
<!DOCTYPE html>
<html>
<head>
 <title>budoren</title>
			<meta charset="utf-8">
			<script type="text/javascript" src="js/loginvalidation.js"></script>
<link href="styles/mystyle.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />

			


</head>
<?php
		include('dbcon.php');?>
<body>
       <?php include('usermenu.html');?>
  <br />
  
  <br /><br />

	
	
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
			//printf("Connect \n");
		}	

$sql="select * from contactdata";

//echo $sql;


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
		printf("<center>Vi finner ikke denne kombinasjonen. Sjekk at du har skrevet riktig.</center>");
		printf("<center><a href=\"loginn.html\">klick her.</a></center>");
  }
}


if (!$mysqli->set_charset("utf8")) {
printf("Error loading character set utf8: %s\n", $mysqli->error);
} else {
//printf("Current character set: %s\n", $mysqli->character_set_name());
}


	echo "<table  border=\"1\" style=\"width: 100%\" class=\"tablesstyle\">";
echo "<tr class=\"theader-style\">";

				echo "<th style=\"width: 2%\" class=\"auto-style3\"> ";
				echo 'Fornavn';
				echo "</th>";
				echo "<th style=\"width: 2%\" class=\"auto-style3\"> ";
				echo 'Etternavn';
				echo "</th>";
				echo "<th style=\"width: 2%\" class=\"auto-style3\"> ";
				echo 'E-Post';
				echo "</th>";
				echo "<th style=\"width: 2%\" class=\"auto-style3\"> ";
				echo 'Dato';
				echo "</th>";				
				echo "<th style=\"width: 2%\" class=\"auto-style3\"> ";
				echo 'Henvendelse';
				echo "</th>";
				
	
			echo "</tr>";

while($rowfilm= $rs->fetch_assoc()){

	echo "<tr>";

				echo "<td style=\"width: 2%\" class=\"tdstyle\"> ";
				echo $rowfilm['firstname'];
				echo "</td>";
				echo "<td style=\"width: 2%\" class=\"tdstyle\"> ";
				echo $rowfilm['lastname'];
				echo "</td>";
				echo "<td style=\"width: 2%\" class=\"tdstyle\"> ";
				echo $rowfilm['email'];
				echo "</td>";
				echo "<td style=\"width: 2%\" class=\"tdstyle\"> ";
				echo $rowfilm['contactdate'];
				echo "</td>";
				echo "<td style=\"width: 40%\" class=\"tdstyle\"> ";
				echo $rowfilm['inquiry'];
				echo "</td>";
				
			echo "</tr>";

}


echo "</table>";
?>

    </body>
    </html>