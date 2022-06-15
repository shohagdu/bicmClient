<?php session_start(); ?>
<aside class="col-md-3">
	<div class="sidebar-box">
		<h4 class="list-group-item active" style="font-size:12px;">  Menu</h4>
		<div class="list-group list-group-root" style="text-align: justify;  font-size: 13px; ">
		
			<a class="list-group-item " href="all_submission_pending.php"> > All pending papers</a>
			
		    <?php if($_SESSION['type']==4){ ?>
		       <a class="list-group-item " href="status_wise_seraching.php">> Status wise papers search</a>
		      <a class="list-group-item " href="decision_wise_seraching.php">> Decision wise papers search</a>
		   
		    <a class="list-group-item " href="all_submission_reviewer.php"> > All under review papers</a>

			<a class="list-group-item " href="list_editor.php"> > Editorial Board</a>
			<a class="list-group-item " href="list_reviwer.php">> Reviewer info</a>
				<a class="list-group-item " href="authorinfo_list.php">> Author Info</a>
						<a class="list-group-item " href="all_journal_published.php">> Journal Entry Form</a>
			<?php } ?>
			
		    <?php if($_SESSION['type']==2){ ?>
		    <a class="list-group-item " href="all_submission_reviewer.php"> > All under review papers</a>

			<a class="list-group-item " href="list_reviwer.php">> Reviewer info</a>
			<?php } ?>
			
				<a class="list-group-item " href="all_submission_accepted2.php">>  Accepted papers</a>
			
			<a class="list-group-item " href="all_submission_rejected.php">>  Rejected papers</a>
		
		
	
		</div>
	</div>
</aside> 
                