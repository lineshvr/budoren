<!DOCTYPE html>
<html>
 <?php header('Content-Type: charset=utf-8'); ?>
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
  <br /><br />


<?php
	include('dbcon.php');
$tempfilmid= $_GET['filmid'];
//$tempOrderdate= $_GET['Orderdate'];

$tempPlakat= $_GET['Plakat'];
$tempSmastandeer= $_GET['Smastandeer'];
$tempDCP= $_GET['DCP'];
$tempMelding= $_GET['Melding'];
$tempBannere= $_GET['Bannere'];
$tempStorestandeer= $_GET['Storestandeer'];
$tempRequest= $_GET['request'];
$tempOrderid= $_GET['orderid'];

$tempMellomstandeer= $_GET['Mellomstandeer'];
$tempTeaserplakat= $_GET['Teaserplakat'];
//$tempHovedplakat= $_GET['Hovedplakat'];

if($tempRequest=="oppdatere"){


$sql = "UPDATE orderdata SET Bannere=$tempBannere,Smastandeer=$tempSmastandeer,Plakat=$tempPlakat,Storestandeer=$tempStorestandeer,Mellomstandeer=$tempMellomstandeer,Teaserplakat=$tempTeaserplakat,DCP=$tempDCP,Melding='$tempMelding',update_status='true' WHERE film_id=$tempfilmid and order_id='$tempOrderid'"; 
//echo "sql".$sql;
if (!$mysqli->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
} else {
   // printf("Current character set: %s\n", $mysqli->character_set_name());
}


// Check connection
$result = $mysqli->query($sql);

if (!$result) {
   printf("%s\n", $mysqli->error);
   exit();
}else
{ 
?>
 <h3>Oppdatering er ferdig.</h3>
 

  <?php
}


}


