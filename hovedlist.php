
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
<html>
	<head>
		<title>budoren</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<script src="css/ie/html5shiv.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.tablescroll.js"></script>
	
		<noscript>
			<link rel="stylesheet" type="text/css" href="css/jquery.tablescroll.css"/>

		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
	
			<script>
$(document).ready(function() {
    $('#regularSelecct').click(function(event) {  //on click
        if(this.checked) { // check select status

                
					 var inputValues = [];
            $("input.HiddenHovedplakat:hidden").each(function() {
                inputValues.push($(this).val());
            });
            $("input.Hovedplakat:text").each(function(index) {
                if(index < inputValues.length) {
                    $(this).val(inputValues[index]);
                }
			});
           
        }
		else
		{

		$("input.Hovedplakat:text").val("0");
			
		}
			
    });

});

</script>
			<script>
$(document).ready(function() {
    $('#teaserSelecct').click(function(event) {  //on click
        if(this.checked) { // check select status

                
			
            var inputValues = [];
            $("input.HiddenTeaserplakat:hidden").each(function() {
                inputValues.push($(this).val());
            });
            $("input.Teaserplakat:text").each(function(index) {
                if(index < inputValues.length) {
                    $(this).val(inputValues[index]);
                }
			});
        }
		else
		{
		$("input.Teaserplakat:text").val("0");
		
			
		}
			
    });

});

</script>
 <script>

$(document).ready(function($)
{
	$('#thetable2').tableScroll({height:550});

});
</script>

 <script>
$(document).ready(function() {
  $("#FilmNavn").change(function() {
    $("#changeme").val($(this).val());
  });
});
</script>

		<script>
$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click

        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"   
			
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      

            });        
        }
    });

});
</script>

  <script type="text/javascript">
        $(function() {
            $("#addAll").click(function() {
                var add = 0;
                $(".Teaserplakat").each(function() {
                    add += Number($(this).val());
                });
                $("#TotTeaserplakat").text(add);
				
				 var add = 0;
                $(".Bannere").each(function() {
                    add += Number($(this).val());
                });
                $("#TotBannere").text(add);
				
				var add = 0;
                $(".Teaser").each(function() {
                    add += Number($(this).val());
                });
                $("#TotTeaser").text(add);	
				
				var add = 0;
                $(".Hovedplakat").each(function() {
                    add += Number($(this).val());
                });
                $("#TotRegulr").text(add);	
				
				var add = 0;
                $(".Mellomstandeer").each(function() {
                    add += Number($(this).val());
                });
                $("#TotMellomstandeer").text(add);	
				
				var add = 0;
                $(".Smastandeer").each(function() {
                    add += Number($(this).val());
                });
				$("#TotSmåstandeer").text(add);
				
			var add = 0;
                $(".DCP").each(function() {
                    add += Number($(this).val());
                });	
                $("#TotDCP").text(add);	
			var add = 0;
                $(".Storestandeer").each(function() {
                    add += Number($(this).val());
                });
                $("#TotStorestandeer").text(add);					
            });
	        });
    </script>
	</head>
	
    <?php
		include('dbcon.php');?>
    <?php include('customermenu.html');?>
	<body>

<h3>Velg Film</h3>

<?php

require_once 'Classes/PHPExcel/IOFactory.php';
$tmpCustomerid=$_SESSION['sess_customerid'];
$tmpCustomerName=$_SESSION['sess_customername'];
$sql_custID="SELECT customer_id,customer_name FROM budoren.customer_information where customer_name='$tmpCustomerName'";
$rscustomerInfo=$mysqli ->query($sql_custID);

while($row =$rscustomerInfo->fetch_array(MYSQLI_BOTH)){  
  $tmpCustomerid=$row[0];
  break;
 }
 $film_id="";

$itemList=array();

$sql_ProductName ="SELECT * FROM globalstockslist";
$sql_kinodata ="SELECT * FROM kino_hoved_liste";

$sql_FilmInfo ="SELECT film_id,film_name,customer_id FROM film_data where customer_id=$tmpCustomerid";



		
//echo "$sql_kinodata ".$sql_kinodata;

		
		$rsProductName=$mysqli ->query($sql_ProductName);
		$rsOrderData=$mysqli ->query($sql_kinodata);
		$sql_custdata="SELECT film_id,film_name FROM budoren.film_data where customer_id=$tmpCustomerid";
if (!$mysqli->set_charset("utf8")) 
 	{
																		  
  printf("Error loading character set utf8: %s\n", $mysqli->error);
	} 
	else {
		   // printf("Current character set: %s\n", $mysqli->character_set_name());
	}

$rscustdata=$mysqli ->query($sql_custdata);
		 
		 if (!$mysqli->set_charset("utf8")) {
printf("Error loading character set utf8: %s\n", $mysqli->error);
} else {
//printf("Current character set: %s\n", $mysqli->character_set_name());
}

		?>
		<form method="post" action="orderexcel.php">
		
					<?php 
			 $selectbox='<select name=\'FilmNavn\' id=\'FilmNavn\' required class=\"combobox\">';

 while ($row = $rscustdata->fetch_assoc()) {
     $selectbox.='<option value="' . $row['film_name'] . '">' . $row['film_name'] . '</option>';
 }

 $selectbox.='</select>';
			echo $selectbox;?>
		<section class="">

		
