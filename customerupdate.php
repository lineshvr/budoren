<!DOCTYPE html>
<html>

 <head>
    
			<title>budoren</title>
			<script type="text/javascript" src="js/loginvalidation.js"></script>

		
			<style type="text/css">
			.auto-style4 {
				text-align: center;
			}
			</style>

    </head>
      <?php
		include('dbcon.php');?>
    <body>
 
	

	<div class="auto-style4">
 
	

<?php
if(isset($_POST['submit'])){
// Create temporary variables
 
   $tmp_customeremailaddress= $_POST['emailid'];   
   $tmp_password= $_POST['oldpassword'];   
   $tmp_newpassword= $_POST['password1'];   
  $sql="select * from customer_information where customer_emailid='$tmp_customeremailaddress' and customer_password='$tmp_password'";

  $rs=$mysqli ->query($sql); 


if($rs === false)
 {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else 
{
  $rows_returned = $rs->num_rows;
  if($rows_returned==0){
		printf("<br>");
		printf("<br>");
		printf("<br>");
		printf("<br>");
		printf("<br>");
		printf("<center>Vi finner ikke denne kombinasjonen av e-postadresse og Passord. Sjekk at du har skrevet riktig.</center>");
		printf("<center><a href=\"newcustomerhome.php\">klick har.</a></center>");
  }
  else
  {
		  
		  $rs->data_seek(0);
		while($row = $rs->fetch_assoc())
		{
		$sql = "UPDATE customer_information SET customer_password='$tmp_newpassword',newcustomer='false' WHERE customer_emailid='$tmp_customeremailaddress'"; 
			if (!$mysqli->set_charset("utf8")) 
			{
		    printf("Error loading character set utf8: %s\n", $mysqli->error);
			} 
			else
			{
		   // printf("Current character set: %s\n", $mysqli->character_set_name());
			}
		
		}
		// Check connection
		$result = $mysqli->query($sql);
		
		if (!$result)
		 {
		   printf("%s\n", $mysqli->error);
		   exit();
		}
		else
		{ 
		 
		
		echo 'Oppdatere har. Du kan logg inn nå   '.'http://budoren.no/loginn.html';
		}


  }
  }
  
}
if(isset($_POST['recoverypassword'])){
// Create temporary variables
 
   $tmp_customeremailaddress= $_POST['emailid'];   
   $tmp_newpassword= $_POST['password1'];   
  $sql="select * from customer_information where customer_emailid='$tmp_customeremailaddress'";

  $rs=$mysqli ->query($sql); 


if($rs === false)
 {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else 
{
  $rows_returned = $rs->num_rows;
  if($rows_returned==0){
		printf("<br>");
		printf("<br>");
		printf("<br>");
		printf("<br>");
		printf("<br>");
		printf("<center>Vi finner ikke denne kombinasjonen av e-postadresse og passord. Sjekk at du har skrevet riktig.</center>");
		printf("<center><a href=\"newcustomerhome.php\">klick har.</a></center>");
  }
  else
  {
		  
		  $rs->data_seek(0);
		while($row = $rs->fetch_assoc())
		{
		$sql = "UPDATE customer_information SET customer_password='$tmp_newpassword' WHERE customer_emailid='$tmp_customeremailaddress'"; 
			if (!$mysqli->set_charset("utf8")) 
			{
		    printf("Error loading character set utf8: %s\n", $mysqli->error);
			} 
			else
			{
		   // printf("Current character set: %s\n", $mysqli->character_set_name());
			}
		
		}
		// Check connection
		$result = $mysqli->query($sql);
		
		if (!$result)
		 {
		   printf("%s\n", $mysqli->error);
		   exit();
		}
		else
		{ ?> 
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br>Oppdatere har. Du kan logg inn nå.<a href="loginn.html">Klick her</a>
			<?php
		}


  }
  }
  
}








  
  
?> 



	</div>



</body>
</html>