<?php
   session_start();
   include("config/db.php");
   if(!isset($_SESSION['loguniqID'])){
	   header("location:logout.php");
   }
   $pid=$_SESSION['loguniqID'];
   $query=$db->query("SELECT * FROM sr_registration WHERE id='$pid'");
   $row = $query->fetch_assoc();
   //print_r($row);
   
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
		  window.location="authordeshboard.php";
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
		  window.location="authordeshboard.php";
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
                        <h3 class="article-title" style="Text-align: justify;  font-family: Times New Roman; font-size: 20px; color:#000; ">Enter New Manuscript Submission</h3>
						<p>
						      <?php 
							     

								  if(isset($_GET['mgs'])) 
								  {
									   if($_GET['mgs']==1)
									   {
										   echo '<div class="alert alert-primary" role="alert" style="width:90%; color: green;"> Your paper has been recorded successfully.!</div>';
									   }
									   else{
										    echo '<div class="alert alert-primary" role="alert" style="width:90%; color: red;"> Data save error.!</div>';
									   }
								  } 
							  ?>
						      <form id="foraction" action="include/loginsecure.php" method="post">
							       <table width="90%">
								       <input type="hidden" name="paperUniqID" value="<?php echo  $_SESSION['uniqID']; ?>" id="paperUniqID" />
								       <input type="hidden" value="<?php echo $row['id']; ?>" id="authorIDs" name="authorIDs" />
								       <tr>
									       <td style="Text-align: justify; font-size: 13px; color:#000; "> Paper title * <br/> <textarea id="paper_title" name="paper_title" class="form-control" required ></textarea> </td>
									   </tr>
									   <tr>
									       <td style="Text-align: justify;   font-size: 13px; color:#000; "> Abstract <br/> <textarea id="abstract" name="abstract" class="form-control"  ></textarea> </td>
									   </tr>
									   <tr>
									       <td style="Text-align: justify; font-size: 13px; color:#000; "> Keywords (Keywords should be separated by semi-colons, e.g. Business; Finance.) <br/> <textarea id="keyword" name="keyword" class="form-control"  ></textarea> </td>
									   </tr>
									  
								         
									    <tr> 
										  <td align="right"> <input type="submit" id="new_submission" name="new_submission" class="btn btn-primary" style="width: 150px;" value="Save & Continue"   /></td>
										</tr>
									
								   </table>
							  </form>

								<!-- Modal Start -->
							
							<!-- Modal End -->
						</p>
						
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