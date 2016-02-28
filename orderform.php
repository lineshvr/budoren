
<!DOCTYPE html>
<html>

    <?php
    //Start session
    session_start();

    if(!isset($_SESSION['sess_customername']) || (trim($_SESSION['sess_customerid']) == ''))
    		{		
				header("location: loginn.html");
				exit();
    		}
  
      	?>
<head>
 <title>budoren</title>

			<script type="text/javascript" src="js/loginvalidation.js"></script>
<link href="styles/mystyle.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
<script>
function checkField(val)
{


 document.getElementById("Hid_Melding").value = val;
}

function checkFieldDato(val)
{


 document.getElementById("Hid_Dato").value = val;

}
</script>
</head>
    <?php
		include('dbcon.php');?>

<body>

    <?php include('customermenu.html');?>
<br>
<br>
<br>
<br>
<h1 class="h1Style">Bestillingsskjema</h1>


<!-- <h1>Welcome, <?php echo $_SESSION["sess_customername"] ?></h1>
-->


<?php
  	$itemsName=array();
  	 $kinoname=array();
	$temp_customername=	$_SESSION['sess_customername'];
	$temp_customerid=	$_SESSION['sess_customerid'];
// Create connection



if (mysqli_connect_errno()) {
   printf("Connect failed: %s\n", mysqli_connect_error());
   exit();
}else{
//printf("Connect \n");
}

//$sql_filmdata="SELECT * FROM film_data RIGHT JOIN leftstock_data ON (leftstock_data.film_id = film_data.film_id) WHERE customer_id='$temp_customerid'";
$sql_filmdata="SELECT * FROM film_data RIGHT JOIN film_stocks_entry ON (film_stocks_entry.film_id = film_data.film_id) WHERE customer_id='$temp_customerid' group by film_data.film_name";
 	
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
		printf("<center>Det har ingen film registret.</center>");
		
  }

else{


?>

<!--<p class="auto-style5"><strong>Dine detaljer</strong></p>

	<form action="" method=post autocomplete="on" onsubmit="return checkForm(this);>-->	
	
	<form action="upload_file.php" method="post" autocomplete="on" enctype="multipart/form-data" style="height: 245px" name="uploadform" id="uploadform">


			<table style="width: 100%" class="tablesstyle">
				<tr>
	<?php
		/* change character set to utf8 */
		if (!$mysqli->set_charset("utf8")) {
		printf("Error loading character set utf8: %s\n", $mysqli->error);
		} else {
		// printf("Current character set: %s\n", $mysqli->character_set_name());
		}
		
		$sql_itemlist="SELECT item FROM globalstockslist";
 	if (!$mysqli->set_charset("utf8")) 
 	{
																		  
  printf("Error loading character set utf8: %s\n", $mysqli->error);
	} 
	else {
	   // printf("Current character set: %s\n", $mysqli->character_set_name());
	}

$rsitemlist=$mysqli ->query($sql_itemlist);


/*$sql_kinodata="SELECT kino FROM kino_detail";
 	if (!$mysqli->set_charset("utf8")) 
 	{
																		  
  printf("Error loading character set utf8: %s\n", $mysqli->error);
	} 
	else {
		   // printf("Current character set: %s\n", $mysqli->character_set_name());
	}

$rskinodata=$mysqli ->query($sql_kinodata);
if (!$mysqli->set_charset("utf8")) {
													printf("Error loading character set utf8: %s\n", $mysqli->error);
													} else {
													// printf("Current character set: %s\n", $mysqli->character_set_name());
													}

														    while ($rowkinodata = $rskinodata->fetch_assoc()) {
														     //   echo "<option value=\"{$rowkinodata ['kino']}\">";
														       $kinoname= $rowcustdata['kino'];
	
														   	    }*/
														    

	?>
			<tr class="theader-style">																
		
<th >Velg</th>
<th>Film_navn</th>
<th>Siste frist til lager</th>
<th>Melding til lager </th>

</tr>
		    <div align="left">
		      <?php
		while ($rowfilmdata = $rsfilmdata->fetch_assoc()) {
		
		echo "<tr>";																
		echo "<td  class=\"tdstyle\"><input type=\"checkbox\" name=\"film_id[]\" value=\"{$rowfilmdata ['film_id']}\"></td>";
		echo "<td class=\"tdstyle\">".$rowfilmdata['film_name']."</td>";
		echo "<td class=\"tdstyle\"><input type=\"date\" maxlength=\"20\" placeholder=\"
yyyy-mm-dd\" size=\"20\" name=\"sistedato\" id=\"sistedato\" onchange=\"checkFieldDato(this.value)\"></td>";

	
		
		echo "<td class=\"tdstyle\"><input type=\"text\" maxlength=\"500\" placeholder=\"
akseptere 500 tegn for sammensmelting\" size=\"200\" name=\"Melding\" id=\"Melding\" value=\"{$rowfilmdata ['Melding']}\"  onchange=\"checkField(this.value)\" ></td>";

	
		echo "</tr>";	
				?>
		      </div>

		<?php	
		
	
/*	
foreach ($itemsName as &$value) {
echo $value;
    echo "<td class=\"tdstyle\">".$rowfilmdata [$value]."</td>";

    }
    
		echo "<td class=\"tdstyle\">".$rowfilmdata ['Bannere']."</td>";
		echo "<td class=\"tdstyle\">".$rowfilmdata ['DCP']."</td>";
		echo "<td class=\"tdstyle\">".$rowfilmdata ['Erter']."</td>";
		echo "<td class=\"tdstyle\">".$rowfilmdata ['Plakat']."</td>";
		echo "<td class=\"tdstyle\">".utf8_encode($rowfilmdata ['Smastandeer'])."</td>";	
		echo "<td class=\"tdstyle\">".$rowfilmdata ['Storestandeer']."</td>";	
		*/
		echo "</tr>";	
		}
		?>
					
	
			</table>
<table class="tablesstyle">
	<tr class="theader-style">
		<td style="width: 4%" class="tdstyle">&nbsp; </td>
		<td style="width: 3%" class="tdstyle">Her kan du laste opp bestillingsskjema</td>
		<td style="width: 10%" class="tdstyle">
		<input name="uploadfile" type="file" style="width: 63%" id="uploadfile"></td>
	</tr>

	<tr>
		<td style="width: 4%">&nbsp; </td>
		<td style="width: 3%">&nbsp; </td>
		<td style="width: 10%">&nbsp;</td>
	</tr>

	<tr>
		<td style="width: 4%">&nbsp; </td>
		<td style="width: 3%"> </td>
		<td style="width: 10%"><input name="submit" type="submit" value="Registrer" >&nbsp;&nbsp;&nbsp;&nbsp;
		<input name="Reset" type="reset" value="Reset"></td>
	</tr>

</table>
<div id="valid_msg"></div>
<input type="hidden" maxlength="500" size="200" name="Hid_Dato" id="Hid_Dato">
<input type="hidden" maxlength="500" size="200" name="Hid_Melding" id="Hid_Melding">


</form>
<?php
}}
?>	
</body>
</html>