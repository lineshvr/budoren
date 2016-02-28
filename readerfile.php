<html>
  <head>
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
    include 'reader.php';
        $excel = new Spreadsheet_Excel_Reader();
    ?>
    Sheet 1:<br/>
    <table border="1">
    <?php
        $excel->read($tmp_filmname); // set the excel file name here   
        $x=1;
        while($x<=$excel->sheets[0]['numRows']) { // reading row by row 
          echo "\t<tr>\n";
          $y=1;
          while($y<=$excel->sheets[0]['numCols']) {// reading column by column 
            $cell = isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : '';
            echo "\t\t<td>$cell</td>\n";  // get each cells values
            $y++;
          }  
          echo "\t</tr>\n";
          $x++;
        }
        ?>    
    </table>
  </body>
</html>