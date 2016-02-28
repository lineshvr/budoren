<!DOCTYPE html>
<html lang="no">
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
 <title>budoren</title>
 	<meta charset="utf-8">

			<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
			<link href="styles/mystyle.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />

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
		
		var   vrmellomstandeer=document.getElementById("Mellomstandeer" +(counter)).value;
		var   vrteaserplakat=document.getElementById("Teaserplakat" +(counter)).value;
		//var   vrhovedplakat=document.getElementById("Hovedplakat" +(counter)).value;		
		
		var   varrequest="oppdatere";
		window.location = "orderupdatesumit.php?filmid=" + varfilmid+"&Plakat=" + varplakat+"&Smastandeer=" + varsmastandeer+"&Bannere=" + varbannere+"&Storestandeer=" + vrstorestandeer+"&DCP=" + vrdcp+"&request=" + varrequest+"&orderid=" + varorderid+"&Melding=" + vrMelding+"&Mellomstandeer=" + vrmellomstandeer+"&Teaserplakat=" + vrteaserplakat;

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
		
		var   vrmellomstandeer=document.getElementById("Mellomstandeer" +(counter)).value;
		var   vrteaserplakat=document.getElementById("Teaserplakat" +(counter)).value;
	//	var   vrhovedplakat=document.getElementById("Hovedplakat" +(counter)).value;		
		

	 	var   varrequest="levere";
	 	
	
	 	
		window.location = "orderupdatesumit.php?filmid=" + varfilmid+"&Plakat=" + varplakat+"&Smastandeer=" + varsmastandeer+"&Bannere=" + varbannere+"&Storestandeer=" + vrstorestandeer+"&DCP=" + vrdcp+"&request=" + varrequest+"&orderid=" + varorderid+"&Melding=" + vrMelding+"&Mellomstandeer=" + vrmellomstandeer+"&Teaserplakat=" + vrteaserplakat;

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
	if(this.value!=""){
    message.innerHTML =this.value;
    popup.appendChild(message);                                    
    popup.appendChild(cancel);
    document.body.appendChild(popup);
}


});
});
</script>
<style>
table, th, td {
    border: 1px solid black;
}
a {background-color: rgb(0,255,0)}
</style>

 </head>
 
 <body>
 <?php include('usermenu.html');?>
 <br>
<br>
<br>
<br>
 <h1 class="h1Style">Oppdater skjema</h1>
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
<table id="show_data"  border="1"   >
	
	<?php
		echo"<tr class=\"theader-style\">";
		$itemList=array();
		?>
			<th style="width: 2%" >Oppdatere</th>
	         <th style="width: 2%" >Levere</th>
	         <th style="width: 2%" >Kunder</th>
		<th style="width: 2%" >Bestilling Dato</th>
		<th style="width: 2%" >Leveranse Dato</th>
		<th style="width: 2%" >Siste frist</th>		
	   <th style="width: 10%" >Film Navn</th>
		
	<?php
	while ($rows = $rsProductName->fetch_assoc()) 
	{	if(($rows['item']=="Melding")||($rows['item']=="Plakat")||($rows['item']=="Smastandeer")){
		if($rows['item']=="Melding")
		echo("<th style=\"width: 20%\" class=\"auto-style3\">Filmeffekter/annet</th>");
		if($rows['item']=="Plakat")
		echo("<th style=\"width: 2%\" class=\"auto-style3\">Hovedplakat</th>");
		if($rows['item']=="Smastandeer")
		echo("<th style=\"width: 2%\" class=\"auto-style3\">Småstandeer</th>");
		}
	else
		echo("<th style=\"width: 2%\" class=\"auto-style3\">".$rows['item']."</th>");
			$itemList[]=$rows['item'];
	}	
//print_r($itemList);
	
	?>
	   <th style="width: 177px" >Melding</th>
   <?php
	echo"</tr>";
		$tempField="";
		$tempVariable="";
		$count=0;
		
	//	$row = $result->fetch_array(MYSQLI_BOTH);
