<!doctype html>
<html>
<head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <title>TravX</title>
        <meta name="description" content="Master the art of ancient tactics as Roman, Gaul or Teuton!" />
        <link media="all" type="text/css" rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/form.css" />
        <link rel="icon" href="css/img/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="css/img/favicon.ico" type="image/x-icon" />
    </head>
    <body>

        <div id="trv_wrapper">
            <div id="trv_page">
                
           <div id="partnerMod"></div>
                <!--Header-->
                <div id="trv_header">
                    <div class="trv_header_info">

                    </div>
                </div>
                <div id="headline"></div>
                <div class="trv_form_part">
                    <h2><br /></h2>
                    <ul>
                        <li>100x</li>
                        <li>100x</li>
                        <li>10x</li>
                    </ul>
                    
                
        <form name="formular" action="login.php" method="post">
        <input type="hidden" name="check" value="{code}" />
        <div style="position: absolute;  top: 150px; left: 8px">    
			<input type="text" id="loginNameID" name="username" placeholder="Username" id="username" type="text" value="{username}"/>&nbsp;&nbsp;{error1}<br />
        </div>
        <div style="position: absolute;  top: 180px; left: 8px">    
			<input name="password" type="password" placeholder="Password" id="loginNameID" value="{password}" /> {error2}
			<input type="hidden" name="redirect" value="index.php" />			
        </div>
        
        <div style="position: absolute;  top: 132px; left: 49px">
        <input type="image" src="css/img/login.png" onmouseover="this.src='css/img/login.png'" onmouseout="this.src='css/img/login.png'" onclick="form.submit()" />
        </div>
        
        <div class="text" style="position: absolute;  top: 45px; left: 285px"><p class="stats">{players}</p></div>
        <div class="text" style="position: absolute;  top: 80px; left: 270px"><p class="stats">{online}</p></div>
        
        <br />
        
        </form>
        <!-- NEWS 1 -->
        <div style="position: absolute;  top: 150px; left: 199px;height: 70px;">
        <font size="1" color="gray"></font>        <br />
        <font size="1"></font><!--News Mehet ide--><font size="2"><a href='register.php'><b>REGISTER NOW</b></a></font>        </div>
        
  
        
        <div style="position: absolute;  top: 523px; left: -550px">
        </div>
        
        <div style="position: absolute;  top: 206px; left: 8px">
        <font size="1"></font>
        </div>
        

            
            
            
            
            
            
                </div>
                <div class="trv_slider_area">
                    <!-- Facebook-Feld-->
                    <div class="trv_fb_field">
                        
                    </div>
                    <!-- Screenshot-Slider -->
                    <div id="trv_wrap_img">
                        <h3></h3>
                        <div class="trv_image_carousel">
                        
                            <div class="clearfix"></div>
                    
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <div id="trv_footer">
                    <div class="trv_footer_2">&copy; 2006 - 2013 TravX. All rights reserved</div>
                </div>
            </div>
        </div>
        <div id="trv_overlay">  </div>
        <!-- Layer 1 -->
        <div id="trv_layer1" class="trv_layer">
            <a class="trv_close" onclick="closeLayer();" href="#" ></a>
        </div>
        <!-- Layer 2 -->
        <div id="trv_layer2" class="trv_layer">
            <a class="trv_close" onclick="closeLayer();" href="#"></a>
        </div>
        <!-- Layer 3 -->
        <div id="trv_layer3" class="trv_layer">
            <a class="trv_close" onclick="closeLayer();" href="#"></a>
        </div>
        <!-- Layer 4 -->
        <div id="trv_layer4" class="trv_layer">
            <a class="trv_close" onclick="closeLayer();" href="#"></a>
        </div>
        <!-- Layer 5 -->
        <div id="trv_layer5" class="trv_layer">
            <a class="trv_close" onclick="closeLayer();" href="#"></a>
        </div>

    </body>

</html>