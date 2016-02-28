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
 </head>
<body>
       <?php include('usermenu.html');?>

<table style="width: 100%" >
<tr >
<td style="width: 29%;" >&nbsp;</td>
<td class=><div id="header" >
	<h3 style="margin-bottom: 0pt; height: 3%; width: 636px;" >Ny Film Registrering</h3>
</div>
</td>

	
	<td>&nbsp;</td>


</tr>

</table>
<?php


// Create connection


//$mysqli = new mysqli("budoren.mysql.domeneshop.no","budoren","Viqvt3vA","budoren");

if (mysqli_connect_errno()) {
   printf("Connect failed: %s\n", mysqli_connect_error());
   exit();
}else{
//printf("Connect \n");
}
$sql_custdata="SELECT customer_name,customer_id FROM customer_information";
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
	<form action="filmdataentry.php" name="frmMain" method=post autocomplete="on"  id="frmMain">

			<table style="width: 100%; float: none;" cellspacing="1">
				<tr>
					<td style="width: 4%"> &nbsp;</td>
					<td style="width: 6%" > Film Navn :</td>
					<td style="width: 10%" >	<input id="filmname" name="filmname" size="20" maxlength="20"  type="text" value=""  required tabindex="1" /></td>
	</tr>
		<tr>
		<td style="width: 4%"> &nbsp;</td>
		<td style="width: 6%" > Film språk :</td>
		<td style="width: 10%" ><input id="film_language" name="film_language" size="40" maxlength="40"  type="text" value=""  required  tabindex="2" /></td>
	</tr>

	<tr>
		<td style="width: 4%"> &nbsp;</td>
		<td style="width: 6%" > Film av :</td>
		<td style="width: 10%" >
		<input id="film_about" name="film_about" size="400" maxlength="20"  type="textarea" value=""  required   tabindex="3" style="width: 329px; height: 80px"/></td>
	</tr>
	
	<tr>
		<td style="width: 4%"> &nbsp;</td>
		<td style="width: 6%" > Kunder navn :</td>
		<td style="width: 10%" ><select name="customer_name" id="customer_name" tabindex="4" required>
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
		<td style="width: 4%"> &nbsp;</td>
		<td style="width: 6%" > Hyllenummer :</td>
		<td style="width: 10%" ><input id="Hyllenummer" name="Hyllenummer" size="20" maxlength="20"  type="text" value=""  tabindex="5"/></td>
	</tr>
<tr>
		<td style="width: 4%"> &nbsp;</td>
		<td style="width: 6%" > DCP Hyllenummer :</td>
		<td style="width: 10%" ><input id="DCPHyllenummer" name="DCPHyllenummer" size="20" maxlength="20"  type="text" value=""  tabindex="6"/></td>
	</tr>

	<tr>
		
<!--		<td style="width: 2%" > Produkt :</td>-->

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
																		echo "<td style=\"width: 4%\" > &nbsp;</td>";
																		//echo "<td style=\"width: 6%\" > Items :</td>";
																		echo "<td style=\"width: 6%\" >";
																		echo "<label  for=\"items\">{$rowitemlist ['item']} <label>";
																		echo "</td>";

															      	$itemsName=$rowitemlist ['item'];
															      	
																		echo "<td style=\"width: 10%\" class=\"auto-style1\">";
																		if($itemsName!='Erter')
																		echo "<input  type=\"text\"  value=\"\" pattern=\"[0-9]*\" name=\"quantity[$counter]\" tabindex=\"$counter\">";
																		else
																		echo "<input  type=\"text\"  value=\"\" name=\"quantity[$counter]\" tabindex=\"$counter\">";
			
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
							
		<td style="width: 4%"> &nbsp;</td>


		<td colspan="2" > Notify epost :</td>
				<td style="width: 4%" > <input id="emailnotify" name="emailnotify" type="checkbox"/></td>
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
																		echo "<td style=\"width: 4%\"> &nbsp;</td>";
																		//echo "<td style=\"width: 6%\" > Items :</td>";
																		echo "<td style=\"width: 6%\">";
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
		<td style="width: 4%"> &nbsp;</td>
		<td style="width: 5%" > </td>
		<td style="width: 10%" ><input name="submit" type="submit" value="Registrer" onclick="validateForm(this.form);return false;">&nbsp;&nbsp;&nbsp;&nbsp;</input>
		<input name="Reset" type="reset" value="Reset"></td>
	</tr>

</table>
</form>
</body>
</html>