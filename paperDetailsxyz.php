
<?php

   session_start();
   include("config/db.php");
   if(!isset($_SESSION['loguniqID'])){
	   header("location:logout.php");
   }
   $pid=$_SESSION['loguniqID'];
   $query=$db->query("SELECT * FROM sr_registration WHERE id='$pid'");
   $row = $query->fetch_assoc();
$revCommUniqTk=$db->query("select * from sr_reviwer_comments WHERE paperId='".$_GET['paperId']."'");
$revCommRowsTk=$revCommUniqTk->fetch_assoc();


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
                <!-- Sidebar -->
				  <?php if($_SESSION['type']==4){ ?>
                  <?php include("sidebaradmin.php"); ?>
				  <?php } if($_SESSION['type']==2){ ?>
				  
                  <?php include("sidebaradmin.php"); ?>
				  <?php } if($_SESSION['type']==3){ ?>
				  
                  <?php include("sidebaradmin.php"); ?>
				  <?php } if($_SESSION['type']=='Author'){ ?>
				     <?php include("sidebar2.php"); ?>
				  <?php } ?>
                <!-- Main content -->
                <div class="col-md-8">
                    
                    <article>
					    <br/>
                        <h3 class="article-title" style="Text-align: justify;  font-size: 20px; color:#000; ">Paper Details </h3>
						<p>
						<?php 
						
						        if($revCommRowsTk['submit_status']==1){
						             echo '<div class="alert alert-primary" role="alert" style="width:100%; color: green;"> You have successfully submitted this review. No more edits or changes can be made to this review.</div>';
						        }
						          
						          
								  if(isset($_GET['mgs'])) 
								  {
									   if($_GET['mgs']==1)
									   {
										   echo '<div class="alert alert-primary" role="alert" style="width:100%; color: green;"> Data Added.!</div>';
									   }
									   if($_GET['mgs']==2)
									   {
										   echo '<div class="alert alert-primary" role="alert" style="width:100%; color: green;"> Your inputs have been successfully updated and stored.</div>';
									   }
									 
									
								  } 
							  ?>
						<?php 
						                $paperId=$_GET['paperId'];
										$queryData=$db->query("SELECT * FROM sr_menuscript_info WHERE  paperUniqID='$paperId'");
										$rowData = $queryData->fetch_assoc();

                                        $queryDataMainAuthor=$db->query("SELECT * FROM sr_registration WHERE  id='".$rowData['authorid']."'");
										$rowDataMainAuthor = $queryDataMainAuthor->fetch_assoc();
                            			     
									
						
						?>					
							<div style="border:1px solid gray; padding:10px; font-size: 15px; color:#000;">
							       <b>Paper ID: </b><span ><?php echo $rowData['paperUniqID']; ?></span> <br/>
							       <b>Paper title:</b> <span><?php echo $rowData['papertilte']; ?></span> <br/>
							       	<b>Status: </b> <span> <?php echo $statusArray[$rowData['status']]; ?> </span> <br/>
	                              <?php if($_SESSION['type']!=3){ ?>
								   <b>Author Information </b> <br/>
								   <table width="100%" border="1" rules="all" style="border:1px solid gray; Text-align: justify; line-height:20px;  font-size: 15px; color:#000;">
											      
												    <tr>
													    <td>Sl</td>
													    <td width="100">Corresponding <br/> Author</td>
													    <td>Author Info</td>
													</tr>
													 <tr>
													    <td>1</td>
													    <td>Yes</td>
													    <td>
														     Name: <?php echo $rowDataMainAuthor['auth_title'].'.'. $rowDataMainAuthor['first_name'].' '. $rowDataMainAuthor['lastname']; ?> <br/>
															 Email: <?php echo $rowDataMainAuthor['email']; ?> <br/>
															 Organization: <?php echo $rowDataMainAuthor['organization_name']; ?> <br/>
															 Country: <?php echo $rowDataMainAuthor['country']; ?> <br/>
														</td>
													</tr>
											       <?php
												       $sl=2;
												       $queryAuthorData=$db->query("SELECT * FROM sr_more_author_info WHERE  paperUniqID_Author='$paperId'");
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
													</tr>
												   
												  <?php $sl++; } ?>
											  </table>
									<?php } ?>	   
								   <b>Abstract:</b> <span style="font-size:13px; color: #000;"><?php echo $rowData['abstract']; ?></span> <br/>
							       <b>Submission Date:</b> <span style="font-size:15px; color: black;"><?php echo $rowData['submit_date_time']; ?></span> <br/>
							       <table width="100%" border="1" rules="all">
								          <tr style="color: black; font-size:14px;">
								               <th> Attachment file name </th>
								               <th>Attachment</th>
								               <th>Date & Time</th>
								          </tr>
								   <?php 
								        $k=1;
								        $queryDataDoc=$db->query("SELECT * FROM sr_document_info_details  WHERE paperUniqID_Doc='$paperId' ORDER BY id DESC");
										while($rowDataDoc = $queryDataDoc->fetch_assoc()){
										    
										
								    ?>
								     
								          
								          <tr  style="color: black; font-size:14px;">
								              <td> <?php echo $rowDataDoc['des']; ?></td>
								             <td><a href="all_document/<?php echo $rowDataDoc['attchment_data']; ?>" target="_blank">Download</a></td>
								             <td><?php echo $rowDataDoc['attchment_time_date']; ?></td>
								          </tr>
								   
									<?php $k++; } ?>
									      
								     </table>
								   </span> 
								   		<?php if($_SESSION['type']==4){ ?>
					           <form id="foraction" action="include/loginsecure.php" method="post"  enctype="multipart/form-data">
							      <table>
								     <input type="hidden" value="<?php echo $rowData['id']; ?>" id="updateID"  name="updateID" />
								     <input type="hidden" value="<?php echo $rowData['paperUniqID']; ?>" id="paperId"  name="paperId" />
								     <tr>
									     <td style="color: black;">Paper Status</td>
										 <td>

										    <select class="form-control" id="decision" name="decision">
											   <option value=""> >-Select-< </option>
											   <?php foreach ($statusArray AS $key=>$val){ ?>
											   			<option value="<?php echo $key; ?>"> <?php echo $val; ?> </option>

											   <?php } ?>
											</select>
											
										 </td>
										 <td><input class="btn btn-primary" type="submit" name="controll_paper_status" value="Submit" /></td>
									 </tr>
								  </table>
								 </form>
							<?php } ?>
							</div>
							 <br/>
							
							
						<?php if($_SESSION['type']==4){ ?>
					      
						
						      <div   class="scheduler-border">
                                <fieldset  class="scheduler-border">
                                <legend class="scheduler-border" style="font-size: 12px; color:black;"> Associate editor assign for this paper </legend>
						             
						                    <form id="foraction" action="include/loginsecure.php" method="post"  enctype="multipart/form-data">
												<table width="100%">
												    <input type="hidden" value="<?php echo $_SESSION['loguniqID'];  ?>" id="logID" name="logID" />
												    <input type="hidden" value="<?php echo $_SESSION['type'];  ?>" id="userType" name="userType" />
											
												     <input type="hidden" value="<?php echo $rowData['papertilte'];  ?>" id="papertilte" name="papertilte" />
												     
												     <input type="hidden" value="<?php echo $rowData['paperUniqID'];  ?>" id="uniqIDs" name="uniqIDs" />
												     
												     <input type="hidden" name="paperId" id="paperId" value="<?php echo $_GET['paperId']; ?>" />	
												     <tr>
													 
														<?php //echo $rowData['editorID']; ?>
														 
														           <td>Name:</td>
																   <td style="color:#000;">  
																		   <select id="editorId" name="editorId" class="form-control" required>
																		      <option value="">>-Select any one-< </option>
                                                                                <?php
                                                                                $sl=1;
                                                                                $queryAuthorData=$db->query("SELECT * FROM sr_registration WHERE userType=2");
                                                                                while($rowAuthor = $queryAuthorData->fetch_assoc()){
                                                                                         $name=$rowAuthor['auth_title'].' '.$rowAuthor['first_name'].' '.$rowAuthor['lastname'];
                                                                                ?>
                                       <option value="<?php echo $rowAuthor['id']; ?>" <?php if($rowAuthor['id']==$rowData['editorID']){ echo "selected"; } ?>><?php echo $name; ?> </option>
                                                                                <?php } ?>
		                                                                    </select>
										</td>
									    <td><input type="submit" class="btn btn-primary" style="width: 130px;" name="assign_editor_Data" value="Submit" /></td>
													  </tr>
												</table>
											</form>
											<br/>
										
								           
											     <?php
                    $EditorAssignInfo=$db->query("SELECT B.auth_title,B.first_name,B.lastname,B.email,B.organization_name,A.entryDate,A.id FROM sr_editor_reviwer_assign_info A,sr_registration B WHERE A.assignID=B.id AND A.paperId='$paperId' AND A.type='2'");
                                                    $EditorEntrycount = $EditorAssignInfo->num_rows;
                                                    if($EditorEntrycount>0){
                                                    while($editorAssign = $EditorAssignInfo->fetch_assoc()){
                                                             $name=$editorAssign['auth_title'].' '.$editorAssign['first_name'].' '.$editorAssign['lastname'];
											     ?>
											         <div style="border:1px solid gray; padding:10px; font-size: 15px; color:#000;">
	                                               <table width="100%" border="1" rules="all" style="border:1px solid gray; Text-align: justify; line-height:20px;  font-family: Times New Roman; font-size: 15px; color:#000;">
											    
											     <tr>
											         <th>Name</th>
											         <th>Email</th>
											         <th>Organization</th>
											         <th>Assign Date</th>
											         <th>Action</th>
											     </tr>
								
											       <tr>
											         <td><?php echo  $name; ?></td>
											         <td><?php echo $ReviwerAssign['email']; ?></td>
											         <td><?php echo $ReviwerAssign['organization_name']; ?></td>
											         <td><?php echo $ReviwerAssign['entryDate']; ?></td>
											         <td><button onclick="fnc_data_remove('<?php echo $ReviwerAssign['id']; ?>')">Remove</button></td>
											     </tr>
											     
											      <tr>
											         <td>Editor Decision</td>
										            
											         <td colspan='4'><?php if($ReviwerAssign['confirm_status']==1){
											         echo 'Accept.'; }
											          if($ReviwerAssign['confirm_status']==2){
											         echo 'Reject.'; } else {
											              echo 'Pending';
											         }
											         ?></td>
											     </tr>
											     
										
											    
											</table>
										   </div>
										   <br/>
									     <?php } } else {?>
									      <p>No data available.</p>
									      <?php } ?>
						    </div>
						    <br/>
						    <?php } ?>
						    
						    
					
				<?php  if($_SESSION['type']==2 || $_SESSION['type']==4) { ?>
                                <div   class="scheduler-border">
                                <fieldset  class="scheduler-border">
                                <legend class="scheduler-border" style="font-size: 12px; color:black;"> Reviewer assign for this paper </legend>

						                    <form id="foraction" action="include/loginsecure.php" method="post"  enctype="multipart/form-data">
												<table width="100%">
												     <input type="hidden" value="<?php echo $_SESSION['loguniqID'];  ?>" id="logID" name="logID" />
												     <input type="hidden" value="<?php echo $rowData['papertilte'];  ?>" id="papertilte" name="papertilte" />
												     <input type="hidden" value="<?php echo $rowData['paperUniqID'];  ?>" id="uniqIDs" name="uniqIDs" />
												     
									
												     <input type="hidden" value="<?php echo $_SESSION['type'];  ?>" id="userType" name="userType" />
												     <input type="hidden" name="paperId" id="paperId" value="<?php echo $_GET['paperId']; ?>" />
												
														<?php //echo $rowData['editorID']; ?>
														 
														 
															<tr>
															      <td>Name:</td>
																   <td style="color:#000;">
																		   <select id="editorId" name="editorId" class="form-control" required> 
																			  <option value="">>-Select any one-< </option>
                                                                                <?php
                                                                                $sl=1;
                                                                                $queryAuthorData=$db->query("SELECT * FROM sr_registration WHERE userType=3");
                                                                                while($rowAuthor = $queryAuthorData->fetch_assoc()){
                                                                                                                                        $name=$rowAuthor['auth_title'].' '.$rowAuthor['first_name'].' '.$rowAuthor['lastname'];
                                                                                ?>
                                                                                
                                                                                <option value="<?php echo $rowAuthor['id']; ?>" <?php if($rowAuthor['id']==$rowData['reviwerID']){ echo "selected"; } ?>><?php echo $name ?> </option>
                                                                                <?php } ?>
																		   </select>
																   
																   </td>
														
													
												
													      <td><input type="submit" class="btn btn-primary" style="width: 130px;" name="assign_reviwer_Data" value="Submit" /></td>
													  </tr>
												</table>
											</form>
											<br/>
											

    <?php
    
    $ReviwerAssignInfo=$db->query("SELECT B.auth_title,B.first_name,B.lastname,B.email,B.organization_name,A.entryDate,A.id,A.confirm_status FROM sr_editor_reviwer_assign_info A,sr_registration B WHERE A.assignID=B.id AND A.paperId='$paperId'");
    $ReviwerEntrycount = $ReviwerAssignInfo->num_rows;
    if($ReviwerEntrycount>0){
    while($ReviwerAssign = $ReviwerAssignInfo->fetch_assoc()){
    $name=$ReviwerAssign['auth_title'].' '.$ReviwerAssign['first_name'].' '.$ReviwerAssign['lastname'];
    
    ?>	
       <div style="border:1px solid gray; padding:10px; font-size: 15px; color:#000;">
	             <table width="100%" border="1" rules="all" style="border:1px solid gray; Text-align: justify; line-height:20px;  font-family: Times New Roman; font-size: 15px; color:#000;">
											    
											     <tr>
											         <th>Name</th>
											         <th>Email</th>
											         <th>Organization</th>
											         <th>Assign Date</th>
											         <th>Action</th>
											     </tr>
								
											       <tr>
											         <td><?php echo  $name; ?></td>
											         <td><?php echo $ReviwerAssign['email']; ?></td>
											         <td><?php echo $ReviwerAssign['organization_name']; ?></td>
											         <td><?php echo $ReviwerAssign['entryDate']; ?></td>
											         <td><button onclick="fnc_data_remove('<?php echo $ReviwerAssign['id']; ?>')">Remove</button></td>
											     </tr>
											     
											      <tr>
											         <td>Reviewer Acceptance Status</td>
										            
											         <td colspan='4'><?php if($ReviwerAssign['confirm_status']==1){
											         echo 'Accepted.'; }
											          if($ReviwerAssign['confirm_status']==2){
											         echo 'Rejected.'; } 
											         ?></td>
											     </tr>
											     
											     <tr>
											         <td>Reviewer Comments & Decision</td>
										            
											         <td colspan='4'>
											             
											              <button type="button"  data-toggle="modal" data-target="#exampleModal">Show Details</button>
											             
											         </td>
											     </tr>
											     
										
											    
											</table>
										   </div>
										   <br/>
									     <?php } } else {?>
									      <p>No data available.</p>
									      <?php } ?>
								   </fieldset>
								</div>
								<?php } ?>
								<br/>
							<?php if($_SESSION['type']==4) { ?>
							<div>
							<fieldset  class="scheduler-border">
                                <legend class="scheduler-border" style="font-size: 12px; color:black;"> Comments and Decision</legend>
						       
						                    <form id="foraction" action="include/loginsecure.php" method="post"  enctype="multipart/form-data">
												<table width="100%">
												     <input type="hidden" value="<?php echo $_SESSION['loguniqID'];  ?>" id="logID" name="logID" />
												     <input type="hidden" value="<?php echo $_SESSION['type'];  ?>" id="userType" name="userType" />
												     <input type="hidden" name="paperId" id="paperId" value="<?php echo $_GET['paperId']; ?>" />
												     <input type="hidden" name="papertilte" id="papertilte" value="<?php echo $rowData['papertilte']; ?>" />
												     <input type="hidden" name="authorName" id="authorName" value="<?php echo $rowDataMainAuthor['lastname']; ?>" />
												     <input type="hidden" name="email" id="email" value="<?php echo $rowDataMainAuthor['email']; ?>" />
												
														 
															<tr>
															      <td>Comments:</td>
																   <td style="color:#000;">
																		  
																		   <textarea id="comments" name="comments" class="form-control"></textarea>
																   
																   </td>

													  </tr>
													  <tr>
													              <td>Decision:</td>
																   <td style="color:#000;">
																		   <select id="decision" name="decision" class="form-control" required> 
																			  <option value="">>-Select any one-< </option>
                                                                             
                                                                                
                                       <?php foreach ($decision AS $key=>$val){ ?>                                       <option value="<?php echo $key; ?>"> <?php echo $val; ?>  </option>
                                        <?php } ?>           
																		   </select>
																   
																   </td>
													  </tr>
													  <tr>
													      <td align="right" colspan="2"><input type="submit" class="btn btn-primary" style="width: 130px;" id="comments_decision" name="comments_decision" value="Submit" /></td>   
													  </tr>
												</table>
											</form>
											<br/>
										
								           <table width="100%" border="1" rules="all" style="border:1px solid gray; Text-align: justify; line-height:20px;  font-family: Times New Roman; font-size: 15px; color:#000;">
											    
											     <tr>
											         <th>Comments</th>
											         <th>Decision</th>
											         <th>Time & date</th>
											        
											     </tr>
											     <?php
                                                    $commensInfoQuery=$db->query("SELECT * FROM sr_comments WHERE paperId='$paperId'");
                                                    $CommentsInfoCount = $commensInfoQuery->num_rows;
                                                    if($CommentsInfoCount>0){
                                                    while($commentsRows = $commensInfoQuery->fetch_assoc()){
											     ?>
											       <tr>
											         <td><?php echo $commentsRows['comments']; ?></td>
											         <td><?php  echo $decision[$commentsRows['dstatus']]; ?></td>
											         <td><?php echo $commentsRows['entryDate']; ?></td>

											     </tr>
											     <?php } } else {?>
											      <tr>
											         <td colspan="3">No data available.</td>
											     </tr>
											     <?php } ?>
											</table>
									</fieldset>
								</div>
						<?php } ?> 
						 
						
						<!-- Reviwer Comments -->
						
						
						
						<?php if($_SESSION['type']==3){ 
						
                        $revCommUniq=$db->query("select * from sr_reviwer_comments WHERE paperId='".$_GET['paperId']."'");
                        $revCommRows=$revCommUniq->fetch_assoc();
                        $numRows=$revCommUniq->num_rows;
						
						?>
						
						
							
							<div>
							       <form id="foraction" action="include/loginsecure.php" method="post"  enctype="multipart/form-data">
								<table width="100%">
			                    <input type="hidden" value="<?php echo $_GET['paperId'];  ?>" id="paperID" name="paperID" />
			                    <input type="hidden" value="<?php echo $row['auth_title'].' '.$row['lastname'];  ?>" id="authorName" name="authorName" />
							     <input type="hidden" value="<?php echo $rowData['papertilte'];  ?>" id="$papertilte" name="$papertilte" />
							     
                                <p style="Text-align: justify;  font-size: 15px; color:#000; font-weight:bolder; ">Welcome to the JFMG review center. You may write your reviews in the form below and/or upload review documents in the section at the bottom of this form.
                                </p>
                                
                                <table class='table' width="100%" style="Text-align: justify;  font-size: 15px; color:#000; ">
                                    
                                       <tr>
                                             <td>1. <b>Originality of idea:</b> Does the paper contain new information and significant knowledge contribution to that justifies its publication? <br/>
                                        <?php if($revCommRows['submit_status']==1){ ?>
                                        <?php echo $revCommRows['comm1']; ?>
                                        <?php } else { ?>
                                                   <textarea class='form-control' name="comm1" id="comm1"><?php echo $revCommRows['comm1']; ?></textarea>
                                           <?php } ?>
                                                 
                                             </td>
                                       </tr>
                                       
                                       <tr>
                                             <td>2. <b>Contextualizing the Literature:</b> Does the manuscript evidence a comprehensive understanding of the relevant literature in the field? Does it cite the appropriate and significant works? Has (have) any significant work(s) been ignored?<br/>
                                    <?php if($revCommRows['submit_status']==1){ ?>
                                    <?php echo $revCommRows['comm2']; ?>
                                    <?php } else { ?>
                                                   <textarea class='form-control' name="comm2" id="comm2"><?php echo $revCommRows['comm2']; ?></textarea>
                                                   <?php } ?>
                                                 
                                             </td>
                                       </tr>
                                       
                                            
                                       <tr>
                                             <td>
                                                3. <b>Methodology: </b>
                                                Is the methodology of the paper appropriately designed? <br/>
                                                Does the paper build on any theories, concepts or defined frameworks? <br/>
                                                Does it offer any new theories, concepts or frameworks that can be tested further? <br/>
                                                Are the methods and techniques used appropriate and relevant for the work?<br/>
                                                Have the methods and techniques implemented appropriately?
                                                
                                                
                                                <br/>
                                                
                                                <?php if($revCommRows['submit_status']==1){ ?>
                                    <?php echo $revCommRows['comm3']; ?>
                                    <?php } else { ?>
                                                
                                                <textarea class='form-control' name="comm3" id="comm3"><?php echo $revCommRows['comm3']; ?></textarea>
                                         <?php } ?>
                                             </td>
                                       </tr>
                                       
                                            
                                       <tr>
                                             <td>4. <b>Results and discussions:</b> Does the paper report results with clarity? Does it interpret the results appropriately and adequately with support from the relevant literature? Do the conclusions align with the other elements of the paper, e.g., research objectives, results and discussions?<br/>
                                                        <?php if($revCommRows['submit_status']==1){ ?>
                                    <?php echo $revCommRows['comm4']; ?>
                                    <?php } else { ?>
                                                 
                                                   <textarea class='form-control' name="comm4" id="comm4"><?php echo $revCommRows['comm4']; ?></textarea>
                                            <?php } ?>
                                                 
                                             </td>
                                       </tr>
                                       
                                       
                                         <tr>
                                             <td>5. <b>Research implications:</b> Does the paper suggest any academic, professional, public and/or social policy formulation? Does the paper provide any direction as to how the research could help in further knowledge and practice in the broad areas of finance.<br/>
                                                          <?php if($revCommRows['submit_status']==1){ ?>
                                    <?php echo $revCommRows['comm5']; ?>
                                    <?php } else { ?>     
                                                   <textarea class='form-control' name="comm5" id="comm5"><?php echo $revCommRows['comm5']; ?></textarea>
                                              <?php } ?>   
                                             </td>
                                       </tr>
                                       
                                       <tr>
                                        <td>6. <b>Standard of communication: </b>
                                        Is the paper’s expression readable and up to the international standard, such as sentence structure, jargon use, acronyms, etc.?  <br/>
                                        Does the paper describes in language that is understandable to general readers in business, finance and economics?  <br/>
                                        Does the paper uses abbreviations and elaborates them appropriately? <br/>
                                        What is the quality of English language used in the paper?
                                        <br/>
                                                             <?php if($revCommRows['submit_status']==1){ ?>
                                    <?php echo $revCommRows['comm6']; ?>
                                    <?php } else { ?> 
                                                   <textarea class='form-control' name="comm6" id="comm6"><?php echo $revCommRows['comm6']; ?></textarea>
                                                <?php } ?>
                                                 
                                             </td>
                                       </tr>
                                            <tr>
                                        <td><b>Recommendation</b>
                                        <br/><br/>
                                                 <?php if($revCommRows['submit_status']==1){ ?>
                                    <?php echo $decision[$revCommRows['recom']]; ?>
                                    <?php } else { ?>       
                                                <select class="form-control"  name="recom" id="recom">
                                                    <option value=""> >-Select-< </option>
                                                    <?php foreach ($decision AS $key=>$val) { ?>
                                                             <option value="<?php echo $key; ?>" <?php  if($revCommRows['recom']==$key){ echo "selected"; }?>> <?php echo $val; ?> </option>
                                                      
                                                    <?php } ?>
                                                </select>
                                            <?php } ?>
                                             </td>
                                       </tr>
                                       
                                               <tr>
                                        <td><b>Confidential comments to the Editor</b>
                                        <br/>
                                                     <?php if($revCommRows['submit_status']==1){ ?>
                                    <?php echo $revCommRows['con_editor']; ?>
                                    <?php } else { ?> 
                                                   <textarea class='form-control' name="con_editor" id="con_editor"><?php echo $revCommRows['con_editor']; ?></textarea>
                                         <?php } ?>        
                                             </td>
                                       </tr>
                                                 <tr>
                                        <td><b>Other comments to the Author</b>
                                        <br/>
                                                             <?php if($revCommRows['submit_status']==1){ ?>
                                    <?php echo $revCommRows['com_author']; ?>
                                    <?php } else { ?> 
                                                   <textarea class='form-control' name="com_author" id="com_author"><?php echo $revCommRows['com_author']; ?></textarea>
                                                   <?php } ?>
                                                 
                                             </td>
                                       </tr>
                                               <tr>
                                        <td><b>Attach review documents</b>
                                        <br/>
                                                                  <?php if($revCommRows['submit_status']==0){ ?>
                                     <input type="file" class='form-control' name="rev_doc" id="rev_doc" />
                                    <?php }  ?>
                                                  
                                                  
                                               <?php if($numRows>0) { ?>  
                                               <a href="all_document/<?php echo $revCommRows['rev_doc']; ?>"     target="_blank">Download attachment  </a>    
                                              
                                               <?php } ?>  
                                                 
                                             </td>
                                       </tr>
                                        <tr>
                                        <td>
                                         
                                            <input type="hidden" value="<?php if($numRows>0) { echo '1000'; } else { echo '2000'; }?>" name="traceId" id="traceId" />
                                           <input type="hidden" value="<?php echo $revCommRows['rev_doc']; ?>"  name="hiddenAttach" id="hiddenAttach" />   
                                        
                                <?php if($revCommRows['submit_status']==0){ ?>
                                            <input type="submit"  value="Save and return later" name="save_data_submit_reviwer_comm_data" class="btn btn-primary" id="save_data_submit_reviwer_comm_data" />    
                                        
                                        <input type="submit"  value="Submit" name="save_data_submit_reviwer_comm_submit" id="save_data_submit_reviwer_comm_submit"  class="btn btn-primary" />
                                        <?php } ?>  
                                             </td>
                                       </tr>
                                    
                                </table>
							    
							   </form>
							    
							    
							    
							    
							    
							</div>
				
						<?php } ?>
						
						
						
						
						
						
						
						
						
						
							<?php if($_SESSION['type']==2){ ?>
						
				
						       	<div  >
						        	<fieldset  class="scheduler-border">
                                <legend class="scheduler-border" style="font-size: 12px; color:black;"> Comments and Decision</legend>
						                    <form id="foraction" action="include/loginsecure.php" method="post"  enctype="multipart/form-data">
												<table width="100%">
												     <input type="hidden" value="<?php echo $_SESSION['loguniqID'];  ?>" id="logID" name="logID" />
												     <input type="hidden" value="<?php echo $_SESSION['type'];  ?>" id="userType" name="userType" />
												     <input type="hidden" name="paperId" id="paperId" value="<?php echo $_GET['paperId']; ?>" />
												
														 
															<tr>
															      <td>Comments:</td>
																   <td style="color:#000;">
																		  
																		   <textarea id="comments" name="comments" class="form-control"></textarea>
																   
																   </td>

													  </tr>
													  <tr>
													              <td>Decision:</td>
																   <td style="color:#000;">
																		   <select id="decision" name="decision" class="form-control" required> 
																			  <option value="">>-Select any one-< </option>
                                                                             
                                                                                
                                                                                <option value="1"> Accepted  </option>
                                                                                <option value="2"> Rejected  </option>
                                                                                <option value="3"> Revised  </option>
                                                                               
																		   </select>
																   
																   </td>
													  </tr>
													  <tr>
													      <td align="right" colspan="2"><input type="submit" class="btn btn-primary" style="width: 130px;" id="comments_decision" name="comments_decision" value="Submit" /></td>   
													  </tr>
												</table>
											</form>
											<br/>
										
								           <table width="100%" border="1" rules="all" style="border:1px solid gray; Text-align: justify; line-height:20px;  font-family: Times New Roman; font-size: 15px; color:#000;">
											    
											     <tr>
											         <th>Comments</th>
											         <th>Decision</th>
											         <th>Time & date</th>
											        
											     </tr>
											     <?php
                                                    $commensInfoQuery=$db->query("SELECT * FROM sr_comments WHERE paperId='$paperId'");
                                                    $CommentsInfoCount = $commensInfoQuery->num_rows;
                                                    if($CommentsInfoCount>0){
                                                    while($commentsRows = $commensInfoQuery->fetch_assoc()){
											     ?>
											       <tr>
											         <td><?php echo $commentsRows['comments']; ?></td>
											         <td><?php  if($commentsRows['dstatus']==1) { echo "Accepted"; } else if($commentsRows['dstatus']==2) { echo "Rejected"; } if($commentsRows['dstatus']==3) { echo "Revised"; }?></td>
											         <td><?php echo $commentsRows['entryDate']; ?></td>

											     </tr>
											     <?php } } else {?>
											      <tr>
											         <td colspan="3">No data available.</td>
											     </tr>
											     <?php } ?>
											</table>
									</fieldset>
								</div>         
						                
						<?php } ?>
								
                    </article>
                </div>
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Reviewer Comments</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
								          
								          
							<?php
							  $revCommUniq=$db->query("select * from sr_reviwer_comments WHERE paperId='".$_GET['paperId']."' AND submit_status='1'");
                        $revCommRows=$revCommUniq->fetch_assoc();
                        $numRows=$revCommUniq->num_rows;
							if($numRows>0) {
							?>
							
						
                                <table class='table' width="100%" style="Text-align: justify;  font-size: 15px; color:#000; ">
                                    
                                       <tr>
                                             <td>1. <b>Originality of idea:</b> Does the paper contain new information and significant knowledge contribution to that justifies its publication? <br/>
                                        <?php if($revCommRows['submit_status']==1){ ?>
                                        <?php echo $revCommRows['comm1']; ?>
                                        <?php } else { ?>
                                                   <textarea class='form-control' name="comm1" id="comm1"><?php echo $revCommRows['comm1']; ?></textarea>
                                           <?php } ?>
                                                 
                                             </td>
                                       </tr>
                                       
                                       <tr>
                                             <td>2. <b>Contextualizing the Literature:</b> Does the manuscript evidence a comprehensive understanding of the relevant literature in the field? Does it cite the appropriate and significant works? Has (have) any significant work(s) been ignored?<br/>
                                    <?php if($revCommRows['submit_status']==1){ ?>
                                    <?php echo $revCommRows['comm2']; ?>
                                    <?php } else { ?>
                                                   <textarea class='form-control' name="comm2" id="comm2"><?php echo $revCommRows['comm2']; ?></textarea>
                                                   <?php } ?>
                                                 
                                             </td>
                                       </tr>
                                       
                                            
                                       <tr>
                                             <td>
                                                3. <b>Methodology: </b>
                                                Is the methodology of the paper appropriately designed? <br/>
                                                Does the paper build on any theories, concepts or defined frameworks? <br/>
                                                Does it offer any new theories, concepts or frameworks that can be tested further? <br/>
                                                Are the methods and techniques used appropriate and relevant for the work?<br/>
                                                Have the methods and techniques implemented appropriately?
                                                
                                                
                                                <br/>
                                                
                                                <?php if($revCommRows['submit_status']==1){ ?>
                                    <?php echo $revCommRows['comm3']; ?>
                                    <?php } else { ?>
                                                
                                                <textarea class='form-control' name="comm3" id="comm3"><?php echo $revCommRows['comm3']; ?></textarea>
                                         <?php } ?>
                                             </td>
                                       </tr>
                                       
                                            
                                       <tr>
                                             <td>4. <b>Results and discussions:</b> Does the paper report results with clarity? Does it interpret the results appropriately and adequately with support from the relevant literature? Do the conclusions align with the other elements of the paper, e.g., research objectives, results and discussions?<br/>
                                                        <?php if($revCommRows['submit_status']==1){ ?>
                                    <?php echo $revCommRows['comm4']; ?>
                                    <?php } else { ?>
                                                 
                                                   <textarea class='form-control' name="comm4" id="comm4"><?php echo $revCommRows['comm4']; ?></textarea>
                                            <?php } ?>
                                                 
                                             </td>
                                       </tr>
                                       
                                       
                                         <tr>
                                             <td>5. <b>Research implications:</b> Does the paper suggest any academic, professional, public and/or social policy formulation? Does the paper provide any direction as to how the research could help in further knowledge and practice in the broad areas of finance.<br/>
                                                          <?php if($revCommRows['submit_status']==1){ ?>
                                    <?php echo $revCommRows['comm5']; ?>
                                    <?php } else { ?>     
                                                   <textarea class='form-control' name="comm5" id="comm5"><?php echo $revCommRows['comm5']; ?></textarea>
                                              <?php } ?>   
                                             </td>
                                       </tr>
                                       
                                       <tr>
                                        <td>6. <b>Standard of communication: </b>
                                        Is the paper’s expression readable and up to the international standard, such as sentence structure, jargon use, acronyms, etc.?  <br/>
                                        Does the paper describes in language that is understandable to general readers in business, finance and economics?  <br/>
                                        Does the paper uses abbreviations and elaborates them appropriately? <br/>
                                        What is the quality of English language used in the paper?
                                        <br/>
                                                             <?php if($revCommRows['submit_status']==1){ ?>
                                    <?php echo $revCommRows['comm6']; ?>
                                    <?php } else { ?> 
                                                   <textarea class='form-control' name="comm6" id="comm6"><?php echo $revCommRows['comm6']; ?></textarea>
                                                <?php } ?>
                                                 
                                             </td>
                                       </tr>
                                            <tr>
                                        <td><b>Recommendation</b>
                                        <br/><br/>
                                                 <?php if($revCommRows['submit_status']==1){ ?>
                                    <?php echo $decision[$revCommRows['recom']]; ?>
                                    <?php } else { ?>       
                                                <select class="form-control"  name="recom" id="recom">
                                                    <option value=""> >-Select-< </option>
                                                    <?php foreach ($decision AS $key=>$val) { ?>
                                                             <option value="<?php echo $key; ?>" <?php  if($revCommRows['recom']==$key){ echo "selected"; }?>> <?php echo $val; ?> </option>
                                                      
                                                    <?php } ?>
                                                </select>
                                            <?php } ?>
                                             </td>
                                       </tr>
                                       
                                               <tr>
                                        <td><b>Confidential comments to the Editor</b>
                                        <br/>
                                                     <?php if($revCommRows['submit_status']==1){ ?>
                                    <?php echo $revCommRows['con_editor']; ?>
                                    <?php } else { ?> 
                                                   <textarea class='form-control' name="con_editor" id="con_editor"><?php echo $revCommRows['con_editor']; ?></textarea>
                                         <?php } ?>        
                                             </td>
                                       </tr>
                                                 <tr>
                                        <td><b>Other comments to the Author</b>
                                        <br/>
                                                             <?php if($revCommRows['submit_status']==1){ ?>
                                    <?php echo $revCommRows['com_author']; ?>
                                    <?php } else { ?> 
                                                   <textarea class='form-control' name="com_author" id="com_author"><?php echo $revCommRows['com_author']; ?></textarea>
                                                   <?php } ?>
                                                 
                                             </td>
                                       </tr>
                                               <tr>
                                        <td><b>Attach review documents</b>
                                        <br/>
                                                                  <?php if($revCommRows['submit_status']==0){ ?>
                                     <input type="file" class='form-control' name="rev_doc" id="rev_doc" />
                                    <?php }  ?>
                                                  
                                                  
                                               <?php if($numRows>0) { ?>  
                                               <a href="all_document/<?php echo $revCommRows['rev_doc']; ?>"     target="_blank">Download attachment  </a>    
                                              
                                               <?php } ?>  
                                                 
                                             </td>
                                       </tr>
                              
                                    
                                </table>   
									<?php } else { echo "No comments yet now."; } ?> 
									
									  </div>
									  
									
									</div>
								  </div>
								</div>
                
                
                
                
                
                
                
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