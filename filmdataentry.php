<!DOCTYPE html>
<html>
 <?php
    //Start session
    session_start();
    //Check whether the session variable sess_username is present or not
    if($_SESSION['sess_admmin'])
    {
      if(!isset($_SESSION['sess_admfirstname']) || (!isset($_SESSION['sess_admlastname'])))
    		{		
				header("location: loginn.html");
				exit();
    		}

    
    }
    else{
    if(!isset($_SESSION['sess_firstname']) || (!isset($_SESSION['sess_lastname'])))
    		{
				header("location: loginn.html");
				exit();
    		}
    }		
      	?>

<head>
    <?php
		include('dbcon.php');?>

 <title>budoren</title>
			<meta charset="utf-8">
			<script type="text/javascript" src="js/loginvalidation.js"></script>


 <style type="text/css">
.auto-style1 {
	color: #FFFFFF;
	background-color: #66AFE9;
}
</style>
</head>
<body>
       <?php include('usermenu.html');?>

<?php

if(isset($_POST['submit'])){
// Create temporary variables
   $tmp_filmname= $_POST['filmname'];
   $tmp_filmlanguage= $_POST['film_language'];
   $tmp_filmabout= $_POST['film_about'];
   $tmp_customerid =$_POST['customer_name'];
   $tmp_hylleid =$_POST['Hyllenummer'];
   $tmp_dcphylleid =$_POST['DCPHyllenummer']; 
   $tmp_releasedato =$_POST['Filmreleasedato'];     
   
   $temp_filmid="";
//echo($tmp_customerid);


$tmp_prd=array();
$tmp_qty=array();
			foreach ($_POST['product'] as $key => $value) {
			//echo $value . "<br />";
			$tmp_prd[]=$value;
			
			}

			foreach ($_POST['quantity'] as $key => $value) {
			  //  echo $value . "<br />";
			  $tmp_qty[]=$value;
			}

//$mysqli = new mysqli("budoren.mysql.domeneshop.no","budoren","Viqvt3vA","budoren");

if (mysqli_connect_errno()) {
   printf("Connect failed: %s\n", mysqli_connect_error());
   exit();
}

/* change character set to utf8 */

if (!$mysqli->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
} else {
  // printf("Current character set: %s\n", $mysqli->character_set_name());
}

$sqlFilmID="SELECT film_id FROM budoren.film_data where film_name='$tmp_filmname'";
//echo "sqlFilmID".$sqlFilmID."<br />";
// Check connection
$rsFilmID = $mysqli->query($sqlFilmID);

    
    if (!$rsFilmID) {
   printf("%s\n", $mysqli->error);
   exit();
}

while($rowFilmID= $rsFilmID->fetch_assoc()){
		
//printf("%s", $rowFilmID['film_id']);
		
		$temp_filmid= $rowFilmID['film_id'];
		
}

    
    
    
    


//$tmp_postItems = $_POST['data '];


  // printf("%s vakue\n", $temp_filmid);
// Create sql
if($temp_filmid=="")
{
			$sql = "INSERT INTO film_data ".
			       "(film_id,film_name,film_language,film_about,customer_id,film_entrydate,hylleid,dcphylleid) ".
			       "VALUES ".
			       "('','$tmp_filmname','$tmp_filmlanguage','$tmp_filmabout',$tmp_customerid,now(),'$tmp_hylleid','$tmp_dcphylleid')";
			
			if (mysqli_connect_errno()) {
			   printf("Connect failed: %s\n", mysqli_connect_error());
			   exit();
			}
			
			/* change character set to utf8 */
			if (!$mysqli->set_charset("utf8")) {
			    printf("Error loading character set utf8: %s\n", $mysqli->error);
			} 
			else {
			  //  printf("Current character set: %s\n", $mysqli->character_set_name());
			}
			
			
			// Check connection
			$result = $mysqli->query($sql);
			$last_record_filmid=mysqli_insert_id($mysqli);
		//	printf("Filmid  %s\n",$last_record_filmid);
			$temp_filmid=$last_record_filmid;
			 $sqlchild  = "INSERT INTO film_stocks_entry";

//printf("%s\n",$temp_filmid);
   // implode keys of $array...
   $sqlchild .= " (film_stocks_id,film_id,stockentrydate,".implode(", ", array_values($tmp_prd)).")";

   // implode values of $array...
   $sqlchild .= " VALUES ('',$temp_filmid,now(),'".implode("', '", $tmp_qty)."') ";
  //echo ($sqlchild);
     

$resultsqlchild  = $mysqli->query($sqlchild );
$last_record_filmstocksid=mysqli_insert_id($mysqli);


	$sqlfilmother = "INSERT INTO film_otherinfo".
			       "(film_id,film_release_date) ".
			       "VALUES ".
			       "($last_record_filmid,'$tmp_releasedato')";
				//echo ($sqlfilmother);
	$resultsotherinfo  = $mysqli->query($sqlfilmother );
//echo ($resultsotherinfo);	
}
else{
 $sqlstockid  = "select * from film_stocks_entry where film_id=$temp_filmid";
 $sqlleftstockid  = "select * from leftstock_data where film_id=$temp_filmid";
 $resultsqlstockid  = $mysqli->query($sqlstockid );
  $resultsqlleftstockid  = $mysqli->query($sqlleftstockid );
//echo ("<br />".$tmp_qty[0]." bannere".$tmp_qty[1]."  dcp".$tmp_qty[2]." Melding".$tmp_qty[3]." Plakat".$tmp_qty[4]."  Smastandeer");
//echo ("<br />".$tmp_qty[5]." Storestandeer".$tmp_qty[6]."  mellomplakat".$tmp_qty[7]."  teaserplakat"."<br />");	
while($rowstockdata= $resultsqlleftstockid->fetch_assoc()){
$tempBannere= (int)$rowstockdata['Bannere']+ (int)$tmp_qty[0];
$tempDCP= (int)$rowstockdata['DCP']+ (int)$tmp_qty[1];
$tempMelding=$tmp_qty[2];
$tempPlakat= (int)$rowstockdata['Plakat']+ (int)$tmp_qty[4];
$tempSmastandeer= (int)$rowstockdata['Smastandeer']+ (int)$tmp_qty[5];
$tempStorestandeer= (int)$rowstockdata['Storestandeer']+ (int)$tmp_qty[6];

$tempMellomstandeer= (int)$rowstockdata['Mellomstandeer']+ (int)$tmp_qty[3];
$tempTeaserplakat= (int)$rowstockdata['Teaserplakat']+ (int)$tmp_qty[7];
//$tempHovedplakat=$rowstockdata['Hovedplakat']+$tmp_qty[8];

}

while($rowstockperdata= $resultsqlstockid->fetch_assoc()){
$tempStckBannere= (int)$rowstockperdata['Bannere']+ (int)$tmp_qty[0];
$tempStckDCP= (int)$rowstockperdata['DCP']+ (int)$tmp_qty[1];
$tempStckMelding=$tmp_qty[2];
$tempStckPlakat= (int)$rowstockperdata['Plakat']+ (int)$tmp_qty[4];
$tempStckSmastandeer= (int)$rowstockperdata['Smastandeer']+ (int)$tmp_qty[5];
$tempStckStorestandeer= (int)$rowstockperdata['Storestandeer']+ (int)$tmp_qty[6];

$tempStckMellomstandeer= (int)$rowstockperdata['Mellomstandeer']+ (int)$tmp_qty[3];
$tempStckTeaserplakat= (int)$rowstockperdata['Teaserplakat']+ (int)$tmp_qty[7];
//$tempHovedplakat=$rowstockdata['Hovedplakat']+$tmp_qty[8];

}

//echo ("<br />".$tempBannere." bannere".$tempDCP."dcp".$tempMelding."Melding".$tempPlakat."Plakat".$tempSmastandeer."Smastandeer");
//echo ("<br />".$tempStorestandeer." Storestandeer".$tempMellomstandeer."mellomplakat".$tempTeaserplakat."teaserplakat");	
  if($tmp_qty[2]!=""){
  $sql = "UPDATE film_stocks_entry SET Bannere=$tempStckBannere,Smastandeer=$tempStckSmastandeer,Plakat=$tempStckPlakat,Storestandeer=$tempStckStorestandeer,Mellomstandeer=$tempStckMellomstandeer,Teaserplakat=$tempStckTeaserplakat,DCP=$tempStckDCP,Melding='$tempStckMelding' WHERE film_id=$temp_filmid"; 
 $sqlleft = "UPDATE leftstock_data SET Bannere=$tempBannere,Smastandeer=$tempSmastandeer,Plakat=$tempPlakat,Storestandeer=$tempStorestandeer,Mellomstandeer=$tempMellomstandeer,Teaserplakat=$tempTeaserplakat,DCP=$tempDCP,Melding='$tempMelding' WHERE film_id=$temp_filmid"; 
}
else
{
  $sql = "UPDATE film_stocks_entry SET Bannere=$tempStckBannere,Smastandeer=$tempStckSmastandeer,Plakat=$tempStckPlakat,Storestandeer=$tempStckStorestandeer,Mellomstandeer=$tempStckMellomstandeer,Teaserplakat=$tempStckTeaserplakat,DCP=$tempStckDCP WHERE film_id=$temp_filmid"; 
 $sqlleft = "UPDATE leftstock_data SET Bannere=$tempBannere,Smastandeer=$tempSmastandeer,Plakat=$tempPlakat,Storestandeer=$tempStorestandeer,Mellomstandeer=$tempMellomstandeer,Teaserplakat=$tempTeaserplakat,DCP=$tempDCP WHERE film_id=$temp_filmid"; 
}




  //echo "sql".$sql."<br />";
 //   echo "sqlleft".$sqlleft."<br />";
if (!$mysqli->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
} else {
   // printf("Current character set: %s\n", $mysqli->character_set_name());
}


// Check connection
$result = $mysqli->query($sql);
$resultstock = $mysqli->query($sqlleft);

$last_record_filmstocksid=mysqli_insert_id($mysqli);
if (!$result) {
   printf("%s\n", $mysqli->error);
   exit();
}


}
if(isset($_POST['emailnotify']))
 {
if($last_record_filmstocksid=="")
$sqlmail="select customer_emailid from customer_information where customer_id =(select customer_id from film_data where film_id=$temp_filmid);";
else
$sqlmail="select customer_emailid from customer_information where customer_id =(select customer_id from film_data where film_id=(SELECT film_id FROM budoren.film_stocks_entry where film_stocks_id='$last_record_filmstocksid'));";

$resultsqlmail  = $mysqli->query($sqlmail);

$emailadd="";
$cntr=1;
while($rowcustdata= $resultsqlmail->fetch_assoc()){
		$emailadd= $rowcustdata['customer_emailid'];

}

$to  =$emailadd;
//$to  ="linesh.vr@gmail.com";

$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
// subject
$subject = 'New Product from OsloBudOReN.';

// message
$message = '<html><body>';
//$message .= '<img src="http://css-tricks.com/examples/WebsiteChangeRequestForm/images/wcrf-header.png" alt="Website Change Request" />';
$message .='<br /><h3>New Release </h3><br />';

$message .= '<table rules="all" style="border-color: #407BF6;background: #eee;" cellpadding="10">';
$message .= "<tr ><td><strong>Film navn:</strong> </td><td>" . strip_tags($_POST['filmname']) . "</td></tr>";
//$message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['filmname']) . "</td></tr>";
$message .= "<tr><td><strong>Språk:</strong> </td><td>" . strip_tags($_POST['film_language']) . "</td></tr>";
$message .= "<tr><td><strong>Litt info av film:</strong> </td><td>" . strip_tags($_POST['film_about']) . "</td></tr>";
$message .= "</table>";
//$message .= "<tr><td><strong>URL To Change (main):</strong> </td><td>" . $_POST['customer_name'] . "</td></tr>";
//$addURLS = $_POST['addURLS'];
$length = count($tmp_prd);
if($last_record_filmstocksid==""){
 $message .='<h3>Product detail and quantity</h3>';
$message .='<br /><br />';
$message .= '<table rules="all" style="border-color: #407BF6;background: #E6E6E6;" cellpadding="10">';

$message .= "<tr><td><strong>Product</strong> </td><td><strong>Quantity</strong> </td></tr>";

for ($i = 0; $i < $length; $i++) {
if(strip_tags($tmp_prd[$i])=="Melding"){
 $message .= "<tr><td>Filmeffekter/annet</td>";
$message .= "<td>" . strip_tags($tmp_qty[$i]) . "</td></tr>";
}
else
{
 $message .= "<tr><td>" . strip_tags($tmp_prd[$i]) . "</td>";
$message .= "<td>" . strip_tags($tmp_qty[$i]) . "</td></tr>";
}
}
}
else
{
$message .='<h3>Product detail and quantity</h3>';
$message .='<br /><br />';
$message .= '<table rules="all" style="border-color: #407BF6;background: #E6E6E6;" cellpadding="10">';

$message .= "<tr><td><strong>Product</strong> </td><td><strong>Quantity</strong> </td></tr>";
for ($i = 0; $i < $length; $i++) {
if(strip_tags($tmp_prd[$i])=="Melding"){
 $message .= "<tr><td>Filmeffekter/annet </td>";
$message .= "<td>" . strip_tags($tmp_qty[$i]) . "</td></tr>";
}
else
{
 $message .= "<tr><td>" . strip_tags($tmp_prd[$i]) . "</td>";
$message .= "<td>" . strip_tags($tmp_qty[$i]) . "</td></tr>";
}
}
}
$message .= "</table>"; 
$message .= "</body></html>";

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
//$headers .= 'To: Mary <divchandran@gmail.com>, Kelly <linesh.vr@gmail.com>' . "\r\n";
//$headers .= 'To: <linesh.vr@gmail.com>' . "\r\n";

$headers .= 'From: OsloBudoren <post@budoren.no>' . "\r\n";

// Mail it

$retval=mail($to, $subject, $message, $headers);

if( $retval == true )
   {
      echo "<br><br><br><br><br><br><br>Produktet har registrert og sende e-post varsle til kunde...";
   }
   else
   {
      echo "<br><br><br><br><br>Message could not be sent...";
   }

}
else{
 echo "<br><br><br><br><br><br>Produktet har registrert ...";


}
?>
<?php
$mysqli->close();
}

?>

</body>
</html>