//printf ("%s (%s)\n", $row[0], $row["CountryCode"]);
while($row =$rsFilmName->fetch_array(MYSQLI_BOTH)){  
echo"<tr>";
if($row[10]=="false")
echo '<td  > <a href="javascript:DisplayFormValues((\''.$count.'\'),(\''.$row[1].'\'));">Oppdatere</ a> </ td>';
else
echo "<td  >Oppdatere </ td>";
if(($row[11]=="false") && ($row[10]=="true"))
echo '<td  > <a href="javascript:DeliverUpdates((\''.$count.'\'),(\''.$row[1].'\'));">Levere</ a> </ td>';
else
echo "<td  > Levere</ td>";
$sql_KunderNavn ="SELECT customer_name FROM customer_information where customer_id=$row[21]";
$rsKunderNavn=$mysqli ->query($sql_KunderNavn);
	while ($rows = $rsKunderNavn->fetch_assoc()) 
	{	echo("<td  >".$rows['customer_name']."</td>");
	}
echo "<input  type=\"hidden\" value=\"$row[0]\" pattern=\"[0-9]*\" name=\"order_id$count\" id=\"order_id$count\">";
echo "<td  style=\"width: 2%\" >$row[2]</ td>";
echo "<td  style=\"width: 2%\" >$row[9]</ td>";

//sistedato
echo "<td style=\"width: 1%\" >$row[13]</ td>";
//filmname
echo "<td style=\"width: 1%\" >$row[18]</ td>";
//echo "<td ><input  type=\"text\" value=\"$row[4]\" pattern=\"[0-9]*\" name=\"deliverydate$count'\" id=\"deliverydate$count\"></ td>";
echo "<td style=\"width: 1%\" ><input  type=\"text\" size=\"5\" value=\"$row[3]\" pattern=\"[0-9]*\" name=\"Bannere$count\" id=\"Bannere$count\"></ td>";
echo "<td style=\"width: 1%\" ><input  type=\"text\" size=\"5\" value=\"$row[7]\" pattern=\"[0-9]*\" name=\"DCP$count\" id=\"DCP$count\"></ td>";
//echo "<td ><input  type=\"text\" value=\"$row[8]\"  name=\"Melding$count\" id=\"Melding$count\"></ td>";
//echo "<td style=\"width: 1%\" ><input  type=\"text\" size=\"5\" value=\"$row[17]\" pattern=\"[0-9]*\" name=\"Hovedplakat$count\" id=\"Hovedplakat$count\"></ td>";
echo "<td style=\"width: 1%\" >		<input id=\"Melding$count\" type=\"text\" value=\"$row[8]\" /></ td>";
echo "<td style=\"width: 1%\" ><input  type=\"text\" size=\"5\" value=\"$row[15]\" pattern=\"[0-9]*\" name=\"Mellomstandeer$count\" id=\"Mellomstandeer$count\"></ td>";
echo "<td style=\"width: 1%\" ><input  type=\"text\" size=\"5\" value=\"$row[5]\" pattern=\"[0-9]*\" id=\"Plakat$count\" name=\"Plakat$count\"></ td>";
echo "<td style=\"width: 1%\" ><input  type=\"text\" size=\"5\" value=\"$row[4]\" pattern=\"[0-9]*\" name=\"Smastandeer$count\" id=\"Smastandeer$count\"></ td>";
echo "<td style=\"width: 1%\" ><input  type=\"text\" size=\"5\" value=\"$row[6]\" pattern=\"[0-9]*\" name=\"Storestandeer$count\" id=\"Storestandeer$count\"></ td>";


echo "<td style=\"width: 1%\" ><input  type=\"text\"  size=\"5\" value=\"$row[16]\" pattern=\"[0-9]*\" name=\"Teaserplakat$count\" id=\"Teaserplakat$count\"></ td>";



echo "<td style=\"width: 2%\" ><input  type=\"text\"  value=\"$row[14]\" name=\"MeldingTilLager$count\" id=\"MeldingTilLager$count\"></ td>";

echo '</ tr>';

$count++;
}    


	
	?>
	</table>		

</form>
</body>
</html>