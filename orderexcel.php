
    <?php
    //Start session
   session_start();

    if(!isset($_SESSION['sess_customername']) || (trim($_SESSION['sess_customerid']) == ''))
    		{		
				header("location: loginn.html");
				exit();
    		}
  
      	?>

<!DOCTYPE HTML>
<!--
	Helios by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>budoren</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
		<script src="js/jquery-1.10.1.js"></script>
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
			<link rel="stylesheet" href="css/table.css" />
		</noscript>
	</head>
 <?php
		include('dbcon.php');?>
		
		<body class="no-sidebar">

    <?php include('customermenu.html');?>

<h2 class="h1Style"></h2>
<?php
/** Error reporting */
error_reporting(E_ALL);
	$counterNum=Array();
/** Include path **/
ini_set('include_path', ini_get('include_path').';../Classes/');

	


/** PHPExcel */
include 'PHPExcel.php';

require_once 'Classes/PHPExcel/IOFactory.php';
/** PHPExcel_Writer_Excel2007 */
include 'PHPExcel/Writer/Excel2007.php';

// Create new PHPExcel object
////////echodate('H:i:s') . " Create new PHPExcel object\n";
$objPHPExcel = new PHPExcel();
$sqlchild  = "INSERT INTO kino_order_data";
$itemList=array();

$tmp_melding= $_POST['Melding'];
$tmp_dato= $_POST['sistedato'];
 $mailsend=false;
// Set properties
////////echodate('H:i:s') . " Set properties\n";
$objPHPExcel->getProperties()->setCreator("Budoren");
$objPHPExcel->getProperties()->setLastModifiedBy("Budoren");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("Bestlle skjema");


////////echodate('H:i:s') . " Add some data\n";

	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, "Kinonummer");
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, "Kino navn");
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 1, "Teaser");
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, 1, "Regulær");
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, 1, "Bannere");
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, 1, "DCP");
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, 1, "Mellomstandeer");
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, 1, "Småstandeer");
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, 1, "Storestandeer");
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, 1, "Kommentar");

$row = 2; // kinonummer

    $col = 0;
	

if(isset($_POST["kinonummer"])){
   
    $capture_field_vals ="";
	
    foreach($_POST["kinonummer"] as $key => $text_field){
//////echo"1  ".$text_field."  time  ".$key."<br>";
        $capture_field_vals[]= $text_field;
    }
	$cntr=1;
	    foreach($_POST["kinonummer"] as $key => $text_field){
/////echo"2 Kinonummer".$key."2 value ".$text_field."<br>";
	$counterNum[$cntr]= $key;
	$cntr=$cntr+1;
    }

$arrlength=count($counterNum);
//////echo"2.1 Number of Kino".$arrlength."<br>";
$found=false;

   foreach ($capture_field_vals as $key=>$value) {
 //////echo"3 length of kino".$arrlength." capture_field_valscome  ". $value."<br>";

	for($x=1;$x<=$arrlength;$x++)
	{
		//////echo" 4 x value  ".$counterNum[$x]."  x ".$x."  value   "."$value<br>";
			if($counterNum[$x]==$value)
			{
				//////echo" 5 found  ".$x." value of key ".$key." counter value".$counterNum[$x]."<br>";
				$found=true;
				break; 
			}
	}
if($found){
 //////////echo" found here  ". $value."<br>";
           $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
	 
    $row++;
	 ////print "hello"."$value <br>"."$row"."$col";

}
$found=false;
}
}

$row = 2; // 0-Kinonavn
$col = 1;

