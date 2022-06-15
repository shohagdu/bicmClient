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
                        <h3 class="article-title" style="Text-align: justify;  font-family: Times New Roman; font-size: 20px; color:#000; ">All Accepted Paper</h3>
						<p>
						      <?php 
								  if(isset($_GET['mgs'])) 
								  {
									   if($_GET['mgs']==1)
									   {
										   echo '<div class="alert alert-primary" role="alert" style="width:100%; color: green;"> Your File Upload has been recorded successfully.!</div>';
									   }
									   else{
										    echo '<div class="alert alert-primary" role="alert" style="width:100%; color: red;"> Data save error.!</div>';
									   }
								  } 
							  ?>
						    <?php
										$queryData=$db->query("SELECT * FROM sr_menuscript_info A, sr_document_info B WHERE  A.paperUniqID=B.paperUniqID_Doc AND A.status=10 ORDER BY A.id DESC");
										while($rowData = $queryData->fetch_assoc()){
										$submitID=$rowData['id'];
										$paperUniqIDForDataGet=$rowData['paperUniqID'];
                             ?>							
							<div style="border:1px solid gray; padding:10px; font-family: Times New Roman; font-size: 15px; color:#000;">
							       Paper ID: <span style="font-size:15px; color: #009ece;"><?php echo $rowData['paperUniqID']; ?></span> <br/>
							       Paper title: <span style="font-size:15px; color: #009ece;"><a href="paperDetails.php?paperId=<?php echo $rowData['paperUniqID']; ?>"><?php echo $rowData['papertilte']; ?></a></span> <br/>
							       Submission Date: <span style="font-size:15px; color: black;"><?php echo $rowData['submit_date_time']; ?></span> <br/>
							       Status: <span style="font-size:15px; color: black;"> <?php echo $statusArray[$rowData['status']]; ?> </span> <br/>
								   <button><a href="all_document/<?php echo $rowData['attchment_data']; ?>">Download Attachment</a> </button> 
									
							</div>
							 <br/>
							<?php } ?>
								
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