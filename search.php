<!DOCTYPE html>
<html lang="no">
<head>


<title>Untitled 1</title>
<style type="text/css">
.auto-style1 {
	text-align: center;
}
</style>
</head>

<?php
	include('dbcon.php');

$title=$_POST["title"];
 //echo $title;
  //SELECT * FROM film_data WHERE film_name LIKE "%'.$title.'%"
 $sql="SELECT * FROM film_data Left JOIN orderdata ON ( film_data.film_id=orderdata.film_id) where ( film_data.film_name like '%$title%' or film_data.hylleid  like '%$title%')";
 
 // echo $sql;
 $result = $mysqli->query($sql);

if (!$result) {
   printf("%s\n", $mysqli->error);
   exit();
}else
{  
echo("<table style=\"width: 100%\">");
echo("<tr>");
echo("<th style=\"width: 2%\">Film_navn</th>");
echo("<th style=\"width: 2%\">Film lager dato</th>");
echo("<th style=\"width: 2%\">Bestilling dato</th>");
echo("<th style=\"width: 2%\">Levering dato</th>");
echo("<th style=\"width: 2%\">Hylle nummer</th>");
echo("<th style=\"width: 2%\">DCP Hylle nummer</th>");

		echo("</tr>"); 

while ($rows = $result->fetch_assoc()) 
	{	
			echo("<tr>");
		echo("<td style=\"width: 2%\" class=\"auto-style1\">".$rows['film_name']."</td>");
		echo("<td style=\"width: 2%\" class=\"auto-style1\">".$rows['film_entrydate']."</td>");
		echo("<td style=\"width: 2%\" class=\"auto-style1\">".$rows['Orderdate']."</td>");
		echo("<td style=\"width: 2%\" class=\"auto-style1\">".$rows['deliverydate']."</td>");		
		echo("<td style=\"width: 2%\" class=\"auto-style1\">".$rows['hylleid']."</td>");
		echo("<td style=\"width: 2%\" class=\"auto-style1\">".$rows['dcphylleid']."</td>");
	echo("</tr>"); 
	}

echo("</table>"); 
}

 

 // ajax search
?>