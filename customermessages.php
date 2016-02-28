<!DOCTYPE html>
<html lang="no">
<head>
    <?php
    //Start session
    session_start();

    if(!isset($_SESSION['sess_customername']) || (trim($_SESSION['sess_customerid']) == ''))
    		{		
				header("location: loginn.html");
				exit();
    		}
  
      	?>


<title>budoren</title>
			<meta charset="utf-8">
			<link href="styles/mystyle.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />

			<script type="text/javascript" src="js/loginvalidation.js"></script>
			<script type="text/javascript" src="js/script.js"></script>
						<script type="text/javascript" src="js/jquery-1.3.2.js"></script>
 <style type="text/css">
 .auto-style1 {
	 background-color: #66AFE9;
 }
 .auto-style2 {
	 color: #fff;
	 text-align: right;
 }
  .auto-style3 {
	 text-align: center;
 }
			

 </style>

</head>
    <?php
		include('dbcon.php');?>

<body>

    <?php include('customermenu.html');?>

	
	
   	 <?php
	$temp_customerid= $_SESSION['sess_customerid'];
	
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
		
$sql_filmdata="SELECT * FROM leftstock_data RIGHT JOIN film_data ON (film_data.film_id = leftstock_data.film_id) WHERE customer_id='$temp_customerid'";
 	
 	if (!$mysqli->set_charset("utf8")) 
 	{
																		  
  printf("Error loading character set utf8: %s\n", $mysqli->error);
	} 
	else {
	  //  printf("Current character set: %s\n", $mysqli->character_set_name());
	}

$rsfilmdata=$mysqli ->query($sql_filmdata);

if($rsfilmdata== false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else 
{
  $rows_returned = $rsfilmdata->num_rows;
  if($rows_returned==0)
  {
		printf("<br>");
		printf("<br>");
		printf("<br>");
		printf("<br>");
		printf("<br>");
		printf("<center>Det har ikke film registret.</center>");
		
  }

else{


?>



		
	<?php
		/* change character set to utf8 */
		if (!$mysqli->set_charset("utf8")) {
		printf("Error loading character set utf8: %s\n", $mysqli->error);
		} else {
		// printf("Current character set: %s\n", $mysqli->character_set_name());
		}	?>
		
		
		<h2>Kunder Bestille Logg</h2>
			<table style="width: 100%" class="tablesstyle">
				
<tr class="theader-style">																
		<th>Film</th>
		<th>Film_navn</th>
		<th>Bannere</th>
		<th>DCP</th>	
		<th>Gulvplakat</th>
		<th>Plakat</th>
		<th>Standeer</th>
		</tr>		<?php
		while ($rowfilmdata = $rsfilmdata->fetch_assoc()) {
		echo "<tr>";																
	//	echo "<td  class=\"auto-style3\"><input type=\"radio\" name=\"film_id\" value=\"{$rowfilmdata ['film_id']}\"></td>";
		echo "<td class=\"tdstyle\">".$rowfilmdata['film_name']."</td>";
		echo "<td class=\"tdstyle\">".$rowfilmdata['film_language']."</td>";
/*		echo "<td class=\"auto-style3\"> <input type=\"text\" readonly value=\"{$rowfilmdata ['Bannere']}\"></td>";
		echo "<td class=\"auto-style3\"><input type=\"text\" readonly value=\"{$rowfilmdata ['DCP']}\"></td>";
		echo "<td class=\"auto-style3\"><input type=\"text\" readonly value=\"{$rowfilmdata ['Gulvplakat']}\"></td>";
		echo "<td class=\"auto-style3\"><input type=\"text\" readonly value=\"{$rowfilmdata ['Plakat']}\"></td>";
		echo "<td class=\"auto-style3\"><input type=\"text\" readonly  value=\"{$rowfilmdata ['Standeer']}\"></td>";	
*/		
		echo "<td class=\"tdstyle\">".$rowfilmdata ['Bannere']."</td>";
		echo "<td class=\"tdstyle\">".$rowfilmdata ['DCP']."</td>";
		echo "<td class=\"tdstyle\">".$rowfilmdata ['Gulvplakat']."</td>";
		echo "<td class=\"tdstyle\">".$rowfilmdata ['Plakat']."</td>";
		echo "<td class=\"tdstyle\">".$rowfilmdata ['Standeer']."</td>";	
		echo "</tr>";	
		}
		?>
					
			
			</table>
<table>

	

</table>

<?php
}}
?>

    </body>
    </html>