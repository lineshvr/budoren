


<!DOCTYPE html>
<html>
<head>
 <title>budoren</title>
 
<style>
table, th, td {
    border: 1px solid black;
}
</style>

 <style type="text/css">
 .auto-style2 {
	 color: #fff;
	 text-align: right;
 }
 .auto-style4 {
	text-align: center;
}



 </style>
<script>
function goBack() {
    window.history.back()
}
</script>
</head>
    <?php
		include('dbcon.php');?>

<body>

    <?php include('customermenu.html');?>
   
 <br>
<br>
<br>
<br>
 <h1 class="h1Style">Bestillinglogg</h1>

<br>
<br>
 <button onclick="goBack()">Tilbake (Klikk her)</button>

   <?php
//$File_name = 'kino.xls';
$tempOrderid= $_GET['orderid'];
$tempOrderid=405;
//echo $tempOrderid;
$sql_path="SELECT * FROM budoren.order_file_details where order_id=$tempOrderid";

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
$tmp_filmname=$rowfilmpath ['path'];
	
			
		}
		
	$tmp_filmname="/www/uploadfiles/Wild/Wild_1424419405.xlsx";
//echo "tmp_filmname".$tmp_filmname;


$exp = array();

$str = $tmp_filmname;
 $path=explode("/",$str);
foreach ($path as  $key=>$value) {
if($key==7){
// echo "<br> $key <br> ";
$filmfolder=$value;
 }
 if($key==8){
 //echo "$key <br> ";
$filmname=$value;
 }

}

$File_name ="orderedfiles"."/".$filmfolder."/".$filmname;
//echo ($File_name);

//require_once '../class/database.php';
require_once 'Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load($File_name);

echo "<form action=\"simple-download.php\" method=\"post\">";
echo "<input type=\"text\" name=\"filepath\" value=\"$tmp_filmname\">";
echo "<input type=\"submit\" value=\"$tmp_filmname\">";
echo "</form>";
?>

<table border="1">
        <thead>
          <tr  BGCOLOR=FF6600>
		  	

      <th><font color=black>Kinonummer</font></th>
              <th><font color=black>Kino navn</font></th>
              <th><font color=black>Teaser</font></th>
              <th><font color=black>Regulær</font></th>
              <th><font color=black>Bannere</font></th>
              <th><font color=black>DCP</font></th>
              <th><font color=black>Mellomstandeer</th>
              <th><font color=black>Småstandeer</font></th>
			<th><font color=black>Storestandeer</font></th>
			<th><font color=black>Kommentar</font></th>

              <th>


              </th>
          </tr>
         </thead>

<tbody>
<?php
 foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
  $highestRow         = $worksheet->getHighestRow();
  $highestColumn      = $worksheet->getHighestColumn();
  $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
?>
                          <?php
for ($row = 2; $row <= $highestRow; ++ $row) {
                          ?>
                             <tr class="theader-style">
                             <?php
                             for ($col = 0; $col < $highestColumnIndex; ++ $col) {
							 
                               $cell = $worksheet->getCellByColumnAndRow($col, $row);

                               $val = $cell->getValue();

                               $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);

                           //  if ( $col = 1 ) {
							// $id = $val;
							//echo "<td class=\"tdstyle\"><a href='http://tracking.bring.com/tracking.html?q={$val}' target=_blank>$val</a></td>";  

   ?>
                         

                                     <td class="tdstyle"><?php echo $val; ?></td>

                             <?php 
                             }
                             ?>
                             </tr>
                           <?php
                           }
                           ?>

<?php
}
?>
</tbody>
<SCRIPT language="Javascript">
  function sauverResultatEpreuve()
  {
      var arrayLignes = document.getElementById("tableau").rows;
      var longueur = arrayLignes.length;
      for(var iter=1; iter < longueur; ++iter)
      {
        alert(iter);
        var arrayColonnes = arrayLignes[1].cells;
        alert((arrayColonnes[0].innerHTML));
        var largeur = arrayColonnes.length;
        var valeur =  arrayColonnes[8].innerHTML;
        alert(valeur);
        var input = document.getElementById(iter + 1);
        var id_cb = input.id;
        alert(id_cb);
        if ((document.getElementById(id_cb).checked) == false)
        {
           document.getElementById('tableau').deleteRow(arrayLignes[1].rowIndex);
        }
        else
        {
                    go();
       }
    }
  }
function getXhr(){
      var xhr = null;
      if(window.XMLHttpRequest) // Firefox et autres
           xhr = new XMLHttpRequest();
      else if(window.ActiveXObject){ // Internet Explorer
                                   try {
                                        xhr = new ActiveXObject("Msxml2.XMLHTTP");
                                    } catch (e) {
                                        xhr = new ActiveXObject("Microsoft.XMLHTTP");
                                    }
                                }
                                else { // XMLHttpRequest non supportÃ©ar le navigateur
                                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
                                   xhr = false;
                                }
                                return xhr
                        }

                        /**
                        * MÃ©ode qui sera appelÃ©sur le click du bouton
                        */

                        function go(){
                                var xhr = getXhr()
                                // On dÃ©ni ce qu'on va faire quand on aura la rÃ©nse
                                xhr.onreadystatechange = function(){
                                        // On ne fait quelque chose que si on a tout reÃ§et que le serveur est ok
                                        if(xhr.readyState == 4 && xhr.status == 200){
                                                alert(xhr.responseText);
                                        }
                                }
                                xhr.open("GET","ajax.php",true);
                                xhr.send(null);
                        }

</SCRIPT>
</table>


<script language="javascript"></script>

</body>
</html>