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
 <br/>
<br/>

 <h1 class="h1Style">AllekinoListe - Ny Kino Registrering</h1>


	<form action="kino_registrationallekinolist.php" method=post autocomplete="on" onsubmit="return checkForm(this);">
<fieldset>
<table style="width: 100%">
	<tr>
		<td style="width: 29%; height: 24px;"> </td>
		<td style="width: 18%; height: 24px;" class="text-right">Kino Navn </td>
		<td style="height: 24px; width: 448px">
		<input id="kino" name="kino" size="20" maxlength="30"  type="text" value=""  required tabindex="1" /></td>
		<td style="height: 24px">
		&nbsp;</td>
	</tr>
		<tr>
		<td style="width: 29%"> &nbsp;</td>
		<td style="width: 18%" class="text-right">Kino adress</td>
		<td style="width: 448px"><input id="kino_address" name="kino_address" size="40" maxlength="40"  type="text" value=""  required /></td>
		<td>&nbsp;</td>
	</tr>

	<tr>
		<td style="width: 29%"> &nbsp;</td>
		<td style="width: 18%" class="text-right"><span lang="no-bok">P</span>ost<span lang="no-bok">Nummer</span> </td>
		<td style="width: 448px"><input id="kino_postnumber" name="kino_postnumber" size="20" maxlength="20"  type="text" value=""  required /></td>
		<td>&nbsp;</td>
	</tr>
		<tr>
		<td style="width: 29%"> &nbsp;</td>
		<td style="width: 18%" class="text-right"> Sted</td>
		<td style="width: 448px"><input id="kino_city" name="kino_city" size="20" maxlength="20"  type="text" value=""  required /></td>
		<td>&nbsp;</td>
	</tr>


	
	<tr>
		<td style="width: 29%"> &nbsp;</td>
		<td style="width: 18%" class="text-right"> E-post</td>
		<td style="width: 448px"><input id="kino_emailid" name="kino_emailid" size="30" maxlength="30"  type="email" value=""  required  placeholder="E-postadresse" /></td>
		<td>&nbsp;</td>
	</tr>

		<tr>
		<td style="width: 29%"> &nbsp;</td>
		<td style="width: 18%" class="text-right"> Teaser</td>
		<td style="width: 448px"><input id="kino_teaser" name="kino_teaser" size="30" maxlength="30"  type="number" value=""    placeholder="Teaser" /></td>
		<td>&nbsp;</td>
	</tr>

	<tr>
		<td style="width: 29%"> &nbsp;</td>
		<td style="width: 18%" class="text-right"> Bannere</td>
		<td style="width: 448px"><input id="kino_bannere" name="kino_bannere" size="30" maxlength="30"  type="number" value=""    placeholder="Bannere" /></td>
		<td>&nbsp;</td>
	</tr>
	
	<tr>
		<td style="width: 29%"> &nbsp;</td>
		<td style="width: 18%" class="text-right"> Regular</td>
		<td style="width: 448px"><input id="kino_regular" name="kino_regular" size="30" maxlength="30"  type="number" value=""    placeholder="Regular" /></td>
		<td>&nbsp;</td>
	</tr>	

		<tr>
		<td style="width: 29%"> &nbsp;</td>
		<td style="width: 18%" class="text-right"> Dcp</td>
		<td style="width: 448px"><input id="kino_dcp" name="kino_dcp" size="30" maxlength="30"  type="number" value=""    placeholder="Dcp" /></td>
		<td>&nbsp;</td>
	</tr>	

		<tr>
		<td style="width: 29%"> &nbsp;</td>
		<td style="width: 18%" class="text-right"> Mellomstandeer</td>
		<td style="width: 448px"><input id="kino_mellomstandeer" name="kino_mellomstandeer" size="30" maxlength="30"  type="number" value=""    placeholder="Mellomstandeer" /></td>
		<td>&nbsp;</td>
	</tr>
	
			<tr>
		<td style="width: 29%"> &nbsp;</td>
		<td style="width: 18%" class="text-right"> Småstandeer</td>
		<td style="width: 448px"><input id="kino_smastandeer" name="kino_smastandeer" size="30" maxlength="30"  type="number" value=""    placeholder="Småstandeer" /></td>
		<td>&nbsp;</td>
	</tr>
	
			<tr>
		<td style="width: 29%"> &nbsp;</td>
		<td style="width: 18%" class="text-right"> Storestandeer</td>
		<td style="width: 448px"><input id="kino_storestandeer" name="kino_storestandeer" size="30" maxlength="30"  type="number" value=""    placeholder="Storestandeer" /></td>
		<td>&nbsp;</td>
	</tr>
	
				<tr>
		<td style="width: 29%"> &nbsp;</td>
		<td style="width: 18%" class="text-right"> Kommentar</td>
		<td style="width: 448px"><input id="kino_kommentar" name="kino_kommentar" size="30" maxlength="30"  type="text" value=""    placeholder="Kommentar" /></td>
		<td>&nbsp;</td>
	</tr>
	
	<tr>
		<td style="width: 29%"> &nbsp;</td>
		<td style="width: 18%" class="text-right"> <div class="auto-style1">
			</div></td>
					<td style="width: 448px">
			<input name="submit" type="submit" value="Registrer">&nbsp;&nbsp;&nbsp;&nbsp;
		<input name="Reset" type="reset" value="Reset"></td>
					<td>
					&nbsp;</td>
	</tr>

</table>
</fieldset>
</form>
</body>
</html>