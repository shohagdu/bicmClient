<?php
   session_start();
   include("config/db.php");
   if(!isset($_SESSION['loguniqID'])){
	   header("location:logout.php");
   }
   $pid=$_SESSION['loguniqID'];
    if(isset($_GET['DELETEID']))
    {
    $DELETEID=$_GET['DELETEID'];
    $QueryEditRemove=$db->query("DELETE FROM sr_menuscript_info WHERE paperUniqID='$DELETEID'");
        if($QueryEditRemove==1)
        {
           
            header("location:status_wise_seraching.php?mgsalt=10");
           
        }
    } 

?>
<script>

 function fnc_data_search()
 {
    var DecisionID=$('#decision').val();
    var data ="action=status_wise_data_search&DecisionID="+DecisionID;
    //alert(data); return;
    http.open( "POST","include/loginsecure.php",true);
    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    http.onreadystatechange =fnc_data_search_response;
    http.send(data); 
 }
 
 function fnc_data_search_response()
  {
    if(http.readyState == 4)
    { 
      var response=http.responseText;
      $('#htmlData').html(response);
     }
  }  
  

</script>

<!doctype html>
<html lang="en">
	<head>
        <title>Journal Management Systems</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


        <!-- Main CSS --> 
        <link rel="stylesheet" href="css/style.css">

        <!-- Font Awesome -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<style>
		    #fontdesign{
			  color: #456990;
			}
		</style>
    </head>
  
    <body>

        <!-- Header -->
        <?php include("header.php"); ?>

        
        <!-- Main navigation -->
        <?php include("topmenu.php"); ?>

 

        <!-- Main content area -->
        <main class="container">
            <div class="row">
                <!-- Sidebar -->
                  <?php include("sidebaradmin.php"); ?>
                <!-- Main content -->
                <div class="col-md-8">
                    <article>
                            <?php 
								if(isset($_GET['mgsalt'])) 
								  {
									   if($_GET['mgsalt']==10)
									   {
										   echo '<div class="alert alert-primary" role="alert" style="width:100%; color: green;"> Your record has been removed successfully.!</div>';
									   }
									  
								  } 
							  ?>
					    <br/>
                        <h3 class="article-title" style="Text-align: justify;  font-family: Times New Roman; font-size: 20px; color:#000; ">Status wise papers search</h3>
                       
						  <table width="100%">
<tr>
	
	   <td style="color: black;">Status category</td>
	   <td style="color: black;">Action</td>

</tr>
<tr>
						  	  	
<td>
<select id="decision" name="decision" class="form-control" required> 
<option value="All">>-Select any one-< </option>


<?php foreach ($statusArray AS $key=>$val){ ?>                                       
	<option value="<?php echo $key; ?>"> <?php echo $val; ?>  </option>
<?php } ?>           
</select>

</td>
<td><button class="btn btn-primary" onclick="fnc_data_search()">Search</button></td>

						  	  </tr>
						  </table>
						<div id="htmlData"></div>		
                    </article>
                </div>
                
            </div> 
        </main>


        <?php include("footer.php"); ?>



        <!-- Bootcamp JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="common_function.js"></script>
		 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    </body>
</html>