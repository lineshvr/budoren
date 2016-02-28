
    <?php
    //Start session
    session_start();

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
 		<meta charset="utf-8">
			<link href="styles/mystyle.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
			<script type="text/javascript" src="js/loginvalidation.js"></script>

			<script type="text/javascript" src="js/jquery-1.3.2.js"></script>
			    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
 <style type="text/css">
 .auto-style2 {
	 color: #fff;
	 text-align: right;
 }
 .auto-style4 {
	text-align: center;
}



 </style>
<script type="text/javascript">
function showHint() {


             var filmname= $("input[name='film_name']:text").val(); 
    
                $.ajax({ url: "filmdata.php",
                    type: 'post',
                    dataType: "html",
					success: function(response){                    
            $("#responsecontainer").html(response); 
            //alert(response);
        }
          
    
                });
                
                
                }
</script>
</head>
    <?php
		include('dbcon.php');?>

<body>

    <?php include('customermenu.html');?>
<h1 class="h1Style">Lagerstaus</h1>

<?php


$itemList=array();

$tmpCustomerid=$_SESSION['sess_customerid'];
		
$sql_ProductName ="SELECT * FROM globalstockslist";
$sql_orderdata ="SELECT * FROM film_data RIGHT JOIN leftstock_data ON (leftstock_data.film_id = film_data.film_id) where film_data.customer_id=$tmpCustomerid";


		
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
		/*	 echo("<th style=\"width: 4%\">".'Lager register dato'."</th>");
			$itemList[]='film_entrydate';
			echo("<th style=\"width: 4%\">".'Bestill Dato'."</th>");
			$itemList[]='Orderdate';
*/
	
	while ($rows = $rsProductName->fetch_assoc()) 
	{	
		echo("<th style=\"width: 2%\">".$rows['item']."</th>");
			$itemList[]=$rows['item'];
	}	
/*				echo("<th style=\"width: 2%\">".'Leveringsdato'."</th>");
			$itemList[]='deliverydate';
			echo("<th style=\"width: 2%\">".'Leverings status'."</th>");
			$itemList[]='delivery_status';
*/
//print_r($itemList);
	echo"</tr>";
	?>
	
	<?php
	$tempField="";
		$tempVariable="";
		$count=0;
		
		

	//	$row = $result->fetch_array(MYSQLI_BOTH);
//printf ("%s (%s)\n", $row[0], $row["CountryCode"]);
while($row =$rsOrderData->fetch_array(MYSQLI_BOTH)){  
			echo("<tr>");  
//echo '<td style=\"width: 5%\"> <a href="javascript:DisplayFormValues((\''.$count.'\'),(\''.$row[1].'\'));">update</ a> </ td>';
echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[1]</ td>";

/*echo "<td style=\"width: 6%\" class=\"tdstyle\">$row[2]</ td>";
echo "<td style=\"width: 6%\" class=\"tdstyle\">$row[10]</ td>";
*///echo "<td style=\"width: 2%\"><input  type=\"text\" value=\"$row[3]\" pattern=\"[0-9]*\" name=\"deliverydate$count'\" id=\"deliverydate$count\"></ td>";
/*echo "<td style=\"width: 2%\" class=\"auto-style4\"><input  type=\"text\" readonly value=\"$row[11]\" pattern=\"[0-9]*\" name=\"Bannere$count\" id=\"Bannere$count\"></ td>";
echo "<td style=\"width: 2%\" class=\"auto-style4\"><input  type=\"text\"  readonly  value=\"$row[12]\" pattern=\"[0-9]*\" name=\"Gulvplakat$count\" id=\"Gulvplakat$count\"></ td>";
echo "<td style=\"width: 2%\" class=\"auto-style4\"><input  type=\"text\"  readonly value=\"$row[13]\" pattern=\"[0-9]*\" id=\"Plakat$count\" name=\"Plakat$count\"></ td>";
echo "<td style=\"width: 2%\" class=\"auto-style4\"><input  type=\"text\" readonly value=\"$row[14]\" pattern=\"[0-9]*\" name=\"Standeer$count\" id=\"Standeer$count\"></ td>";
echo "<td style=\"width: 2%\" class=\"auto-style4\"><input  type=\"text\" readonly value=\"$row[15]\" pattern=\"[0-9]*\" name=\"DCP$count\" id=\"DCP$count\"></ td>";

*/

echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[12]</ td>";
echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[16]</ td>";
echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[17]</ td>";
echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[14]</ td>";
echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[13]</ td>";
echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[15]</ td>";
/*echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[17]</ td>";

if($row[19]=='true')
echo "<td style=\"width: 2%\" class=\"tdstyle\">Ferdig</ td>";
else
echo "<td style=\"width: 2%\" class=\"tdstyle\">Ikke Ferdig</ td>";
*/
echo '</ tr>';

$count++;
}    
 

	?>
	</table>		




<td style="width: 29%;" class="auto-style3"><div id="responsecontainer" align="center"></td>

</body>

</html>
