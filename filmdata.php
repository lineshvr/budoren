
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

<body >

	<table style="width: 100%" class="tablesstyle" >
<?php
// Fill up array with names

	include('dbcon.php');

// get the q parameter from URL
$q= $_POST["q"];
 $hint="";
 $tmpCustomerid=$_SESSION['sess_customerid'];

$sql_ProductName ="SELECT * FROM globalstockslist";
$rsProductName=$mysqli ->query($sql_ProductName);
//$sql_custinfo = "SELECT * FROM film_data RIGHT JOIN budoren.film_stocks_entry ON (budoren.film_stocks_entry.film_id = film_data.film_id) where budoren.film_data.film_name like '$q%'";
$sql_orderdata ="
SELECT *
FROM `film_stocks_entry`
left join `leftstock_data` on film_stocks_entry.film_id = leftstock_data.film_id
union
SELECT *
FROM `film_stocks_entry`
right join `leftstock_data` on film_stocks_entry.film_id = leftstock_data.film_id ";


	echo"<tr class=\"trsstyle\">";
		$itemList=array();

		     echo("<th class=\"theader-style\" style=\"width: 4%\">".'Film Navn'."</th>");
			$itemList[]='film_name';

	
	while ($rows = $rsProductName->fetch_assoc()) 
	{	
		//echo("<th class=\"theader-style\" style=\"width: 2%\">".$rows['item']."</th>");
			//$itemList[]=$rows['item'];
			
				if(($rows['item']=="Smastandeer")||($rows['item']=="Melding")||($rows['item']=="Plakat")){
			//echo("<th style=\"width: 2%\">".Småstandeer."</th>");
				if($rows['item']=="Melding")
				echo("<th class=\"theader-style\" style=\"width: 2%\">"."Filmeffekter/annet"."</th>");
				if($rows['item']=="Smastandeer")
				echo("<th  class=\"theader-style\" style=\"width: 2%\">"."Småstandeer"."</th>");	
				if($rows['item']=="Plakat")
				echo("<th class=\"theader-style\" style=\"width: 2%\">"."Hovedplakat"."</th>");		
			}
		else{	
		echo("<th class=\"theader-style\" style=\"width: 2%\">".$rows['item']."</th>");
			$itemList[]=$rows['item'];
			}
	}	
/*				echo("<th style=\"width: 2%\">".'Leveringsdato'."</th>");
			$itemList[]='deliverydate';
			echo("<th style=\"width: 2%\">".'Leverings status'."</th>");
			$itemList[]='delivery_status';
*/
//print_r($itemList);
echo("<tr>");
	?>
	
	<?php
	
			//	$row = $result->fetch_array(MYSQLI_BOTH);
//printf ("%s (%s)\n", $row[0], $row["CountryCode"]);

	$tempField="";
	$tempVariable="";
	$count=0;
				

$rsOrderData=$mysqli ->query($sql_orderdata);
while($row =$rsOrderData->fetch_array(MYSQLI_BOTH)){  

$sql_FilmInfo ="SELECT film_id,film_name,customer_id FROM film_data where film_id=$row[1] and customer_id=$tmpCustomerid and budoren.film_data.film_name like '$q%'";
$rsFilmCustDetail=$mysqli ->query($sql_FilmInfo);
while ($rowsData = $rsFilmCustDetail->fetch_assoc()) 
	{	
		$film_name=$rowsData['film_name'];
		$film_id=$rowsData['film_id'];
		$customer_id=$rowsData['customer_id'];
		
}
  
//echo '<td style=\"width: 5%\"> <a href="javascript:DisplayFormValues((\''.$count.'\'),(\''.$row[1].'\'));">update</ a> </ td>';
	//echo"<tr class=\"trsstyle\">";

if($film_name!=""){
	echo("<tr>");  
echo "<td style=\"width: 2%\" class=\"tdstyle\">$film_name</ td>";

//Bannere
if($row[13]!="")
	{
	if($row[5]>$row[17])
		echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[17]</ td>";
		else
		echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[5]</ td>";
	}
else
echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[5]</ td>";

//DCP

if($row[13]!="")
{
	if($row[8]>$row[21])
		echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[21]</ td>";
		else
		echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[8]</ td>";
}
else
echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[8]</ td>";

//Hovedplakat
/*
if($row[13]!=""){
	if($row[13]>$row[26])
		echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[25]</ td>";
		else
		echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[13]</ td>";
}
else
echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[13]</ td>";
*/

//Melding

if($row[13]!="")
{
	if($row[10]!="" || $row[10]=="0")
	echo "<td style=\"width: 2%\" class=\"tdstyle\">		<input id=\"Melding$count\" type=\"text\" value=\"$row[22]\" /></ td>";
	//	echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[20]</ td>";
		else
		echo "<td style=\"width: 2%\" class=\"tdstyle\" >		<input id=\"Melding$count\" type=\"text\" value=\"$row[22]\" /></ td>";
		//echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[10]</ td>";
}
else
//echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[10]</ td>";
echo "<td style=\"width: 2%\" class=\"tdstyle\">		<input id=\"Melding$count\" type=\"text\" value=\"$row[10]\" /></ td>";


//mellomstandeer
if($row[13]!=""){
	if($row[11]>$row[23])
		echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[23]</ td>";
		else
		echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[11]</ td>";
}
else
echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[11]</ td>";


//plakat
if($row[13]!=""){
	if($row[6]>$row[19])
		echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[19]</ td>";
		else
		echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[6]</ td>";
}
else
echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[6]</ td>";


//smastandeer
if($row[13]!=""){
	if($row[7]>$row[18])
	echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[18]</ td>";
	else
	echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[7]</ td>";
}
else
echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[7]</ td>";


//storestandeer
if($row[13]!=""){
	if($row[9]>$row[20])
		echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[20]</ td>";
		else
		echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[9]</ td>";
}
else
echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[9]</ td>";




//Teaserplakat
if($row[13]!=""){
	if($row[12]>$row[24])
		echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[24]</ td>";
		else
		echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[12]</ td>";
}
else
echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[12]</ td>";




echo '</ tr>';

$count++;
}
	
$film_name="";						
		}


		

	?>
	</table>		


</body>

</html>
