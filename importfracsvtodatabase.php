<?php 

//connect to the database
//connect to the database
$mysqli = new mysqli("budoren.mysql.domeneshop.no","budoren","Viqvt3vA","budoren");

if (mysqli_connect_errno()) {
   printf("Connect failed: %s\n", mysqli_connect_error());
   exit();
}

//

if ($_FILES[csv][size] > 0) {

    //get the csv file
    $file = $_FILES[csv][tmp_name];
    $handle = fopen($file,"r");
    
    //loop through the csv file and insert into database
    do {
        if ($data[0]) {
        print($data[0]);
        

          $sql = "INSERT INTO kino_liste (kino_id, kino_name, Teaser,Regulær,Bannere,DCP,Mellomstandeer,Småstandeer,Storestandeer,Kommentar) VALUES
               (
                    '".addslashes($data[0])."',
                    '".addslashes($data[1])."',
					'".addslashes($data[2])."',
					'".addslashes($data[3])."',
                    '".addslashes($data[4])."',
					'".addslashes($data[5])."',
					'".addslashes($data[6])."',
					'".addslashes($data[7])."',
					'".addslashes($data[8])."',
                    '".addslashes($data[9])."'
                )
            ";
            
                    $result = $mysqli->query($sql);
if (!$result) {
   printf("%s\n", $mysqli->error);
   exit();
}

        }
    } while ($data = fgetcsv($handle,1000,",","'"));
    //

    //redirect
    header('Location: importfracsvtodatabase.php?success=1'); die;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
<title>Import a CSV File with PHP & MySQL</title>
</head>

<body>

<?php if (!empty($_GET[success])) { echo "<b>Your file has been imported.</b><br><br>"; } //generic success notice ?>

<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  Choose your file: <br />
  <input name="csv" type="file" id="csv" />
  <input type="submit" name="Submit" value="Submit" />
</form>

</body>
</html> 