
<!DOCTYPE html>
<html>
<head>
 <title>budoren</title>
			<meta charset="utf-8">
			<script type="text/javascript" src="js/loginvalidation.js"></script>
<link href="styles/mystyle.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />

 <style type="text/css">
 .auto-style1 {
	 background-color: #66AFE9;
 }
 .auto-style2 {
	 color: #fff;
	 text-align: right;
 }
 .auto-style5 {
	 color: #000000;
	 text-align: right;
 }
 .auto-style6 {
	 color: #000000;
	 text-align: center;
 }


 </style>

</head>
    <?php
		include('dbcon.php');?>

<body>

    <?php include('usermenu.html');?>
<h1 class="h1Style">Ny kunder Registrering</h1>

			<form action="customerregistration.php" method=post autocomplete="on" onsubmit="return checkForm(this);">
<fieldset>
<table style="width: 100%">
	<tr>
		
		<td style="width: 6%" class="auto-style5"> Firma Navn :</td>
		<td style="width: 10%"><input id="customername" name="customername" size="20" maxlength="20"  type="text" value=""  required tabindex="1" /></td>
	</tr>
		<tr>
		
		<td style="width: 6%" class="auto-style5"> Adresse :</td>
			<td style="width: 10%"><input id="address" name="address" size="40" maxlength="40"  type="text" value=""  required  tabindex="2" /></td>
	</tr>

	<tr>
		
		<td style="width: 6%" class="auto-style5">Sted :</td>
		<td style="width: 10%"><input id="city" name="city" size="20" maxlength="20"  type="text" value=""  required   tabindex="3"/></td>
	</tr>

	<tr>
		
		<td style="width: 6%" class="auto-style5"> Postnummer :</td>
		<td style="width: 10%"><input id="postnumber" name="postnumber" size="10" maxlength="10"  type="text" value=""  required  tabindex="4" /></td>
	</tr>

	<tr>
	
		<td style="width: 6%; " class="auto-style5">Kontaktnummer :</td>
	<td style="width: 10%; "><input id="contactnumber" name="contactnumber" size="10" maxlength="10"  type="tel" value=""  required tabindex="5" /></td>
	</tr>

	<tr>

		<td style="width: 6%; " class="auto-style5">Mobilenummer :</td>
	<td style="width: 10%; "><input id="mobilenumber" name="mobilenumber" size="10" maxlength="10"  type="tel" value=""  required tabindex="6" /></td>
	</tr>
	<tr>
		<td style="width: 6%; " class="auto-style5"> E-post :</td>
	<td style="width: 10%; "><input id="emailid" name="emailid" size="45" maxlength="45"  type="email" value=""  required tabindex="7" /></td>
	<!--</tr>

		<tr>
		
		<td style="width: 6%" class="auto-style2"> Passord :</td>
		<td style="width: 10%"><input id="password" name="password" size="20" maxlength="20"  type="password" value=""  required placeholder="Passord (minst 6 tegn)"/></td>
	</tr>
		<tr>
		
		<td style="width: 6%" class="auto-style2"> Bekreft Passord :</td>
			<td style="width: 10%"><input id="password2" name="password2" size="20" maxlength="20"  type="password" value=""  required placeholder="Passord (minst 6 tegn)"/></td>
	</tr>

-->	<tr>
		
		<td style="width: 6%" class="auto-style2"> </td>
			<td style="width: 10%"><input name="submit" type="submit" value="Registrer">&nbsp;&nbsp;&nbsp;&nbsp;
		<input name="Reset" type="reset" value="Reset"></td>
	</tr>

</table>
</fieldset>
</form>





</body>
</html>