<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<!-- #BeginEditable "doctitle" -->
<title>budoren</title>
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
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
			<link rel="stylesheet" href="css/style-noscript.css" />
		</noscript>
<!-- #EndEditable -->

  
  <script>
function showHint() {
  username=document.getElementById("username").value;
  if (username.length==0) {
    document.getElementById("txtHint").innerHTML="";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }

  xmlhttp.open("GET","loginncheck.php?q="+username,true);
  xmlhttp.send();
}
</script>
</head>

<body class="left-sidebar">
    
    

	<div id="masthead">
		<img alt="" height="66" src="images/sample_red.png" width="150" />
		
		 
		
	</div>
	<!-- End Masthead -->
	<!-- Begin Navigation -->
		<!-- Header -->
			<div id="header">
				<!-- Inner
					<div class="inner">
						<header>
							<h1><a href="index.html" id="logo">BudORen</a></h1>
						</header>
					</div> -->
				
				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a href="index.html">Hjem</a></li>
                            <li><a href="about.html">Om Budoren</a></li>
                            <li><a href="services.html">Tjenster</a></li>
                            <li><a href="kunder.html">Kunder</a></li>
							<li><a href="kontaktskjema.php">Kontakt</a></li>
                            <li><a href="kart.html">Kart</a></li>
                           	<li><a href="loginn.html">Logg inn</a></li> 
						</ul>
					</nav>

			</div>
	<!-- End Navigation -->
	<!-- Begin Page Content -->
	<div id="page_content">
		<!-- Begin Left Column -->
		<div id="column_l">
			<!-- #BeginEditable "content" -->
			<br />
			<h3>
			<br />
	<span lang="no-bok">Glemt passord</span></h3>
		
        <br />
  


Fyll ut e-postadressen din så sender vi deg en e-post. Du trenger bare å klikke på lenken i e-posten, så kommer du til en side hvor du kan endre passordet.


			<br />
	Registrert e-post eller brukernavn		
		<form method="get" name="forgotpassform"> 	
<table style="width: 100%" align="center">
	<tr>

		<td class="auto-style5"><input class="input" name ="username"  id ="username" type="text"  size="50" placeholder="Registrert e-post eller brukernavn" ></td>
	
	</tr>
	

	
	</tr>

	<tr>
		<td style="width: 4%">&nbsp; </td>
		<td style="width: 3%" class="auto-style1"> </td>
			<td style="width: 10%">
			&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
	</tr>


	<tr>
		<td style="width: 4%"> 
			<input type="button"  name="submit" value="Submit" onclick="showHint()">
            <input name="Reset" type="reset" value="Reset"></td>
		<td style="width: 3%" class="auto-style1">&nbsp; </td>
			<td style="width: 10%">&nbsp;
			</td>
	</tr>
	<tr>
		<td style="width: 4%">&nbsp; </td>
		<td style="width: 3%" class="auto-style1">&nbsp; </td>
			<td style="width: 10%">&nbsp;
			</td>
	</tr>


	<tr>
		<td style="width: 4%"> <br />
		<br />
		<br />
		</td>
		<td style="width: 3%" class="auto-style1">&nbsp; </td>
			<td style="width: 10%">
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
		</td>
	</tr>


</table>

</form> <p> <span id="txtHint" style="background:#99CCFF;font-size:medium"></span></p>


			<!-- #EndEditable --></div>
		<!-- End Left Column -->
		<!-- Begin Right Column -->
		<!-- End Right Column -->
	</div>
	<!-- End Page Content -->
	<!-- Begin Footer -->

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
								<div class="copyright">
									<ul class="menu">
										<li>Copyright &copy; 2014 Oslo BudORen Norway. All Rights Reserved.</li>
									</ul>
								</div>
							
						</div>
					
					</div>
				</div>
			</div>

	<!-- End Footer -->
<!-- End Container -->

</body>
<!-- #EndTemplate -->

</html>
