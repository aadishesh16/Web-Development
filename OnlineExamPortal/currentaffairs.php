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
            <h3 class="title text-center" style="font-family: Times New Roman"><i><u>Current Affairs</u>!</i></h3>
          <div class="row">
          <div style="padding-left: 3%" class="col-xs-2 col-md-2 col-sm-2 col-lg-2 ">
           <h5> Search news from:</h5>
           </div>
          <div class="col-xs-2 col-md-2 col-sm-2 col-lg-2">
<form method="GET">
  <select class="form-control" id="sel" name="month">
    <option >--Select Month--</option>

    <option value="1">January</option>
    <option value="2">Febraury</option>
    <option value="3">March</option>
    <option value="4">April</option>
    <option value="5">May</option>
    <option value="6">June</option>
    <option value="7">July</option>
    <option value="8">August</option>
    <option value="9">September</option>
    <option value="10">October</option>
    <option value="11">November</option>
    <option value="12">December</option>
  </select></div>
            <div class="col-xs-2 col-md-2 col-sm-2 col-lg-2">

  <select class="form-control" id="sel1" name="year">
      <option >--Select Year--</option>
    <option value="2017">2017</option>
    <option value="2016">2016</option>
    <option value="2015">2015</option>
  </select>
</div>
            <div class="col-xs-2 col-md-2 col-sm-2 col-lg-2">
            <input class="btn btn-submit" type="submit" name="search" value="search"> </form>
</div><hr></div><br>
                <?php 
if(isset($_REQUEST['search'])){

     $year =$_REQUEST['year'];
     $month= $_REQUEST['month'];

    
    $sql =executeQuery("Select * from currentaffairs  where YEAR(date)='$year' and MONTH(date) ='$month' order by id desc ");}
    
    else
        $sql = executeQuery("Select * from currentaffairs order by id desc");
                ?>
                <div class="item col-md-6 col-sm-6 col-xs-12" >
                <?php 
                if(mysql_num_rows($sql)>0){
                while($row =mysql_fetch_row($sql)){
                                ?>
                   <li class="fa fa-share"><a href="news.php?id=<?= $row[0]; ?>">&nbsp;<?=  $row[1] ;?></a></li><hr>

                   <?php }} else
                   {
                    echo "<p style='text-align:center'>OOPS! No result found &#9785;</p>";
                    }?>                
                <div class="item col-md-4 col-sm-6 col-xs-12">
                   
                   <!--//content-->
                </div><!--//item-->
                <div class="item col-md-4 col-sm-6 col-xs-12">
                                      <!--//content-->
                </div><!--//item-->               
            </div><!--//row-->            
        </div><!--//container-->
    </section><!--//about-->
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
            <small class="copyright">Designed & Developed By  <a href="http://www.twentyfive.in" target="_blank">Twentyfive technoarts!</a> </small>
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
   