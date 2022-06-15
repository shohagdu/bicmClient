<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<nav class="navbar navbar-expand-md navbar-dark topnav"  id="myTopnav" style="background: #014a7f;">
    
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNavbar"  >
                    <ul class="navbar-nav mr-auto">
                              <?php if(!isset($_SESSION['loguniqID'])){ ?>
						<li class="nav-item ">
                                <a class="nav-link" href="index.php" style="color: #fff; font-size:13px;">Home</a>
                        </li>
                        <?php } else { ?>
						<li class="nav-item ">
						        <?php if($_SESSION['type']==4 || $_SESSION['type']==2 || $_SESSION['type']==3){ ?>
                                <a class="nav-link" href="all_submission_pending.php" style="color: #fff; font-size:13px;">Home</a>
								<?php } else { ?>
								      <a class="nav-link" href="submission_status.php" style="color: #fff; font-size:13px;">Home</a>

								<?php } ?>
                        </li>
						<?php } ?>
                        <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="color: #fff; font-size:13px;">About</a>
                                    <div class="dropdown-menu navbar-dark bg-primary">
                                          <a class="dropdown-item" href="aboutjfmg.php">About JFMG</a>
                                            <a class="dropdown-item" href="editorialboard.php">Editorial Board</a>
                                          <a class="dropdown-item" href="aboutbicm.php">Publisher Information</a>
                                        <a class="dropdown-item"  href="contact.php">Contact</a>
                                          <a class="dropdown-item"  href="permission.php">Permissions</a>
                                    </div>
                        </li>
                         <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="color: #fff; font-size:13px;">Submit an Article</a>
                                    <div class="dropdown-menu navbar-dark bg-primary">
                                          <a class="dropdown-item" href="authorguideline.php">Author Guidelines</a>
                                          <a class="dropdown-item" href="login.php">Submit a Manuscript</a>
										  <a class="dropdown-item" href="openaccess.php">Open Access</a>

                                    </div>
                        </li>

                        <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="color: #fff; font-size:13px;">Browse</a>
                                    <div class="dropdown-menu navbar-dark bg-primary">
                                          <a class="dropdown-item" href="currentissue.php">Current Issue</a>
                                          <a class="dropdown-item" href="allissues.php">All Issues</a>
                                    </div>
                        </li>
                        
                    
                    </ul>
                 
               <a class="nav-link d-none d-md-block" href="alert.php" style="color: #000; font-size:20px; padding:3px; margin: 3px;"><span style="border-radius: 10px; background-color: #fff; padding-left:5px; padding-right:5px; padding-top:1px; padding-bottom:1px;" ><i class="fas fa-bell"></i></span></a><a class="nav-link d-none d-md-block" href="subscribe.php" style="color: #000; font-size:20px; padding:3px; margin: 3px;" ><span style="border-radius: 10px; background-color: #fff; padding:1px;" ><i class="fas fa-star"></i></span></a> <a class="nav-link d-none d-md-block" href="library.php" style="color: #000; font-size:20px; padding:3px; margin: 3px;"><span style="border-radius: 10px; background-color: #fff; padding-left:5px; padding-right:5px; padding-top:0px; padding-bottom:1px;"><i class="fas fa-book-reader"></i></span></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </span>
                </div>
                
                
                
            </div>
        </nav>