else if($tempRequest=="levere"){

$sqlLeftEntry = "select * from leftstock_data where film_id='$tempfilmid'";
//echo "sqlLeftEntry ".$sqlLeftEntry ;

$rsLeftEntry=$mysqli ->query($sqlLeftEntry);

if($rsLeftEntry== false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else 
{
  $rows_returned = $rsLeftEntry->num_rows;
  if($rows_returned==0)
  {
	
		
$sqlItemsQty = "select * from film_stocks_entry where film_id='$tempfilmid'";
//echo "sqlItemsQty".$sqlItemsQty;
$rsItemsQnty=$mysqli ->query($sqlItemsQty);
$orignalQty_Bannere="";
$orignalQty_Smastandeer="";
$orignalQty_Plakat="";
$orignalQty_Storestandeer="";
$orignalQty_DCP="";
$orignalQty_Melding="";

$orignalQty_Mellomstandeer="";
$orignalQty_Teaserplakat="";

while ($rowsItemsQnty = $rsItemsQnty->fetch_assoc()) 
	{	
		$orignalQty_Bannere=$rowsItemsQnty ['Bannere'];
		$orignalQty_Smastandeer=$rowsItemsQnty ['Smastandeer'];
		$orignalQty_Plakat=$rowsItemsQnty ['Plakat'];
		$orignalQty_Storestandeer=$rowsItemsQnty ['Storestandeer'];
		$orignalQty_DCP=$rowsItemsQnty ['DCP'];
		$orignalQty_Melding=$rowsItemsQnty ['Melding'];
	
		$orignalQty_Mellomstandeer=$rowsItemsQnty ['Mellomstandeer'];
		$orignalQty_Teaserplakat=$rowsItemsQnty ['Teaserplakat'];
	
		
	}	

	if (!$rsItemsQnty) {
   printf("%s\n", $mysqli->error);
   exit();
}else
{ //  printf("levere");
}

//
$sqlItemsQty = "select * from orderdata where film_id='$tempfilmid'";
//echo "sqlItemsQty".$sqlItemsQty;
$rsItemsQnty=$mysqli ->query($sqlItemsQty);
$OrderQty_Bannere="";
$OrderQty_Smastandeer="";
$OrderQty_Plakat="";
$OrderQty_Storestandeer="";
$OrderQty_DCP="";
$OrderQty_Melding="";

$OrderQty_Mellomstandeer="";
$OrderQty_Teaserplakat="";

while ($rowsItemsQnty = $rsItemsQnty->fetch_assoc()) 
	{	
		$OrderQty_Bannere=$OrderQty_Bannere+$rowsItemsQnty ['Bannere'];
		$OrderQty_Smastandeer=$OrderQty_Smastandeer+$rowsItemsQnty ['Smastandeer'];
		$OrderQty_Plakat=$OrderQty_Plakat+$rowsItemsQnty ['Plakat'];
		$OrderQty_Storestandeer=$OrderQty_Storestandeer+$rowsItemsQnty ['Storestandeer'];
		$OrderQty_DCP=$OrderQty_DCP+$rowsItemsQnty ['DCP'];
		$OrderQty_Melding=$rowsItemsQnty ['Melding'];
		
		$OrderQty_Mellomstandeer=$OrderQty_Mellomstandeer+$rowsItemsQnty ['Mellomstandeer'];
		$OrderQty_Teaserplakat=$OrderQty_Teaserplakat+$rowsItemsQnty ['Teaserplakat'];
	
	}	

	if (!$rsItemsQnty) {
   printf("%s\n", $mysqli->error);
   exit();
}else
{ //  printf("levere");
}
//

$tempBannere= (int)$orignalQty_Bannere-(int)$OrderQty_Bannere;
$tempStorestandeer= (int)$orignalQty_Storestandeer-(int)$OrderQty_Storestandeer;
$tempPlakat= (int)$orignalQty_Plakat-(int)$OrderQty_Plakat;
$tempSmastandeer=(int) $orignalQty_Smastandeer-(int)$OrderQty_Smastandeer;
$tempDCP= (int)$orignalQty_DCP-(int)$OrderQty_DCP;
$tempMelding= $orignalQty_Melding;

$tempMellomstandeer= (int)$orignalQty_Mellomstandeer-(int)$OrderQty_Mellomstandeer;
$tempTeaserplakat= (int)$orignalQty_Teaserplakat-(int)$OrderQty_Teaserplakat;


/*
if (((int)$tempBannere<=0) || ((int)$tempGulvplakat<=0)  || ((int)$tempPlakat<=0)  || ((int)$tempStandeer<=0)  || ((int)$tempDCP<=0) )
{
echo("Noen problem med data");
exit;
}
 */
$sql = "INSERT INTO leftstock_data".
			       "(delivery_id,film_id,deliverydate,Bannere,Smastandeer,Plakat,Storestandeer,Mellomstandeer,Teaserplakat,DCP,Melding) ".
			       "VALUES ".
			       "('',$tempfilmid,now(),$tempBannere,$tempSmastandeer,$tempPlakat,$tempStorestandeer,$tempMellomstandeer,$tempTeaserplakat,$tempDCP,'$tempMelding')";
			       
//echo "sql".$sql;			       

if (!$mysqli->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
} else {
   // printf("Current character set: %s\n", $mysqli->character_set_name());
}
		
  }

else{

		
$sqlItemsQty = "select * from film_stocks_entry where film_id='$tempfilmid'";
//echo "sqlItemsQty".$sqlItemsQty;
$rsItemsQnty=$mysqli ->query($sqlItemsQty);
$orignalQty_Bannere="";
$orignalQty_Smastandeer="";
$orignalQty_Plakat="";
$orignalQty_Storestandeer="";
$orignalQty_DCP="";
$orignalQty_Melding="";

$orignalQty_Mellomstandeer="";
$orignalQty_Teaserplakat="";


while ($rowsItemsQnty = $rsItemsQnty->fetch_assoc()) 
	{	
		$orignalQty_Bannere=$rowsItemsQnty ['Bannere'];
		$orignalQty_Smastandeer=$rowsItemsQnty ['Smastandeer'];
		$orignalQty_Plakat=$rowsItemsQnty ['Plakat'];
		$orignalQty_Storestandeer=$rowsItemsQnty ['Storestandeer'];
		$orignalQty_DCP=$rowsItemsQnty ['DCP'];
		$orignalQty_Melding=$rowsItemsQnty ['Melding'];
	
		$orignalQty_Mellomstandeer=$rowsItemsQnty ['Mellomstandeer'];
		$orignalQty_Teaserplakat=$rowsItemsQnty ['Teaserplakat'];
		
		
	}	

	if (!$rsItemsQnty) {
   printf("%s\n", $mysqli->error);
   exit();
}else
{ //  printf("levere");
}

//
$sqlItemsQty = "select * from orderdata where film_id='$tempfilmid'";
//echo "sqlItemsQty".$sqlItemsQty;
$rsItemsQnty=$mysqli ->query($sqlItemsQty);
$OrderQty_Bannere="";
$OrderQty_Smastandeer="";
$OrderQty_Plakat="";
$OrderQty_Storestandeer="";
$OrderQty_DCP="";
$OrderQty_Melding="";


$OrderQty_Mellomstandeer="";
$OrderQty_Teaserplakat="";


while ($rowsItemsQnty = $rsItemsQnty->fetch_assoc()) 
	{	
		$OrderQty_Bannere=$OrderQty_Bannere+$rowsItemsQnty ['Bannere'];
		$OrderQty_Smastandeer=$OrderQty_Smastandeer+$rowsItemsQnty ['Smastandeer'];
		$OrderQty_Plakat=$OrderQty_Plakat+$rowsItemsQnty ['Plakat'];
		$OrderQty_Storestandeer=$OrderQty_Storestandeer+$rowsItemsQnty ['Storestandeer'];
		$OrderQty_DCP=$OrderQty_DCP+$rowsItemsQnty ['DCP'];
		$OrderQty_Melding=$rowsItemsQnty ['Melding'];
		
		$OrderQty_Mellomstandeer=$OrderQty_Mellomstandeer+$rowsItemsQnty ['Mellomstandeer'];
		$OrderQty_Teaserplakat=$OrderQty_Teaserplakat+$rowsItemsQnty ['Teaserplakat'];

		
	}	
//printf("%s\n", $OrderQty_Melding);
	if (!$rsItemsQnty) {
   printf("%s\n", $mysqli->error);
   exit();
}else
{ //  printf("levere");
}
//

$tempBannere= (int)$orignalQty_Bannere-(int)$OrderQty_Bannere;
$tempStorestandeer= (int)$orignalQty_Storestandeer-(int)$OrderQty_Storestandeer;
$tempPlakat= (int)$orignalQty_Plakat-(int)$OrderQty_Plakat;
$tempSmastandeer=(int) $orignalQty_Smastandeer-(int)$OrderQty_Smastandeer;
$tempDCP= (int)$orignalQty_DCP-(int)$OrderQty_DCP;
$tempMelding= $OrderQty_Melding;

$tempMellomstandeer= (int)$orignalQty_Mellomstandeer-(int)$OrderQty_Mellomstandeer;
$tempTeaserplakat= (int)$orignalQty_Teaserplakat-(int)$OrderQty_Teaserplakat;

		 
$sql = "update leftstock_data set deliverydate=now(),Bannere=$tempBannere,Smastandeer=$tempSmastandeer,Plakat=$tempPlakat,Storestandeer=$tempStorestandeer,Mellomstandeer=$tempMellomstandeer,Teaserplakat=$tempTeaserplakat,DCP=$tempDCP,Melding='$tempMelding' where film_id='$tempfilmid'";		
	    //   "('','$tempfilmid',now(),'$tempBannere','$tempGulvplakat',$tempPlakat,$tempStandeer,$tempDCP)";
//echo "sql".$sql;
}







// Check connection
$result = $mysqli->query($sql);

if (!$result) {
   printf("%s\n", $mysqli->error);
   exit();
}else
{  




$sqlDelUpStatus = "UPDATE orderdata SET delivery_status='true',deliverydate=now() WHERE film_id=$tempfilmid and order_id='$tempOrderid'";
//echo $sqlDelUpStatus;
$result = $mysqli->query($sqlDelUpStatus);
echo ("Levere Oppdatering er ferdig."); 
				session_regenerate_id();
//$_SESSION['sess_orderid'] = $tempOrderid;
//$_SESSION['sess_filmid'] =$tempfilmid;
			session_write_close();
	//				header('Location: shipmentupdate.php');

echo ("<a href=\"shipmentupdate.php?orderid=$tempOrderid&filmid=$tempfilmid\">Klikk her</a>");
 //printf("levere");
mysqli_close($mysqli);
}
}
}
?>



</body>
</html>