<?php

error_reporting(0);
      session_start();
      include_once 'oesdb.php';
      if($_REQUEST['stdsubmit'])
      {
/***************************** Step 1 : Case 2 ****************************/
 //Perform Authentication
          $result=executeQuery("select *,DECODE(stdpassword,'oespass') as std from student where stdname='".htmlspecialchars($_REQUEST['name'],ENT_QUOTES)."' and stdpassword=ENCODE('".htmlspecialchars($_REQUEST['password'],ENT_QUOTES)."','oespass')");
          if(mysql_num_rows($result)>0)
          {

              $r=mysql_fetch_array($result);
              if(strcmp(htmlspecialchars_decode($r['std'],ENT_QUOTES),(htmlspecialchars($_REQUEST['password'],ENT_QUOTES)))==0)
              {
                  $_SESSION['stdname']=htmlspecialchars_decode($r['stdname'],ENT_QUOTES);
                  $_SESSION['stdid']=$r['stdid'];
                  unset($_GLOBALS['message']);
                  header('Location: stdwelcome.php');
              }else
          {
              $_GLOBALS['message']="Check Your user name and Password.";
          }

          }
          else
          {
              $_GLOBALS['message']="Check Your user name and Password.";
          }
          closedb();
      }
?>



<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>Practice Adda</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">    
    <link rel="shortcut icon" href="favicon.png">  
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'> 
    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Plugins CSS -->    
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="assets/plugins/prism/prism.css">
    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/styles.css">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head> 

<body data-spy="scroll">
    
     <?php

        if($_GLOBALS['message'])
        {
         echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
        }
      ?>
    <!---//Facebook button code-->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    
    <!-- ******HEADER****** --> 
    <header id="header" class="header">  
        <div class="container">            
            <h1 class="logo pull-left">
                <a class="scrollto" href="#promo">
                    <span class="logo-title">Practice <span class="title">Adda</span>
                </a>
            </h1><!--//logo-->              
            <nav id="main-nav" class="main-nav navbar-right" role="navigation">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button><!--//nav-toggle-->
                </div><!--//navbar-header-->            
                <div class="navbar-collapse collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active nav-item sr-only"><a class="scrollto" href="#promo">Home</a></li>
                        <li class="nav-item"><a class="scrollto" href="#about">About</a></li>

                        <li class="nav-item"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Upcoming Exams<span class="caret"></span></a><ul class="dropdown-menu" style="overflow: visible;background-color: white">
          <li><a href="#">Banking</a></li>
          <li><a href="#">SSC</a></li>
          <li><a href="#">Railways</a></li>
        </ul></li>
                        <li class="nav-item"><a class="scrollto"  href="#features">Features</a></li>
                        

                        <li class="nav-item last"><a  href="currentaffairs.php">Current Affairs</a></li>
                        <li class="nav-item last"><a class="scrollto" href="#contact">Contact</a></li>
     
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </nav><!--//main-nav-->
        </div>
    </header><!--//header-->
    
    <!-- ******PROMO****** -->
    <section id="promo" class="promo section offset-header" style="margin-top: -1%">
    <div class="row">


    <div class="col-md-8 col-sm-12 col-xs-12">
            <h5 class="title" style="font-size:350%;text-align: center;" >Practice<span class="highlight">Adda</span></h5>
            <p class="intro" style="font-size:150%;text-align: center;">An online examination preparation website for aspirants!</p></div>
            <div class="col-md-4 col-sm-12 col-xs-12" style="padding-right: 5%">
<div style="background-color:white ;border-top:solid  #17baef;box-shadow:  4px 4px  grey; "">
<p style="text-align: center;color:black;background-color:#0081AF;color:white">Notifications:</p>
<ul class="fa-ul"><marquee scrollamount="1.5" direction="up"><li class="fa fa-hand-o-right" style="color:black">&nbsp;<a style="color:#0081AF" href="#">first</a></li><br>
<li class="fa fa-hand-o-right" style="color:black">&nbsp;<a style="color:#0081AF" href="#"> second</a></li><br>
<li class="fa fa-hand-o-right" style="color:black">&nbsp;<a style="color:#0081AF" href="#"> third</a></li><br>
<li class="fa fa-hand-o-right" style="color:black">&nbsp; <a style="color:#0081AF" href="#">fourth</a></li></marquee></ul>
</div>

<hr><span style="margin-left: 30%">Student Login</span>

      <form action="index.php">              <div class="input-group margin-bottom-sm">
             <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
  <input type="text" class="form-control" id="usr" placeholder="Enter Username" name="name"><br></div>
  <div class="input-group">
    <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
  <input type="password" class="form-control" id="pwd" placeholder="Enter Password" name="password"></div>

  
  <input type="submit" class="btn btn-default" name="stdsubmit" value="Login">
  </form>

