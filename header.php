    <div class="header-wrap">
            <div class="container">
                <div class="row">
                    
                    <!-- Left header box -->
                    <header class="col-6 text-left">
                          <table width="100%">
								    <tr>
									    <!--<td><img src="images/logo.jpg" style="height:70px; width: 200px;"/></td> -->
									    <td style="text-align: center; color:#000;"> <h2 style="text-align: left; color:#000; font-size:24px;"><a href="index.php" style="color:#000;">Journal of Financial Markets and Governance</a>
 </h2></td>
									</tr>
								</table>
                    </header>
                    
                    <!-- Right header box -->
					 <div class="col-3 text-center d-none d-md-block"> 

						<div class="search-container">
							<form action="#">
							    <table>
							        <tr>
							             <td>	<input type="text" placeholder="Search.." name="search"></td>
							             <td><button type="submit" style="background: #014a7f; color: #fff;">Submit</button></td>
							        </tr>
							
								
								</table>
							</form>
						</div>
					 
					 </div>
                    <div class="col-3 text-right">   
                        				
                        <p class="header-social-icons social-icons">
						   <?php 
						    session_start();
							if(isset($_SESSION['loguniqID'])){
								
								echo 'Login user: <span style="color: green;">'. $_SESSION['fullname']. '</span> &nbsp;&nbsp;&nbsp; <a href="logout.php" id="fontdesign">Logout</a><br/><a href="change_password.php" id="fontdesign">Change Password</a>';
							}
							else {
                             echo '<a href="login.php" id="fontdesign">Login</a> <a href="registration.php" id="fontdesign">Register</a>';
							}
							?>
                        </p>
                    </div>
                </div>
            </div>
        </div>