<table id="thetable2" cellspacing="0" border="2">
				
      <thead>
	
	<?php
	echo"<tr border=\"2\">";
			$itemList=array();

		echo("<th width=\"80px\" style=\"border:solid 2px #D8D8D8;border-right:none\">VelgKino<input type=\"checkbox\"  id=\"selecctall\" /> </th>");
		echo("<th width=\"220px\" style=\"border:solid 2px #D8D8D8;border-right:none\">Kino navn</th>");
		echo("<th width=\"120px\" style=\"border:solid 2px #D8D8D8;border-right:none\">Teaser<input type=\"checkbox\"  id=\"teaserSelecct\" /> </th>");
		echo("<th width=\"120px\" style=\"border:solid 2px #D8D8D8;border-right:none\">Regulær   <input type=\"checkbox\"  id=\"regularSelecct\" /> </th>");						 
		echo("<th width=\"120px\" style=\"border:solid 2px #D8D8D8;border-right:none\">Bannere</th>");	
		echo("<th width=\"120px\" style=\"border:solid 2px #D8D8D8;border-right:none\">DCP</th>");	
		echo("<th width=\"120px\" style=\"border:solid 2px #D8D8D8;border-right:none\">Mellomstandeer</th>");	
		echo("<th width=\"120px\" style=\"border:solid 2px #D8D8D8;border-right:none\">Småstandeer</th>");	
		echo("<th width=\"120px\" style=\"border:solid 2px #D8D8D8;border-right:none\">Storestandeer</th>");
		echo("<th width=\"120px\" style=\"border:solid 2px #D8D8D8;border-right:none\">Kommentar</th>");			
		echo "<tr>";
	?>
	    </thead>
      <tbody>
	<?php
	
			//	$row = $result->fetch_array(MYSQLI_BOTH);
//printf ("%s (%s)\n", $row[0], $row["CountryCode"]);

		$tempField="";
		$tempVariable="";
		$counter=1;

		
while($row =$rsOrderData->fetch_array(MYSQLI_BOTH)){  
echo "<tr>";
echo "<td  ><input class=\"checkbox1\" type=\"checkbox\" id=\"$counter\" name=\"kinonummer[$counter]\" value=\"$row[0]\" ></input></td>"; 
echo "<td  ><input type=\"text\" readonly name=\"Kinonavn[$counter]\"  value=\"$row[1]\" ></input></ td>"; 

echo "<td ><input  type=\"text\" name=\"Teaserplakat[$counter]\" class=\"Teaserplakat\"   value=\"$row[2]\" ></input></ td>"; 


echo "<input type=\"hidden\" name=\"HiddenTeaserplakat[$counter]\" class=\"HiddenTeaserplakat\"   value=\"$row[2]\" ></input>"; 

echo "<td ><input type=\"text\" name=\"Hovedplakat[$counter]\"  class=\"Hovedplakat\"  value=\"$row[3]\" ></input></ td>"; 
echo "<input type=\"hidden\" name=\"HiddenHovedplakat[$counter]\"  class=\"HiddenHovedplakat\"  value=\"$row[3]\" ></input>"; 

echo "<td ><input type=\"text\" name=\"Bannere[$counter]\" value=\"$row[4]\" class=\"Bannere\"  ></input></ td>"; 
echo "<td ><input type=\"text\" name=\"DCP[$counter]\"  value=\"$row[5]\" class=\"DCP\"  ></input></ td>"; 
echo "<td ><input type=\"text\" name=\"Mellomstandeer[$counter]\" value=\"$row[6]\" class=\"Mellomstandeer\"  ></input></ td>"; 
echo "<td ><input type=\"text\" name=\"Smastandeer[$counter]\" value=\"$row[7]\" class=\"Smastandeer\"  ></input></ td>"; 
echo "<td ><input type=\"text\" name=\"Storestandeer[$counter]\" value=\"$row[8]\" class=\"Storestandeer\"  ></input></ td>"; 

echo "<td ><input type=\"text\" name=\"Kommentar[$counter]\"  value=\"$row[9]\" ></input></ td>";
echo "</tr>";
$counter=$counter+1;
}
$counter=$counter-1;


//echo "counter".$counter;
	?>
	      </tbody>
<tfoot>
<tr>
<td ></td> 
<td >Totalt film bestilling</td> 
<td ><p id="TotTeaserplakat" /></input></td> 
<td ><p id="TotRegulr" /></input></td> 
<td ><p id="TotBannere" /></input></td> 
<td ><p id="TotDCP" /></input></td> 
<td ><p id="TotMellomstandeer" /></input></td> 
<td ><p id="TotSmåstandeer" /></input></td> 
<td ><p id="TotStorestandeer" /></input></td> 
<td ></td> 
</tr>
	</tfoot>
	</table>


 <br />
Siste frist til lager
<input type="date" maxlength="20" placeholder="
yyyy-mm-dd" size="20" name="sistedato" id="sistedato" ></td><br>

Melding til lager<input type="text" maxlength="500" placeholder="
akseptere 500 tegn for sammensmelting" size="500" name="Melding" id="Melding" value="" >


<input type="hidden" id="changeme" name="value" />
 <input id="addAll" type="button" value="Totalt film bestilling" />
<input type="Submit" name="Submit" value="Submit" ></input>

</form>


  <?php include('footer.html');?>
  
  
</body>

</html>
