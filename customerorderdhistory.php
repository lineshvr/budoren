
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
$("input[name='film_name']:text").val()="";
   location.reload(); 
}
function showHint() {
  //   var filmname= $("input[name='film_name']:text").val(); 
//if(filmname!=""){
     $('#tablecontainer').html("");
 
             var filmname= $("input[name='film_name']:text").val(); 
		
    
                $.ajax({ url: "orderedhistory.php",
				    data: {"q":filmname},
                    type: 'post',
                    dataType: "html",
					success: function(response){                    
            $("#responsecontainer").html(response); 
            //alert(response);
        }
          
    
                });
                
               } 
//			   else 
	//		   location.reload(); 
               // }
</script>
</head>
    <?php
		include('dbcon.php');?>

<body>

    <?php include('customermenu.html');?>
	<br>	<br>	<br>
  <div class="text-center">
  	<h1 class="h1Style">
  <span><strong>Bestillinglogg</strong></span><strong> </strong></h1>
  </div>


<?php


$itemList=array();

$tmpCustomerid=$_SESSION['sess_customerid'];
		
$sql_ProductName ="SELECT * FROM globalstockslist";
$sql_orderdata ="SELECT * FROM film_data RIGHT JOIN orderdata ON (orderdata.film_id = film_data.film_id) where film_data.customer_id=$tmpCustomerid order by orderdate desc";

		
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
		<input type="text" name="film_name" id="film_name" onkeydown="showHint()" style="width: 332px" placeholder="Film Navn.." onblur="showHint()"></input> 

	<table style="width: 100%" class="tablesstyle" id="tablecontainer">
				
			
	
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





<div name="responsecontainer" id="responsecontainer" align="center">
			</div>
	<form>
</body>

</html>
