 
    <?php
    //Start session
    session_start();

    if(!isset($_SESSION['sess_firstname']) || (!isset($_SESSION['sess_lastname'])))
    		{		
				header("location: loginn.html");
				exit();
    		}
  
      	?>

<!DOCTYPE html>
<html lang="no">
<head>
 <title>budoren</title>
			<meta charset="utf-8">
			<script type="text/javascript" src="js/loginvalidation.js"></script>
 <style type="text/css">
 .auto-style1 {
	 background-color: #66AFE9;
 }
 .auto-style2 {
	 color: #fff;
	 text-align: right;
 }
 
.auto-style3 {
	text-align: center;
}


 </style>

</head>
    <?php
		include('dbcon.php');?>

<body>

    <?php include('usermenu.html');?>

  
  <div class="text-center">
  	<h2>
  <span><strong>Betillesjemma</strong></span><strong> </strong></h2>
  </div>

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

<?php
   
		include('dbcon.php');

if(isset($_POST['submit'])){
// Create connection
   $tmp_firstname = $_POST['firstname'];
   $tmp_lastname = $_POST['lastname'];
   $tmp_address = $_POST['address'];
   $tmp_city = $_POST['city'];
   $tmp_postnumber= $_POST['postnumber'];
   $tmp_phonenumber_1= $_POST['phonenumber_1'];
   $tmp_phonenumber_2= $_POST['phonenumber_2'];   
   $tmp_emailaddress= $_POST['emailaddress'];   
   $tmp_password = $_POST['password'];
   $tmp_userpermission = "user";
 //  query("INSERT INTO t (field) VALUES ('value');")
//$sql = "INSERT INTO user_information (first_name,last_name,password) VALUES ('"$tmp_firstname"','"$tmp_lastname"','" $tmp_password"')";

$sql = "INSERT INTO user_information ".
       "(user_id,first_name,last_name,user_address,user_city,user_postnumber,user_permission,user_phonenumber_1,user_phonenumber_2,user_emailid,user_password) ".
       "VALUES ".
       "('','$tmp_firstname','$tmp_lastname','$tmp_address','$tmp_city','$tmp_postnumber', '$tmp_userpermission','$tmp_phonenumber_1','$tmp_phonenumber_2','$tmp_emailaddress','$tmp_password')";


if (mysqli_connect_errno()) {
   printf("Connect failed: %s\n", mysqli_connect_error());
   exit();
}

/* change character set to utf8 */
if (!$mysqli->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
} else {
    //printf("Current character set: %s\n", $mysqli->character_set_name());
}


// Check connection
$result = $mysqli->query($sql);
if (!$result) {
   printf("%s\n", $mysqli->error);
   exit();
}

  echo "Bruker her registret. " "<br />";
  


$mysqli->close();
}

?>
 </body>
    </html> 