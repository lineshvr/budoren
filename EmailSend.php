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
</style>
</head>
<body>
       <?php include('usermenu.html');?>

<?php

if(isset($_POST['submit'])){
// Create temporary variables
   $tmp_filmname= $_POST['filmname'];
   $tmp_filmlanguage= $_POST['film_language'];
   $tmp_filmabout= $_POST['film_about'];
   $tmp_customerid =$_POST['customer_name'];
   
   
   $temp_filmid="";
//echo($tmp_customerid);


$tmp_prd=array();
$tmp_qty=array();
			foreach ($_POST['product'] as $key => $value) {
			//echo $value . "<br />";
			$tmp_prd[]=$value;
			
			}

			foreach ($_POST['quantity'] as $key => $value) {
			    //echo $value . "<br />";
			  $tmp_qty[]=$value;
			}

//$mysqli = new mysqli("budoren.mysql.domeneshop.no","budoren","Viqvt3vA","budoren");

if (mysqli_connect_errno()) {
   printf("Connect failed: %s\n", mysqli_connect_error());
   exit();
}

/* change character set to utf8 */

if (!$mysqli->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
} else {
  // printf("Current character set: %s\n", $mysqli->character_set_name());
}

$sqlFilmID="SELECT customer_name FROM budoren.customer_information where customer_id=$tmp_customerid;";
//echo "sqlFilmID".$sqlFilmID."<br />";
// Check connection
$rsFilmID = $mysqli->query($sqlFilmID);

    
    if (!$rsFilmID) {
   printf("%s\n", $mysqli->error);
   exit();
}

while($rowFilmID= $rsFilmID->fetch_assoc()){
		
//printf("%s", $rowFilmID['film_id']);
		
		$temp_customername= $rowFilmID['customer_name'];
		
}

    
    
    
    


//$tmp_postItems = $_POST['data '];

  // printf("%s vakue\n", $temp_filmid);
// Create sql

if(isset($_POST['emailnotify']))
 {
if($last_record_filmstocksid=="")
$sqlmail="select customer_emailid from customer_information where customer_name ='$temp_customername';";
//echo "$sqlmail".$sqlmail;
$resultsqlmail  = $mysqli->query($sqlmail);
$emailadd=Array();
$emailadd="";
$cntr=1;
while($rowcustdata= $resultsqlmail->fetch_assoc()){
//echo "Email Address".$rowcustdata['customer_emailid'];
		$emailadd[$cntr]= $rowcustdata['customer_emailid'];
		$cntr=$cntr+1;
}


$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
// subject
$subject = 'New Product from OsloBudOReN.';
//echo "Email Address 2";
// message
$message = '<html><body>';
//$message .= '<img src="http://css-tricks.com/examples/WebsiteChangeRequestForm/images/wcrf-header.png" alt="Website Change Request" />';
$message .='<br /><h3>New Release </h3><br />';

$message .= '<table rules="all" style="border-color: #407BF6;background: #eee;" cellpadding="10">';
$message .= "<tr ><td><strong>Film navn:</strong> </td><td>" . strip_tags($_POST['filmname']) . "</td></tr>";
//$message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['filmname']) . "</td></tr>";
$message .= "<tr><td><strong>Språk:</strong> </td><td>" . strip_tags($_POST['film_language']) . "</td></tr>";
$message .= "<tr><td><strong>Litt info av film:</strong> </td><td>" . strip_tags($_POST['film_about']) . "</td></tr>";
$message .= "</table>";
//$message .= "<tr><td><strong>URL To Change (main):</strong> </td><td>" . $_POST['customer_name'] . "</td></tr>";
//$addURLS = $_POST['addURLS'];
$length = count($tmp_prd);
if($last_record_filmstocksid==""){
 $message .='<h3>Product detail and quantity</h3>';
$message .='<br /><br />';
$message .= '<table rules="all" style="border-color: #407BF6;background: #E6E6E6;" cellpadding="10">';

$message .= "<tr><td><strong>Product</strong> </td><td><strong>Quantity</strong> </td></tr>";

for ($i = 0; $i < $length; $i++) {
if(strip_tags($tmp_prd[$i])=="Melding"){
 $message .= "<tr><td>Filmeffekter/annet</td>";
$message .= "<td>" . strip_tags($tmp_qty[$i]) . "</td></tr>";
}
else
{
 $message .= "<tr><td>" . strip_tags($tmp_prd[$i]) . "</td>";
$message .= "<td>" . strip_tags($tmp_qty[$i]) . "</td></tr>";
}
}
}
else
{
$message .='<h3>Product detail and quantity</h3>';
$message .='<br /><br />';
$message .= '<table rules="all" style="border-color: #407BF6;background: #E6E6E6;" cellpadding="10">';

$message .= "<tr><td><strong>Product</strong> </td><td><strong>Quantity</strong> </td></tr>";
for ($i = 0; $i < $length; $i++) {
if(strip_tags($tmp_prd[$i])=="Melding"){
 $message .= "<tr><td>Filmeffekter/annet </td>";
$message .= "<td>" . strip_tags($tmp_qty[$i]) . "</td></tr>";
}
else
{
 $message .= "<tr><td>" . strip_tags($tmp_prd[$i]) . "</td>";
$message .= "<td>" . strip_tags($tmp_qty[$i]) . "</td></tr>";
}
}
}
$message .= "</table>"; 
$message .= "</body></html>";

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
//$headers .= 'To: Mary <divchandran@gmail.com>, Kelly <linesh.vr@gmail.com>' . "\r\n";
//$headers .= 'To: <linesh.vr@gmail.com>' . "\r\n";

$headers .= 'From: OsloBudoren <post@budoren.no>' . "\r\n";

// Mail it
$max = sizeof($emailadd);
//echo "max".$max;
for($cntr=1;$cntr<=$max;$cntr++){
//echo "subject".$emailadd[$cntr];
$retval=mail($emailadd[$cntr], $subject, $message, $headers);
$retval=true;
}
if( $retval == true )
   {
      echo "<br><br><br><br><br><br><br>Produktet har registrert og sende e-post varsle til kunde...";
   }
   else
   {
      echo "<br><br><br><br><br>Message could not be sent...";
   }

}
else{
 echo "<br><br><br><br><br><br>Produktet har registrert ...";


}
?>
<?php
$mysqli->close();
}

?>

</body>
</html>