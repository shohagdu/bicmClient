<?php
   session_start();
   include("config/db.php");
   if(!isset($_SESSION['loguniqID'])){
	   header("location:logout.php");
   }
   $pid=$_SESSION['loguniqID'];
   $query=$db->query("SELECT * FROM sr_registration WHERE id='$pid'");
   $row = $query->fetch_assoc();
   
   $queryArray=$db->query("SELECT * FROM sr_registration");
   while($rowArray = $queryArray->fetch_assoc()){
        $nameArray[$rowArray['id']]=$rowArray['auth_title'].' '.$rowArray['first_name'].' '.$rowArray['lastname'];
        $EmailArray[$rowArray['id']]=$rowArray['email'];
   }
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
        <?php //include("header.php"); ?>

        
        <!-- Main navigation -->
        <?php //include("topmenu.php"); ?>

 

        <!-- Main content area -->
        <main class="container">
            <div class="row">
                <!-- Sidebar -->
                  <?php //include("sidebaradmin.php"); ?>
                <!-- Main content -->
                <div class="col-md-12">
                    <article>
					    <br/>
                        
                        <h3 class="article-title" style="Text-align: right;  font-family: Times New Roman; font-size: 20px; color:#000; "><button onclick="window.print()">All Print</button></h3>
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
							          if($_SESSION['type']==4){
										$queryData=$db->query("SELECT * FROM sr_menuscript_info A,sr_document_info B WHERE  A.paperUniqID=B.paperUniqID_Doc ORDER BY A.id DESC");
									   }else if($_SESSION['type']==2) {
										   $queryData=$db->query("SELECT * FROM sr_menuscript_info A, sr_document_info B,sr_editor_reviwer_assign_info C WHERE  A.paperUniqID=B.paperUniqID_Doc AND A.paperUniqID=C.paperId AND C.assignID='$pid' ORDER BY A.id DESC");
                                         // echo  "SELECT * FROM sr_menuscript_info A, sr_document_info B WHERE  A.paperUniqID=B.paperUniqID_Doc AND A.editorID='$pid' ORDER BY A.id DESC";
									   }
									   else if($_SESSION['type']==3) {
										   	$queryData=$db->query("SELECT * FROM sr_menuscript_info A, sr_document_info B,sr_editor_reviwer_assign_info C WHERE  A.paperUniqID=B.paperUniqID_Doc AND A.paperUniqID=C.paperId AND C.assignID='$pid' ORDER BY A.id DESC");
                                         // echo  "SELECT * FROM sr_menuscript_info A, sr_document_info B WHERE  A.paperUniqID=B.paperUniqID_Doc AND A.editorID='$pid' ORDER BY A.id DESC";
									   }
							?>
							<table border="1" rules="all">
							    <tr style="font-size:15px; color: #000; font-weight:bolder;">
							        <td colspan="3"><h3 class="article-title" style="Text-align: center;  font-family: Times New Roman; font-size: 20px; color:#000; ">All Pending Papers</h3></td>
							    </tr>
							     <tr style="font-size:15px; color: #000; font-weight:bolder;">
							         <td>Author Info</td>
							         <td>Paper Title</td>
							         <td>Reviwer Info</td>
							         
							     </tr>
						
							<?php
										while($rowData = $queryData->fetch_assoc()){
										$submitID=$rowData['id'];
										$paperUniqIDForDataGet=$rowData['paperUniqID'];
                             ?>	
                             
                               <tr style="font-size:12px; color: #000;">
                                   <td align="top">
                                       <ul>
                                            <li>
                                               Author: <?php echo $nameArray[$rowData['authorid']]; ?> <br/>
                                               email: <?php echo $EmailArray[$rowData['authorid']]; ?>
                                            </li>
                                          <?php 
                                            $MoreAuthor=$db->query("SELECT * FROM sr_more_author_info WHERE paperUniqID_Author='$paperUniqIDForDataGet'");
                                            $MoreAuthorCount = $MoreAuthor->num_rows;
                                            if($MoreAuthorCount>0){
                                            while($MoreAuthorx = $MoreAuthor->fetch_assoc()){
                                          ?>
                                            <li>
                                               Author: <?php echo $MoreAuthorx['auth_title'].' '.$MoreAuthorx['first_name'].' '.$MoreAuthorx['lastname']; ?> <br/>
                                               email: <?php echo $MoreAuthorx['email']; ?>
                                            </li>
                                          <?php } } ?>
                                          
                                       </ul>
                                   </td>
                                    <td align="top">Paper ID: <?php echo $rowData['paperUniqID']; ?> <br/>
                                        Title: <?php echo $rowData['papertilte']; ?><br/>
                                        Submit Date: <?php echo $rowData['submit_date_time']; ?><br/>
                                        Status:  <?php echo $statusArray[$rowData['status']]; ?>
                                   </td>
                                   <td align="top">
                                        <ul>
                                       <?php 
                                            $ReviwerAssignInfo=$db->query("SELECT B.name,B.email,B.mobile,B.organization_name,A.entryDate,A.id FROM sr_editor_reviwer_assign_info A,sr_others_login B WHERE A.assignID=B.id AND A.paperId='$paperUniqIDForDataGet' AND A.type='2'");
                                            $ReviwerEntrycount = $ReviwerAssignInfo->num_rows;
                                            if($ReviwerEntrycount>0){
                                            while($ReviwerAssign = $ReviwerAssignInfo->fetch_assoc()){
                                       ?>
                                        
                                             <li>
                                                 Name: <?php echo $ReviwerAssign['name'];?> <br/> 
                                                 Email: <?php echo $ReviwerAssign['email'];?> <br/>
                                                 Assign Date: <?php echo $ReviwerAssign['entryDate'];?>
                                             </li>
                                               
                                        
                                       
                                       <?php } } else { ?>
                                       
                                             <li>
                                                 N/A
                                             </li>
                                             
                                         <?php } ?>
                                       
                                       </ul>
                                   </td>
                               </tr>
						
						
							<?php } ?>
							</table>		
                    </article>
                </div>
                
            </div> 
        </main>


        <?php //include("footer.php"); ?>



        <!-- Bootcamp JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="common_function.js"></script>
		 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    </body>
</html>