
<?php

	include('dbcon.php');

if($_REQUEST)
{

	$id 	= $_REQUEST['parent_id'];
$sql_filmName = "SELECT * from film_data where customer_id = '$id' group by film_name";

		$rsFilmName=$mysqli ->query($sql_filmName);
		 
		?>

	<select name="sub_category"  id="sub_category_id">
	<option value="" selected="selected"></option>
	<?php

	while ($rows = $rsFilmName->fetch_assoc()) 
	{?>
		<option value="<?php echo $rows['film_id'];?>  ID=<?php echo $rows['film_id'];?>"><?php echo $rows['film_name'];?></option>
	<?php
	}?>
	</select>		
<?php	
}
?>	