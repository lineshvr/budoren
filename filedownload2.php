<?php
// connect and login to FTP server
/* $ftp_server = "ftp.domeneshop.no";
$ftp_username="budoren";
$ftp_userpass="i496RCkx";
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
$name2=$_POST['filepath'];
echo $name2;
	
$local_file = "local.xlsx";
$server_file = $name2;


$file = basename($_POST['filepath']);


if(!$file){ // file does not exist
    die('file not found');
} else {
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$file");
    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: binary");

    // read the file from disk
  //  readfile($file);
}


// download server file
if (ftp_get($ftp_conn, $local_file, $server_file, FTP_BINARY))
  {
  echo "Successfully written to $local_file.";
  }
else
  {
  echo "Error downloading .".$server_file."        file ".$ftp_conn;
  }

// close connection
ftp_close($ftp_conn); */



$file = basename($_POST['filepath']);
echo "file name".$file;
//$path = "/absolute_path_to_your_files/"; // change the path to fit your websites document structure
$path ="/www/uploadfiles/Wild/";
header("Content-Disposition: attachment; filename=".$file);
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Length: " . filesize($file));
header("Content-Transfer-Encoding: binary");
header("Cache-Control: must-revalidate");
header("Pragma: public");
ob_clean();
flush(); 
readfile($file);
?> 