if(isset($_POST["Kinonavn"])){
   
    $capture_field_vals ="";
$ctr=1;
    foreach($_POST["Kinonavn"] as $key => $text_field){
	//echo"kinonavn".$text_field;
        $capture_field_vals[$ctr]= $text_field;
		$ctr=$ctr+1;
    }

	$cntr=1;
   foreach($_POST["kinonummer"] as $key => $text_field){
   	////////echo"kinonavn kinonummer".$key;
	$counterKinonavn[$cntr]= $key;
	$cntr=$cntr+1;
    }	

$arrlength=count($counterKinonavn);
////////echo"counter variable in kinonavn ".$arrlength."<br>";
$found=false;
   
   foreach ($capture_field_vals as $key=>$value) {
          for($x=1;$x<=$arrlength;$x++) {
	
 if($counterKinonavn[$x]==$key){
   ////////echo" found  ".$x." value of key ".$key." counter value".$counterKinonavn[$x]."<br>";
 $found=true;
    break; 
	}
	}
if($found){
 //////////echo" found here  ". $value."<br>";
           $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
	 
    $row++;
	 ////print "hello"."$value <br>"."$row"."$col";

}
$found=false;

}
}

$row = 2; // 0-Teaserplakat

    $col = 2;
	
if(isset($_POST["Teaserplakat"])){
   
    $capture_field_vals ="";
	$ctr=1;
    foreach($_POST["Teaserplakat"] as $key => $text_field){
        $capture_field_vals[$ctr]= $text_field;
		$ctr=$ctr+1;
    }
	$cntr=1;
	   foreach($_POST["kinonummer"] as $key => $text_field){
	$counterTeaserplakat[$cntr]= $key;
	$cntr=$cntr+1;
    }
  $arrlength=count($counterTeaserplakat);
$found=false; 
   foreach ($capture_field_vals as $key=>$value) {
      for($x=1;$x<=$arrlength;$x++) {
	
 if($counterTeaserplakat[$x]==$key){
   //////////echo" found  ".$x." value of key ".$key." counter value".$counterNum[$x]."<br>";
 $found=true;
    break; 
	}
	}
if($found){
 //////////echo" found here  ". $value."<br>";
           $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
	 
    $row++;
	 ////print "hello"."$value <br>"."$row"."$col";

}
$found=false;

}
}

$row = 2; // 0-Hovedplakat

    $col = 3;
	
if(isset($_POST["Hovedplakat"])){
   
    $capture_field_vals ="";
	$ctr=1;
    foreach($_POST["Hovedplakat"] as $key => $text_field){
        $capture_field_vals[$ctr]= $text_field;
		$ctr=$ctr+1;
    }
	$cntr=1;
	foreach($_POST["kinonummer"] as $key => $text_field){
	$counterHovedplakat[$cntr]= $key;
	$cntr=$cntr+1;
	}  
$arrlength=count($counterHovedplakat);
$found=false;
   foreach ($capture_field_vals as $key=>$value) {
          for($x=1;$x<=$arrlength;$x++) {
	
 if($counterHovedplakat[$x]==$key){
   //////////echo" found  ".$x." value of key ".$key." counter value".$counterNum[$x]."<br>";
 $found=true;
    break; 
	}
	}
if($found){
 //////////echo" found here  ". $value."<br>";
           $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
	 
    $row++;
	 ////print "hello"."$value <br>"."$row"."$col";

}
$found=false;

}
}

$row = 2; // Bannere

    $col = 4;
	
if(isset($_POST["Bannere"])){
   
    $capture_field_vals ="";
	$ctr=1;
    foreach($_POST["Bannere"] as $key => $text_field){
        $capture_field_vals[$ctr]= $text_field;
		$ctr=$ctr+1;
    }
	$cntr=1;
	foreach($_POST["kinonummer"] as $key => $text_field){
	$counterBannere[$cntr]= $key;
	$cntr=$cntr+1;
	}
	$arrlength=count($counterBannere);
	$found=false;
   
   foreach ($capture_field_vals as $key=>$value) {
          for($x=1;$x<=$arrlength;$x++) {
	
 if($counterBannere[$x]==$key){
   //////////echo" found  ".$x." value of key ".$key." counter value".$counterNum[$x]."<br>";
 $found=true;
    break; 
	}
	}
if($found){
 //////////echo" found here  ". $value."<br>";
           $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
	 
    $row++;
	 ////print "hello"."$value <br>"."$row"."$col";

}
$found=false;

}
}

$row = 2; // DCP

    $col = 5;
	
