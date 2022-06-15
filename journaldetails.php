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
    <style>
    #authorHover {
    background-color: yellow;
    padding: 20px;
    display: none;
    }
    
    #autorLink:hover + authorHover {
    display: block;
    }
    </style>
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
                    <article style="color: #000;">
					<br/>
                     <?php
                     
                    
                     	          
                                   
                                   
								    include("config/db.php");
									$pidx=$_GET['pid'];
								
									 $updateMostViewed=$db->query("UPDATE sr_published_journal SET countMostView='$countMostView+1' WHERE paperId='$pidx'");
									$query=$db->query("SELECT * FROM sr_published_journal WHERE paperId='$pidx'");
									$row = $query->fetch_assoc();
								 ?>
                   
						
					<p>
					    
					             <p> <a href="" style="text-align: justify;    font-size: 13px; line-height: 20px;">LAUNCHING ISSUE: Role of financial markets in economic development/ <?php echo $row['issueNo']; ?> <a/></p>
					             <p><a href="" style="text-align: justify; font-size: 13px; line-height: 20px; color: black; font-weight: normal;">    <?php echo $row['research_type']; ?> </a> | <i class="fas fa-lock"></i> <a href="openaccess.php" style="text-align: justify; font-size: 13px; line-height: 20px; color: black; font-weight: normal;"> Open Access </a>
					             </p>
								 
								
								 <p><a href="journaldetails.php?pid=<?php echo $row['paperId']; ?>" style="text-align: justify; font-size: 15px; line-height: 20px; color: black;">
								     <?php echo htmlspecialchars_decode($row['papertitle']); ?>
								     </a> <br/>
							 	   <span style="text-align: justify;font-size: 13px; line-height: 20px; color:black;">
									<?php
									$pid=$row['paperId'];
									$queryx=$db->query("SELECT * FROM sr_pub_author_details WHERE paperId='$pid' ORDER BY authortype ASC");
									while($rowx = $queryx->fetch_assoc()){
									?>
								
									<span id="autorLink">
									<a href='' style="text-align: justify;font-size: 13px; line-height: 20px; color:black; font-weight: normal;"><?php if($rowx['authortype']==1) { echo '<i class="fas fa-envelope"> </i>'; } ?> <?php echo $rowx['author_name']; ?> </a> </span>
									   <span id="authorHover">xxxx</span>
									<?php } ?>
									<br/>
									    Published Online: <?php echo $row['publishedonlineDate']; ?> | Published In Print: <?php echo $row['publishedInPrintDate']; ?> | <a href="journaldetails.php?pid=<?php echo $row['paperId']; ?>"><?php echo $row['doilink']; ?></a>
									
									</span>
								  </p>
								  <p align="right"><a href='all_document/<?php echo $row['pdfattachment']; ?>' style="text-align: justify;font-size: 13px; line-height: 20px; color:black; font-weight: normal;" target="_blank">	PDF <i class="fas fa-file-pdf"></i> </a>| <a href='' style="text-align: justify;font-size: 13px; line-height: 20px; color:black; font-weight: normal;"> <i class="fas fa-file-tools"></i> TOOLS </a></p>
							
							
					
								 </p>
								 
								 <p>
								     <p  style="text-align: justify; font-size: 18px; line-height: 20px; font-weight: normal;">Abstract</p>
									 <p style="text-align: justify; font-size: 13px; line-height: 20px; font-weight: normal;"><?php echo htmlspecialchars_decode($row['abstract']); ?></p>
								 </p>
								 <br/>
								 <br/>
								 <p>
								    
									 <p style="Text-align: justify; font-size: 15px;"><?php echo htmlspecialchars_decode($row['mainbody']); ?></p>
								 </p>
						  

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