   <!DOCTYPE html>
<html lang="en">
    <head>
    
			<title>budoren</title>
			<meta charset="utf-8">
			<script type="text/javascript" src="js/loginvalidation.js"></script>

    </head>

    <?php
    //Start session
    session_start();
     
    //Check whether the session variable SESS_MEMBER_ID is present or not
    if((!isset($_SESSION['sess_admfirstname'])) || (!isset($_SESSION['sess_admlastname']))) {
    header("location: loginn.html");
    exit();
    }
    ?>
 
     
    <body>
       <?php include('adminmenu.html');?>
  <br /><br />
	<h1>Welcome, <?php echo $_SESSION["sess_admfirstname"];
	
	
	//echo $_SESSION["sess_admlastname"];
	//	echo $_SESSION["sess_admmin"];
	
	?></h1>
    </body>
    </html>