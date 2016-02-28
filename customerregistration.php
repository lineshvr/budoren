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


 <style type="text/css">
.auto-style1 {
	color: #FFFFFF;
	background-color: #66AFE9;
}
 .auto-style2 {
	 text-align: right;
 }
 .auto-style3 {
	 text-align: center;
 }
 </style>
</head>
<body>
       <?php include('usermenu.html');?>

	   <div class="auto-style3">

<?php
if(isset($_POST['submit'])){
// Create temporary variables
   $tmp_customer = $_POST['customername'];
   $tmp_customeraddress = $_POST['address'];
   $tmp_customercity = $_POST['city'];
   $tmp_customerpostnumber= $_POST['postnumber'];
   $tmp_customeremailaddress= $_POST['emailid'];   
   $tmp_customercontactnumber= $_POST['contactnumber'];   
   $tmp_customermobilenumber= $_POST['mobilenumber'];   
   $tmp_password= $_POST['password'];   
   $tmp_customerdata="Some Info";
  
 $tmp_password=generate_password(8);

// Create sql
$sql = "INSERT INTO customer_information ".
       "(customer_id,customer_name,customer_address,customer_city,customer_postnumber,customer_entrydate,customer_emailid,customer_password,customer_data,customer_contactnumber,customer_mobilenumber) ".
       "VALUES ".
       "('','$tmp_customer','$tmp_customeraddress','$tmp_customercity','$tmp_customerpostnumber',now(), '$tmp_customeremailaddress', '$tmp_password', '$tmp_customerdata', '$tmp_customercontactnumber', '$tmp_customermobilenumber')";
// Create connection
  //printf("sql character set: %s\n", $sql);

if (mysqli_connect_errno()) {
   printf("Connect failed: %s\n", mysqli_connect_error());
   exit();
}

/* change character set to utf8 */
if (!$mysqli->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
} else {
 //  printf("Current character set: %s\n", $mysqli->character_set_name());
}


/*   $result = mysqli_query($con,"SELECT * FROM user_information");

while($row = mysqli_fetch_array($result)) {
  echo $row['fname'] . " " . $row['lname'];
  echo "<br>"; 
 echo "connected" ;
}
*/
// Check connection
$result = $mysqli->query($sql);
if (!$result) {
   printf("%s\n", $mysqli->error);
   exit();
}


$to  =$tmp_customeremailaddress;

$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
// subject
$subject = 'Du er registere i BudOReN.';

// message
$message = '<html><body>';
$message .='<br /><h3>Kunder info </h3><br />';

$message .= '<table rules="all" style="border-color: #407BF6;background: #eee;" cellpadding="10">';
$message .= "<tr ><td><strong>Firma Navn:</strong> </td><td>" . strip_tags($_POST['customername']) . "</td></tr>";
$message .= "<tr><td><strong>Epost :</strong> </td><td>" . strip_tags($_POST['emailid']) . "</td></tr>";
$message .= "<tr><td><strong>Kontakt:</strong> </td><td>" . strip_tags($_POST['contactnumber']) . "</td></tr>";
$message .= "<tr><td><strong>Temp Passord</strong> </td><td>" . $tmp_password. "</td></tr>";
$message .= "</table>";
$message .= "<tr><td><strong>Du må logginn med www.budoren.no og bytte passord.</strong> </td><td>";
$message .='<br /><br />';
$message .= '<table rules="all" style="border-color: #407BF6;background: #E6E6E6;" cellpadding="10">';

$message .= "</body></html>";

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


$headers .= 'From: Budoren <post@budoren.no>' . "\r\n";

// Mail it
$retval=mail($to, $subject, $message, $headers);
if( $retval == true )
   {
?> 
     <br><br><br><br><br><br><br>Kunder er registrert og sende e-post varsle til kunde...
 <?php     
   }
   else
   {
   ?> 
<br><br><br><br><br>Message could not be sent...
 
 <?php    }


$mysqli->close();
}
function generate_password( $length = 10 ) {
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$";
$password = substr( str_shuffle( $chars ), 0, $length );
return $password;
}
?> 

	   </div>

</body>
</html>