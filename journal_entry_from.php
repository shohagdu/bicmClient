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
 
 
 
 if(isset($_GET['editID'])){
     $eids=$_GET['editID'];
 }
  
$QueryEditIds=$db->query("SELECT * FROM sr_published_journal WHERE id='$eids'");
$roweds = $QueryEditIds->fetch_assoc();
 
 
 
 ?>
 

<script>

	var rowincprofession=1;
	function fnc_commission_enlisted_details(){
	 rowincprofession++;
	 $('#fnc_commission_enlisted_detailsID').append('<tr id='+rowincprofession+'> <td><input type="text" class="form-control"   id="authorName[]" name="authorName[]" /></td><td><input type="text" class="form-control" id="affiliation[]" name="affiliation[]" /></td>	<td><input type="text" class="form-control" id="authorEmail[]" name="authorEmail[]" /></td><td><select class="form-control" id="authortype[]" name="authortype[]" > <option value="0">>-Select-< </option><option value="1">CORRESPONDING AUTHOR</option><option value="2">AUTHOR</option></select></td><td  onclick="fnc_commission_enlisted_details_removed('+rowincprofession+')"><span class="btn btn-danger"><span class=" glyphicon glyphicon-remove-sign"></span> Remove</span></td></tr>');
	}

	function fnc_commission_enlisted_details_removed(rid){
		var conf=confirm('Are you sure remove this row?');
		if(conf==true){
		   $('#'+rid).remove();
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
  <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
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
						      <form id="foraction" action="include/loginsecure.php" method="post" enctype="multipart/form-data" accept-charset="utf-8">
							       <table width="90%" style="padding: 10px;">
								      <input type="hidden" id="updateId" name="updateId" value="<?php echo $roweds['id']; ?>" />
								         <input type="hidden" id="paperID" name="paperID" value="<?php echo $roweds['paperId']; ?>" />
								         <input type="hidden" id="hiddenAttch" name="hiddenAttch" value="<?php echo $roweds['pdfattachment']; ?>" />
 								       <tr>
									       <td style="text-align: justify; font-size: 20px; color:#000; "> <b>Journal Entry Form</b> 
									  
									       </td>
									   </tr>
								       <tr>
									       <td style="Text-align: justify;  font-size: 15px; color:#000; "> Paper Title * <br/> <textarea id="papertitle" name="papertitle" class="form-control" placeholder="Enter your Paper Title" required > <?php echo $roweds['papertitle']; ?> </textarea></td>
									   </tr>
									   
									      <tr>
									     <td style="Text-align: justify;  font-size: 15px; color:#000; "> Reserach Type. * <br/> <input type="text" id="research_type" name="research_type" class="form-control" value="<?php echo $roweds['research_type']; ?>" placeholder="Like Original/Industy and others" required />  </td>
									   </tr>
									    <tr>
									     <td style="Text-align: justify;  font-size: 15px; color:#000; "> Issue No. * <br/> <input type="text" id="issueNo" name="issueNo" class="form-control" value="<?php echo $roweds['issueNo']; ?>" placeholder="Enter Issue No." required />  </td>
									   </tr>
									   
									   
									    <tr>
									     <td style="Text-align: justify;  font-size: 15px; color:#000; "> Issue Date. * <br/> <input type="text" id="issueDate" name="issueDate" class="form-control" value="<?php echo $roweds['issueDate']; ?>" placeholder="Enter Issue Date." required />  </td>
									   </tr>
									   
									   <tr>
									     <td style="Text-align: justify;  font-size: 15px; color:#000; "> Manuscript number * <br/> <input type="text" id="manuscriptNo" name="manuscriptNo" class="form-control" value="<?php echo $roweds['manuscriptNo']; ?>" placeholder="Enter Manuscript number." required />  </td>
									   </tr>
									     <tr>
									     <td style="Text-align: justify;  font-size: 15px; color:#000; ">Received Date * <br/> <input type="text" id="receivedDate" name="receivedDate" class="form-control" value="<?php echo $roweds['receivedDate']; ?>" placeholder="Enter Received Date." required />  </td>
									   </tr>
									   
									     <tr>
									     <td style="Text-align: justify;  font-size: 15px; color:#000; "> Accepted Date * <br/> <input type="text" id="acceptedDate" name="acceptedDate" class="form-control" value="<?php echo $roweds['acceptedDate']; ?>" placeholder="Enter Accepted Date." required />  </td>
									   </tr>
									   
									   
									     <tr>
									     <td style="Text-align: justify;  font-size: 15px; color:#000; ">Published Online * <br/> <input type="text" id="publishedonlineDate" name="publishedonlineDate" class="form-control" value="<?php echo $roweds['publishedonlineDate']; ?>" placeholder="Enter Published Online." required />  </td>
									   </tr>
									   
									   
									     <tr>
									     <td style="Text-align: justify;  font-size: 15px; color:#000; "> Published In Print * <br/> <input type="text" id="publishedInPrintDate" name="publishedInPrintDate" class="form-control" value="<?php echo $roweds['publishedInPrintDate']; ?>" placeholder="Enter Published In Print." required />  </td>
									   </tr>
								         
								        <tr>
									     <td style="Text-align: justify;  font-size: 15px; color:#000; "> DOI Link * <br/> <input type="text" id="doilink" name="doilink" class="form-control" value="<?php echo $roweds['doilink']; ?>" placeholder="Enter DOI Link" required />  </td>
									   </tr>
									   
									   <tr>
									     <td style="Text-align: justify;  font-size: 15px; color:#000; "> Pages * <br/> <input type="text" id="pages" name="pages" class="form-control" value="<?php echo $roweds['pages']; ?>" placeholder="Enter pages" required />  </td>
									   </tr>
								         
										<tr>
									       <td style="Text-align: justify; font-size: 15px; color:#000; "> Abstract * <br/> <textarea id="abstract" name="abstract" class="form-control ckeditor" placeholder="Enter your Abstract" required > <?php echo $roweds['abstract']; ?> </textarea> </td>
									   </tr>
									   <tr>
									       <td style="Text-align: justify; font-size: 15px; color:#000; "> Main Body  <br/> <textarea id="mainbody" name="mainbody" class="form-control ckeditor" placeholder="Enter your Main Body"   > <?php echo $roweds['mainbody']; ?> </textarea> </td>
									   </tr>
									   
									   
									   <tr>
									       <td style="Text-align: justify; font-size: 15px; color:#000; "> References  <br/> <textarea id="referencesx" name="referencesx" class="form-control ckeditor" placeholder="Enter your References" required > <?php echo $roweds['referencesx']; ?> </textarea> </td>
									   </tr>
									   
									    <tr>
									       <td style="Text-align: justify; font-size: 15px; color:#000; "> Cite AS  <br/> <textarea id="citeAs" name="citeAs" class="form-control ckeditor" placeholder="Enter your Cite As"  > <?php echo $roweds['citeAs']; ?> </textarea> </td>
									   </tr>
									   
									   <tr>
									       <td style="Text-align: justify; font-size: 15px; color:#000; "> <b>Author Information</b> 
									       </td>
									   </tr>
									   
								        <tr>
										<td>
											<table class="table" id="fnc_commission_enlisted_detailsID">
                                      
                                      
                                                 <tr style="color: black;">
                                                     <td>Author Name</td>
                                                     <td>Affiliation</td>
                                                     <td>Email</td>
                                                     <td>Author Type</td>
                                                 </tr>
                                      	<?php
									$pid=$roweds['paperId'];
									$queryx=$db->query("SELECT * FROM sr_pub_author_details WHERE paperId='$pid' ORDER BY id ASC");
									$count=  $queryx->num_rows;
									if($count>0){
									while($rowx = $queryx->fetch_assoc()){
									?>
												 <tr>
													  <td><input type="text" class="form-control" value="<?php echo $rowx['author_name']; ?>"   id="authorName[]" name="authorName[]" /></td>
										<td><input type="text" class="form-control" id="affiliation[]"  value="<?php echo $rowx['affiliation']; ?>"  name="affiliation[]" /></td>
										<td><input type="text" class="form-control" id="authorEmail[]" value="<?php echo $rowx['authorEmail']; ?>" name="authorEmail[]" /></td>
										<td>
										    <select class="form-control" id="authortype[]" name="authortype[]" >
										        <option value="0">>-Select-< </option>
										        <option value="1" <?php if($rowx['authortype']==1){ echo 'selected'; } ?>>CORRESPONDING AUTHOR</option>
										        <option value="2"  <?php if($rowx['authortype']==2){ echo 'selected'; } ?>>AUTHOR</option>
										    </select>
										</td>
													  
													  <td id onclick="fnc_commission_enlisted_details()" width="15%"><span class="btn btn-primary"> <span class="glyphicon glyphicon-plus-sign"></span> Add More</span></td>
												 </tr>
											<?php } } else { ?>	
											 <tr>
													  <td><input type="text" class="form-control" value="<?php echo $rowx['author_name']; ?>"   id="authorName[]" name="authorName[]" /></td>
										<td><input type="text" class="form-control" id="affiliation[]"  value="<?php echo $rowx['affiliation']; ?>"  name="affiliation[]" /></td>
										<td><input type="text" class="form-control" id="authorEmail[]" value="<?php echo $rowx['authorEmail']; ?>" name="authorEmail[]" /></td>
										<td>
										    <select class="form-control" id="authortype[]" name="authortype[]" >
										        <option value="0">>-Select-< </option>
										        <option value="1" <?php if($rowx['authortype']==1){ echo 'selected'; } ?>>CORRESPONDING AUTHOR</option>
										        <option value="2"  <?php if($rowx['authortype']==2){ echo 'selected'; } ?>>AUTHOR</option>
										    </select>
										</td>
													  
													  <td id onclick="fnc_commission_enlisted_details()" width="15%"><span class="btn btn-primary"> <span class="glyphicon glyphicon-plus-sign"></span> Add More</span></td>
												 </tr>
											<?php } ?>
											</table>
										</td>								
							          </tr>
									   <tr>
									       <td style="Text-align: justify; font-size: 15px; color:#000; "> Attched Full Paper (PDF)  <br/> <a href='all_document/<?php echo $roweds['pdfattachment']; ?>' style="text-align: justify;font-size: 13px; line-height: 20px; color:black; font-weight: normal;" target="_blank"><?php echo $roweds['pdfattachment']; ?></a> <br/><input type="file" id="pdfattachment" name="pdfattachment" class="form-control"    >  </td>
									   </tr>
							
								         
									    <tr> 
										  <td align="left"><input type="submit" id="new_article_submit" name="new_article_submit" class="btn btn-primary" style="width: 100px;" value="Submit"   /></td>
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