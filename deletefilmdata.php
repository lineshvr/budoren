<!DOCTYPE html>
<html>
 <?php header('Content-Type: charset=utf-8'); ?>
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
  <br /><br />


<?php
	include('dbcon.php');
$tempfilmid= $_GET['filmid'];
$tempRequest= $_GET['request'];
if($tempRequest=="delete"){
if (!$mysqli->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
} else {
   // printf("Current character set: %s\n", $mysqli->character_set_name());
}
$sqlFilmDelete = "delete from film_data where film_id=$tempfilmid"; 
$resultFilmName = $mysqli->query($sqlFilmDelete);
if (!$resultFilmName) {
   printf("%s\n", $mysqli->error);
   exit();
}
else{ 



?>
 <h3>Sletter er ferdig.</h3>
 

  <?php

}
}
?>



</body>
</html>