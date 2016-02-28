
<?php
// multiple recipients
$emailadd='bgees80@gmail.com';
printf("%s",$emailadd);
printf("connect");
$to  =$emailadd;
printf("%s",$to);
// . ', '; // note the comma
$to .= 'bgees80r@gmail.com';
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
// subject
$subject = 'Birthday Reminders for Jan øpåøøsd';

// message
$message = '
<html>
<head>
  <title>Birthday Reminders for øpåøøsd</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
  <p>Here are the birthdays upcoming in jan øpåøøsd !</p>
  <table>
    <tr>
      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
    </tr>
    <tr>
      <td>Joe</td><td>3rd</td><td>August</td><td>1970</td>
    </tr>
    <tr>
      <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
    </tr>
  </table>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
//$headers .= 'To: Mary <divchandran@gmail.com>, Kelly <linesh.vr@gmail.com>' . "\r\n";
$headers .= 'To: Mary <bgees80@gmail.com>' . "\r\n";

$headers .= 'From: Birthday Reminder <post@budoren.no>' . "\r\n";

// Mail it
$retval=mail($to, $subject, $message, $headers);
if( $retval == true )
   {
      echo "Message sent successfully...";
   }
   else
   {
      echo "Message could not be sent...";
   }
?>
