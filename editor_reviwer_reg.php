<?php
   session_start();
   include("config/db.php");
   if(!isset($_SESSION['loguniqID'])){
	   header("location:logout.php");
   }
   $pid=$_SESSION['loguniqID'];
   $query=$db->query("SELECT * FROM sr_registration WHERE id='$pid'");
   $row = $query->fetch_assoc();
   
   if(isset($_GET['getID'])){
       $getID=$_GET['getID'];
       if($getID==1){
           
           $titleHeading='Add New Editor';
       }
       else if($getID==3){
           
           $titleHeading='Add New Author';
       }
       else {
            $titleHeading='Add New Reviewer';
       }
   }
 
 

if(isset($_GET['editID'])){
    $editIDs=$_GET['editID'];
    $UpdateID='UPDATEID';
} 

if(isset($_GET['DELETEID']))
{
    $DELETEID=$_GET['DELETEID'];
    $QueryEditRemove=$db->query("DELETE FROM sr_registration WHERE id='$DELETEID'");
    if($QueryEditRemove==1)
    {
        if($getID==2)
        {
        header("location:list_reviwer.php?mgs=1");
        }
        
        if($getID==1)
        {
        header("location:list_editor.php?mgs=1");
        }
        
        if($getID==3)
        {
        header("location:authorinfo_list.php?mgs=1");
        }


    }
} 


 
$QueryEditRemove=$db->query("SELECT * FROM sr_registration WHERE id='$editIDs'");
$rowEditRemove = $QueryEditRemove->fetch_assoc();
 //print_r($rowEditRemove);
 
 ?>

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
                <div class="col-md-9">
                    <article>
					    <br/>
                        <h3 style=" font-size: 20px; color: #000; line-height:35px; "> <?php echo $titleHeading; ?></h3>
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
								      <input type="hidden" id="updateId" name="updateId" value="<?php echo $UpdateID ?>" />
								         <input type="hidden" id="EditId" name="EditId" value="<?php echo $editIDs ?>" />
 								       <tr>
									       <td style="Text-align: justify; font-size: 15px; color:#000; "> <b>Login Information</b> 
									        <input type='hidden' value="<?php echo $getID; ?>" id="getID" name="getID" />
									       </td>
									   </tr>
								       <tr>
									       <td style="Text-align: justify;  font-size: 15px; color:#000; "> Email * <br/> <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email ID" required  value="<?php echo $rowEditRemove['email']; ?>" /> </td>
									   </tr>
								         
										<tr>
									       <td style="Text-align: justify; font-size: 15px; color:#000; "> Password * <br/> <input type="password" id="pass" name="pass" class="form-control" placeholder="Enter your password" required value="<?php echo $rowEditRemove['log_password']; ?>" /> </td>
									   </tr>
									   <tr>
									       <td style="Text-align: justify; font-size: 15px; color:#000; "> Confirm Password * <br/> <input type="password" id="conpass" name="conpass" class="form-control" placeholder="Enter your confirm password" required value="<?php echo $rowEditRemove['log_password']; ?>"  /> </td>
									   </tr>
									   <tr>
									       <td style="Text-align: justify; font-size: 15px; color:#000; "> User Type* <br/> 
									       <select id="userType" name="userType" class="form-control" required> 
                                              <?php if($getID==1){ ?>
                                            <option value="2">Editor</option>
                                            <?php } else if($getID==3){ ?>
                                            <option value="1">Author</option>
                                            <?php } else { ?>
                                            <option value="3">Reviewer</option>
                                            <?php } ?>
												      
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
												      <option value="Dr" <?php  if($rowEditRemove['auth_title']=='Dr'){ echo 'Selected'; } ?>> Dr </option>
												      <option value="Mr" <?php  if($rowEditRemove['auth_title']=='Mr'){ echo 'Selected'; } ?>> Mr </option>
												      <option value="Miss" <?php  if($rowEditRemove['auth_title']=='Miss'){ echo 'Selected'; } ?>> Miss </option>
												      <option value="Mrs" <?php  if($rowEditRemove['auth_title']=='Mrs'){ echo 'Selected'; } ?>> Mrs </option>
												      <option value="Ms" <?php  if($rowEditRemove['auth_title']=='Ms'){ echo 'Selected'; } ?>> Ms </option>
												      <option value="Professor" <?php  if($rowEditRemove['auth_title']=='Professor'){ echo 'Selected'; } ?>> Professor </option>
												   </select>
										   
										   </td>
									   </tr>
									   <tr>
									       <td style="Text-align: justify;  font-size: 15px; color:#000; "> First Name * <br/> <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Enter your first name" required value="<?php echo $rowEditRemove['first_name']; ?>" /> </td>
									   </tr>
									   <tr>
									       <td style="Text-align: justify;   font-size: 15px; color:#000; "> Last Name * <br/> <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Enter your last name" required value="<?php echo $rowEditRemove['lastname']; ?>" /> </td>
									   </tr>
									   		   <tr>
									       <td style="Text-align: justify;   font-size: 15px; color:#000; "> Alternate  Email ID  <br/> <input type="text" id="alt_email" name="alt_email" class="form-control" placeholder="Enter your Alternate  Email ID"   value="<?php echo $rowEditRemove['alt_email']; ?>" /> </td>
									   </tr>
									   	 <tr>
									       <td style="Text-align: justify;   font-size: 15px; color:#000; "> Mobile No.   <br/> <input type="text" id="phone_no" name="phone_no" class="form-control" placeholder="Enter your mobile no."   value="<?php echo $rowEditRemove['phone_no']; ?>" /> </td>
									   </tr>
									   <tr>
									       <td style="Text-align: justify;   font-size: 15px; color:#000; "> Organization Name * <br/> <input type="text" id="orgname" name="orgname" class="form-control" placeholder="Enter your organization name" required  value="<?php echo $rowEditRemove['organization_name']; ?>" /> </td>
									   </tr>
									   
							
									   
								
									     <tr>
									       <td style="Text-align: justify;  font-size: 15px; color:#000; "> Country * <br/>

                                                   <select id="country" name="country" class="form-control" required> 
                                                   
                                                   
												      <option value="">>-Select any one-< </option>
                                    <?php
                                    $query=$db->query("SELECT * FROM sr_country_list");
                                    while($row = $query->fetch_assoc()){
                                    
                                    ?>
												      <option value="<?php echo $row['country_name'];?>" <?php  if($rowEditRemove['country']==$row['country_name']){ echo 'Selected'; } ?>> <?php echo $row['country_name'];?> </option>
												     
												      <?php } ?>
												      
												   </select>
										   </td>
									   </tr>
								        
								         
									    <tr> 
										  <td align="right"><input type="submit" id="new_registration" name="new_registration" class="btn btn-primary" style="width: 100px;" value="Submit"   /></td>
										</tr>
								
								   </table>
							  </form>
						</p>
						
                    </article>
                </div>
                
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