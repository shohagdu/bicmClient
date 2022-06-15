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
    if(fn_validation('name*email*orgname*country')==0) return;
 
    var name=$('#name').val();
    var email=$('#email').val();
    var orgname=$('#orgname').val();
    var country=$('#country').val();
   
	
    
    var data ="action=save_editor_info&name="+name+"&email="+email+"&orgname="+orgname+"&country="+country;
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
                          <?php 
								if(isset($_GET['mgs'])) 
								  {
									   if($_GET['mgs']==1)
									   {
										   echo '<div class="alert alert-primary" role="alert" style="width:100%; color: green;"> Your record has been removed successfully.!</div>';
									   }
									  
								  } 
							  ?>
                    <article>
					    <br/>
					     <p align="right"><a href='editor_reviwer_reg.php?getID=2'><button style="width: 150px; height: 40px; background-color: #4C7CBA; color:#fff; font-weight:bolder;">Add New</button></a></p>
                      <h3 class="article-title" style="Text-align: justify;  font-size: 20px; color:#000; ">Reviewer List</h3>
						 <table width="100%" border="1" rules="all" style="border:1px solid gray; Text-align: justify; line-height:20px; font-size: 13px; color:#000;">
											 
												    <tr>
													    <th>Sl</th>
													    <th>Name</th>
													    <th>Email</td>
													    <th>Organization Name                  </th>
													    <th>Country</th>
													    <th>Action</th>
													</tr>
												
<?php
$sl=1;
$queryAuthorData=$db->query("SELECT * FROM sr_registration WHERE UserType=3");
while($rowAuthor = $queryAuthorData->fetch_assoc()){
$name=$rowAuthor['auth_title'].' '.$rowAuthor['first_name'].' '.$rowAuthor['lastname'];
?>
<tr style="Text-align: justify;  font-size: 15px; color:#000; ">
<td><?php echo $sl; ?></td>
<td> <a href="editor_reviwer_reg.php?getID=2&editID=<?php echo $rowAuthor['id'];  ?>"><?php echo $name; ?><a/></td>
<td><?php echo $rowAuthor['email']; ?></td>
<td><?php echo $rowAuthor['organization_name']; ?></td>
<td><?php echo $rowAuthor['country']; ?></td>
<td width="200" align="center">
    <a href="editor_reviwer_reg.php?getID=2&editID=<?php echo $rowAuthor['id'];  ?>"><button class="btn btn-primary" style="width:80px; height:;">Edit</button> </a>
    <a href="editor_reviwer_reg.php?getID=2&DELETEID=<?php echo $rowAuthor['id'];  ?>"><button class="btn btn-danger" style="width:80px; height:;">Remove</button> </a>
</td>
</tr>

<?php $sl++; } ?>
											  </table>
										 
										   
						      
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