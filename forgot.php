<!doctype html>
<html lang="en">
	<head>
        <title> Journal</title>
</title>

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
                 
                
                <!-- Main content -->
                <div class="col-md-9">
                    <article>
					    <br/>
                        <h3 style=" font-size: 20px; color: #000; line-height:35px; ">Forgot Password</h3>
						<p>
						      <?php 
								  if(isset($_GET['mgsID'])) 
								  {
									   if($_GET['mgsID']==1)
									   {
										   echo '<div class="alert alert-primary" role="alert" style="width:90%; color: green;"> You password has been reset successfully, Please check email ID.!</div>';
									   }else {
										   
										   echo '<div class="alert alert-primary" role="alert" style="width:90%; color: red;"> Email does not macth, Please try again.!</div>';

									   }
									
								  } 
							  ?>
						      <form id="foraction" action="forgot.php" method="post">
							       <table width="90%">
								   
								       <tr>
									       <td style="Text-align: justify;  font-size: 15px; color:#000; "> Email:  <br/> <input type="email" id="email" name="email" required class="form-control" placeholder="Enter your email ID"  /> </td>
									   </tr>
								     
									   <tr>
									       <td  style="Text-align: justify;   font-size: 15px; color:#000; "> User Type:  <br/> 
										      <select  id="usertype" name="usertype" required class="form-control">
											    <option value=""> >-Select-< </option>
											    <option value="1"> Author  </option>
											    <option value="2"> Editor </option>
											    <option value="3"> Reviwer </option>
                                              </select>
										   </td>
									   </tr>
									    <tr>
										  <td>
										   <table width="100%">
										       <tr>
											   	 <td align="left"><a href="login.php" style="Text-align: justify;   font-size: 15px; color:#000; "> Login</a></td>
											      <td align="right"><input type="submit" id="resetPass" name="resetPass" class="btn btn-primary" style="width: 100px;" value="Log in"   /></td>
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

<?php
include("config/db.php");
extract($_POST);
if(isset($_POST['resetPass']))
{

   $query=$db->query("SELECT * FROM sr_registration WHERE email='$email' AND userType='$usertype'");
   if($query->num_rows >0){
	   
	 $rows=$query->fetch_assoc();
	 $email=$rows['email'];
	 $password=$rows['log_password'];
	 $name=$rows['auth_title'].' '.$rows['first_name'].' '.$rows['lastname'];
	   
	    
         $to = "$email";
         $subject = "JFMG Portal Password Reset";

         $message = "
            <div style='width: 21cm; min-height: 29.7cm; padding: 1cm; margin: 1cm auto; border-radius: 5px; background: white;'> 
					<h3>Dear $name, </h3>
                   <p>
					Greetings!  <br/>
					Password has been reset for your JFMG Portal.<br/>

					URL: http://jfmg.bicm.ac.bd/login.php<br/>

					USER NAME: $email<br/>
					PASSWORD: $password
                  </p>

				<p>* Please do not reply in this mail. Contact with your Editorial Assistant  for further assistance.</p>

				<p>
					Regards,<br/>
					Journal of Financial Markets and Governance<br/>
				</p>
              </h4>
            </div>
         ";
        
        $header = "From:noreply@jfmg.bicm.ac.bd \r\n";
        $header .= "Reply-To:noreply@jfmg.bicm.ac.bd \r\n";
        $header .= "Return-Path:noreply@jfmg.bicm.ac.bd \r\n";
         //$header .= "Cc:ariffbs@du.ac.bd \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
   
	   	 echo "<script>location='forgot.php?mgsID=1'</script>"; die();

   }else {
	   
	   		echo "<script>location='forgot.php?mgsID=2'</script>"; die();

   }	
}

?>