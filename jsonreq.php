
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <title>Tableau de voisngae 2G 2G</title>
</head>
<body>
    <?php
		include('dbcon.php');?>

<?php

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
$File_name = "kino.xls";



require_once '/Classes/PHPExcel/IOFactory.php';
//require_once '../class/database.php';
$objPHPExcel = PHPExcel_IOFactory::load($File_name);
?>

<table id="tableau" border="1" align="center">
        <thead>
          <tr  BGCOLOR=FF6600>
              <th><font color=black>Sendingstype</font></th>
              <th><font color=black>Sendingsnummer</font></th>
              <th><font color=black>Status</font></th>
              <th><font color=black>Dato</font></th>
              <th><font color=black>Pakke/Transp.type</font></th>
              <th><font color=black>Avsender-ID</font></th>
              <th><font color=black>Mottaker-ID</th>
              <th><font color=black>Mottaker</font></th>
			<th><font color=black>Kundenummer</font></th>
			<th><font color=black>Kundegr-ID</font></th>
			<th><font color=black>PostAdr1</font></th>
			<th><font color=black>PostAdr2</font></th>
			<th><font color=black>Postnr</font></th>
			<th><font color=black>Poststed</font></th>
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
                             <tr>
                             <?php
                             for ($col = 0; $col < $highestColumnIndex; ++ $col) {
							 
                               $cell = $worksheet->getCellByColumnAndRow($col, $row);

                               $val = $cell->getValue();

                               $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);

                             if ( $col == 1 ) {
							 $id = $val;
							echo "<td ><a href='http://tracking.bring.com/tracking.html?q={$val}' target=_blank>$val</a></td>";  

   ?>
                             <?php } else { ?>

                                     <td><?php echo $val; ?></td>

                             <?php }
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
                                else { // XMLHttpRequest non supportéar le navigateur
                                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
                                   xhr = false;
                                }
                                return xhr
                        }

                        /**
                        * Méode qui sera appelésur le click du bouton
                        */

                        function go(){
                                var xhr = getXhr()
                                // On déni ce qu'on va faire quand on aura la rénse
                                xhr.onreadystatechange = function(){
                                        // On ne fait quelque chose que si on a tout reçet que le serveur est ok
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