if(isset($_POST["DCP"])){
   
    $capture_field_vals ="";
	$ctr=1;
    foreach($_POST["DCP"] as $key => $text_field){
        $capture_field_vals[$ctr]= $text_field;
		$ctr=$ctr+1;
    }
	
	$cntr=1;
	foreach($_POST["kinonummer"] as $key => $text_field){
	$counterDCP[$cntr]= $key;
	$cntr=$cntr+1;
	}
  $arrlength=count($counterDCP);
$found=false; 
   foreach ($capture_field_vals as $key=>$value) {
         for($x=1;$x<=$arrlength;$x++) {
	
 if($counterDCP[$x]==$key){
   //////////echo" found  ".$x." value of key ".$key." counter value".$counterNum[$x]."<br>";
 $found=true;
    break; 
	}
	}
if($found){
 //////////echo" found here  ". $value."<br>";
           $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
	 
    $row++;
	 ////print "hello"."$value <br>"."$row"."$col";

}
$found=false;

}
}

$row = 2; // Mellomstandeer

    $col = 6;
	
if(isset($_POST["Mellomstandeer"])){
   
    $capture_field_vals ="";
	$ctr=1;
    foreach($_POST["Mellomstandeer"] as $key => $text_field){
        $capture_field_vals[$ctr]= $text_field;
		$ctr=$ctr+1;
    }
	$cntr=1;
		   foreach($_POST["kinonummer"] as $key => $text_field){
	$counterMellomstandeer[$cntr]= $key;
	$cntr=$cntr+1;
    }
  $arrlength=count($counterMellomstandeer);
$found=false; 
   foreach ($capture_field_vals as $key=>$value) {
        for($x=1;$x<=$arrlength;$x++) {
	
 if($counterMellomstandeer[$x]==$key){
   //////////echo" found  ".$x." value of key ".$key." counter value".$counterNum[$x]."<br>";
 $found=true;
    break; 
	}
	}
if($found){
 //////////echo" found here  ". $value."<br>";
           $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
	 
    $row++;
	 ////print "hello"."$value <br>"."$row"."$col";

}
$found=false;

}
}

$row = 2; // Smastandeer

    $col = 7;
	
if(isset($_POST["Smastandeer"])){
   
    $capture_field_vals ="";
	$ctr=1;
    foreach($_POST["Smastandeer"] as $key => $text_field){
        $capture_field_vals[$ctr]= $text_field;
		$ctr=$ctr+1;
    }
	$cntr=1;
foreach($_POST["kinonummer"] as $key => $text_field){
$counterSmastandeer[$cntr]= $key;
$cntr=$cntr+1;
}
   $arrlength=count($counterSmastandeer);
$found=false;
   foreach ($capture_field_vals as $key=>$value) {
          for($x=1;$x<=$arrlength;$x++) {
	
 if($counterSmastandeer[$x]==$key){
   //////////echo" found  ".$x." value of key ".$key." counter value".$counterNum[$x]."<br>";
 $found=true;
    break; 
	}
	}
if($found){
 //////////echo" found here  ". $value."<br>";
           $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
	 
    $row++;
	 ////print "hello"."$value <br>"."$row"."$col";

}
$found=false;

}
}

$row = 2; // Storestandeer

    $col = 8;
	
if(isset($_POST["Storestandeer"])){
   
    $capture_field_vals ="";
	$ctr=1;
    foreach($_POST["Storestandeer"] as $key => $text_field){
        $capture_field_vals[$ctr]= $text_field;
		$ctr=$ctr+1;
    }
	$cntr=1;
	foreach($_POST["kinonummer"] as $key => $text_field){
	$counterStorestandeer[$cntr]= $key;
	$cntr=$cntr+1;
	}
	$arrlength=count($counterStorestandeer);
	$found=false; 
   foreach ($capture_field_vals as $key=>$value) {
         for($x=1;$x<=$arrlength;$x++) {
	
 if($counterStorestandeer[$x]==$key){
   //////////echo" found  ".$x." value of key ".$key." counter value".$counterNum[$x]."<br>";
 $found=true;
    break; 
	}
	}
if($found){
 //////////echo" found here  ". $value."<br>";
           $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
	 
    $row++;
	 ////print "hello"."$value <br>"."$row"."$col";

}
$found=false;

}
}


