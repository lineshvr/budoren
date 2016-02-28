<div id="payment" class="modal">
<?php $vid = $_GET['vid']; ?>
<br /><center><h2><font size ="16">Melding <?php echo $vid ?></font></h2></center><br /><br />
            <? $query="SELECT Melding FROM orderdata WHERE vid = '".mysql_escape_string($vid)."'";
            $result=mysql_query($query);

            while($row = mysql_fetch_array($result))
                 {
                  $Melding = $row['Melding'];
             }
?>
</div>