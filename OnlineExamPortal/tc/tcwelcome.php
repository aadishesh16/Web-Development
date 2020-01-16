<?php


/* Procedure
*********************************************
 * ----------- *
 * PHP Section *
 * ----------- *
Step 1: Perform Session Validation.
 * ------------ *
 * HTML Section *
 * ------------ *
Step 2: Display the Dashboard.

*********************************************
*/

error_reporting(0);
/********************* Step 1 *****************************/
session_start();
        if(!isset($_SESSION['tcname'])){
            $_GLOBALS['message']="Session Timeout.Click here to <a href=\"index.php\">Re-LogIn</a>";
        }
        else if(isset($_REQUEST['logout'])){
           unset($_SESSION['tcname']);
            $_GLOBALS['message']="You are Loggged Out Successfully.";
            header('Location: index.php');
        }
?>

<html>
    <head>
        <title>OES-DashBoard</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" type="text/css" href="../oes.css"/>
        <link rel="stylesheet" type="text/css" href="bootstrap.min.css"/>

    </head>
    <body>
        <?php
/********************* Step 2 *****************************/
        if($_GLOBALS['message']) {
            echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
        }
        ?>
        <div id="container">
            <div class="header">
                <img style="margin:10px 2px 2px 10px;float:left;" height="80" width="200" src="../images/logo.png" alt="OES"/><h3 class="headtext"> &nbsp;Practice Adda </h3><h4 style="color:#ffffff;text-align:center;margin:0 0 5px 5px;"><i>...आओ परीक्षा सरल बनाएं|</i></h4>
            </div>
            <br>
                <form name="tcwelcome" action="tcwelcome.php" method="post">
                    <ul id="menu">
                        <?php if(isset($_SESSION['tcname'])){ ?>
                        <li><input type="submit" value="LogOut" name="logout" class="btn btn-primary" title="Log Out"/></li><br>
                        <?php } ?>
                    </ul>
                </form>
            </div><hr >
            <div class="admpage">
                <?php if(isset($_SESSION['tcname'])){ ?>

             <div class="container" style="margin-left: 18%">
 				<ul class="nav nav-pills">
    				<li><a href="submng.php">Manage Subjects</a></li>
    				<li><a href="testmng.php">Manage Tests</a></li>
    				<li><a href="editprofile.php">Edit Profile</a></li>
    				<li><a href="rsltmng.php">Manage Test Results</a></li>
    				<li><a href="testmng.php?forpq=true">Prepare Questions</a></li>
                    <li><a href="../register.php">Register Student</a></li>
  				</ul>
                </div>
                <?php }?>

            </div>
      </div>
  </body>
</html>
