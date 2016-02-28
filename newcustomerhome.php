
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
<!DOCTYPE html>
<html>
 <head>
    
			<title>budoren</title>
			<script type="text/javascript" src="js/loginvalidation.js"></script>

		
			<style type="text/css">
			.auto-style2 {
			color: #fff;
			text-align: right;
			}
			.auto-style3 {
				text-align: right;
			}
			</style>

    </head>
      <?php
		include('dbcon.php');?>
    <body>
 
	
    

	
	
    <h1>Velkommen <?php echo $_SESSION["sess_customername"] ?></h1>
    
    Du må bytte passord nå.
    			<form action="customerupdate.php" method=post autocomplete="on" name="updatecustform" id="updatecustform" onsubmit="return changeCustomerPassword();">
<fieldset>
<table style="width: 100%">
	
	<tr>
		<td style="width: 4%; "> </td>
		<td style="width: 6%; " class="auto-style3"> E-post :</td>
	<td style="width: 10%; "><input id="emailid" name="emailid" size="45" maxlength="45"  type="email" value=""  required tabindex="7" /></td>
	</tr>

		<tr>
		<td style="width: 4%"> &nbsp;</td>
		<td style="width: 6%" class="auto-style3"> Gammel Passord :</td>
		<td style="width: 10%"><input id="oldpassword" name="oldpassword" size="20" maxlength="20"  type="password" value="" /></td>
	</tr>
			<tr>
		<td style="width: 4%"> &nbsp;</td>
		<td style="width: 6%" class="auto-style3"> Nytt Passord :</td>
			<td style="width: 10%"><input id="password1" name="password1" size="20" maxlength="20"  type="password" value=""  placeholder="Passord (minst 6 tegn)"/></td>
	</tr>

		<tr>
		<td style="width: 4%"> &nbsp;</td>
		<td style="width: 6%" class="auto-style3"> Bekreft Passord :</td>
			<td style="width: 10%"><input id="password2" name="password2" size="20" maxlength="20"  type="password" value=""  placeholder="Passord (minst 6 tegn)"/></td>
	</tr>

	<tr>
		<td style="width: 4%"> &nbsp;</td>
		<td style="width: 6%" class="auto-style2"> </td>
			<td style="width: 10%"><input name="submit" type="submit" value="Registrer">&nbsp;&nbsp;&nbsp;&nbsp;
		<input name="Reset" type="reset" value="Reset"></td>
	</tr>

</table>
</fieldset>
</form>


    
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
		printf("<center><a href=\"loginn.html\">klick har.</a></center>");
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