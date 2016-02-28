
    <?php
    //Start session
    session_start();

    if(!isset($_SESSION['sess_customername']) || (trim($_SESSION['sess_customerid']) == ''))
    		{		
				header("location: loginn.html");
				exit();
    		}
  
      	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>budoren</title>
 		<meta charset="utf-8">
			<link href="styles/mystyle.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
			<script type="text/javascript" src="js/loginvalidation.js"></script>
			 <style type="text/css">


 .auto-style2 {
	 color: #fff;
	 text-align: right;
 }
 .auto-style4 {
	text-align: center;
}

.hiddendiv {display:none;}
.visiblediv {display:block;}

 </style>

</head>
 

<body>




<?php


		include('dbcon.php');
$q= $_POST["q"];
$itemList=array();

$tmpCustomerid=$_SESSION['sess_customerid'];
$tmpCustomerName=$_SESSION['sess_customername'];
$sql_custID="SELECT customer_id,customer_name FROM budoren.customer_information where customer_name='$tmpCustomerName'";
$rscustomerInfo=$mysqli ->query($sql_custID);

while($row =$rscustomerInfo->fetch_array(MYSQLI_BOTH)){  
  $tmpCustomerid=$row[0];
  break;
 }
 
$sql_ProductName ="SELECT * FROM globalstockslist";
$sql_orderdata ="SELECT * FROM film_data RIGHT JOIN orderdata ON (orderdata.film_id = film_data.film_id) where film_data.customer_id=$tmpCustomerid and budoren.film_data.film_name like '$q%'";

		
//echo "$sql_orderdata ".$sql_orderdata;
		$rsProductName=$mysqli ->query($sql_ProductName);
		$rsOrderData=$mysqli ->query($sql_orderdata);
		 
		 if (!$mysqli->set_charset("utf8")) {
printf("Error loading character set utf8: %s\n", $mysqli->error);
} else {
//printf("Current character set: %s\n", $mysqli->character_set_name());
}

		?>
	<table style="width: 100%" class="tablesstyle">
				
		
	
	<?php
		echo"<tr class=\"theader-style\">";
		$itemList=array();

		     echo("<th style=\"width: 4%\">".'Film Navn'."</th>");
			$itemList[]='film_name';
			 echo("<th style=\"width: 4%\">".'Lager registering dato'."</th>");
			$itemList[]='film_entrydate';
			echo("<th style=\"width: 4%\">".'Bestilling Dato'."</th>");
			$itemList[]='Orderdate';
			echo("<th style=\"width: 2%\">".'Leveringsdato'."</th>");
			$itemList[]='deliverydate';
			echo("<th style=\"width: 2%\">".'Leverings status'."</th>");
			$itemList[]='delivery_status';
			echo("<th style=\"width: 2%\">".'Shipmentstatus'."</th>");
			$itemList[]='Shipmentinfo';



	echo"</tr>";
	?>
	
	<?php
		$tempField="";
		$tempVariable="";
		$count=0;

while($row =$rsOrderData->fetch_array(MYSQLI_BOTH)){  
			echo("<tr>");  
//echo '<td style=\"width: 5%\"> <a href="javascript:DisplayFormValues((\''.$count.'\'),(\''.$row[1].'\'));">update</ a> </ td>';
echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[1]</ td>";

echo "<td style=\"width: 6%\" class=\"tdstyle\">$row[2]</ td>";
echo "<td style=\"width: 6%\" class=\"tdstyle\">$row[10]</ td>";
//echo "<td style=\"width: 2%\"><input  type=\"text\" value=\"$row[3]\" pattern=\"[0-9]*\" name=\"deliverydate$count'\" id=\"deliverydate$count\"></ td>";
/*echo "<td style=\"width: 2%\" class=\"auto-style4\"><input  type=\"text\" readonly value=\"$row[11]\" pattern=\"[0-9]*\" name=\"Bannere$count\" id=\"Bannere$count\"></ td>";
echo "<td style=\"width: 2%\" class=\"auto-style4\"><input  type=\"text\"  readonly  value=\"$row[12]\" pattern=\"[0-9]*\" name=\"Gulvplakat$count\" id=\"Gulvplakat$count\"></ td>";
echo "<td style=\"width: 2%\" class=\"auto-style4\"><input  type=\"text\"  readonly value=\"$row[13]\" pattern=\"[0-9]*\" id=\"Plakat$count\" name=\"Plakat$count\"></ td>";
echo "<td style=\"width: 2%\" class=\"auto-style4\"><input  type=\"text\" readonly value=\"$row[14]\" pattern=\"[0-9]*\" name=\"Standeer$count\" id=\"Standeer$count\"></ td>";
echo "<td style=\"width: 2%\" class=\"auto-style4\"><input  type=\"text\" readonly value=\"$row[15]\" pattern=\"[0-9]*\" name=\"DCP$count\" id=\"DCP$count\"></ td>";



echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[11]</ td>";
echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[15]</ td>";*/
echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[17]</ td>";
if($row[19]=='true')
echo "<td style=\"width: 2%\" class=\"tdstyle\">Ferdig</ td>";
else
echo "<td style=\"width: 2%\" class=\"tdstyle\">Ikke Ferdig</ td>";
echo "<td style=\"width: 2%\" class=\"tdstyle\"><a href=\"shipmenthistory.php?path=$row[20]&orderid=$row[8]\">KlickHer</a></ td>";

echo '</ tr>';

$count++;
}    
 

	?>
	</table>		


</body>

</html>