$row = 2; // Kommentar

    $col = 9;
	
if(isset($_POST["Kommentar"])){
   
    $capture_field_vals ="";
	$ctr=1;
    foreach($_POST["Kommentar"] as $key => $text_field){
        $capture_field_vals[$ctr]= $text_field;
		$ctr=$ctr+1;
    }
	$cntr=1;
	foreach($_POST["kinonummer"] as $key => $text_field){
	$counterKommentar[$cntr]= $key;
	$cntr=$cntr+1;
	}
	$arrlength=count($counterKommentar);
	$found=false;
   foreach ($capture_field_vals as $key=>$value) {
         for($x=1;$x<=$arrlength;$x++) {
	
 if($counterKommentar[$x]==$key){
   //////////echo" found  ".$x." value of key ".$key." counter value".$counterNum[$x]."<br>";
 $found=true;
    break; 
	}

	}
if($found){
 //////////echo" found here  ". $value."<br>";
           $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
	 
    $row++;
	 ////print "hello"."$value <br>"."$row"."$col";

}
$found=false;

}
}
	
// Rename sheet
////////echodate('H:i:s') . " Rename sheet\n";
$objPHPExcel->getActiveSheet()->setTitle('Budoren');

	
// Save Excel 2007 file
////////echodate('H:i:s') . " Write to Excel2007 format\n";
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

 $FilmNameArray = explode(',',$_POST['value']);
 
//echo "FilmNameArray    ".$FilmNameArray;
foreach ($FilmNameArray as $key=>$filmName) {


$sql_filmdata="SELECT film_id FROM film_data WHERE film_name='$filmName'";

$rsfilmdata=$mysqli ->query($sql_filmdata);


//echo "sql_filmdata".$sql_filmdata;
 	if (!$mysqli->set_charset("utf8")) 
 	{
																		  
  printf("Error loading character set utf8: %s\n", $mysqli->error);
	} 
	else {
	   // printf("Current character set: %s\n", $mysqli->character_set_name());
	}

	while ($rowfilmdata = $rsfilmdata->fetch_assoc()) {
	//echo "<br>"."filmid ".$rowfilmdata['film_id']."<br>";
$itemList[]=$rowfilmdata['film_id'];
	
			
		}


}

function makeDir($path)
{
   $ret = mkdir($path); // use @mkdir if you want to suppress warnings/errors
   return $ret === true || is_dir($path);
}
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
$counter=1;
$fileUploaded=FALSE;
foreach ($FilmNameArray as $key=>$value) {
$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/orderedfiles/'.$value;
//echo "Folder name".$uploaddir ;
$chkDirCreated =makeDir($uploaddir);
//echo "chkDirCreated name".$chkDirCreated ;
$utc = new DateTimeZone('UTC');
$pdt = new DateTimeZone('Europe/Oslo');
$today = date("Y-m-d H:i:s");
$timestamp=$today;
$objWriter->save($uploaddir."/".$value."_".$timestamp.'.xlsx');
$uploaded_file_name[$counter]=$uploaddir."/".$value."_".$timestamp.'.xlsx';
$upfilmname[$counter]=$value;
/////echo date('H:i:s') . " Done writing file.\r\n";
      
  	  
$fileUploaded=TRUE;	 
$counter=$counter+1; 
	  
}

