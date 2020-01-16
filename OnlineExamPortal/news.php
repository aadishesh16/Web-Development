<?php
include_once("oesdb.php");
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>Online Exam Preparation</title>
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
        <div class="container"">            
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
                        <li class="nav-item"><a class="" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Upcoming Exams<span class="caret"></span></a><ul class="dropdown-menu">
          <li><a href="">Banking</a></li>
          <li><a href="#">SSC</a></li>
          <li><a href="#">Railways</a></li>
        </ul></li>

                        <li class="nav-item last"><a href="currentaffairs.php">Current Affairs</a></li>
                        <li class="nav-item last"><a class="scrollto" href="#contact">Contact</a></li>
     
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </nav><!--//main-nav-->
        </div>
    </header><!--//header-->
 <section id="about" class="about section">
        <div class="container" style="border-top:solid  #17baef;background-color: white;box-shadow:  4px 4px grey; "> <br>
            <h3 class="title text-center" style="font-family: Times New Roman"><i><u>Top Stories</u></i></h3>
           
                <div class="item col-md-8 col-sm-6 col-xs-12" >
                <?php  
                $id =$_GET["id"];
                $sql =executeQuery("Select * from currentaffairs where id ='$id' ");
               $row =mysql_fetch_row($sql);
               $row_words =explode("*",$row[2]);  ?>
            <ul class="fa-ul"> <?php   foreach($row_words as $rows) {
?>
                   <li class="fa fa-chevron-circle-right" aria-hidden="true" ><?= "  ".$rows." " ;?></li><hr> <?php } ?></ul> 

                                      <a href="currentaffairs.php"><< Back to current affairs</a>
                <div class="item col-md-4 col-sm-6 col-xs-12">
                   
                   <!--//content-->
                </div><!--//item-->
                <div class="item col-md-4 col-sm-6 col-xs-12">
                                      <!--//content-->
                </div><!--//item-->               
            </div><!--//row-->            
        </div><!--//container-->
    </section><!--//about-->
    

<div class="container">
</div>
   <section id="contact" class="contact section has-pattern">
        <div class="container">
            <div class="contact-inner">
                <h2 class="title  text-center">Contact Us</h2>
               
  <h2>Vertical (basic) form</h2>
  <form>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="query">Query:</label>
<textarea class="form-control" rows="5" id="comment"></textarea>    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>

            </div><!--//contact-inner-->
        </div><!--//container-->
    </section><!--//contact-->  
 
    <footer class="footer">
        <div class="container text-center">
            <small class="copyright">Designed & Developed By  <a href="http://www.scriptexcel.com" target="_blank">Script Excel</a> </small>
        </div><!--//container-->
    </footer><!--//footer-->
     
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
   