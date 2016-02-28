<!DOCTYPE html>
<html lang="no">
<head>
 <title>budoren</title>
 	<meta charset="utf-8">

			<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
			
<link href="css/jsmodal-light.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.popup{
	position: fixed;
    top: 50%;
    left: 50%;
	width: 100%;
    height: 10%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    font-family:verdana;
    font-size:15px;
	background-color:#00FF12 ;
    }
 .note {
    text-align:center;
 
 }
.cancel{
    display:relative;
    cursor:pointer;
    margin:0;
    float:right;
    height:10px;
    width:34px;
    padding:0 0 5px 0;
    background-color:red;
    text-align:left;
    font-weight:bold;
    font-size:11px;
    color:white;
    border-radius:3px;
    z-index:100000000000000000;
    }

.cancel:hover{
    background:rgb(255,50,50);
    }
    
</style>
			<script type="text/javascript">
			

 function DisplayFormValues(counter,filmid) 
 {        
    
    // do something with document.forms[0].myField[i].value
		//vrname=document.updateForm.test1.value;
		var   varfilmid=filmid;
		var   varorderid=document.getElementById("order_id" +(counter)).value;
		var   varplakat=document.getElementById("Plakat" +(counter)).value;	
		var   varsmastandeer=document.getElementById("Smastandeer" +(counter)).value;
		var   varbannere =document.getElementById("Bannere" +(counter)).value;	
		var   vrMelding=document.getElementById("Melding" +(counter)).value;
		var   vrdcp=document.getElementById("DCP" +(counter)).value;
		var   vrstorestandeer=document.getElementById("Storestandeer" +(counter)).value;
		var   varrequest="oppdatere";
		window.location = "orderupdatesumit.php?filmid=" + varfilmid+"&Plakat=" + varplakat+"&Smastandeer=" + varsmastandeer+"&Bannere=" + varbannere+"&Storestandeer=" + vrstorestandeer+"&DCP=" + vrdcp+"&request=" + varrequest+"&orderid=" + varorderid+"&Melding=" + vrMelding;

   }
   
    function DeliverUpdates(counter,filmid) 
 {        
    
    // do something with document.forms[0].myField[i].value
   //vrname=document.updateForm.test1.value;
		var   varfilmid=filmid;
		var   varorderid=document.getElementById("order_id" +(counter)).value;
		var   varplakat=document.getElementById("Plakat" +(counter)).value;	
		var   varsmastandeer=document.getElementById("Smastandeer" +(counter)).value;
		var   vrdcp=document.getElementById("DCP" +(counter)).value;
		var   vrstorestandeer=document.getElementById("Storestandeer" +(counter)).value;
		var   vrMelding=document.getElementById("Melding" +(counter)).value;
		var   varbannere =document.getElementById("Bannere" +(counter)).value;	

	 	var   varrequest="levere";
	 	
	
	 	
		window.location = "orderupdatesumit.php?filmid=" + varfilmid+"&Plakat=" + varplakat+"&Smastandeer=" + varsmastandeer+"&Bannere=" + varbannere+"&Storestandeer=" + vrstorestandeer+"&DCP=" + vrdcp+"&request=" + varrequest+"&orderid=" + varorderid+"&Melding=" + vrMelding;

   }

   

</script>

<script>
$( document ).ready(function() {

$('input[id^="Melding"]').on('click', function() {  
 var popup = document.createElement('div');
    popup.className = 'popup';
    popup.id = 'test';
    var cancel = document.createElement('div');
    cancel.className = 'cancel';
    cancel.innerHTML = 'lukk';
   cancel.onclick = function (e) { popup.parentNode.removeChild(popup) }; 
    var message = document.createElement('span');
	message.setAttribute('style', 'note');
    message.innerHTML =this.value;
    popup.appendChild(message);                                    
    popup.appendChild(cancel);
    document.body.appendChild(popup);



});
});
</script>
 <style type="text/css">
.auto-style1 {
	color: #FFFFFF;
	background-color: #66AFE9;
}
.auto-style2 {
	text-align: center;
}
 .auto-style3 {
	 text-align: left;
	 color: #FFFFFF;
	 background-color: #66AFE9;
 }
 </style>

 </head>
 
 <body>
 <?php include('usermenu.html');?>
 <h1>Oppdater skjema</h1>
