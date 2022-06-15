<?php
   session_start();
   include("config/db.php");
   if(!isset($_SESSION['loguniqID'])){
	   header("location:logout.php");
   }
   $pid=$_SESSION['loguniqID'];
   $query=$db->query("SELECT * FROM sr_registration WHERE id='$pid'");
   $row = $query->fetch_assoc();
 
 
 $delID=$_GET['delID'];
 $queryx=$db->query("DELETE FROM sr_published_journal WHERE id='$delID'");

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
					     <p align="right"><a href='journal_entry_from.php'><button style="width: 150px; height: 40px; background-color: #4C7CBA; color:#fff; font-weight:bolder;">Add New Entry Form</button></a></p>
                      <h3 class="article-title" style="Text-align: justify;  font-size: 20px; color:#000; ">All Journal</h3>
						 <table width="100%" border="1" rules="all" style="border:1px solid gray; Text-align: justify; line-height:20px; font-size: 13px; color:#000;">
											 
												    <tr>
													    <th>Sl</th>
													    <th>Paper Title</th>
													    <th>Published date</td>
													    <th>Attachment</th>
													</tr>
												
													<?php
													$sl=1;
													$query=$db->query("SELECT * FROM sr_published_journal");
													while($row = $query->fetch_assoc()){

													?>
													<tr style="Text-align: justify;  font-size: 15px; color:#000; ">
													<td><?php echo $sl; ?></td>
													<td><?php echo $row['papertitle']; ?></td>
													<td><?php echo $row['entryDatetime']; ?></td>
													<td><a href="all_document/<?php echo $row['pdfattachment']; ?>"><button style="width: 80px; border: none; height: 35px; background: #005274; color: #fff;">PDF</button> </a>
													<br/>
															<a href="journal_entry_from.php?editID=<?php echo $row['id']; ?>"><button style="width: 80px; border: none; height: 35px; background: #000fff; color: #fff;">Update</button></a>
															<br/>
													<a href="all_journal_published.php?delID=<?php echo $row['id']; ?>"><button style="width: 80px; border: none; height: 35px; background: red; color: #fff;">Delete</button></a>
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