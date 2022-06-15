<?php
   include("config/db.php");
  

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
        <title>BICM Journal</title>

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
                        <h3 style=" font-size: 20px; color: #000; line-height:35px; ">Register as a new user</h3>
						<p>
						      <?php 
								  if(isset($_GET['mgs'])) 
								  {
									   if($_GET['mgs']==1)
									   {
										   echo '<div class="alert alert-primary" role="alert" style="width:90%; color: green;"> Your registration has been recorded successfully.!</div>';
									   }
									   else if($_GET['mgs']==3)
									   {
										   echo '<div class="alert alert-primary" role="alert" style="width:90%; color: red;"> Email already exists.</div>';
									   }
									   else{
										    echo '<div class="alert alert-primary" role="alert" style="width:90%; color: red;"> Data save error.!</div>';
									   }
								  } 
							  ?>
						      <form id="foraction" action="include/loginsecure.php" method="post">
							       <table width="90%" style="padding: 10px;">
								       
								       <tr>
									       <td style="Text-align: justify; font-size: 15px; color:#000; "> <b>Login Information</b> </td>
									   </tr>
								       <tr>
									       <td style="Text-align: justify;  font-size: 15px; color:#000; "> Email * <br/> <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email ID" required  /> </td>
									   </tr>
								         
										<tr>
									       <td style="Text-align: justify; font-size: 15px; color:#000; "> Password * <br/> <input type="password" id="pass" name="pass" class="form-control" placeholder="Enter your password" required /> </td>
									   </tr>
									   <tr>
									       <td style="Text-align: justify; font-size: 15px; color:#000; "> Confirm Password * <br/> <input type="password" id="conpass" name="conpass" class="form-control" placeholder="Enter your confirm password" required /> </td>
									   </tr>
									   <tr>
									       <td style="Text-align: justify; font-size: 15px; color:#000; "> User Type* <br/> 
									       <select id="userType" name="userType" class="form-control" required> 
												      <option value="">>-Select any one-< </option>
												      <option value="1">Author</option>
												      <option value="2">Editor</option>
												      <option value="3">Reviewer</option>
												      
											</select>
									       
									       </td>
									   </tr>
									   
									   <tr>
									       
									       <td style="Text-align: justify;  font-size: 15px; color:#000; "> <b>Personal Information</b> </td>
									   </tr>
									    <tr>
									       <td style="Text-align: justify;   font-size: 15px; color:#000; "> Your title * <br/>
          										   <select id="title" name="title" class="form-control" required> 
												      <option value="">>-Select any one-< </option>
												      <option value="Dr"> Dr </option>
												      <option value="Mr"> Mr </option>
												      <option value="Miss"> Miss </option>
												      <option value="Mrs"> Mrs </option>
												      <option value="Ms"> Ms </option>
												      <option value="Professor"> Professor </option>
												   </select>
										   
										   </td>
									   </tr>
									   <tr>
									       <td style="Text-align: justify;  font-size: 15px; color:#000; "> First Name * <br/> <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Enter your first name" required /> </td>
									   </tr>
									   <tr>
									       <td style="Text-align: justify;   font-size: 15px; color:#000; "> Last Name * <br/> <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Enter your last name" required /> </td>
									   </tr>
									    <tr>
									       <td style="Text-align: justify;   font-size: 15px; color:#000; "> Alternate  Email ID  <br/> <input type="text" id="alt_email" name="alt_email" class="form-control" placeholder="Enter your Alternate  Email ID"    /> </td>
									   </tr>
									   	 <tr>
									       <td style="Text-align: justify;   font-size: 15px; color:#000; "> Mobile No.   <br/> <input type="text" id="phone_no" name="phone_no" class="form-control" placeholder="Enter your mobile no."   /> </td>
									   </tr>
									   <tr>
									       <td style="Text-align: justify;   font-size: 15px; color:#000; "> Organization Name * <br/> <input type="text" id="orgname" name="orgname" class="form-control" placeholder="Enter your organization name" required  /> </td>
									   </tr>
									     <tr>
									       <td style="Text-align: justify;  font-size: 15px; color:#000; "> Country * <br/>

                                                   <select id="country" name="country" class="form-control" required> 
                                                   
                                                   
												      <option value="">>-Select any one-< </option>
                                    <?php
                                    $query=$db->query("SELECT * FROM sr_country_list");
                                    while($row = $query->fetch_assoc()){
                                    
                                    ?>
												      <option value="<?php echo $row['country_name'];?>"> <?php echo $row['country_name'];?> </option>
												     
												      <?php } ?>
												      
												   </select>
										   </td>
									   </tr>
								         
								         
									    <tr> 
										  <td align="right"><input type="submit" id="new_registration" name="new_registration" class="btn btn-primary" style="width: 100px;" value="Register"   /></td>
										</tr>
										<tr>
									       <td align="left"><hr/><a href="login.php" style="Text-align: justify; font-size: 15px; color:#000; "> Login to Journal</a></td>
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