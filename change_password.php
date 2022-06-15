    <?php
	session_start();
   include("config/db.php");
   if(!isset($_SESSION['loguniqID'])){
	   header("location:logout.php");
   }
	
	?>

	<script>
                document.onkeydown = function(e) {
                if(event.keyCode == 123) {
                return false;
                }
                if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
                return false;
                }
                if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
                return false;
                }
                if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
                return false;
                }
                if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
                return false;
                }
                }
      </script>
<!doctype html>
<html lang="en">
	<head>
 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Journal Management Systems</title>

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
  
    <body oncontextmenu="return false">

        <!-- Header -->
       <?php include("header.php"); ?>

        
        <!-- Main navigation -->
        <?php include("topmenu.php"); ?>


 

        <!-- Main content area -->
        <main class="container">
            <div class="row">
                 <!-- Sidebar -->
                 
                
                <!-- Main content -->
                <div class="col-md-9">
                    <article>
					    <br/>
                        <h3 class="article-title"  style="Text-align: justify;  font-family: Times New Roman; font-size: 20px; color:#000; ">Pasword Reset</h3>
						<p>
						      <?php 
								  if(isset($_GET['mgs'])) 
								  {
									   if($_GET['mgs']==1)
									   {
										   echo '<div class="alert alert-primary" role="alert" style="width:90%; color: red;"> Password has been changed. </div>';
									   }
									   if($_GET['mgs']==2)
									   {
										   echo '<div class="alert alert-primary" role="alert" style="width:90%; color: red;"> Old Password does not macth. Please try again!</div>';
									   }
									
								  } 
							  ?>
						      <form id="foraction" action="include/loginsecure.php" method="post">
							       <table width="90%">
								          <input type="hidden" name="hid" value="<?php echo $_SESSION['loguniqID']; ?>" />
								          <input type="hidden" name="utype" value="<?php echo $_SESSION['type']; ?>" />
								          
								       <tr>
									       <td style="Text-align: justify;  font-family: Times New Roman; font-size: 15px; color:#000; "> Old Password:  <br/> <input type="password" id="oldpassword" name="oldpassword" required class="form-control" placeholder="Enter your Old Password"  /> </td>
									   </tr>
								         
										<tr>
									       <td  style="Text-align: justify;  font-family: Times New Roman; font-size: 15px; color:#000; "> New Password:  <br/> <input type="password" id="pass" name="pass" required class="form-control" placeholder="Enter your New password"  /> </td>
									   </tr>
									   
									    <tr>
										  <td>
										   <table width="100%">
										       <tr>
											      <td align="right"><input type="submit" id="LoginSystem_reset" name="LoginSystem_reset" class="btn btn-primary" style="width: 100px;" value="Reset"   /></td>
											   </tr>
										   </table>
										  </td>
									   </tr>
									  
								   </table>
							  </form>
						</p>
						
                    </article>
                </div>
                 <?php include("sidebar.php"); ?>
            </div> 
        </main>


            <?php include("footer.php"); ?>

        <!-- Bootcamp JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    </body>
</html>