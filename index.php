






<!doctype html>
<html lang="en">
	<head>
        <title>Journal of Financial Markets and Governance</title>

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
        <script>
                document.onkeydown = function(e) {
                if(event.keyCode == 123) {
                return false;
                }
                if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
                return false;
                }
                if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
                return false;
                }
                if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
                return false;
                }
                if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
                return false;
                }
                }
      </script>
    <body oncontextmenu="return false">

        <!-- Header -->
   
            <?php include("header.php"); ?>
            <?php include("topmenu.php"); ?>
			

        <!-- Jumbtron / Slider -->

            <?php //include("slider.php"); ?>
        <!-- Main content area -->
        <main class="container">
            <div class="row">

                
                <!-- Main content -->
                <div class="col-md-9">
                    <article style="color: #000;">
                        <br/>
                        <h2 style=" font-size: 20px; line-height:30px;">About the Journal   </h2>

                        <p style="text-align: justify;    font-size: 13px; line-height: 20px;">
                           The Journal of Financial Markets and Governance focuses on facilitating the exchange of scholarly knowledge between academics, industry stakeholders and the regulators across the world in the fields of finance, accounting and governance studies.
                           <br/><br/>
                          The journal welcomes original research articles, reviews, and industry insights related to finance and investment, governance, financial institutions, money and capital markets, and the interlinks between financial markets and the economy at the country, regional, and world level.

                      
                            <br/><br/>
                        JFMG is officially published and supported by the Bangladesh Institute of Capital Market – Bangladesh’s only state-run specialized institute for offering academic degree programs, training and research in areas related to financial markets.

						</p>

                      
                    </article>
					
					 <article style="overflow-x:auto;">
					    <h2 style="Text-align: justify;   font-size: 20px; color:#000;">Featured</h2>
						<p>
						
						     <table>
							     <tr>
								     <td> <img src="images/CFP.png"  /></td>
									    <td valign="top" style="padding: 10px;">
										<p style="Text-align: ;  font-size: 14px; line-height:22px; color:#000;"><a href="images/CFP-v2.pdf"  style="Text-align: ;  font-size: 14px; line-height:22px;">Call for Papers: Role of Financial
Markets for Economic Development </a> 
										<br/>
                                        Issue 1 Volume 1 <br/>
                                        Manuscript submission deadline: 28 February 2021 </span>
                                        <br/>
                                        <a href="login.php" style="Text-align: justify;   font-size: 15px;">Click here for submission</a>
										</p>
									 </td>
								 </tr>
							 </table>
						    
							  
						
						</p>
					 </article>
					<nav>

</nav>

                     <article>
						<h2 style="Text-align: justify;   font-size: 15px; color: #000;">Published Articles</h2>
						
							<div class="nav nav-tabs" id="nav-tab" role="tablist">
								<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"  style="Text-align: justify;   font-size: 15px; color: #000;">Most Recent</a>
								<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"  style="Text-align: justify; font-size: 15px; color: #000;">Most Viewed</a>
							</div>
						  <div class="tab-content">
							<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
							  
							     <p>
								 <?php
								    include("config/db.php");
									$query=$db->query("SELECT * FROM sr_published_journal");
									while($row = $query->fetch_assoc()){
								 ?>
								
								 <p><a href="journaldetails.php?pid=<?php echo $row['paperId']; ?>"   style="text-align: justify;    font-size: 13px; line-height: 20px;"><?php echo htmlspecialchars_decode($row['papertitle']); ?></a> <br/>
									<span style="text-align: justify;font-size: 13px; line-height: 20px; color:black;">
								 
									<?php
									$pid=$row['paperId'];
									$queryx=$db->query("SELECT * FROM sr_pub_author_details WHERE paperId='$pid' ORDER BY authortype ASC");
									$count=$rowx = $queryx->num_rows;
									while($rowx = $queryx->fetch_assoc()){
									?>
									
									<?php 
									 
									
									echo $rowx['author_name']; ?> 
									
									<?php } ?>
									<br/>
									Pages: <?php echo $row['pages']; ?> |  Published Online: <?php echo $row['publishedonlineDate']; ?> | Published In Print: <?php echo $row['publishedInPrintDate']; ?>
									</span>
								  </p>
								  <p><i><a href="journaldetails.php?pid=<?php echo $row['paperId']; ?>"   style="text-align: justify;    font-size: 13px; line-height: 20px; color: #142d3d;"> Abstract </a>  |  <a href="journaldetails.php?pid=<?php echo $row['paperId']; ?>"   style="text-align: justify;    font-size: 13px; line-height: 20px; color: #142d3d;"> Full text </a> | <a href="all_document/<?php echo $row['pdfattachment']; ?>"  style="text-align: justify;    font-size: 13px; line-height: 20px; color: #142d3d;" target="_blank"> PDF </a> | <a href="#"   style="text-align: justify;    font-size: 13px; line-height: 20px; color: #142d3d;">References</a> | <a href="#"   style="text-align: justify;    font-size: 13px; line-height: 20px; color: #142d3d;"> Request permission </a> </i></p>
								       <hr/>
								<?php } ?>
								 </p>
					
                         
							</div>
							<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
							 
							  
							  
							  
							  
							  <p>
								 <?php
								    //include("config/db.php");
									$queryx=$db->query("SELECT * FROM sr_published_journal WHERE countMostView NOT IN(0)  ORDER BY countMostView DESC");
									while($rowx = $queryx->fetch_assoc()){
								 ?>
								
								 <p><a href="journaldetails.php?pid=<?php echo $rowx['paperId']; ?>"   style="text-align: justify;    font-size: 13px; line-height: 20px;"><?php echo htmlspecialchars_decode($rowx['papertitle']); ?></a> <br/>
									<span style="text-align: justify;font-size: 13px; line-height: 20px; color:black;">
								 
									<?php
									$pidx=$rowx['paperId'];
									$queryxx=$db->query("SELECT * FROM sr_pub_author_details WHERE paperId='$pidx' ORDER BY authortype ASC");
									$count=$rowxx = $queryxx->num_rows;
									while($rowxx = $queryxx->fetch_assoc()){
									?>
									
									<?php 
									 
									
									echo $rowxx['author_name']; ?> 
									
									<?php } ?>
									<br/>
									Pages: <?php echo $rowx['pages']; ?> |  Published Online: <?php echo $rowx['publishedonlineDate']; ?> | Published In Print: <?php echo $rowx['publishedInPrintDate']; ?>
									</span>
								  </p>
								  <p><i><a href="journaldetails.php?pid=<?php echo $rowx['paperId']; ?>"   style="text-align: justify;    font-size: 13px; line-height: 20px; color: #142d3d;"> Abstract </a>  |  <a href="journaldetails.php?pid=<?php echo $rowx['paperId']; ?>"   style="text-align: justify;    font-size: 13px; line-height: 20px; color: #142d3d;"> Full text </a> | <a href="all_document/<?php echo $rowx['pdfattachment']; ?>"  style="text-align: justify;    font-size: 13px; line-height: 20px; color: #142d3d;" target="_blank"> PDF </a> | <a href="#"   style="text-align: justify;    font-size: 13px; line-height: 20px; color: #142d3d;">References</a> | <a href="#"   style="text-align: justify;    font-size: 13px; line-height: 20px; color: #142d3d;"> Request permission </a> </i></p>
								       <hr/>
								<?php } ?>
								 </p>
							  
							  
							  
					
							  
							</div>
						  </div>
					 </article>

                </div>
                
			                                 <!-- Sidebar -->
                <?php include("sidebar.php"); ?>
				
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