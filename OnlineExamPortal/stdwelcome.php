

<?php


error_reporting(0);
session_start();
        if(!isset($_SESSION['stdname'])){
            $_GLOBALS['message']="Session Timeout.Click here to <a href=\"index.php\">Re-LogIn</a>";
        }
        else if(isset($_REQUEST['logout'])){
                unset($_SESSION['stdname']);
            $_GLOBALS['message']="You are Loggged Out Successfully.";
            header('Location: index.php');
        }
?>
<html>
    <head>
        <title>Practice Adda-DashBoard</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" type="text/css" href="oes.css"/>
        <link rel="stylesheet" type="text/css" href="bootstrap.min.css"/>

                <script src="js.bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.css">


    </head>
    <body>
        <?php
       
        if($_GLOBALS['message']) {
            echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
        }
        ?>

        <div id="container">
           <div class="header">
                <img style="margin:10px 2px 2px 10px;float:left;" height="80" width="200" src="images/logo.png" alt="OES"/><h3 class="headtext"> &nbsp;Practice Adda </h3><h4 style="color:#ffffff;text-align:center;margin:0 0 5px 5px;"><i>...आओ परीक्षा सरल बनाएं|</i></h4>
            </div>

                <form name="stdwelcome" action="stdwelcome.php" method="post">
                    <ul id="menu" class="nav nav-pills">
                        <?php if(isset($_SESSION['stdname'])){ ?>
                        <?php } ?>
                    </ul>
                </form>
            


<!-- Button to trigger modal -->

<!-- Modal -->




     





            <div class="stdpage">
                <?php if(isset($_SESSION['stdname'])){ ?>

        <hr>

                 <nav role="navigation" class="navbar navbar-default">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="active"><a href="stdwelcome.php">Home</a></li>
            <li><a href="editprofile.php?edit=edit">Edit Your Profile</a></li>
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">Take Tests <b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
                    <li><a href="stdtest.php">From your Institute</a></li>
                    <li><a href="stdtestpracticeadda.php">From Practice Adda</a></li>
                    
                </ul>
            </li>
                      <li><a href="viewresult.php">View Results</a></li>
                     </ul>             <ul class="nav navbar-nav navbar-right">
            

                        <li  ><a href ="logout.php">Logout <i class="fa fa-sign-out" aria-hidden="true"></i></a>  </li>

        </ul>
       
    </div>
</nav>
  
                   
                <?php }?>

            </div>











           <div id="footer">



<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
    function refresh_div() {
        jQuery.ajax({
            url:'testajax.php',
  
            type:'POST',
            success:function(results) {
              
                jQuery(".admin").html(results);
            }
        });
    }

    t = setInterval(refresh_div,1000);
</script>
     <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12" ><br>
     <h4>Questions and their status</h4>
<div class="admin">
<table cellpadding="30" cellspacing="10" class="datatable">
               
                    </table></div>

</div>



      </div>
      </div>
      
  </body>
</html>
