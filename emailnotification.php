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
		<link href="styles/mystyle.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />			

</head>
<body>
       <?php include('usermenu.html');?>
<br>
<br>
<br>
<br>
<h1 class="h1Style">E-post Varsle</h1>





<?php


// Create connection


//$mysqli = new mysqli("budoren.mysql.domeneshop.no","budoren","Viqvt3vA","budoren");

if (mysqli_connect_errno()) {
   printf("Connect failed: %s\n", mysqli_connect_error());
   exit();
}else{
//printf("Connect \n");
}
$sql_custdata="SELECT customer_name,customer_id FROM customer_information group by customer_name";
 	if (!$mysqli->set_charset("utf8")) 
 	{
																		  
  printf("Error loading character set utf8: %s\n", $mysqli->error);
	} 
	else {
		   // printf("Current character set: %s\n", $mysqli->character_set_name());
	}

$rscustdata=$mysqli ->query($sql_custdata);

$sql_itemlist="SELECT item,price FROM globalstockslist";
 	if (!$mysqli->set_charset("utf8")) 
 	{
																		  
  printf("Error loading character set utf8: %s\n", $mysqli->error);
	} 
	else {
	   // printf("Current character set: %s\n", $mysqli->character_set_name());
	}

$rsitemlist=$mysqli ->query($sql_itemlist);

?>
	<form action="EmailSend.php" name="frmMain" method=post autocomplete="on"  id="frmMain">

			<table>
				<tr>
					<td style="width: 10%">&nbsp; </td>
					<td style="width: 1%" class="auto-style2"> Film Navn :</td>
					<td style="width: 10%">	<input id="filmname" name="filmname" size="40" maxlength="45"  type="text" value=""  required tabindex="1" /></td>
	</tr>
		<tr>
		<td style="width: 10%">&nbsp; </td>
		<td style="width: 1%" class="auto-style2"> Film språk :</td>
		<td style="width: 10%"><input id="film_language" name="film_language" size="40" maxlength="40"  type="text" value=""  tabindex="2" /></td>
	</tr>

	<tr>
		<td style="width: 10%">&nbsp; </td>
		<td style="width: 1%" class="auto-style2"> Film av :</td>
		<td style="width: 10%"><input id="film_about" name="film_about" size="50" maxlength="400"  type="text" value=""  tabindex="3"/></td>
	</tr>
	
	<tr>
		<td style="width: 10%">&nbsp; </td>
		<td style="width: 1%" class="auto-style2"> Kunder navn :</td>
		<td style="width: 10%"><select name="customer_name" id="customer_name" tabindex="4" required>
														<option value="">velge alternativet</option>
				
														<?php
														/* change character set to utf8 */
													if (!$mysqli->set_charset("utf8")) {
													printf("Error loading character set utf8: %s\n", $mysqli->error);
													} else {
													// printf("Current character set: %s\n", $mysqli->character_set_name());
													}

														    while ($rowcustdata = $rscustdata->fetch_assoc()) {
														        echo "<option value=\"{$rowcustdata ['customer_id']}\">";
														        echo $rowcustdata['customer_name'];
														        echo "</option>";
														   	    }
														    
														?>
								</select>
	</tr>
	
	
	
	<tr>
		
<!--		<td style="width: 2%" class="auto-style2"> Produkt :</td>-->

		<?php
					$counter=7;
																		$itemsName=array();
														/* change character set to utf8 */
																if (!$mysqli->set_charset("utf8")) {
																		    printf("Error loading character set utf8: %s\n", $mysqli->error);
																		} else {
																		   // printf("Current character set: %s\n", $mysqli->character_set_name());
																		}
															

														    while ($rowitemlist = $rsitemlist->fetch_assoc()) {
														   
																	
																		echo "<tr>";
																		echo "<td style=\"width: 10%\"> &nbsp;</td>";
																		//echo "<td style=\"width: 1%\" class=\"auto-style2\"> Items :</td>";
																		echo "<td style=\"width: 1%\">";
																		if($rowitemlist ['item']=="Melding")
																		echo "<label  for=\"items\">Filmeffekter/annet<label>";
																		else
																		echo "<label  for=\"items\">{$rowitemlist ['item']} <label>";
																		echo "</td>";

															      	$itemsName=$rowitemlist ['item'];
															      	
																		echo "<td style=\"width: 10%\">";
																				if($itemsName!='Melding')
																		echo "<input  size=\"50\" maxlength=\"200\" type=\"text\"  value=\"\" pattern=\"[0-9]*\" name=\"quantity[$counter]\" tabindex=\"$counter\">";
																		else
																		echo "<input size=\"50\" maxlength=\"200\" type=\"text\"  value=\"\" name=\"quantity[$counter]\" tabindex=\"$counter\">";
			
															//			echo "<input  type=\"text\"  value=\"\" name=\"{$rowitemlist ['item']}\">";
																		echo "<input  type=\"hidden\"  value=\"$itemsName\" name=\"product[$counter]\">";
															//			echo "<input  type=\"hidden\" value=\"\" name=\"items[$counter]\">";
														//		echo "</input>";

																		echo "</td>";
																		echo "</tr>";
																		$counter=$counter+1;
															//     echo "<input  type=\"text\" value=\"{$rowitemlist ['item']}\">";
														      //  echo "</input>";
														    }
														  //  $counter=$counter-1;
/*for($j=0;$j<=$counter;$j++)
	echo "<input  type=\"text\" name=\"itemsList\" value=\"$itemsName[$j]\">";
*/

														?>
	
										
							<tr>
							<td  > </td>

		</tr>
			
					<tr>
							<td  > </td>
	<td>  <input id="emailnotify" tabindex="14" name="emailnotify" type="hidden"/></td>
	</tr>

	

<!--		<?php
														/* change character set to utf8 */
																if (!$mysqli->set_charset("utf8")) {
																		    printf("Error loading character set utf8: %s\n", $mysqli->error);
																		} else {
																		   // printf("Current character set: %s\n", $mysqli->character_set_name());
																		}

														    while ($rowitemlist = $rsitemlist->fetch_assoc()) {
														   
																	
																		echo "<tr>";
																		echo "<td style=\"width: 10%\"> &nbsp;</td>";
																		//echo "<td style=\"width: 1%\" class=\"auto-style2\"> Items :</td>";
																		echo "<td style=\"width: 1%\">";
																		echo "<label  for=\"items\">{$rowitemlist ['item']} <label>";
																		echo "</td>";

																		echo "</input>";
																			echo "<td style=\"width: 10%\">";

																		echo "<input  type=\"text\" readonly value=\"{$rowitemlist ['price']}\">";
																		echo "</input>";
																		echo "<input  type=\"text\" required name=\"{$rowitemlist ['item']}\">";
																		echo "<input  type=\"hidden\" name=\"{$rowitemlist ['item']}\">";

																		echo "</input>";

																		echo "</td>";
																		echo "</tr>";
															//     echo "<input  type=\"text\" value=\"{$rowitemlist ['item']}\">";
														      //  echo "</input>";
														    }
														?>
-->

	<tr>
		<td style="width: 10%">&nbsp; </td>
		<td style="width: 1%"> </td>
		<td style="width: 10%"><input name="submit" type="submit" value="Registrer" onclick="validateForm(this.form);return false;">&nbsp;&nbsp;&nbsp;&nbsp;</input>
		<input name="Reset" type="reset" value="Reset"></td>
	</tr>

</table>

</form>
</body>
</html>