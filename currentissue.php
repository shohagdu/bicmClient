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
  
    <body>

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
                   
						 <article style="overflow-x:auto;">
					 
						<p>
						
						     <table>
							     <tr>
								     <td> <img src="images/cover.PNG" style="height: 170px; width: 130px;" /></td>
									    <td valign="top" style="padding: 10px;">
										<p style="Text-align: ;  font-size: 13px; line-height:22px; color:#000;">
										    
										    <a href="allissues.php"  style="Text-align: ;  font-size: 18px; line-height:22px;">Volume 1, Issue 1 <br/>LAUNCHING ISSUE: Role of Financial
Markets for Economic Development </a> 

										<br/>
                                        
                                        Published In: December, 2021 <br/>
                                       
                                        </span>
                                       
										</p>
									 </td>
								 </tr>
							 </table>
						    
							  
						
						</p>
					 </article>
							 <article style="overflow-x:auto;">
					 
						     <p  style="text-align: justify; font-size: 18px; line-height: 20px; color: black; font-weight: normal;"><a href='all_document/issue informations.pdf' style="text-align: justify;font-size: 20px; line-height: 20px; color:black; font-weight: normal;" target="_blank">	ISSUE INFORMATION  </a></p>
                              <p style="text-align: justify; font-size:13px; line-height: 20px; color: black; font-weight: normal;">
								     	<i>Published Online: 9 December 2021 | Published In Print: 28 December 2021</i>
									</span>
								  </p>
								  <p></p>
								      
							
								 </p>	 
								 
					 </article>
					 
					<article style="overflow-x:auto;">
					 
						     <p  style="text-align: justify; font-size: 18px; line-height: 20px; color: black; font-weight: normal;">EDITORIAL</p>
                                 <p style="text-align: justify; font-size:13px; line-height: 20px; color: black; font-weight: normal;">
								     	<i><a href='all_document/drMahfuz.pdf' style="text-align: justify;font-size: 13px; line-height: 20px; color:black; font-weight: normal;" target="_blank">Editorial by Editor-in-Chief Professor Dr. Mahfuzul Hoque</i> </a>
									</span>
								  </p>
								   <p style="text-align: justify; font-size:13px; line-height: 20px; color: black; font-weight: normal;">
								     	<i> <a href='all_document/drSubarna.pdf' style="text-align: justify;font-size: 13px; line-height: 20px; color:black; font-weight: normal;" target="_blank">	Editorial by Managing Editor Associate Professor Dr. Suborna Barua </i></a>
									</span>
								  </p>
							 
								 
					 </article>
			         <article style="overflow-x:auto;">
					 
						     <p  style="text-align: justify; font-size: 18px; line-height: 20px; color: black; font-weight: normal;">ARTICLES</p>
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
								 
					
                    
                         <p  style="text-align: justify; font-size: 18px; line-height: 20px; color: black; font-weight: normal;">CLOSING</p>
                          <p  style="text-align: justify; font-size: 13px; line-height: 20px; color: black; font-weight: normal;"><i> <a href='all_document/closing_mets.pdf' style="text-align: justify;font-size: 13px; line-height: 20px; color:black; font-weight: normal;" target="_blank">Closing Metarials</a></i></p>
                    <p></p><a href="https://188.166.198.24/" style="color:white">slot online</a>
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