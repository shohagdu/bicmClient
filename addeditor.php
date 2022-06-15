<?php
   session_start();
   include("config/db.php");
   if(!isset($_SESSION['loguniqID'])){
	   header("location:logout.php");
   }
   $pid=$_SESSION['loguniqID'];
   $query=$db->query("SELECT * FROM sr_registration WHERE id='$pid'");
   $row = $query->fetch_assoc();
 
?>

<script type="text/javascript">
   function fnc_more_author_info(){
    if(fn_validation('name*deg*email*mobile*orgname*country')==0) return;

    var name=$('#name').val();
    var email=$('#email').val();
    var orgname=$('#orgname').val();
    var country=$('#country').val();
    var deg=$('#deg').val();
    var mobile=$('#mobile').val();
   
	
    
    var data ="action=save_editor_info&name="+name+"&email="+email+"&orgname="+orgname+"&country="+country+"&deg="+deg+'&mobile='+mobile;
    //alert(data); return;
    http.open( "POST","include/loginsecure.php",true);
    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    http.onreadystatechange =fnc_more_author_info_response;
    http.send(data); 
  }
  
  
  function fnc_more_author_info_response()
  {
    if(http.readyState == 4)
    { 
      var response=http.responseText;
      //alert(response);
      if(response==1){
		  alert('Added new Editor');
		  window.location="addeditor.php?sk=1";
	  }
     }
  }  

 function fnc_remove_coAuthor(DelVal)
 {
    var data ="action=delete_author_info&delID="+DelVal;
    //alert(data); return;
    http.open( "POST","include/loginsecure.php",true);
    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    http.onreadystatechange =fnc_remove_coAuthor_response;
    http.send(data); 
 }
 function fnc_remove_coAuthor_response()
  {
    if(http.readyState == 4)
    { 
      var response=http.responseText;
      if(response==1){
		  alert('Delete Author');
		  window.location="fileupload.php?paperID=<?php echo  $_GET['paperID']; ?>";
	  }
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
					    <br/>
                        <h3 class="article-title" style="Text-align: justify;  font-family: Times New Roman; font-size: 20px; color:#000; ">Add New Editor</h3>
						<p>
						      <?php 
								  if(isset($_GET['mgs'])) 
								  {
									   if($_GET['mgs']==1)
									   {
										   echo '<div class="alert alert-primary" role="alert" style="width:90%; color: green;"> Editor Added!</div>';
									   }
									   else{
										    echo '<div class="alert alert-primary" role="alert" style="width:90%; color: red;"> Data save error.!</div>';
									   }
								  } 
							  ?>
						      <form id="foraction" action="include/loginsecure.php" method="post"  enctype="multipart/form-data">
							       
							       <table width="100%">
													
												   <tr>
													   <td> Name * <br/> <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name" required /> </td>
												   </tr>
												   <tr>
													   <td> Designation * <br/> <input type="text" id="deg" name="deg" class="form-control" placeholder="Enter your Designation" required /> </td>
												   </tr>
												   <tr>
													   <td> Email* <br/> <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email address" required  /> </td>
												   </tr>
												    <tr>
													   <td> Mobile* <br/> <input type="number" id="mobile" name="mobile" class="form-control" placeholder="Enter your mobile no." required  /> </td>
												   </tr>
												   <tr>
													   <td> Organization Name * <br/> <input type="text" id="orgname" name="orgname" class="form-control" placeholder="Enter your organization name" required  /> </td>
												   </tr>
													 <tr>
													   <td> Country * <br/>

															   <select id="country" name="country" class="form-control" required> 
																	<option value="">>-Select any one-< </option>
																	<?php
																	include("config/db.php");
																	$queryCountry=$db->query("SELECT * FROM sr_country_list");
																	while($rowCountry = $queryCountry->fetch_assoc()){

																	?>
																	<option value="<?php echo $rowCountry['country_name'];?>"> <?php echo $rowCountry['country_name'];?> </option>

																	<?php } ?>
																  
															   </select>
													   </td>
												   </tr>
												   <tr>
												      <td colspan="2">	<button type="button" id="save_author_info" onclick="fnc_more_author_info()" name="save_author_info" class="btn btn-primary">Submit Info</button></td>
												   </tr>
											</table>
									
									  </div>
									
									
							  </form>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Add Author information</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
								       
										    <table width="100%">
													<input type="hidden" name="paperUniqID_Author" value="<?php echo  $_GET['paperID']; ?>" id="paperUniqID_Author" />

											        <input type="hidden" value="<?php echo $row['id']; ?> " id="registered_id" name="registered_id" />
											        <input type="hidden" value="<?php echo $row['email']; ?> " id="registered_email" name="registered_email" />
													<tr>
													   <td> Your title * <br/>
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
													   <td> First Name * <br/> <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Enter your first name" required /> </td>
												   </tr>
												   <tr>
													   <td> Last Name * <br/> <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Enter your last name" required /> </td>
												   </tr>
												   <tr>
													   <td> Email* <br/> <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email address" required  /> </td>
												   </tr>
												   <tr>
													   <td> Organization Name * <br/> <input type="text" id="orgname" name="orgname" class="form-control" placeholder="Enter your organization name" required  /> </td>
												   </tr>
													 <tr>
													   <td> Country * <br/>

															   <select id="country" name="country" class="form-control" required> 
																	<option value="">>-Select any one-< </option>
																	<?php
																	include("config/db.php");
																	$queryCountry=$db->query("SELECT * FROM sr_country_list");
																	while($rowCountry = $queryCountry->fetch_assoc()){

																	?>
																	<option value="<?php echo $rowCountry['country_name'];?>"> <?php echo $rowCountry['country_name'];?> </option>

																	<?php } ?>
																  
															   </select>
													   </td>
												   </tr>
											</table>
									
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" id="save_author_info" onclick="fnc_more_author_info()" name="save_author_info" class="btn btn-primary">Save</button>
									  </div>
									
									</div>
								  </div>
								</div>
								
                    </article>
                </div>
                
            </div> 
        </main>


        <!-- Footer -->
      <?php include("footer.php"); ?>


        <!-- Bootcamp JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="common_function.js"></script>
		 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    </body>
</html>