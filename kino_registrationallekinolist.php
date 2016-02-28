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

 <title>Budoren</title>
			<meta charset="utf-8">
			<script type="text/javascript" src="js/loginvalidation.js"></script>
		<link href="styles/mystyle.css" media="screen" rel="stylesheet" title="CSS" type="text/css" />			

</head>
<body>
       <?php include('usermenu.html');?>
 <br/>
<br/>

 <h1 class="h1Style">AllekinoListe - Ny Kino Registrering</h1>

<?php
if(isset($_POST['submit'])){
// Create connection
   $tmp_kino = $_POST['kino'];
   $tmp_kinoaddress = $_POST['kino_address'];
   $tmp_kinocity = $_POST['kino_city'];
   $tmp_kinopostnumber= $_POST['kino_postnumber'];
   $tmp_kinoemailaddress= $_POST['kino_emailid'];   

   
$tmp_kinoteaser=$_POST['kino_teaser'];
$tmp_kinobannere=$_POST['kino_bannere'];
$tmp_kinoregular=$_POST['kino_regular'];
$tmp_kinodcp=$_POST['kino_dcp'];
$tmp_kinomellomstandeer=$_POST['kino_mellomstandeer'];
$tmp_kinosmastandeer=$_POST['kino_smastandeer'];
$tmp_kinostorestandeer=$_POST['kino_storestandeer'];
$tmp_kinokommentar=$_POST['kino_kommentar'];

 //  query("INSERT INTO t (field) VALUES ('value');")
//$sql = "INSERT INTO user_information (first_name,last_name,password) VALUES ('"$tmp_firstname"','"$tmp_lastname"','" $tmp_password"')";

$sql = "INSERT INTO kino_detail ".
       "(kino_id,kino,kino_address,kino_city,kino_postnumber,kino_emailid) ".
       "VALUES ".
       "('','$tmp_kino','$tmp_kinoaddress','$tmp_kinocity','$tmp_kinopostnumber', '$tmp_kinoemailaddress')";
$mysqli = new mysqli("budoren.mysql.domeneshop.no","budoren","Viqvt3vA","budoren");

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

$sqllisteinsert = "INSERT INTO kino_liste ".
       "(kino_id,kino,teaser,bannere,regular,dcp,mellomstandeer,smastandeer,storestandeer,kommentar) ".
       "VALUES ".
       "('','$tmp_kino','$tmp_kinoteaser','$tmp_kinobannere','$tmp_kinoregular', '$tmp_kinodcp', '$kinomellomstandeer', '$kinosmastandeer', '$kinostorestandeer', '$kinokommentar')";
$mysqli = new mysqli("budoren.mysql.domeneshop.no","budoren","Viqvt3vA","budoren");
$result = $mysqli->query($sqllisteinsert);
if (!$result) {
   printf("%s\n", $mysqli->error);
   exit();
}
  echo "Kino registeret";
  


$mysqli->close();
}

?> 
</body>
</html>