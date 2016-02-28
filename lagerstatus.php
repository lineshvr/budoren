
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

<!DOCTYPE html>
<html>
<head>
 <title>budoren</title>
 		<meta charset="utf-8">
			<link href="styles/mystyle.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />
			<script type="text/javascript" src="js/loginvalidation.js"></script>
			<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>

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
    
                $.ajax({ url: "stockstatus.php",
				    data: {"q":filmname},
                    type: 'post',
                    dataType: "html",
					success: function(response){                    
            $("#responsecontainer").html(response); 
            //alert(response);
        }
          
    
                });
                
                
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
</head>
    <?php
		include('dbcon.php');?>

<body>
  <?php include('usermenu.html');?>
  <br>
<br>
<br>
<br>

<h1 class="h1Style">Lagerstaus</h1>

<?php
$film_id="";

$itemList=array();


$tmpCustomerid=$_SESSION['sess_customerid'];
$sql_ProductName ="SELECT * FROM globalstockslist";
$sql_FilmInfo ="SELECT film_id,film_name,customer_id,hylleid,dcphylleid FROM film_data";
$sql_orderdata ="
SELECT *
FROM `film_stocks_entry`
left join `leftstock_data` on film_stocks_entry.film_id = leftstock_data.film_id
union
SELECT *
FROM `film_stocks_entry`
right join `leftstock_data` on film_stocks_entry.film_id = leftstock_data.film_id";


		
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
		echo"<tr class=\"theader-style\">";
		$itemList=array();

		     echo("<th style=\"width: 4%\">".'Film Navn'."</th>");
			$itemList[]='film_name';
			echo("<th style=\"width: 4%\">".'Film Release Dato'."</th>");
			$itemList[]='film_name';
			
			echo("<th style=\"width: 4%\">".'Hylle'."</th>");
			$itemList[]='Hylle';
			echo("<th style=\"width: 4%\">".'DCP Hylle'."</th>");
			$itemList[]='DCP Hylle';
			
			echo("<th style=\"width: 4%\">".'Kunder Navn'."</th>");
			$itemList[]='Kunder Navn';
	
	while ($rows = $rsProductName->fetch_assoc()) 
	{	
	if(($rows['item']=="Plakat")||($rows['item']=="Melding") || ($rows['item']=="Smastandeer")){
		if(($rows['item']=="Plakat"))
		echo("<th style=\"width: 2%\" class=\"auto-style3\">Hovedplakat</th>");
		if(($rows['item']=="Melding"))
		echo("<th style=\"width: 2%\" class=\"auto-style3\">Filmeffekter/annet</th>");	
		if(($rows['item']=="Smastandeer"))
		echo("<th style=\"width: 2%\" class=\"auto-style3\">Småstandeer</th>");
		}
	else
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
	
			//	$row = $result->fetch_array(MYSQLI_BOTH);
//printf ("%s (%s)\n", $row[0], $row["CountryCode"]);

	$tempField="";
		$tempVariable="";
		$count=0;

while($row =$rsOrderData->fetch_array(MYSQLI_BOTH)){  

$sql_FilmInfo ="SELECT film_id,film_name,customer_id,hylleid,dcphylleid FROM film_data where film_id=$row[1]";
$sql_FilmReleaseDato ="SELECT film_release_date FROM film_otherinfo where film_id=$row[1] and film_release_date <= DATE(NOW() - INTERVAL 3 MONTH)";

//printf ("%s\n", $sql_FilmReleaseDato);
$rsFilmCustDetail=$mysqli ->query($sql_FilmInfo);
$rsFilmDetail=$mysqli ->query($sql_FilmReleaseDato);
while ($rowsData = $rsFilmCustDetail->fetch_assoc()) 
	{	

			$film_name=$rowsData['film_name'];
			$film_id=$rowsData['film_id'];
			$customer_id=$rowsData['customer_id'];
			$hylleid=$rowsData['hylleid'];
			$dcphylleid=$rowsData['dcphylleid'];
	
}

$sqlCustomerID="SELECT customer_name FROM budoren.customer_information where customer_id=$customer_id;";
//echo "sqlFilmID".$sqlFilmID."<br />";
// Check connection
$rsCustomerID = $mysqli->query($sqlCustomerID);

    
    if (!$rsCustomerID) {
   printf("%s\n", $mysqli->error);
   exit();
}

while($rowCustomerID= $rsCustomerID->fetch_assoc()){
		
//printf("%s", $rowFilmID['film_id']);
		
		$temp_customername= $rowCustomerID['customer_name'];
		
}

while ($rowsOtherInfo = $rsFilmDetail->fetch_assoc()) 
	{	

			$film_release_date=$rowsOtherInfo['film_release_date'];
			//printf ("come to heree  %s\n", $film_release_date);


	//printf ("come to last  %s\n", $film_release_date);
}


			echo("<tr>");  
//echo '<td style=\"width: 5%\"> <a href="javascript:DisplayFormValues((\''.$count.'\'),(\''.$row[1].'\'));">update</ a> </ td>';

if($film_name!=""){
if($film_release_date!="")
echo "<td style=\"width: 2%\" bgcolor=\"#FF0000\" class=\"tdstyle\">$film_name</ td>";
else
echo "<td style=\"width: 2%\" class=\"tdstyle\">$film_name</ td>";
if($film_release_date!="")
echo "<td style=\"width: 2%\" class=\"tdstyle\" bgcolor=\"#FF0000\">$film_release_date</ td>";
else
echo "<td style=\"width: 2%\" class=\"tdstyle\">$film_release_date</ td>";


echo "<td style=\"width: 2%\" class=\"tdstyle\">$hylleid</ td>";
echo "<td style=\"width: 2%\" class=\"tdstyle\">$dcphylleid</ td>";
echo "<td style=\"width: 2%\" class=\"tdstyle\">$temp_customername</ td>";
//$row[13] delivery id
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
if($row[14]!=""){
	if($row[13]>$row[26])
		echo "<td style=\"width: 2%\" class=\"tdstyle\">$row[26]</ td>";
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






$count++;
}
echo "</ tr>";
$film_name="";
$film_release_date="";
}    
 

	?>
	</table>		



<div name="responsecontainer" id="responsecontainer" align="center">
			</div>
</form>

</html>
