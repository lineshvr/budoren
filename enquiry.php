<!DOCTYPE html>
<html>
 <?php
    //Start session
    session_start();
    //Check whether the session variable sess_username is present or not
    if($_SESSION['sess_admmin'])
    {
      if(!isset($_SESSION['sess_admfirstname']) || (!isset($_SESSION['sess_admlastname'])))
    		{		
				header("location: loginn.html");
				exit();
    		}

    
    }
    else{
    if(!isset($_SESSION['sess_firstname']) || (!isset($_SESSION['sess_lastname'])))
    		{
				header("location: loginn.html");
				exit();
    		}
    }		
      	?>

<head>
    <?php
		include('dbcon.php');?>

 <title>budoren</title>

			<script type="text/javascript" src="js/loginvalidation.js"></script>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript">
</script>
        <script type="text/javascript">
            $(document).ready(function(){
                  
                 function search(){
 
                      var title=$("#search").val();
 
                      if(title!=""){
                        $("#result").html("<img alt='ajaxsearch' src='pic/loader.gif'/>");
                         $.ajax({
                            type:"post",
                            url:"search.php",
                            data:"title="+title,
                            success:function(data){
                                $("#result").html(data);
                                $("#search").val("");
                             }
                          });
                      }
                       
 
                      
                 }
 
                  $("#button").click(function(){
                     search();
                  });
 
                  $('#search').keyup(function(e) {
                     if(e.keyCode == 13) {
                        search();
                      }
                  });
            });
        </script>
</head> 

<body>
   <?php include('usermenu.html');
   	if (!$mysqli->set_charset("utf8")) 
 	{
																		  
  printf("Error loading character set utf8: %s\n", $mysqli->error);
	} 
	else {
		   // printf("Current character set: %s\n", $mysqli->character_set_name());
	}

   ?>
  <br /><br />
  

             <table style="width: 100%">
				 <tr>
					 <td style="width: 534px">&nbsp;</td>
					 <td style="width: 204px">
             <input type="text" id="search" placeholder="Søk filmen  ..."/>
             <input type="button" id="button" value="Search" />

			 	 <td style="width: 109px">
					 <input type="submit" id="button" value="S&#248k" class="auto-style1" /></td>
					 <td>&nbsp;</td>
				 </tr>
			 </table>
			 
             <ul id="result"></ul>

  </body>
  
</html>