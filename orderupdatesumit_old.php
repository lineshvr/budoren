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
  <br /><br />
 <h1>Order Updation form</h1>

<?php
	include('dbcon.php');
$tempfilmid= $_GET['filmid'];
//$tempOrderdate= $_GET['Orderdate'];

$tempPlakat= $_GET['Plakat'];
$tempGulvplakat= $_GET['Gulvplakat'];
$tempDCP= $_GET['DCP'];

$tempBannere= $_GET['Bannere'];
$tempStandeer= $_GET['Standeer'];
$tempRequest= $_GET['request'];
$tempOrderid= $_GET['orderid'];

if($tempRequest=="oppdatere"){


$sql = "UPDATE orderdata SET Bannere='$tempBannere',Gulvplakat='$tempGulvplakat',Plakat='$tempPlakat',Standeer='$tempStandeer',DCP='$tempDCP',update_status='true' WHERE film_id=$tempfilmid and order_id='$tempOrderid'"; 
echo "sql".$sql;
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
 printf("Oppdatere ");
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
$orignalQty_Gulvplakat="";
$orignalQty_Plakat="";
$orignalQty_Standeer="";
$orignalQty_DCP="";

while ($rowsItemsQnty = $rsItemsQnty->fetch_assoc()) 
	{	
		$orignalQty_Bannere=$rowsItemsQnty ['Bannere'];
		$orignalQty_Gulvplakat=$rowsItemsQnty ['Gulvplakat'];
		$orignalQty_Plakat=$rowsItemsQnty ['Plakat'];
		$orignalQty_Standeer=$rowsItemsQnty ['Standeer'];
		$orignalQty_DCP=$rowsItemsQnty ['DCP'];
	}	

	if (!$rsItemsQnty) {
   printf("%s\n", $mysqli->error);
   exit();
}else
{ //  printf("levere");
}



$tempBannere= (int)$orignalQty_Bannere-(int)$tempBannere;

$tempGulvplakat= (int)$orignalQty_Gulvplakat-(int)$tempGulvplakat;


$tempPlakat= (int)$orignalQty_Plakat-(int)$tempPlakat;


$tempStandeer=(int) $orignalQty_Standeer-(int)$tempStandeer;
$tempDCP= (int)$orignalQty_DCP-(int)$tempDCP;


/*
if (((int)$tempBannere<=0) || ((int)$tempGulvplakat<=0)  || ((int)$tempPlakat<=0)  || ((int)$tempStandeer<=0)  || ((int)$tempDCP<=0) )
{
echo("Noen problem med data");
exit;
}
 */
$sql = "INSERT INTO leftstock_data".
			       "(delivery_id,film_id,deliverydate,Bannere,Gulvplakat,Plakat,Standeer,DCP) ".
			       "VALUES ".
			       "('','$tempfilmid',now(),'$tempBannere','$tempGulvplakat',$tempPlakat,$tempStandeer,$tempDCP)";
			       
//echo "sql".$sql;			       

if (!$mysqli->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
} else {
   // printf("Current character set: %s\n", $mysqli->character_set_name());
}
		
  }

else{

		
$sqlItemsQty = "select * from leftstock_data where film_id='$tempfilmid'";
//echo "sqlItemsQty".$sqlItemsQty;
$rsItemsQnty=$mysqli ->query($sqlItemsQty);
$orignalQty_Bannere="";
$orignalQty_Gulvplakat="";
$orignalQty_Plakat="";
$orignalQty_Standeer="";
$orignalQty_DCP="";

while ($rowsItemsQnty = $rsItemsQnty->fetch_assoc()) 
	{	
		$orignalQty_Bannere=$rowsItemsQnty ['Bannere'];
		$orignalQty_Gulvplakat=$rowsItemsQnty ['Gulvplakat'];
		$orignalQty_Plakat=$rowsItemsQnty ['Plakat'];
		$orignalQty_Standeer=$rowsItemsQnty ['Standeer'];
		$orignalQty_DCP=$rowsItemsQnty ['DCP'];
	}	

	if (!$rsItemsQnty) {
   printf("%s\n", $mysqli->error);
   exit();
}else
{ //  printf("levere");
}



$tempBannere= (int)$orignalQty_Bannere-(int)$tempBannere;

$tempGulvplakat= (int)$orignalQty_Gulvplakat-(int)$tempGulvplakat;


$tempPlakat= (int)$orignalQty_Plakat-(int)$tempPlakat;


$tempStandeer=(int) $orignalQty_Standeer-(int)$tempStandeer;
$tempDCP= (int)$orignalQty_DCP-(int)$tempDCP;

		 
$sql = "update leftstock_data set deliverydate=now(),Bannere='$tempBannere',Gulvplakat='$tempGulvplakat',Plakat='$tempPlakat',Standeer='$tempStandeer',DCP='$tempDCP' where film_id='$tempfilmid'";			       "('','$tempfilmid',now(),'$tempBannere','$tempGulvplakat',$tempPlakat,$tempStandeer,$tempDCP)";
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
//echo $result;

 //printf("levere");
mysqli_close($mysqli);
}
}
}
?>



</body>
</html>