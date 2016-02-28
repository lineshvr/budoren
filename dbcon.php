<?php

//	$link = mysql_connect('budoren.mysql.domeneshop.no', 'budoren', 'Viqvt3vA');

	//@mysql_select_db('budoren',$link);	
$mysqli = mysqli_connect("budoren.mysql.domeneshop.no","budoren","Viqvt3vA","budoren");

if (mysqli_connect_errno($mysqli)) {
   printf("Connect failed: %s\n", mysqli_connect_error());
   exit();
}else{
//printf("Connect \n");
if (!$mysqli->set_charset("utf8")) 
 	{
																		  
  printf("Error loading character set utf8: %s\n", $mysqli->error);
	} 
	else {
	 // printf("Current character set: %s\n", $mysqli->character_set_name());
	}
}
mysqli_close($mysqli);

?>