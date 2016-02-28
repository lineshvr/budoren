<?php
if(isset($_POST['submit'])){
// Create connection
   $tmp_kino = $_POST['kino'];
   $tmp_kinoaddress = $_POST['kino_address'];
   $tmp_kinocity = $_POST['kino_city'];
   $tmp_kinopostnumber= $_POST['kino_postnumber'];
   $tmp_kinoemailaddress= $_POST['kino_emailid'];   

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

  echo "Kino registeret";
  


$mysqli->close();
}

?> 