<!DOCTYPE HTML>
<!--
	Helios by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
 <title>budoren</title>
		<?php

if(isset($_POST['submit'])){

   $tmp_firstname= $_POST['firstname'];
   $tmp_lastname= $_POST['lastname'];
   $tmp_emailid= $_POST['emailid'];
   $tmp_userinput=$_POST['userinput'];

include('dbcon.php');

$sql_filmName ="insert into contactdata (contactid,	firstname,lastname,email,inquiry,contactdate) values ('',  '$tmp_firstname','$tmp_lastname','$tmp_emailid','$tmp_userinput',now())";
$result = $mysqli->query($sql_filmName);

$result = true;


if (!$result) {
   printf("%s\n", $mysqli->error);
   exit();
}
$emailadd='post@budoren.no';


//printf("%s",$emailadd);
//printf("connect");
$to  =$emailadd;
//printf("%s",$to);
// . ', '; // note the comma
$to .= 'post@budoren.no';
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
// subject
$subject = 'kontaktskjema';
$tmp_firstname=$tmp_firstname.$tmp_lastname;
// message
$message = '<html><body>';
//$message .= '<img src="http://css-tricks.com/examples/WebsiteChangeRequestForm/images/wcrf-header.png" alt="Website Change Request" />';
$message .='<br /><h3>Ny Kontakt' . strip_tags($temp_customnm) .'</h3><br />';

$message .= '<table rules="all" style="border-color: #407BF6;background: #eee;" cellpadding="10">';
$message .= "<tr ><td><strong>Name:</strong> </td><td>" . strip_tags($tmp_firstname) . "</td></tr>";
$message .= "<tr><td><strong>E-Post:</strong> </td><td>" . strip_tags($tmp_emailid) . "</td></tr>";
$message .= "<tr><td><strong>Kontaktskjema:</strong> </td><td>" . strip_tags($tmp_userinput) . "</td></tr>";
//$addURLS = $_POST['addURLS'];
$message .= "</table>";
$message .= "</body></html>";


// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
//$headers .= 'To: Mary <divchandran@gmail.com>, Kelly <linesh.vr@gmail.com>' . "\r\n";
$headers .= 'To: post <post@budoren.no>' . "\r\n";

$headers .= 'From: Kontaktskjema<post@budoren.no>' . "\r\n";

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

}
mysqli_close($mysqli);
?>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>

		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/jquery.scrolly.min.js"></script>
		<script src="js/jquery.onvisible.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<script src="js/loginvalidation.js"></script>

		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
			<link rel="stylesheet" href="css/style-noscript.css" />
			<link rel="stylesheet" href="css/style2.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
	</head>
	<body class="left-sidebar">

	<div id="masthead">
		<img alt="" height="66" src="images/sample_red.png" width="150" />
		 
		
	</div>
		<!-- Header -->

				<div id="header">
				<!-- Inner 
					<div class="inner">
						<header>
							<h1><a href="index.html" id="logo">BudORen</a></h1>
						</header>
					</div>
				-->
				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a href="index.html">Hjem</a></li>
                            <li><a href="about.html">Om BUD O REN</a></li>
                            <li><a href="services.html">Tjenster</a></li>
                            <li><a href="kunder.html">Kunder</a></li>
							<li><a href="kontaktskjema.php">Kontakt</a></li>
                            <li><a href="kart.html">Kart</a></li>
                           	<li><a href="loginn.html">Logg inn</a></li> 
						</ul>
					</nav>

			</div>
            
		<!-- Main -->
      
								<h3 align="center">	
							Kontaktskjema
							</h3>
						
			<div class="wrapper style1">

				<div class="container">
					<div class="row 80%">
						<div class="8u" id="sidebar">
							<hr class="first" />
					
		
										
<form method="post" action="<?php echo $PHP_SELF;?>">
<div class="auto-style10">
</div>
<table style="width: 100%">
	<tr>
		<td class="auto-style3" style="width: 616px">Fornavn
		*</td>
		<td style="width: 52px" class="auto-style4">&nbsp;</td>
		<td>

			<input name="firstname" type="text" required class="auto-style2"  />
		</td>
	</tr>
	<tr>
		<td class="auto-style3" style="width: 616px">Etternavn
		*</td>
		<td style="width: 52px" class="auto-style4">&nbsp;</td>
		<td>

			<input name="lastname" type="text" required class="auto-style2" />
		</td>
	</tr>
	<tr>
		<td class="auto-style3" style="width: 616px">E-post
		*</td>
		<td style="width: 52px" class="auto-style4">&nbsp;</td>
		<td class="auto-style6">

			<input name="emailid" type="text" required class="auto-style2" /><span class="auto-style2">
			</span>
		</td>
	</tr>
	<tr>
		<td style="width: 616px; height: 33px;" class="auto-style4"></td>
		<td class="auto-style4" style="height: 33px; width: 52px;"></td>
	</tr>
	<tr>
		<td class="auto-style3" style="width: 616px">Saken gjelder *</td>
		<td style="width: 52px" class="auto-style4">&nbsp;</td>
		<td>

			<textarea name="userinput" style="width: 548px; height: 210px" required class="auto-style2" ></textarea></td>
	</tr>
	<tr>
		<td class="auto-style3" style="width: 616px">&nbsp;</td>
		<td style="width: 52px" class="auto-style2">&nbsp;</td>
		<td class="auto-style2">&nbsp;</td>
	</tr>
</table>
	  <div class="auto-style9">
	  	<span lang="no-bok">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  </span>
	  <input name="submit" type="Submit" value="Submit" class="auto-style2"/><span lang="no-bok">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  </span><input name="Reset1" type="Reset" value="Reset" class="auto-style2"></div>
</form>

								</p>
		
							</section>

						</div>
	
											</div></div>	
						</div>

		
	<!-- Footer -->
	<div id="footer">
				<div class="container">
					
				
					<div class="row">
						<div class="12u">
							
							<!-- Contact -->
								<section class="contact">
									<header>
										<h3>BudORen i sosiale medier</h3>
									</header>
									
									<ul class="icons">
										<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
										<li><a href="#" class="icon fa-pinterest"><span class="label">Pinterest</span></a></li>
										<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
										<li><a href="#" class="icon fa-linkedin"><span class="label">Linkedin</span></a></li>
									</ul>
								</section>
							
							<!-- Copyright -->
								<!-- Copyright -->
								<div class="copyright">
									<ul class="menu">
										<li>Copyright &copy; 2014 Oslo BUD O REN Norway. All Rights Reserved.</li>
									</ul>
								</div>
							
						</div>
					
					</div>
				</div>
			</div>

	<!-- End Footer -->



	</body>
</html>