</div>           </div>
                   
         <!--//meta-->
        <!--//container-->
        
    </section><!--//promo-->
    
    <!-- ******ABOUT****** --> 
    <section id="about" class="about section">
        <div class="container">
            <h2 class="title text-center">What is PracticeAdda</h2>
            <p class="intro text-center">Project details here!! Ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate.</p>
            <div class="row">
                <div class="item col-md-4 col-sm-6 col-xs-12">
                    <div class="icon-holder">
                        <i class="fa fa-heart"></i>
                    </div>
                    <div class="content">
                        <h3 class="sub-title">Designed for Aspirants</h3>
                        <p>Outline a benefit here.  Ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
                    </div><!--//content-->
                </div><!--//item-->
                <div class="item col-md-4 col-sm-6 col-xs-12">
                    <div class="icon-holder">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <div class="content">
                        <h3 class="sub-title">Time saver</h3>
                        <p>Outline a benefit here.  Ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,  </p>
                    </div><!--//content-->
                </div><!--//item-->
                <div class="item col-md-4 col-sm-6 col-xs-12">
                    <div class="icon-holder">
                        <i class="fa fa-crosshairs"></i>
                    </div>
                    <div class="content">
                        <h3 class="sub-title">Real Time Environment</h3>
                        <p>Outline a benefit here.  Ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,  </p>
                    </div><!--//content-->
                </div><!--//item-->           
                <div class="clearfix visible-md"></div>    
                <div class="item col-md-4 col-sm-6 col-xs-12">
                    
                  <!--//content-->
                </div><!--//item-->                
                <div class="item col-md-4 col-sm-6 col-xs-12">
                   
                   <!--//content-->
                </div><!--//item-->
                <div class="item col-md-4 col-sm-6 col-xs-12">
                                      <!--//content-->
                </div><!--//item-->               
            </div><!--//row-->            
        </div><!--//container-->
    </section><!--//about-->
    
    <!-- ******FEATURES****** --> 
    <section id="features" class="features section">
        <div class="container text-center">
            <h2 class="title">Features</h2>
            <ul class="feature-list list-unstyled">
                <li><i class="fa fa-check"></i>Real Time Environment</li>
                <li><i class="fa fa-check"></i>Multiple Exams</li>
                <li><i class="fa fa-check"></i> Hindi/English</li>
                <li><i class="fa fa-check"></i> Compatible with all modern browsers</li>
            </ul>
        </div><!--//container-->
    </section><!--//features-->
    
    <!-- ******DOCS****** --> 
 <hr>   
    <!-- ******CONTACT****** --> 
    <section id="contact" class="contact section has-pattern">
        <div class="container" style="background-color: white">
            <div class="contact-inner">
                <h2 class="title  text-center">Contact Us</h2>
               <div class="row">
               <div class="col-sm-6 col-xs-12 col-md-6 col-lg-6" style="background-color: #DCDCDC;margin-bottom: 3%">
<br>  <form>
    <div class="form-group">
    <label for="name" style="color:black">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Name">


      <label for="email" style="color:black">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email">
    
    <label for="name" style="color:black">Phone Number</label>
      <input type="tel" class="form-control" id="name" placeholder="Enter Name">
    
      <label for="query" style="color:black">Query:</label>
<textarea class="form-control" rows="5" id="comment"></textarea>    </div>
    <button type="submit" class="btn btn-danger">ssSubmit</button>
  </form>
<!--isme maps daalne h-->

  </div>
<div class="col-sm-1 col-xs-12 col-md-1 col-lg-1">
</div>

                 <div class="col-sm-5 col-xs-12 col-md-5 col-lg-5" style="color:black">
<h4 style="color:black;font-family: Times New Roman">Feel free to get in touch with us:</h4>
<i class="fa fa-inbox" aria-hidden="true"></i>info@practiceadda.com<br><br>
<i class="fa fa-mobile" aria-hidden="true"></i>7368040555<br><br>
<i class="fa fa-map-marker" aria-hidden="true"></i>Road No.39,Chitkora,Patna,Bihar 800002<br><br>
<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d28783.133032495996!2d85.07715786869899!3d25.608517107200043!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sRoad+39%2Cchitkora%2Cpatna!5e0!3m2!1sen!2sin!4v1496229588509"  frameborder="0" style="border:0;height:200%;width:100%" allowfullscreen></iframe>


</div>

            </div><!--//contact-inner-->
        </div><!--//container-->
    </section><!--//contact-->  
      
    <!-- ******FOOTER****** --> 
    <footer class="footer">
        <div class="container text-center">
            <small class="copyright">Designed & Developed By  <a href="http://www.twentyfive.in" target="_blank">TwentyFive Technoarts!</a> </small>
        </div><!--//container-->
    </footer><!--//footer-->
     <script>
     $(function() {
    $('marquee').mouseover(function() {
        $(this).attr('scrollamount',0);
    }).mouseout(function() {
         $(this).attr('scrollamount',5);
    });
});
     </script>
    <!-- Javascript -->          
    <script type="text/javascript" src="assets/plugins/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="assets/plugins/jquery-migrate-1.2.1.min.js"></script>    
    <script type="text/javascript" src="assets/plugins/jquery.easing.1.3.js"></script>   
    <script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>     
    <script type="text/javascript" src="assets/plugins/jquery-scrollTo/jquery.scrollTo.min.js"></script> 
    <script type="text/javascript" src="assets/plugins/prism/prism.js"></script>    
    <script type="text/javascript" src="assets/js/main.js"></script>       
</body>
</html> 

