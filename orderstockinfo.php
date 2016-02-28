
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

.hiddendiv {display:none;}
.visiblediv {display:block;}

 </style>
<script type="text/javascript">
function refreshscreen(){
   location.reload(); 
}
function hidetable(){
 if( document.getElementById("tablecontainer").style.display=='none' ){
   document.getElementById("tablecontainer").style.display = '';
 }else{
   document.getElementById("tablecontainer").style.display = 'none';
 }
}
function showHint() {
     $('#tablecontainer').html("");
             var filmname= $("input[name='film_name']:text").val(); 
		
    
                $.ajax({ url: "filmdata.php",
				    data: {"q":filmname},
                    type: 'post',
                    dataType: "html",
					success: function(response){                    
            $("#responsecontainer").html(response); 
            //alert(response);
        }
          
    
                });
                
               
//			   else 
	//		   location.reload(); 
                }
</script>
</head>
    <?php
		include('dbcon.php');?>

<body>

    <?php include('customermenu.html');?>
<h1 class="h1Style">Lagerstaus</h1>

<?php
$film_id="";
$tmpCustomerid=$_SESSION['sess_customerid'];
$itemList=array();



$sql_ProductName ="SELECT * FROM globalstockslist";
$sql_FilmInfo ="SELECT film_id,film_name,customer_id FROM film_data where customer_id=$tmpCustomerid";
$sql_orderdata ="
SELECT *
FROM `film_stocks_entry`
left join `leftstock_data` on film_stocks_entry.film_id = leftstock_data.film_id
union
SELECT *
FROM `film_stocks_entry`
left join `leftstock_data` on film_stocks_entry.film_id = leftstock_data.film_id ";


		
//echo "$sql_orderdata ".$sql_orderdata;

		
		$rsProductName=$mysqli ->query($sql_ProductName);
		$rsOrderData=$mysqli ->query($sql_orderdata);
		 
		 if (!$mysqli->set_charset("utf8")) {
printf("Error loading character set utf8: %s\n", $mysqli->error);
} else {
//printf("Current character set: %s\n", $mysqli->character_set_name());
}

		?>
		<form method="post">
			<div class="auto-style4">
		<input type="text" name="film_name" id="film_name" onkeydown="showHint()"  onchange="hidetable()" style="width: 332px" placeholder="Film Navn.."></input> 

	<table style="width: 100%" class="tablesstyle" id="tablecontainer">
				

	
	<?php
	echo"<tr class=\"trsstyle\">";
			$itemList=array();

		     echo("<th class=\"theader-style\" style=\"width: 4%\">".'Film Navn'."</th>");
			$itemList[]='film_name';
		/*	 echo("<th style=\"width: 4%\">".'Lager register dato'."</th>");
			$itemList[]='film_entrydate';
			echo("<th style=\"width: 4%\">".'Bestill Dato'."</th>");
			$itemList[]='Orderdate';
*/
	
	while ($rows = $rsProductName->fetch_assoc()) 
	{	
		echo("<th class=\"theader-style\" style=\"width: 2%\">".$rows['item']."</th>");
			$itemList[]=$rows['item'];
	}	
/*				echo("<th style=\"width: 2%\">".'Leveringsdato'."</th>");
			$itemList[]='deliverydate';
			echo("<th style=\"width: 2%\">".'Leverings status'."</th>");
			$itemList[]='delivery_status';
*/
//print_r($itemList);

	?>
	
	<?php
	
			//	$row = $result->fetch_array(MYSQLI_BOTH);
//printf ("%s (%s)\n", $row[0], $row["CountryCode"]);

		$tempField="";
		$tempVariable="";
		$count=0;

while($row =$rsOrderData->fetch_array(MYSQLI_BOTH)){  

$sql_FilmInfo ="SELECT film_id,film_name,customer_id FROM film_data where film_id=$row[1] and customer_id=$tmpCustomerid";
$rsFilmCustDetail=$mysqli ->query($sql_FilmInfo);
while ($rowsData = $rsFilmCustDetail->fetch_assoc()) 
	{	

			$film_name=$rowsData['film_name'];
			$film_id=$rowsData['film_id'];
			$customer_id=$rowsData['customer_id'];
	

	
}

	echo"<tr class=\"trsstyle\">";
//echo '<td style=\"width: 5%\"> <a href="javascript:DisplayFormValues((\''.$count.'\'),(\''.$row[1].'\'));">update</ a> </ td>';

if($film_name!="")

		{
		echo "<td style=\"width: 2%\" class=\"tdstyle\">$film_name</ td>";
			if($row[11]!="")
			{	
				if($row[15]==0)
				echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[5]</ td>";
				else
				echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[15]</ td>";
			}
			else
			echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[5]</ td>";
		
			if($row[11]!="")
			{	
				if($row[19]==0)
				echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[8]</ td>";
				else
				echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[19]</ td>";
			}
			else
			echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[8]</ td>";		



			if($row[11]!="")
				echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[20]</ td>";
			else
				echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[10]</ td>";

			if($row[11]!="")
			{	
				if($row[17]==0)
				echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[6]</ td>";
				else
				echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[17]</ td>";
			}
			else
			echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[6]</ td>";				
			
			if($row[11]!="")
			{	
				if($row[16]==0)
				echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[7]</ td>";
				else
				echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[16]</ td>";
			}
			else
			echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[7]</ td>";		
			
			if($row[11]!="")
			{	
				if($row[18]==0)
				echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[9]</ td>";
				else
				echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[18]</ td>";
			}
			else
			echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[9]</ td>";
			echo '</ tr>';		
			}			

		$film_name="";

		}

    
 

	?>
	</table>		



<div name="responsecontainer" id="responsecontainer" align="center">
			</div>
</form>
</body>

</html>