<form name="updateForm" id="updateForm" action="orderupdatesumit.php" action="post"> 
<?php

	include('dbcon.php');
$itemList=array();


		
$sql_ProductName ="SELECT * FROM globalstockslist";
//$sql_filmName ="SELECT * FROM orderdata";
$sql_filmName ="SELECT * FROM orderdata RIGHT JOIN film_data ON (orderdata.film_id = film_data.film_id) order by order_id desc";
		
//echo "$sql_filmName ".$sql_filmName;
		$rsProductName=$mysqli ->query($sql_ProductName);
		$rsFilmName=$mysqli ->query($sql_filmName);
		 
		?>
<table id="show_data"  border="1">
	
	<?php
		echo"<tr>";
		$itemList=array();
		?>
			<th style="width: 106px" class="auto-style3">Oppdatere</th>
	         <th style="width: 109px" class="auto-style3">Levere</th>
	         <th style="width: 109px" class="auto-style3">Kunder</th>
		<th style="width: 229px" class="auto-style3">Bestilling Dato</th>
		<th style="width: 177px" class="auto-style3">Leveranse Dato</th>
	   <th style="width: 684px" class="auto-style3">Film Navn</th>
		
	<?php
	while ($rows = $rsProductName->fetch_assoc()) 
	{	
		echo("<th style=\"width: 684px\" class=\"auto-style3\">".$rows['item']."</th>");
			$itemList[]=$rows['item'];
	}	
//print_r($itemList);
	
	?>


	<?php
	echo"</tr>";
		$tempField="";
		$tempVariable="";
		$count=0;
		
	//	$row = $result->fetch_array(MYSQLI_BOTH);
//printf ("%s (%s)\n", $row[0], $row["CountryCode"]);
$counter=0;
while($row =$rsFilmName->fetch_array(MYSQLI_BOTH)){  
echo"<tr>";
if($row[10]=="false")
echo '<td > <a href="javascript:DisplayFormValues((\''.$count.'\'),(\''.$row[1].'\'));">Oppdatere</ a> </ td>';
else
echo '<td >Oppdatere </ td>';
if(($row[11]=="false") && ($row[10]=="true"))
echo '<td > <a href="javascript:DeliverUpdates((\''.$count.'\'),(\''.$row[1].'\'));">Levere</ a> </ td>';
else
echo '<td > Levere</ td>';
$sql_KunderNavn ="SELECT customer_name FROM customer_information where customer_id=$row[17]";
$rsKunderNavn=$mysqli ->query($sql_KunderNavn);
	while ($rows = $rsKunderNavn->fetch_assoc()) 
	{	echo("<td>".$rows['customer_name']."</td>");
	}
echo "<input  type=\"hidden\" value=\"$row[0]\" pattern=\"[0-9]*\" name=\"order_id$count\" id=\"order_id$count\">";
echo "<td >$row[2]</ td>";
echo "<td >$row[9]</ td>";
echo "<td >$row[14]</ td>";

//echo "<td ><input  type=\"text\" value=\"$row[4]\" pattern=\"[0-9]*\" name=\"deliverydate$count'\" id=\"deliverydate$count\"></ td>";
echo "<td ><input  type=\"text\" value=\"$row[3]\" pattern=\"[0-9]*\" name=\"Bannere$count\" id=\"Bannere$count\"></ td>";
echo "<td ><input  type=\"text\" value=\"$row[7]\" pattern=\"[0-9]*\" name=\"DCP$count\" id=\"DCP$count\"></ td>";


echo "<td >		<input id=\"Melding$count\" type=\"text\" value=\"$row[8]\" /></ td>";

//echo "<td ><input  type=\"text\" value=\"$row[8]\"  name=\"Melding$count\" id=\"Melding$count\"></ td>";

echo "<td ><input  type=\"text\" value=\"$row[5]\" pattern=\"[0-9]*\" id=\"Plakat$count\" name=\"Plakat$count\"></ td>";
echo "<td ><input  type=\"text\" value=\"$row[4]\" pattern=\"[0-9]*\" name=\"Smastandeer$count\" id=\"Smastandeer$count\"></ td>";
echo "<td ><input  type=\"text\" value=\"$row[6]\" pattern=\"[0-9]*\" name=\"Storestandeer$count\" id=\"Storestandeer$count\"></ td>";
echo '</ tr>';

$count++;
}    


	
	?>
	</table>		

</form>
</body>
</html>