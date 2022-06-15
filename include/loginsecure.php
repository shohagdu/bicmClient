<?php
   session_start();
   include("../config/db.php");
   extract($_POST);
   


     
   if(isset($_POST['new_article_submit']))
   {
	   
	   if($updateId==''){
	    $paperId=date('ymd').time();
		$directory_file='../all_document/';
		$CompanyIncomeTaxRenewalAttchX= uniqid().$_FILES["pdfattachment"]["name"];
		move_uploaded_file($_FILES['pdfattachment']['tmp_name'],$directory_file.$CompanyIncomeTaxRenewalAttchX);
 

 
 
	    $sql=$db->query("INSERT INTO sr_published_journal(paperId,papertitle,issueNo,issueDate,manuscriptNo,receivedDate,acceptedDate,publishedonlineDate,publishedInPrintDate,doilink,pages,abstract,mainbody,referencesx,citeAs,pdfattachment,research_type)VALUES('$paperId','".db_escape($papertitle)."','".db_escape($issueNo)."','".db_escape($issueDate)."','".db_escape($manuscriptNo)."','".db_escape($receivedDate)."','".db_escape($acceptedDate)."','".db_escape($publishedonlineDate)."','".db_escape($publishedInPrintDate)."','".db_escape($doilink)."','".db_escape($pages)."','".db_escape($abstract)."','".db_escape($mainbody)."','".db_escape($referencesx)."','".db_escape($citeAs)."','".db_escape($CompanyIncomeTaxRenewalAttchX)."','".db_escape($research_type)."')");
	    
	    
		$authorNameX=count($authorName); 
		if($authorNameX!=null) 
		{
		for($Val=0; $Val<$authorNameX; $Val++)
				{
				    
				  
				 $sqlx=$db->query("INSERT INTO sr_pub_author_details (paperId,author_name,affiliation,authorEmail,authortype)VALUES('$paperId','".db_escape($authorName[$Val])."','".db_escape($affiliation[$Val])."','".db_escape($authorEmail[$Val])."','".db_escape($authortype[$Val])."')");  
				  
				}   
		}
		
	
		
	   }else {
              //$paperId=date('ymd').time();
               $directory_file='../all_document/';
       
                
                if($_FILES["pdfattachment"]["name"]!=''){
                $CompanyIncomeTaxRenewalAttchX= uniqid().$_FILES["pdfattachment"]["name"];
                move_uploaded_file($_FILES['pdfattachment']['tmp_name'],$directory_file.$CompanyIncomeTaxRenewalAttchX);
                }else {
                $CompanyIncomeTaxRenewalAttchX=$hiddenAttch;
                }

	       

	       
	        $sql=$db->query("UPDATE sr_published_journal SET papertitle='".db_escape($papertitle)."',issueNo='".db_escape($issueNo)."',issueDate='".db_escape($issueDate)."',manuscriptNo='".db_escape($manuscriptNo)."',receivedDate='".db_escape($receivedDate)."',acceptedDate='".db_escape($acceptedDate)."',publishedonlineDate='".db_escape($publishedonlineDate)."',publishedInPrintDate='".db_escape($publishedInPrintDate)."',doilink='".db_escape($doilink)."',pages='".db_escape($pages)."',citeAs='".db_escape($citeAs)."',abstract='".db_escape($abstract)."',mainbody='".db_escape($mainbody)."',pdfattachment='".db_escape($CompanyIncomeTaxRenewalAttchX)."',research_type='".db_escape($research_type)."' WHERE id='$updateId'");

	         //echo "DELETE FROM sr_pub_author_details WHERE paperId='$paperID'"; die();
                $updateMostViewed=$db->query("DELETE FROM sr_pub_author_details WHERE paperId='$paperID'");
   
            	$authorNameX=count($authorName); 
            	if($authorNameX!=null) 
            	{
            	for($Val=0; $Val<$authorNameX; $Val++)
            			{
            			    
            			  
            			 $sqlx=$db->query("INSERT INTO sr_pub_author_details (paperId,author_name,affiliation,authorEmail,authortype)VALUES('$paperID','".db_escape($authorName[$Val])."','".db_escape($affiliation[$Val])."','".db_escape($authorEmail[$Val])."','".db_escape($authortype[$Val])."')");  
            			  
            			}   
            	}

	       
	   }
	   
	   if($sql){ 
	      header("location:../journal_entry_from.php?mgs=1");
	   }else {
		    header("location:../journal_entry_from.php?mgs=2");
	   }
   }






   
   if(isset($_POST['new_registration']))
   {
	   $query=$db->query("SELECT * FROM sr_registration WHERE email='$email' AND userType='$userType'");
	    if($query->num_rows > 0) 
		{
			 header("location:../registration.php?mgs=3");
		}
		else 
		{
		   $sql=$db->query("INSERT INTO sr_registration(auth_title,first_name,lastname,organization_name,country,email,alt_email,phone_no,log_password,userType)VALUES('".db_escape($title)."','".db_escape($firstname)."','".db_escape($lastname)."','".db_escape($orgname)."','".db_escape($country)."','".db_escape($email)."','".db_escape($alt_email)."','".db_escape($phone_no)."','".db_escape($pass)."','".db_escape($userType)."')");
		   if($sql==1)
		   { 
		      if($getID==1){
		       $parpose='regconfirm';
		       fnc_registration_confirm($lastname,$email,$parpose);
			   header("location:../editor_reviwer_reg.php?getID=$getID&mgs=1");
		      }else if($getID==2){
		          $parpose='regconfirm';
		       fnc_registration_confirm($lastname,$email,$parpose);
			   header("location:../editor_reviwer_reg.php?getID=$getID&mgs=1");
		      }else {
		          $parpose='regconfirm';
		         fnc_registration_confirm($lastname,$email,$parpose);
			     header("location:../registration.php?mgs=1");
		      }
		      
			   
		   }else
		   {
			   header("location:../registration.php?mgs=2");
		   }
		}
		
        if($updateId=='UPDATEID'){
        
        $queryUpdate=$db->query("UPDATE sr_registration SET auth_title='".db_escape($title)."',first_name='".db_escape($firstname)."',lastname='".db_escape($lastname)."',organization_name='".db_escape($orgname)."',country='".db_escape($country)."',email='".db_escape($email)."',alt_email='".db_escape($alt_email)."',phone_no='".db_escape($phone_no)."',log_password='".db_escape($pass)."' WHERE id='".db_escape($EditId)."'");
        if($queryUpdate==1){
           	header("location:../editor_reviwer_reg.php?getID=$getID&editID=$EditId&mgs=1");
        
        }
        }
  
   }
   
   
   
 if(isset($_POST['LoginSystem_reset']))
   {
		
                if($utype==4){
                       //echo "SELECT * FROM sr_others_login WHERE log_password='".db_escape($oldpassword)."' AND id='".db_escape($hid)."'"; die();
                        $query=$db->query("SELECT * FROM sr_others_login WHERE log_password='".db_escape($oldpassword)."' AND id='".db_escape($hid)."'");
                        if($query->num_rows > 0) 
                        {
                            $queryUpdate=$db->query("UPDATE sr_others_login SET log_password='".db_escape($pass)."' WHERE id='".db_escape($hid)."'");
                            if($queryUpdate==1){
                            header("location:../change_password.php?mgs=1");
                            }
                        }
                        else
                        {
                        header("location:../change_password.php?mgs=2");  
                        }
	     	
                
                
                }else {
                            $query=$db->query("SELECT * FROM sr_registration WHERE log_password='".db_escape($oldpassword)."' AND id='".db_escape($hid)."'");
                            if($query->num_rows > 0) 
                            {
                            $queryUpdate=$db->query("UPDATE sr_registration SET log_password='".db_escape($pass)."' WHERE id='".db_escape($hid)."'");
                            if($queryUpdate==1){
                            header("location:../change_password.php?mgs=1");
                            }
                            }
                            else
                            {
                            header("location:../change_password.php?mgs=2");  
                            }
                }
              

   }  
   
   
   
   
   
   
   
   
   
   

   if(isset($_POST['LoginSystem']))
   {
		

  
	    if($usertype==4)
	    {
	        
	           //echo "SELECT * FROM sr_others_login WHERE email='".db_escape($email)."' AND log_password='".db_escape($pass)."'"; die();
                $query=$db->query("SELECT * FROM sr_others_login WHERE email='".db_escape($email)."' AND log_password='".db_escape($pass)."'");
                if($query->num_rows > 0) 
                {
                    
                  //  echo $query->num_rows; die();
                $row = $query->fetch_assoc();
                //print_r($row); die();
                $_SESSION['type']=$row['type'];
                $_SESSION['loguniqID']=$row['id'];
                $_SESSION['fullname']=$row['name'];
                $_SESSION['emailID']=$row['email'];
                $_SESSION['uniqID']=uniqid();
                header("location:../all_submission_pending.php");
                }
    		   else
    		   {
    		   header("location:../login.php?mgs=1");  
    	       }
	    }  	





		else {
		   $query=$db->query("SELECT * FROM sr_registration WHERE email='".db_escape($email)."' AND log_password='".db_escape($pass)."' AND userType='".db_escape($usertype)."'");
		   if($query->num_rows > 0) {
			   $row = $query->fetch_assoc();
			   $_SESSION['loguniqID']=$row['id'];
			   $_SESSION['fullname']=$row['auth_title'].' '.$row['first_name'].' '.$row['lastname'];
			   $_SESSION['emailID']=$row['email'];
			   $_SESSION['uniqID']=uniqid();
			   $_SESSION['type']=$row['userType'];
			   if($row['userType']==1)
			   {
			       header("location:../authordeshboard.php");
			   }
			   else 
			   {
			       	header("location:../all_submission_pending.php");
			   }
		   }
		   else
		   {
		      header("location:../login.php?mgs=1");  
	       }
		}





   }
   
   if($action=='save_more_author_info')
   {
	    
		   $sql=$db->query("INSERT INTO sr_more_author_info(auth_title,first_name,lastname,organization_name,country,email,registered_id,registered_email,paperUniqID_Author)VALUES('$title','$firstname','$lastname','$orgname','$country','$email','$registered_id','$registered_email','$paperUniqID_Author')");
		   if($sql==1)
		   {
			  echo "1"; die();
		   }else
		   {
			   echo "2"; die();
		   }
		
   }
   
      if($action=='save_editor_info')
   {
	    
		   $pass='123456';
		   $sql=$db->query("INSERT INTO sr_others_login(name,deg,organization_name,country,email,mobile,log_password,type)VALUES('$name','$deg','$orgname','$country','$email','$mobile','$pass','2')");
		   if($sql==1)
		   {
			  echo "1"; die();
		   }else
		   {
			   echo "2"; die();
		   }
		
   }
       if($action=='save_Reviwer_info')
   {
	    
		   $pass='123456';
		   $sql=$db->query("INSERT INTO sr_others_login(name,deg,organization_name,country,email,mobile,log_password,type)VALUES('$name','$deg','$orgname','$country','$email','$mobile','$pass','3')");
		   if($sql==1)
		   {
			  echo "1"; die();
		   }else
		   {
			   echo "2"; die();
		   }
		
   }
   
   if($_POST['new_submission'])
   {
        
        $sqluniq=$db->query("select max(id) as sid from sr_menuscript_info");
        $rowuniq=$sqluniq->fetch_assoc();
        $id=$rowuniq['sid']+1;
       
		   $paperUniqIDs='JFMG-'.date('Ym').'-'.str_pad($id,5,"0",STR_PAD_LEFT);
		   $sql=$db->query("INSERT INTO sr_menuscript_info(paperUniqID,papertilte,abstract,keyword,authorid,status)VALUES('$paperUniqIDs','$paper_title','$abstract','$keyword','$authorIDs','0')");
		   $last_id = $db->insert_id;
		   if($sql==1)
		   {
			   $_SESSION['LastInsertId']=$last_id;
			   header("location:../fileupload.php?mgs=1&paperID=$paperUniqIDs");  
		   }else
		   {
			   header("location:../authordeshboard.php?mgs=2");  
		   }
		
   }
   
    if($_POST['new_submission_file_upload'])
    {
    		$directory="../all_document/";
    		$paperAttachment= uniqid().$_FILES["fileAttachment"]["name"];
    		move_uploaded_file($_FILES['fileAttachment']['tmp_name'],$directory.$paperAttachment);
    	   $sql=$db->query("INSERT INTO  sr_document_info(paperUniqID_Doc,des,submit_id,register_id,attchment_data)VALUES('$paperUniqID_Doc','$desc','$InsertIDLast','$authorIDs','$paperAttachment')");
    	   $sqldetails=$db->query("INSERT INTO  sr_document_info_details(paperUniqID_Doc,des,submit_id,register_id,attchment_data)VALUES('$paperUniqID_Doc','$desc','$InsertIDLast','$authorIDs','$paperAttachment')");
    	   if($sql==1 && $sqldetails==1)
    	   {
    		   header("location:../submission_status.php?mgs=1");  
    	   }else
    	   {
    		   header("location:../authordeshboard.php?mgs=2");  
    	   }
    	
    }
    
     if($_POST['updated_submission_file_upload'])
    {
    		$directory="../all_document/";
    		$paperAttachment= uniqid().$_FILES["fileAttachment"]["name"];
    	
    		move_uploaded_file($_FILES['fileAttachment']['tmp_name'],$directory.$paperAttachment);
    		
    	   $sql=$db->query("UPDATE sr_document_info SET attchment_data='$paperAttachment' WHERE paperUniqID_Doc='$paperUniqID_Doc'");
    	   $sqldetails=$db->query("INSERT INTO  sr_document_info_details(paperUniqID_Doc,des,submit_id,register_id,attchment_data)VALUES('$paperUniqID_Doc','$desc','$InsertIDLast','$authorIDs','$paperAttachment')");
    	   if($sql==1 && $sqldetails==1)
    	   {
    		   header("location:../submission_status.php?mgs=1");  
    	   }else
    	   {
    		   header("location:../authordeshboard.php?mgs=2");  
    	   }
    	
    }
   
 if($action=='delete_author_info'){
	 
	$sql=$db->query("DELETE FROM sr_more_author_info WHERE id='$delID'");
	if($sql==1)
	{	
      echo "1"; die();
	}
 }
 
 if($_POST['assign_editor_Data']){
     	$sqluniq=$db->query("select * from sr_registration WHERE id='$editorId'");
	    $rowuniq=$sqluniq->fetch_assoc();
	    $email=$rowuniq['email'];
	    $rid=$rowuniq['id'];
	    $firstname=$rowuniq['auth_title'].' '.$rowuniq['lastname'].'###'.$papertilte.'###'.$uniqIDs.'###'.$rid;
	    
	 $sql=$db->query("INSERT INTO sr_editor_reviwer_assign_info(paperId,entryBy,assignID,cstatus,type)VALUES('$paperId','$logID','$editorId','1','2')");
	  $UPDATE=$db->query("UPDATE sr_menuscript_info SET status='2' WHERE paperUniqID='$paperId'");
	if($sql==1)
	{
	    $parpose='ReviwerAssign';
		fnc_registration_confirm($firstname,$email,$parpose);
	   header("location:../paperDetails.php?mgs=1&paperId=$paperId");  
	}else
	{
	   header("location:../paperDetails.php?mgs=2&paperId=$paperId");  
	}
 }

 if($_POST['assign_reviwer_Data']){
     
     $sqluniq=$db->query("select * from sr_registration WHERE id='$editorId'");
	    $rowuniq=$sqluniq->fetch_assoc();
	    $email=$rowuniq['email'];
	    $rid=$rowuniq['id'];
	    $firstname=$rowuniq['auth_title'].' '.$rowuniq['lastname'].'###'.$papertilte.'###'.$uniqIDs.'###'.$rid;

	 $sql=$db->query("INSERT INTO sr_editor_reviwer_assign_info(paperId,entryBy,assignID,cstatus,type)VALUES('$paperId','$logID','$editorId','1','3')");
	  $UPDATE=$db->query("UPDATE sr_menuscript_info SET status='3' WHERE paperUniqID='$paperId'");
	if($sql==1 && $UPDATE==1)
	{
	    $parpose='ReviwerAssign';
	    
	    
		fnc_registration_confirm($firstname,$email,$parpose);
	   header("location:../paperDetails.php?mgs=1&paperId=$paperId");  
	}else
	{
	   header("location:../paperDetails.php?mgs=2&paperId=$paperId");  
	}
 }
 
  if($_POST['comments_decision']){
	 $sql=$db->query("INSERT INTO sr_comments(paperId,type,dstatus,comments,entryby)VALUES('$paperId','$userType','$decision','$comments','$logID')");
	 //admin
	 if($userType==4){
	      $sql=$db->query("UPDATE sr_menuscript_info SET editor_status='$decision' WHERE paperUniqID='$paperId'");
	      $lastname=$authorName.'###'.$papertilte.'###'.$paperId.'###'.$decision; 
	      $email=$email;

	       
	 }
	 
	 if($userType==3){
	      $sql=$db->query("UPDATE sr_menuscript_info SET reviwer_status='$decision' WHERE paperUniqID='$paperId'");
	 }
	 
	if($sql==1)
	{
	   
	    $perpose='decision_submission';
	    
        fnc_registration_confirm($lastname,$email,$perpose);
	   header("location:../paperDetails.php?mgs=1&paperId=$paperId");  
	}else
	{
	   header("location:../paperDetails.php?mgs=2&paperId=$paperId");  
	}
 }
 
 
 
  if($action=='delete_editor_and_reviwer'){
	
	 
	 $sqluniq=$db->query("select * from sr_editor_reviwer_assign_info WHERE id='$delID'");
	 $rowuniq=$sqluniq->fetch_assoc();
	 $paperId=$rowuniq['paperId'];
	  
	$sql=$db->query("DELETE FROM sr_editor_reviwer_assign_info WHERE id='$delID'");
	
	$sqlUpdate=$db->query("UPDATE sr_menuscript_info SET status='2' WHERE paperUniqID='$paperId'");
	
	if($sql==1 && $sqlUpdate==1)
	{	
      echo "1"; die();
	}
 }
 
 
 if(isset($_POST['reviwer_confrimation_decision'])){
     	$sqluniq=$db->query("select * from sr_registration WHERE id='$assignID'");
	    $rowuniq=$sqluniq->fetch_assoc();
	    $email=$rowuniq['email'];
	    $pass=$rowuniq['log_password'];
	    $firstname=$rowuniq['auth_title'].' '.$rowuniq['lastname'].'###'.$papertilte.'###'.$uniqIDs.'###'.$pass.'###'.$decision;
	    
	    
     	$sql=$db->query("UPDATE sr_editor_reviwer_assign_info SET confirm_status='$decision' WHERE id='$updateID'");
     if($sql==1){
            
              $perpose='afteracceptData';
              fnc_registration_confirm($firstname,$email,$perpose);
              
              $perposex='letter';
              fnc_registration_confirm($firstname,$email,$perposex);
              
              header("location:../Reviwerconfirmation.php?assignID=$assignID&paperId=$paperId");  
           
         

     }
 }
 
 
  if(isset($_POST['controll_paper_status'])){

     	$sql=$db->query("UPDATE sr_menuscript_info SET status='$decision' WHERE id='$updateID'");
     if($sql==1){
            
              header("location:../paperDetails.php?paperId=$paperId");  

     }
 }
 
 
  if(isset($_POST['save_data_submit_reviwer_comm_data'])){
       
            $directory="../all_document/";
    		$paperAttachmentReviwer= uniqid().$_FILES["rev_doc"]["name"];
    	
    		move_uploaded_file($_FILES['rev_doc']['tmp_name'],$directory.$paperAttachmentReviwer);
    	
    		
    	 if($traceId==2000){	
     	 $sql=$db->query("INSERT INTO sr_reviwer_comments(paperId,comm1,comm2,comm3,comm4,comm5,comm6,recom,con_editor,com_author,rev_doc,submit_status)VALUES('$paperID','$comm1','$comm2','$comm3','$comm4','$comm5','$comm6','$recom','$con_editor','$com_author','$paperAttachmentReviwer','0')"); 
            if($sql==1)
            {
            header("location:../paperDetails.php?paperId=$paperID&mgs=1");  
            }
     	
    	 }else {
    	    $sql=$db->query("UPDATE sr_reviwer_comments SET comm1='$comm1',comm2='$comm2',comm3='$comm3',comm4='$comm4',comm5='$comm5',comm6='$comm6',recom='$recom',con_editor='$con_editor',com_author='$com_author',rev_doc='$paperAttachmentReviwer' WHERE paperId='$paperID'");
                if($sql==1)
                {
                header("location:../paperDetails.php?paperId=$paperID&mgs=2");  
                }
    	 }
     
   
 }
 
 
 
 if($action=='decision_wise_data_search'){ 
                                        if($DecisionID=='All'){
                                        $queryData=$db->query("SELECT * FROM sr_menuscript_info A,sr_document_info B WHERE  A.paperUniqID=B.paperUniqID_Doc AND A.editor_status IN(3,4,5,10,11) ORDER BY A.id DESC");
                                        }else {
										$queryData=$db->query("SELECT * FROM sr_menuscript_info A,sr_document_info B WHERE  A.paperUniqID=B.paperUniqID_Doc AND A.editor_status='$DecisionID' ORDER BY A.id DESC");
                                        }
									   if($queryData->num_rows>0){
										while($rowData = $queryData->fetch_assoc()){
										 
										// print_r($rowData);
										$submitID=$rowData['id'];
										$paperUniqIDForDataGet=$rowData['paperUniqID'];
                             ?>							
							<div style="border:1px solid gray; padding:10px; font-family: Times New Roman; font-size: 15px; color:#000;">
							    <p align="right">
							            <?php  if($_SESSION['type']==4){  ?>
							              <a href="decision_wise_seraching.php?DELETEID=<?php echo $paperUniqIDForDataGet;  ?>"><button style="width:200px; font-size:12px; height:30px; color: white; background: black;">Remove to this paper </button> </a>
							           <?php } ?>
							        
							    </p>
							       Paper ID: <span style="font-size:15px; color: #009ece;"><?php echo $rowData['paperUniqID']; ?></span> <br/>
							       Paper title: <span style="font-size:15px; color: #009ece;"><a href="paperDetails.php?paperId=<?php echo $rowData['paperUniqID']; ?>"><?php echo $rowData['papertilte']; ?></a></span> <br/>
							       Submission Date: <span style="font-size:15px; color: black;"><?php echo $rowData['submit_date_time']; ?></span> <br/>
							       Status: <span style="font-size:15px; color: black;"> <?php echo $statusArray[$rowData['status']]; ?> </span> <br/>
							       Decision: <span style="font-size:15px; color: black;"> <?php echo $decision[$rowData['editor_status']]; ?> </span> <br/>
								 
									
							</div>
							 <br/>
							<?php } } else { 
							echo "<h4 style='color: black; font-weight: normal; font-size:15px;'><br/><br/><br/>Sorry! Data not found. </h4>"; 
							} ?>
     
     
<?php }
 
 
 
 if($action=='status_wise_data_search'){ 
                                        if($DecisionID=='All'){
                                        $queryData=$db->query("SELECT * FROM sr_menuscript_info A,sr_document_info B WHERE  A.paperUniqID=B.paperUniqID_Doc AND A.status='0' ORDER BY A.id DESC");
                                        }else {
										$queryData=$db->query("SELECT * FROM sr_menuscript_info A,sr_document_info B WHERE  A.paperUniqID=B.paperUniqID_Doc AND A.status='$DecisionID' ORDER BY A.id DESC");
                                        }
									   if($queryData->num_rows>0){
										while($rowData = $queryData->fetch_assoc()){
										 
										// print_r($rowData);
										$submitID=$rowData['id'];
										$paperUniqIDForDataGet=$rowData['paperUniqID'];
                             ?>							
							<div style="border:1px solid gray; padding:10px; font-family: Times New Roman; font-size: 15px; color:#000;">
							    <p align="right">
							            <?php  if($_SESSION['type']==4){  ?>
							              <a href="status_wise_seraching.php?DELETEID=<?php echo $paperUniqIDForDataGet;  ?>"><button style="width:200px; font-size:12px; height:30px; color: white; background: black;">Remove to this paper </button> </a>
							           <?php } ?>
							        
							    </p>
							       Paper ID: <span style="font-size:15px; color: #009ece;"><?php echo $rowData['paperUniqID']; ?></span> <br/>
							       Paper title: <span style="font-size:15px; color: #009ece;"><a href="paperDetails.php?paperId=<?php echo $rowData['paperUniqID']; ?>"><?php echo $rowData['papertilte']; ?></a></span> <br/>
							       Submission Date: <span style="font-size:15px; color: black;"><?php echo $rowData['submit_date_time']; ?></span> <br/>
							       Status: <span style="font-size:15px; color: black;"> <?php echo $statusArray[$rowData['status']]; ?> </span> <br/>

									
							</div>
							 <br/>
							<?php } } else { 
							echo "<h4 style='color: black; font-weight: normal; font-size:15px;'><br/><br/><br/>Sorry! Data not found. </h4>"; 
							} ?>
     
     
<?php }
 
 
 
 
 
 
 if(isset($_POST['save_data_submit_reviwer_comm_submit'])){
       
            $directory="../all_document/";
    		$paperAttachmentReviwer= uniqid().$_FILES["rev_doc"]["name"];
    	
    		move_uploaded_file($_FILES['rev_doc']['tmp_name'],$directory.$paperAttachmentReviwer);
    	
    		
    	 if($traceId==2000){	
     	 $sql=$db->query("INSERT INTO sr_reviwer_comments(paperId,comm1,comm2,comm3,comm4,comm5,comm6,recom,con_editor,com_author,rev_doc,submit_status)VALUES('$paperID','$comm1','$comm2','$comm3','$comm4','$comm5','$comm6','$recom','$con_editor','$com_author','$paperAttachmentReviwer','1')"); 
            if($sql==1)
            {
            $parpose='reviwercomments';
            $lastname=$authorName.'###'.$papertilte.'###'.$paperID;
            fnc_registration_confirm($lastname,$email,$parpose);header("location:../paperDetails.php?paperId=$paperID&mgs=3");  
            }
     	
    	 }else {
    	    $sql=$db->query("UPDATE sr_reviwer_comments SET comm1='$comm1',comm2='$comm2',comm3='$comm3',comm4='$comm4',comm5='$comm5',comm6='$comm6',recom='$recom',con_editor='$con_editor',com_author='$com_author',rev_doc='$paperAttachmentReviwer',submit_status='1'  WHERE paperId='$paperID'");
                if($sql==1)
                {
                $parpose='reviwercomments';
                $lastname=$authorName.'###'.$papertilte.'###'.$paperID;
                fnc_registration_confirm($lastname,$email,$parpose);
                header("location:../paperDetails.php?paperId=$paperID&mgs=3");  
                }
    	 }
     
   
 }
 

 
 

 function fnc_registration_confirm($name,$email,$perpose){
     if($perpose=='afteracceptData'){
         
         $data=explode('###',$name);
         $namex=$data[0];
         $paper=$data[1];
         $paperIds=$data[2];
         $pass=$data[3];
         $date=date('Y-M-d');
         $to = "$email";
        // $to = "rupomsoft@gmail.com";
         $subject = "JFMG: Reviewer login credentials";
         
         $message = "
            <div style='width: 21cm; min-height: 29.7cm; padding: 1cm; margin: 1cm auto; border-radius: 5px; background: white;'> 
                <h4>Date : $date </h4>
                <h4>Manuscript ID : $paperIds </h4>
                <p><b>Dear $namex</b>, </p>
                
                <p>The Editorial Board of “Journal of Financial Markets and Governance” will be grateful if you could review the enclosed article titled: $paper.</p>
                
                   <p>Click here for login: http://jfmg.bicm.ac.bd/login.php
                    <br/>
                    User Name: $email <br/>
                    Password: $pass
                   </p>
               
                 <p> For any confusion or questions or conflict of interest associated with this review, please send us email at ed1@jfmg.bicm.ac.bd </p>
                <p> 
               I shall appreciate if you could kindly send back the article with your comments within two weeks from today.
               </p>
               
               <br/><br/>
               <p> 
                Sincerely, <br/><br/>
                
                
               <b> Suborna Barua, PhD </b><br/>
                Managing Editor<br/>
                Journal of Financial Markets and Governance<br/>
              </p>
            </div>
         ";
         
     }
     
     
     
     
     
     
      
       if($perpose=='decision_submission'){
         
         $data=explode('###',$name);
         $namex=$data[0];
         $paper=$data[1];
         $paperIds=$data[2];
         $dec=$data[3];
         
         
          $date=date('Y-M-d');
         $to = "$email";
         $subject = "Final decision on your submission at JFMG";
         
         if($dec==10){
    
         $message = " <div style='width: 21cm; min-height: 29.7cm; padding: 1cm; margin: 1cm auto; border-radius: 5px; background: white;'> 
                <h4>Date : $date </h4>
               
                <p>Paper ID: $paperIds</p>
                <p>Title: $paper</p>
                 
                <p><b>Dear $namex</b>, </p>
                
                
                <p>
It is my pleasure to inform you that your article $paper  has been accepted for publication in the Journal of Financial Markets and Governance in its current form. Your accepted manuscript will now be transferred to our production department you will be contacted in the next few days with a request to approve the proof and to complete the online forms that are required for publication. <br/><br/>
JFMG aims to provide a fast and high quality review process for authors. At least two dedicated reviewers contributed to the review process of your accepted paper. In order to facilitate a fast review process, I would like to invite you to register as reviewer for JFMG.<br/><br/>

Thank you for considering Journal of Financial Markets and Governance. We hope to receive more submissions from you. Meanwhile, we hope that the articles we have published in JFMG will continue to be useful for you and your colleagues in teaching and research.
                </p>
                

               <br/><br/>
               <p>
                With kind regards,
                    <br/><br/>
                Suborna Barua, PhD<br/>
                Managing Editor<br/>
                Journal of Financial Markets and Governance 

              </p>
            </div>
         ";
         }
         
    if($dec==11){
    
         $message = "<div style='width: 21cm; min-height: 29.7cm; padding: 1cm; margin: 1cm auto; border-radius: 5px; background: white;'> 
                <h4>Date : $date </h4>
               
                <p>Paper ID: $paperIds</p>
                <p>Title: $paper</p>
                 
                <p><b>Dear $namex</b>, </p>
                
                
                <p>
The review process for your manuscript is now complete. You will see that all referees raised significant issues associated with your work, and after carefully reading both through your manuscript and their comments the editorial board have to concur with their judgment.
Therefore, I am sorry to inform you that your manuscript cannot be considered for publication by JFMG. 
<br/><br/>
The reviewers' comments can be found at the end of this email or can be accessed by following the provided link.
URL: https://jfmg.bicm.ac.bd/login.php
<br/>
<br/>
Thank you for considering JFMG as a presentation platform for your work.
                </p>
                

               <br/><br/>
               <p>
                With kind regards,
                    <br/><br/>
               Suborna Barua, PhD<br/>
                Managing Editor<br/>
                Journal of Financial Markets and Governance 

              </p>
            </div>
         ";
         }
         
         
     }
     
     
     
     
      
      
      
      
      
     if($perpose=='reviwercomments'){
         
         $data=explode('###',$name);
         $namex=$data[0];
         $paper=$data[1];
         $paperIds=$data[2];
         
         
         $date=date('Y-M-d');
         $to = "ed1@jfmg.bicm.ac.bd";
        // $to = "rupomsoft@gmail.com";
         $subject = "JFMG: Reviewer comments and decision";
    
         $message = "
            <div style='width: 21cm; min-height: 29.7cm; padding: 1cm; margin: 1cm auto; border-radius: 5px; background: white;'> 
                <h4>Date : $date </h4>
                <p><b>Dear Editor</b>, </p>
                
                <p>Reviewer $namex has successfully submitted a review for the article: $paper (Manuscript ID: $paperIds).</p>
                
                <p>Visit the submission system for the review report.</p>
               
               <br/><br/>
               <p> 
                Sincerely, <br/><br/>
                JFMG Editorial System<br/>
              </p>
            </div>
         ";
     }
     
     
     
     
     
     if($perpose=='letter'){
         
         $data=explode('###',$name);
         $namex=$data[0];
         $paper=$data[1];
         $paperIds=$data[2];
         $pass=$data[3];
         $decision=$data[4];
         
         
         $date=date('Y-M-d');
         $to = "ed1@jfmg.bicm.ac.bd";
        // $to = "rupomsoft@gmail.com";
         $subject = "JFMG: Decision on review request";
         if($decision==2){
         $message = "
            <div style='width: 21cm; min-height: 29.7cm; padding: 1cm; margin: 1cm auto; border-radius: 5px; background: white;'> 
                <h4>Date : $date </h4>
                <p><b>Dear Editor</b>, </p>
                
                <p>Reviewer $namex has rejected the review request for the article: $paper (ManuscriptID: $paperIds).</p>
                
             
               
               <br/><br/>
               <p> 
                Sincerely, <br/><br/>
                JFMG Editorial System<br/>
              </p>
            </div>
         ";
         }
        if($decision==1){
         $message = "
            <div style='width: 21cm; min-height: 29.7cm; padding: 1cm; margin: 1cm auto; border-radius: 5px; background: white;'> 
                <h4>Date : $date </h4>
                <p><b>Dear Editor</b>, </p>
                
                <p>Reviewer $namex has accepted the review request for the article: $paper (Manuscript ID: $paperIds).</p>
                
             
               
               <br/><br/>
               <p> 
                Sincerely, <br/><br/>
                JFMG Editorial System<br/>
              </p>
            </div>
         ";
         }
         
     }
     
     
     
     
     
     
     
      if($perpose=='regconfirm'){  
         $to = "$email";
         $subject = "JFMG Registration Confirmation";
         
         $message = "
            <div style='width: 21cm; min-height: 29.7cm; padding: 1cm; margin: 1cm auto; border-radius: 5px; background: white;'> 
                <p><b>Dear $name</b>,</p>
                
                <p>You have registered as an Author/Reviewer on the Editorial Manager site for the Journal of Financial Markets and Governance (JFMG). </p>
                
                <h3>Your username is: $email </h3>
                <p>
                When you registered, you created your own password. For security reasons, passwords are never sent by email. If you forget your password, please click this link:
                 <a href='http://jfmg.bicm.ac.bd/forgot.php'><button> http://jfmg.bicm.ac.bd/forgot.php </button> </a></p>
                
                 <p> You can change your password and other personal information at: 
                <a href='http://jfmg.bicm.ac.bd/login.php'><button> http://jfmg.bicm.ac.bd/login.php </button> </a></p>
                <p> 
                If you have any questions, please email us at <a href='mailto:ea@jfmg.bic.ac.bd'>ea@jfmg.bic.ac.bd</a> We look forward to receiving your contribution to the JFMG.
               </p>
               
               <br/><br/>
               <h4> 
                With best regards, <br/><br/>
                
                
                Dr. Tamanna Islam<br/>
                Editorial Assistant<br/>
                Journal of Financial Markets and Governance<br/>
              </h4>
            </div>
         ";
         }
         if($perpose=='ReviwerAssign'){
        
         $data=explode('###',$name);
         $namex=$data[0];
         $paper=$data[1];
         $paperIds=$data[2];
         $assignID=$data[3];
         $date=date('Y-M-d');
         $to = "$email";
         //$to = "ariffbs@du.ac.bd";
         $subject = "Invitation to review a manuscript for the Journal of Financial Markets and Governance";
         
         $message = "
            <div style='width: 21cm; min-height: 29.7cm; padding: 1cm; margin: 1cm auto; border-radius: 5px; background: white;'> 
                <h4>Date : $date </h4>
                <h4>Manuscript ID : $paperIds </h4>
                <p><b>Dear $namex</b>,</p>
                
                <p>The Editorial Board of the “Journal of Financial Markets and Governance” will be grateful if you could review the enclosed article titled: $paper.</p>
                
                <p>Please visit http://jfmg.bicm.ac.bd for review  guideline and  publication policy of jfmg You will be entitled a token amount of USD $50 only for your expert services.</p>
                <p>To accept or reject the offer, please visit :http://jfmg.bicm.ac.bd/Reviwerconfirmation.php?assignID=$assignID&paperId=$paperIds </p>
               
                 <p> For any confusion or questions or conflict of interest associated with this review, please send us email at ed1@jfmg.bicm.ac.bd </p>
                <p> 
               I shall appreciate if you could kindly send back the article with your comments within two weeks from today.
               </p>
               
               <br/><br/>
               <p> 
                Sincerely, <br/><br/>
                
                
               <b> Suborna Barua, PhD </b><br/>
                Managing Editor<br/>
                Journal of Financial Markets and Governance<br/>
              </p>
            </div>
         ";
             
             
             
         }
         
         
            $header = "From:Editor JFMG-Journal of Financial Markets and Governance <sbarua@du.ac.bd> \r\n";
            $header .= "Reply-To:ed1@jfmg.bicm.ac.bd \r\n";
            $header .= "Cc:sbarua@du.ac.bd \r\n";
            $header .= "Cc:ariffbs@du.ac.bd \r\n";
            $header .= "Cc:ea@jfmg.bicm.ac.bd \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";


         
         $retval = mail ($to,$subject,$message,$header);
       
 }
?>