if ($fileUploaded == 1)
		  {
			//echo "inside ".$fileUploaded;	  
							$cntr=1;
			foreach ($itemList as $key=>$value) 
				{
					$tmp_filmid= $value ;
	
					//echo "inside for ".$tmp_filmid;	
					$sql = "INSERT INTO orderdata (order_id,film_id,Orderdate,meldingtillager,sistelagerdato) VALUES ('',$tmp_filmid,now(),'$tmp_melding','$tmp_dato')";

 	
					if (mysqli_connect_errno()) 
						{
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}


						if (!$mysqli->set_charset("utf8")) 
						{
						printf("Error loading character set utf8: %s\n", $mysqli->error);
						} 
						else {
						 //printf("Current character set: %s\n", $mysqli->character_set_name());
						}

						//echo"insert ordet   ".$sql;
			// Check connection
						$result = $mysqli->query($sql);
						$last_record_filmid=mysqli_insert_id($mysqli);
						//echo "last inserted record".$last_record_filmid;
							if (!$result) 
								{
									printf("%s\n", $mysqli->error);
									exit();
								}
								else
								{  
								
								$sqlfileuploadtable = "INSERT INTO order_file_details (order_file_detail_id,order_id,path,Order_date) VALUES ('',$last_record_filmid,'$uploaded_file_name[$cntr]',now())";
								//echo "Sql File".$sqlfileuploadtable;
								$resultUploaded = $mysqli->query($sqlfileuploadtable);
								//echo "Sql resultUploaded ".$resultUploaded;
									if (!$resultUploaded)
									{
										printf("%s\n", $mysqli->error);
										exit();
									}
									else
									{ 	//echo "Come her i else".$upfilmname[$cntr]."Siste Dato".$tmp_dato;
										mailsend($upfilmname[$cntr],$tmp_dato,$tmp_melding);
									
									}
									
								}

						$cntr=$cntr+1;
					}
					

		
					
			}
       else
			{
			   die("Error uploading file.  Please contact an administrator");
            }
     function mailsend($filmname,$sistelagerdato,$tmp_melding)
                {
      /*        $temp_customnm=$_SESSION['sess_customername'];


$sqlmail="select * from customer_information where customer_name ='$temp_customnm';";
//echo "sqlmail  ".$sqlmail;


if (!$mysqli->set_charset("utf8")) 
 	{
																		  
  printf("Error loading character set utf8: %s\n", $mysqli->error);
	} 
	else {
		   printf("Current character set: %s\n", $mysqli->character_set_name());
	}

$resultsqlmail  = $mysqli->query($sqlmail);
//echo "komme her".$resultsqlmail;

while($rowcustdata= $resultsqlmail->fetch_assoc()){
		$emailadd[]= $rowcustdata['customer_emailid'];
}
//echo $emailadd;
$to  =$emailadd[0];	
*/

//$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
// subject
$subject = 'New Product from OsloBudOReN.';



     //Normal headers
$to="post@budoren.no";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
// subject
$subject = 'New Product from OsloBudOReN.';

// message
$message = '<html><body>';

$message .='<br /><h3>Bestille </h3><br />';

$message .= '<table rules="all" style="border-color: #407BF6;background: #eee;" cellpadding="10">';

$message .= "<tr ><td><strong>Film navn:</strong> </td><td>" . strip_tags($filmname) . "</td></tr>";
$message .= "<tr ><td><strong>Sistelagerdato:</strong> </td><td>" . strip_tags($sistelagerdato) . "</td></tr>";
$message .= "<tr ><td><strong>Melding:</strong> </td><td>" . strip_tags($tmp_melding) . "</td></tr>";

$message .= "</table>";

$message .= "</table>"; 
$message .= "</body></html>";

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
//$headers .= 'To: Mary <divchandran@gmail.com>, Kelly <linesh.vr@gmail.com>' . "\r\n";
$headers .= 'To: <post@budoren.no>' . "\r\n";

$headers .= 'From: OsloBudoren <post@budoren.no>' . "\r\n";

// Mail it
$retval=mail($to, $subject, $message, $headers);
if( $retval == true )
   {
   $GLOBALS['$mailsend']=true;
      echo "<br><br><br><br><br><br><br>Produktet har registrert og sende e-post varsle til kunde...";
   }
   else
   {
    $GLOBALS['$mailsend']=false;
  // echo "come 2".$mailsend;
      echo "<br><br><br><br><br>Message could not be sent...";
   }

}

?>


	
	</body>

</html>