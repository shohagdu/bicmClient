
<?php
   session_start();
   include("config/db.php");
   if(!isset($_GET['paperId'])){
	   header("location:logout.php");
   }
   $pid=$_SESSION['loguniqID'];
   $query=$db->query("SELECT * FROM sr_registration WHERE id='$pid'");
   $row = $query->fetch_assoc();
 

?>

<script>

 function fnc_data_remove(DelVal)
 {
    var data ="action=delete_editor_and_reviwer&delID="+DelVal;
    //alert(data); return;
    http.open( "POST","include/loginsecure.php",true);
    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    http.onreadystatechange =fnc_data_remove_response;
    http.send(data); 
 }
 
 function fnc_data_remove_response()
  {
    if(http.readyState == 4)
    { 
      var response=http.responseText;
      if(response==1){
		  alert('Delete tergated data');
		  window.location="paperDetails.php?paperId=<?php echo $_GET['paperId']; ?>";
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
             
                <div class="col-md-12">
                    
                    <article>
					    <br/>
                        <h3 class="article-title" style="Text-align: justify;  font-size: 20px; color:#000; ">Decision on review request</h3>
						<p>
						
						<?php 
						                $paperId=$_GET['paperId'];
										$assignID=$_GET['assignID'];
										$queryData=$db->query("SELECT B.confirm_status,B.id,A.paperUniqID,A.papertilte,A.abstract,A.submit_date_time FROM sr_menuscript_info A,sr_editor_reviwer_assign_info B WHERE  A.paperUniqID=B.paperId AND A.paperUniqID='$paperId' AND B.assignID='$assignID'");
										$rowData = $queryData->fetch_assoc();

                                        $queryDataMainAuthor=$db->query("SELECT * FROM sr_registration WHERE  id='".$rowData['authorid']."'");
										$rowDataMainAuthor = $queryDataMainAuthor->fetch_assoc();
                            			     
									    $uID=$rowData['id'];
										if($rowData['confirm_status']==0){ 
										
						
						?>					
							<div style="border:1px solid gray; padding:10px; font-size: 15px; color:#000;">
							       <b>Paper ID: </b><span ><?php echo $rowData['paperUniqID']; ?></span> <br/>
							       <b>Paper title:</b> <span><?php echo $rowData['papertilte']; ?></span> <br/>
	                               <b>Abstract:</b> <span style="font-size:13px; color: #000;"><?php echo $rowData['abstract']; ?></span> <br/>
							       <b>Submission Date:</b> <span style="font-size:15px; color: black;"><?php echo $rowData['submit_date_time']; ?></span> <br/>
								   <?php 
								        $k=1;
								        $queryDataDoc=$db->query("SELECT * FROM sr_document_info_details  WHERE paperUniqID_Doc='$paperId' ORDER BY id DESC");
										while($rowDataDoc = $queryDataDoc->fetch_assoc()){
								    ?>
								   
								     
									<?php $k++; } ?>
								   </span> 
								  <form id="foraction" action="include/loginsecure.php" method="post"  enctype="multipart/form-data">
							      <table>
								     <input type="hidden" value="<?php echo $uID; ?>" id="updateID"  name="updateID" />
								     <input type="hidden" value="<?php echo $paperId; ?>" id="paperId"  name="paperId" />
								     <input type="hidden" value="<?php echo $assignID; ?>" id="assignID"  name="assignID" />
								     <input type="hidden" value="<?php echo $rowData['papertilte']; ?>" id="papertilte"  name="papertilte" />
								     <input type="hidden" value="<?php echo $rowData['paperUniqID']; ?>" id="uniqIDs"  name="uniqIDs" />
								     <tr>
									     <td style="color: black;">Are you interested in reviewing a manuscript?</td>
										 <td>

										    <select class="form-control" id="decision" name="decision">
											   <option value=""> >-Select-< </option>
											   <option value="1"> Accept </option>
											   <option value="2"> Reject </option>
											</select>
											
										 </td>
										 <td><input class="btn btn-primary" type="submit" name="reviwer_confrimation_decision" value="Submit" /></td>
									 </tr>
								  </table>
								 </form>
							</div>
                    </article>
                </div>
				<?php } else {?>
				     <?php if($rowData['confirm_status']==1){
				          echo '<p style="color:#000;">Thank you for accepting the review request. An email has been sent to your email address containing information on how to access the full article and the review form. </p>

                            <p style="color:#000;">Please check your spam folder if you do not find the email in your inbox.</p>';
				         
				     } ?>
				     
				     <?php if($rowData['confirm_status']==2){
				          echo '<p style="color:#000;">Your decision has been recorded successfully. We thank you for your time and consideration. We wish to work with you in the future. </p>';

				         
				     } ?>
					
				<?php } ?>
            </div> 
        </main>
<style>
fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

legend.scheduler-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;
}
legend.scheduler-border {
    width:inherit; /* Or auto */
    padding:0 10px; /* To give a bit of padding on the left and right */
    border-bottom:none;
}
</style>

        <?php include("footer.php"); ?>



        <!-- Bootcamp JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="common_function.js"></script>
		 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    </body>
</html>