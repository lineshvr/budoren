<?php
//This application is developed by www.webinfopedia.com
//visit www.webinfopedia.com for PHP,Mysql,html5 and Designing tutorials for FREE!!!

include('dbcon.php');

$sql_path="SELECT shipmentpath FROM budoren.orderdata where order_id='85'";

$rsfilmpath=$mysqli ->query($sql_path);

//echo "sql_filmdata".$sql_filmdata;
 	if (!$mysqli->set_charset("utf8")) 
 	{
																		  
  printf("Error loading character set utf8: %s\n", $mysqli->error);
	} 
	else {
	   // printf("Current character set: %s\n", $mysqli->character_set_name());
	}

	while ($rowfilmpath = $rsfilmpath->fetch_assoc()) {
$tmp_filmname=$rowfilmpath ['shipmentpath'];
	
			
		}
echo $tmp_filmname;
$File_name = $tmp_filmname;


// connect and login to FTP server
$ftp_server = "ftp.domeneshop.no";
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
$ftp_username="budoren";
$ftp_userpass="i496RCkx";
$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);

$local_file = "kino.xls";
$server_file = "kino.xls";

// download server file
if (ftp_get($ftp_conn, $local_file, $server_file, FTP_BINARY))
  {
  echo "Successfully written to $local_file.";
  }
else
  {
  echo "Error downloading $server_file.";
  }

// close connection
ftp_close($ftp_conn);
?> 