<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
</head>

<body>
<?php
// Fill up array with names

	include('dbcon.php');

// get the q parameter from URL
$q=$_REQUEST["q"];
 $hint="";
$sql_custinfo = "SELECT customer_emailid from customer_information where customer_emailid = '$q'";
$rsCustData=$mysqli ->query($sql_custinfo );

while ($rows = $rsCustData->fetch_assoc()) 
	{
	 $hint=$rows['customer_emailid'];
	}



// Output "no suggestion" if no hint were found
// or output the correct values
$msg="Vi har sendt deg en lenke for å endre passord. Sjekk e-posten ". $hint." for å komme videre.";
echo $hint==="" ? "Ingen brukere ble funnet ved hjelp av e-postadressen eller brukernavnet." : $msg;

if($hint!=""){

$subject = 'Gjenoppretting av passord from BUD O REN.';


$to=$hint;

$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";




// message
$message = '<html><body>';
//$message .= '<img src="http://css-tricks.com/examples/WebsiteChangeRequestForm/images/wcrf-header.png" alt="Website Change Request" />';
$message .='<br /><h3>Nytt passord for innlogging i BudORen</h3><br />';
$message .= 'Hei,<br />';
$message .= ' Du får denne e-posten fordi vi har fått en henvendelse om at du ønsker å endre ditt BudORen passord.';

$message .='For å endre ditt passord.<br />';
$message .='http://budoren.no/passwordrecovery.php<br />';

$message .='     Hvis du IKKE har bedt om dette, vennligst se bort fra denne e-posten og slett denne mailen.';
$message .= '</body></html>';


    // With message
   
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: OsloBudoren <post@budoren.no>' . "\r\n";
$retval=mail($to, $subject, $message, $headers);


}




?> 
</body>

</html>
