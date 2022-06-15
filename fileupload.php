<?php
   session_start();
   include("config/db.php");
   if(!isset($_SESSION['loguniqID'])){
	   header("location:logout.php");
   }
   $pid=$_SESSION['loguniqID'];
   $query=$db->query("SELECT * FROM sr_registration WHERE id='$pid'");
   $row = $query->fetch_assoc();
 
   if(!isset($_SESSION['loguniqID'])){
	   header("location:authordeshboard.php");
   }
?>

<script type="text/javascript">
   function fnc_more_author_info(){
    if(fn_validation('title*firstname*lastname*email*orgname*country')==0) return;
    var title=$('#title').val();
    var firstname=$('#firstname').val();
    var lastname=$('#lastname').val();
    var email=$('#email').val();
    var orgname=$('#orgname').val();
    var country=$('#country').val();
    var registered_email=$('#registered_email').val();
    var registered_id=$('#registered_id').val();
    var paperUniqID_Author=$('#paperUniqID_Author').val();
	
    
    var data ="action=save_more_author_info&title="+title+"&firstname="+firstname+"&lastname="+lastname+"&email="+email+"&orgname="+orgname+"&country="+country+"&registered_email="+registered_email+"&registered_id="+registered_id+"&paperUniqID_Author="+paperUniqID_Author;
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
      if(response==1){
		  alert('Added new author');
		  window.location="fileupload.php?paperID=<?php echo  $_GET['paperID']; ?>";
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
                  <?php include("sidebar2.php"); ?>
                <!-- Main content -->
                <div class="col-md-8">
                    <article>
					    <br/>
                        <h3 class="article-title" style="Text-align: justify;  font-family: Times New Roman; font-size: 20px; color:#000; ">Upload Files and Author Information</h3>
						<p>
						      <?php 
								  if(isset($_GET['mgs'])) 
								  {
									   if($_GET['mgs']==1)
									   {
										   echo '<div class="alert alert-primary" role="alert" style="width:90%; color: green;"> Your manuscript info. has been recorded successfully.!</div>';
									   }
									   else{
										    echo '<div class="alert alert-primary" role="alert" style="width:90%; color: red;"> Data save error.!</div>';
									   }
								  } 
							  ?>
						      <form id="foraction" action="include/loginsecure.php" method="post"  enctype="multipart/form-data">
							       
							       <p style="color:black;" style="Text-align: justify;  font-family: Times New Roman; font-size: 15px; color:#000; ">Click Upload Files to select and upload submission files.</p>
								   <ul style="Text-align: justify;  font-family: Times New Roman; font-size: 13px; color:#000; ">
								      <li>Click Save to preserve the new order before proceeding.</li>
								      <li>The Manuscript File size should not exceed 150MB.</li>
								      <li>The total size of your submission files must not exceed 700MB.</li>
								   </ul>
								    <tr>
									       <td style="Text-align: justify;  font-family: Times New Roman; font-size: 15px; color:#000; "> <b>Author Information</b> </td>
									   </tr>
									   <tr>
									       <td>
										      <table width="100%" border="1" rules="all" style="border:1px solid gray; Text-align: justify;  font-family: Times New Roman; font-size: 15px; color:#000;">
											      
												    <tr>
													    <th>Sl</th>
													    <th width="100">Corresponding <br/> Author</th>
													    <th>Autor Info</th>
														<th>Action</th>
													</tr>
													 <tr>
													    <td>1</td>
													    <td>Yes</td>
													    <td>
														     Name: <?php echo $row['auth_title'].'.'. $row['first_name'].' '. $row['lastname']; ?> <br/>
															 Email: <?php echo $row['email']; ?> <br/>
															 Organization: <?php echo $row['organization_name']; ?> <br/>
															 Country: <?php echo $row['country']; ?> <br/>
														</td>
														<td align="center">--</td>
													</tr>
											       <?php
												       $sl=2;
												       $queryAuthorData=$db->query("SELECT * FROM sr_more_author_info WHERE  paperUniqID_Author='".$_GET['paperID']."'");
		                                               while($rowAuthor = $queryAuthorData->fetch_assoc()){
												   ?>
												   	 <tr>
													    <td><?php echo $sl; ?></td>
													    <td>NO</td>
													    <td>
														     Name: <?php echo $rowAuthor['auth_title'].'.'. $rowAuthor['first_name'].' '. $rowAuthor['lastname']; ?> <br/>
															 Email: <?php echo $rowAuthor['email']; ?> <br/>
															 Organization: <?php echo $rowAuthor['organization_name']; ?> <br/>
															 Country: <?php echo $rowAuthor['country']; ?> <br/>
														</td>
														<td align="center"><button type="button" onclick="fnc_remove_coAuthor('<?php echo $rowAuthor['id']; ?>')" style="background: #014a7f; border: none; color: #fff; font-size: 13px;">Delete</button></td>
													</tr>
												   
												  <?php $sl++; } ?>
											  </table>
										   
										   </td>
									   </tr>
								         
									    <tr>
										
										   <td>
										   	   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add more author</button>
										   </td>
										 
										</tr>
										
							       <table width="90%">
								    	<input type="hidden" name="paperUniqID_Doc" value="<?php echo  $_GET['paperID']; ?>" id="paperUniqID_Doc" />

								       <input type="hidden" value="<?php echo $_SESSION['LastInsertId']; ?>" id="InsertIDLast" name="InsertIDLast" />
								       <input type="hidden" value="<?php echo $row['id']; ?>" id="authorIDs" name="authorIDs" />
								       <tr>
									       <td style="Text-align: justify;  font-family: Times New Roman; font-size: 13px; color:#000; "> Description  <br/> <textarea id="desc" name="desc" class="form-control"  ></textarea> </td>
									   </tr>
									   <tr>
									       <td style="Text-align: justify;  font-family: Times New Roman; font-size: 13px; color:#000; "> File Upload <br/> <input type="file" id="fileAttachment" name="fileAttachment" class="form-control" required /> </td>
									   </tr>
							
								         
									    <tr> 
										  <td align="right"> <input type="submit" id="new_submission_file_upload" name="new_submission_file_upload" class="btn btn-primary" style="width: 150px;" value="Save"   /></td>
										</tr>
									
								   </table>
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