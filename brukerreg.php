<!DOCTYPE html>
<html>
 <?php
    //Start session
    session_start();
/*if( isset($_SESSION['LAST_REQUEST']) &&
    (time() - $_SESSION['LAST_REQUEST'] > 10) ) {
    session_unset();
    session_destroy();
    header('/login?sessionExpired');
    exit();
}
 
$_SESSION['LAST_REQUEST'] = time();*/
    //Check whether the session variable sess_username is present or not
    if($_SESSION['sess_admmin'])
    {
      if(!isset($_SESSION['sess_admfirstname']) || (trim($_SESSION['sess_admlastname']) == ''))
    		{		
				header("location: loginn.html");
				exit();
    		}

    
    }
    else{
    if(!isset($_SESSION['sess_firstname']) || (trim($_SESSION['sess_lastname']) == ''))
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

 <style type="text/css">
.auto-style1 {
	color: #FFFFFF;
	background-color: #66AFE9;
}
</style>
</head>
<body>
       <?php include('usermenu.html');?>
<br>
<br>
<br>
<br>
<h1 class="h1Style">Dine detaljer</h1>

<form action="bruker_registration.php" method=post autocomplete="on" onsubmit="return checkForm(this);">

<table>
	<tr>
		<td style="width: 10%"> &nbsp;</td>
		<td style="width: 1%" class="auto-style2"> <div class="auto-style11">
			Fornavn<em> </em></div></td>
	
		<td style="width: 10%">
		<input id="firstname" name="firstname" size="20" maxlength="30"  type="text" value=""  required tabindex="1" /></td>
	
		<td style="width: 10%">
		&nbsp;</td>
	</tr>
	<tr>
		<td style="width: 10%"> &nbsp;</td>
		<td style="width: 1%" class="auto-style2"> Etternavn<em> </em></td>
		
		<td style="width: 10%"><input id="lastname" name="lastname" size="20" maxlength="30"  type="text" value=""  required tabindex="2"/></td>
		
		<td style="width: 5%">&nbsp;</td>
	</tr>
		<tr>
		<td style="width: 10%; height: 24px;"> </td>
		<td style="width: 1%; height: 24px;" class="auto-style2"> Gateadresse<em> 
		</em></td>
		
		<td style="width: 10%; height: 24px;"><input id="address" name="address" size="40" maxlength="40"  type="text" value=""  required tabindex="3" /></td>
		
		<td style="width: 10%; height: 24px;">&nbsp;</td>
	</tr>

	<tr>
		<td style="width: 10%"> &nbsp;</td>
		<td style="width: 1%" class="auto-style2"> 
			Sted </td>
	
		<td style="width: 10%"><input id="city" name="city" size="20" maxlength="20"  type="text" value=""  required tabindex="4" /></td>
	
		<td style="width: 5%">&nbsp;</td>
	</tr>

	<tr>
		<td style="width: 10%"> &nbsp;</td>
		<td style="width: 1%" class="auto-style2"> <div class="auto-style11">
			Postnummer<em> </em></div></td>
	
		<td style="width: 10%"><input id="postnumber" name="postnumber" size="20" maxlength="5"  type="text" value=""  required tabindex="5" /></td>
	
		<td style="width: 5%">&nbsp;</td>
	</tr>

	<tr>
		<td style="width: 10%"> &nbsp;</td>
		<td style="width: 1%" class="auto-style2"> Mobiltelefon 1</td>

		<td style="width: 10%"><input id="phonenumber_1" name="phonenumber_1" size="10" maxlength="10"  type="tel" value=""  required  tabindex="6" /></td>

		<td style="width: 5%">&nbsp;</td>
	</tr>
	<tr>
		<td style="width: 10%"> &nbsp;</td>
		<td style="width: 1%" class="auto-style2"> Mobiltelefon 2</td>

		<td style="width: 10%"><input id="phonenumber_2" name="phonenumber_2" size="10" maxlength="10"  type="tel" value=""  /></td>

		<td style="width: 5%">&nbsp;</td>
	</tr>

	<tr>
		<td style="width: 10%"> &nbsp;</td>
		<td style="width: 1%" class="auto-style2"> E-post</td>

		<td style="width: 10%"><input id="emailaddress" name="emailaddress" size="30" maxlength="30"  type="email" value=""  required  placeholder="E-postaddress" tabindex="7" /></td>

		<td style="width: 5%">&nbsp;</td>
	</tr>

		<tr>
		<td style="width: 10%"> &nbsp;</td>
		<td style="width: 1%" class="auto-style2"> <div class="auto-style11">
			Lag et Passord</div></td>
	
				<td style="width: 10%"><input id="password" name="password" size="20" maxlength="20" min ="8" type="password" value=""  required tabindex="8" placeholder="Passord (minst 8 tegn)"/></td>
	
				<td style="width: 5%">&nbsp;</td>
	</tr>
		<tr>
		<td style="width: 10%"> &nbsp;</td>
		<td style="width: 1%" class="auto-style2"> <div class="auto-style11">
			Bekreft Passordet</div></td>
		
		<td style="width: 10%"><input id="password2" name="password2" size="20" maxlength="20"  min ="8" type="password" value=""  required  tabindex="9" placeholder="Passord (minst 8 tegn)"/></td>
		
		<td style="width: 5%">&nbsp;</td>
	</tr>

	<tr>
		<td style="width: 10%"> &nbsp;</td>
		<td style="width: 1%" class="auto-style2"> <div class="auto-style1">
			</div></td>
		
					<td style="width: 10%">
			<input name="submit" id="submit" type="submit" value="Registrer">&nbsp;&nbsp;&nbsp;&nbsp;
		<input name="Reset" type="reset" value="Reset"></td>
		
					<td style="width: 10%">
					&nbsp;</td>
	</tr>

</table>

</form>
<script type="text/javascript"> function checkForm(form) {
 
     if(form.password.value == form.password2.value)
       {
        if(form.password.value.length < 6) 
        {
         alert("Feil: Passordet må inneholde minst seks tegn!"); 
         form.password.focus(); return false; 
         }
          if(form.password.value == form.firstname.value)
           {
            alert("Feil: Passordet må være forskjellig fra Brukernavn!");
             form.password.focus(); return false;
              }
               re = /[0-9]/;
                if(!re.test(form.password.value))
                 {
                  alert("Feil: Passordet må inneholde minst ett tall (0-9)!");
                   form.password.focus(); return false; 
                 } 
                   re = /[a-z]/; 
                 if(!re.test(form.password.value)) 
                 { 
                  alert("Feil: Passordet må inneholde minst en liten bokstav (a-z)!"); 
                  form.password.focus(); return false;
                 }
                  re = /[A-Z]/;
                  if(!re.test(form.password.value)) 
                  { 
                   alert("Feil: Passordet må inneholde minst en stor bokstav (A-Z)!"); 
                   form.password.focus();
                    return false; 
                       } 
                       }
                        else
                         {
                          alert("Feil: Vennligst sjekk at du har skrevet inn og bekreftet passordet ditt!");
                           form.password.focus(); 
                           return false; 
                           } 
                            return true; 
                            } 
                            
                            </script>


</body>

</html>
