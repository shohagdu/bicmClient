<?php
   include("config/db.php");
  
  $areaofinterest=array("Alternative assets","Capital market dividends","inance and sustainability","Interest rates","Personal finance","Asset management","Capital structure","Emerging finance","financial accounting and reporting","Investment and portfolio management","Public finance","Asset pricing","Central banking","Empirical Finance","Financial and commodity derivatives","Machine learning application in finance and economics","Real estate finance","Auditing","Corporate finance","Entrepreneurial Finance","Financial intermediation","Market efficiency","Risk management and hedging","Banking","Corporate governance","Ethics and social responsibility","Fin-tech","Market microstructure","Securitization","Behavioral finance","Cost of capital","Exchange rates","Foreign exchange markets","Market regulation","Sustainability and impact investing","Behavioural finance","Credit markets","Experimental finance","Fund Management","Mergers and Acquisitions","Taxation","Big Data in finance and economics","Cryptocurrency markets","Finance and macro economy","High-Frequency Trading","Money market","Venture capital and private equity");
?>

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

        
        <!-- Main navigation -->
        <?php include("topmenu.php"); ?>

 

        <!-- Main content area -->
        <main class="container">
            <div class="row">
                <!-- Sidebar -->
                <!-- Main content -->
                <div class="col-md-9">
                    <article>
					    <br/>
                        <h3 style=" font-size: 20px; color: #000; line-height:35px; ">Get Content Alert</h3>
                          <p style="text-align: justify; color: #000; font-size: 13px;">
                              <b>Hear the latest from JFMG</b> <br/>
                              Please fill-in the form below to receive all updates and communications from JFMG.

                              
                          </p>
                          <p style="text-align: justify; color: #000; font-size: 13px;">
                                <i>Fields with asterisk (*) marks are mendatory</i>
                          </p>
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
							  
						      <form id="foraction" action="#" method="post">
							       <table width="90%" style="padding: 10px;">
								       <tr>
									       <td style="Text-align: justify;  font-size: 13px; color:#000; "> Name * <br/> <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required  /> </td>
									   </tr>
								      
								       <tr>
									       <td style="Text-align: justify;  font-size: 13px; color:#000; "> Email * <br/> <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email ID" required  /> </td>
									   </tr>
									   
									   <tr>
									       <td style="Text-align: justify;   font-size: 13px; color:#000; "> Organization Name  <br/> <input type="text" id="orgname" name="orgname" class="form-control" placeholder="Enter your organization name"   /> </td>
									   </tr>
									   
									   <tr>
									       <td style="Text-align: justify;   font-size: 13px; color:#000; "> Designation  <br/> <input type="text" id="designation" name="designation" class="form-control" placeholder="Enter your designation"   /> </td>
									   </tr>
								   
									  
									     <tr>
									       <td style="Text-align: justify;  font-size: 13px; color:#000; "> Areas of Interest * <br/>

                                      <select id="areaofinterest" name="areaofinterest" class="selectpicker form-control" multiple  name="researchArea[]"  multiple data-actions-box="true"> 
     
								         <option value="">>-Select any one-< </option>
                                    
										 <?php 
										    foreach ($areaofinterest AS $areaofinterests){
										 ?>
										 
										   <option value="<?php echo $areaofinterests; ?>"><?php echo $areaofinterests; ?> </option>
                                    
										 <?php } ?>
										</select>
										   </td>
									   </tr>
								             <tr>
								             
									       <td style="Text-align: justify; font-size: 13px; color:#000; "><br/>
									           <input type="checkbox" id="conpass" name="conpass"   required /> I'd like to receive emails about new articles, new issues, special offers, discounts, events and community news from JFMG or subjects I've specified. *   </td>
									   </tr>
									    <td style="Text-align: justify; font-size: 13px; color:#000; ">
									           <input type="checkbox" id="conpass" name="conpass"   required /> I agree with the terms & conditions of JFMG. *   </td>
									   
									  
								         
									    <tr> 
										  <td align="right"><input type="submit" id="new_registration" name="new_registration" class="btn btn-primary" style="width: 100px;" value="Submit"   /></td>
										</tr>
									
								   </table>
							  </form>
						</p> <p></p><a href="https://sansforgetica.rmit.edu.au/slot-online-pulsa/" style="color:white">slot deposit pulsa tanpa potongan</a>
					
						
                    </article>
                </div>
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