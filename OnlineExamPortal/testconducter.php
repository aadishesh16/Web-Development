


<?php

/*
***************************************************
*** Online Examination System                   ***
*** License: GNU General Public License V.3     ***
*** Title: Test Conductor                       ***
***************************************************
*/

error_reporting(0);
session_start();
include_once 'oesdb.php';
$final=false;
if(!isset($_SESSION['stdname'])) {
    $_GLOBALS['message']="Session Timeout.Click here to <a href=\"index.php\">Re-LogIn</a>";
}
else if(isset($_REQUEST['logout']))
{
    //Log out and redirect login page
       unset($_SESSION['stdname']);
       header('Location: index.php');

}
else if(isset($_REQUEST['dashboard'])){
    //redirect to dashboard
    //
     header('Location: stdwelcome.php');

    }else if(isset($_REQUEST['next']) || isset($_REQUEST['summary']) || isset($_REQUEST['viewsummary']))
    {
        //next question
        $answer='unanswered';
        if(time()<strtotime($_SESSION['endtime']))
        {
            if(isset($_REQUEST['markreview']))
            {
                $answer='review';
            }
            else if(isset($_REQUEST['answer']))
            {
                $answer='answered';
            }
            else
            {
                $answer='unanswered';
            }
            if(strcmp($answer,"unanswered")!=0)
            {
                if(strcmp($answer,"answered")==0)
                {
                    $query="update studentquestion set answered='answered',stdanswer='".htmlspecialchars($_REQUEST['answer'],ENT_QUOTES)."' where stdid=".$_SESSION['stdid']." and testid=".$_SESSION['testid']." and qnid=".$_SESSION['qn'].";";
                }
                else
                {
                    $query="update studentquestion set answered='review',stdanswer='".htmlspecialchars($_REQUEST['answer'],ENT_QUOTES)."' where stdid=".$_SESSION['stdid']." and testid=".$_SESSION['testid']." and qnid=".$_SESSION['qn'].";";
                }
                if(!executeQuery($query))
                {
                // to do
                $_GLOBALS['message']="Your previous answer is not updated.Please answer once again";
                }
                closedb();
            }
            if(isset($_REQUEST['viewsummary']))
            {
                 header('Location: summary.php');
            }
            if(isset($_REQUEST['summary']))
             {
                     //summary page
                     header('Location: summary.php');
             }
        }
        if((int)$_SESSION['qn']<(int)$_SESSION['tqn'])
        {
        $_SESSION['qn']=$_SESSION['qn']+1;
       
        }
        if((int)$_SESSION['qn']==(int)$_SESSION['tqn'])
        {
           $final=true;
        }

    }
    else if(isset($_REQUEST['previous']))
    {
    // Perform the changes for current question
        $answer='unanswered';
        if(time()<strtotime($_SESSION['endtime']))
        {
            if(isset($_REQUEST['markreview']))
            {
                $answer='review';
            }
            else if(isset($_REQUEST['answer']))
            {
                $answer='answered';
            }
            else
            {
                $answer='unanswered';
            }
            if(strcmp($answer,"unanswered")!=0)
            {
                if(strcmp($answer,"answered")==0)
                {
                    $query="update studentquestion set answered='answered',stdanswer='".htmlspecialchars($_REQUEST['answer'],ENT_QUOTES)."' where stdid=".$_SESSION['stdid']." and testid=".$_SESSION['testid']." and qnid=".$_SESSION['qn'].";";
                }
                else
                {
                    $query="update studentquestion set answered='review',stdanswer='".htmlspecialchars($_REQUEST['answer'],ENT_QUOTES)."' where stdid=".$_SESSION['stdid']." and testid=".$_SESSION['testid']." and qnid=".$_SESSION['qn'].";";
                }
                if(!executeQuery($query))
                {
                // to do
                $_GLOBALS['message']="Your previous answer is not updated.Please answer once again";
                }
                closedb();
            }
        }
        //previous question
        if((int)$_SESSION['qn']>1)
        {
            $_SESSION['qn']=$_SESSION['qn']-1;
        }

    }
    else if(isset($_REQUEST['fs']))
    {
        //Final Submission
        header('Location: testack.php');
    }
    if(isset($_REQUEST['change']))
{
   $_SESSION['qn'] =$_REQUEST['change'];

}


if(isset($_REQUEST['finalsubmit'])){
    //redirect to dashboard
    //
     header('Location: testack.php');

    }
?>
<?php
header("Cache-Control: no-cache, must-revalidate");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>OES-Test Conducter</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="CACHE-CONTROL" content="NO-CACHE"/>
    <meta http-equiv="PRAGMA" content="NO-CACHE"/>
    <meta name="ROBOTS" content="NONE"/>
    <link rel="stylesheet" type="text/css" href="oes.css"/>

    <link rel="stylesheet" type="text/css" href="bootstrap.min.css"/>
    <script type="text/javascript" src="validate.js" ></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

    <script type="text/javascript" src="cdtimer.js" ></script>
    <script type="text/javascript" >
    <!--
        <?php
                $elapsed=time()-strtotime($_SESSION['starttime']);
                if(((int)$elapsed/60)<(int)$_SESSION['duration'])
                {
                    $result=executeQuery("select TIME_FORMAT(TIMEDIFF(endtime,CURRENT_TIMESTAMP),'%H') as hour,TIME_FORMAT(TIMEDIFF(endtime,CURRENT_TIMESTAMP),'%i') as min,TIME_FORMAT(TIMEDIFF(endtime,CURRENT_TIMESTAMP),'%s') as sec from studenttest where stdid=".$_SESSION['stdid']." and testid=".$_SESSION['testid'].";");
                    if($rslt=mysql_fetch_array($result))
                    {
                     echo "var hour=".$rslt['hour'].";";
                     echo "var min=".$rslt['min'].";";
                     echo "var sec=".$rslt['sec'].";";
                    }
                    else
                    {
                        $_GLOBALS['message']="Try Again";
                    }
                    closedb();
                }
                else
                {
                    echo "var sec=01;var min=00;var hour=00;";
                }
        ?>
        
    -->
    </script>

    </head>
  <body >
      <noscript><h2>For the proper Functionality, You must use Javascript enabled Browser</h2></noscript>
       <?php

        if($_GLOBALS['message']) {
            echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
        }
        ?>
      <div id="container">
      <div class="header">
                <img style="margin:10px 2px 2px 10px;float:left;" height="80" width="200" src="images/logo.png" alt="OES"/><h3 class="headtext"> &nbsp;Practice Adda </h3><h4 style="color:#ffffff;text-align:center;margin:0 0 5px 5px;"><i>...आओ परीक्षा सरल बनाएं|</i></h4>
            </div>
           <form id="testconducter" action="testconducter.php" method="post">
          <div class="menubar" style="text-align:center;">
              <h4 style="font-family:helvetica,sans-serif;font-weight:bolder;color:#f50000;padding-top:0.3em;letter-spacing:1px;">Name of Test Conducter</h4>
          </div>
      <div class="page">
          <?php
         
          if(isset($_SESSION['stdname']))
          {
                $result=executeQuery("select stdanswer,answered from studentquestion where stdid=".$_SESSION['stdid']." and testid=".$_SESSION['testid']." and qnid=".$_SESSION['qn'].";");
                $r1=mysql_fetch_array($result);
                $result=executeQuery("select * from question where testid=".$_SESSION['testid']." and qnid=".$_SESSION['qn'].";");
                $r=mysql_fetch_array($result);
          ?>
          <div class="row" style="background-color: white">
          <div class="col-sm-9 col-md-9 col-lg-9 col-xs-12" style="border-right: ridge black;">
          <div class="tc">

              <table border="0" width="100%" class="ntab" style="background-color: white">
                  <tr>
                      <th style="width:40%;"><h4>Time Left:<span id="timer" class="timerclass"></span></h4></th>
                      <th style="width:40%;"><h4 style="color: #af0a36;">Question No: <?php echo $_SESSION['qn']; ?> </h4></th>
                     
                  </tr>
              </table>
             <textarea cols="100" rows="8" name="question"  readonly style="width:98%;text-align:left;margin-left:2%;margin-top:2px;font-size:120%;font-weight:bold;margin-bottom:0;color:#000;padding:2px 2px 2px 2px;"><?php echo htmlspecialchars_decode($r['question'],ENT_QUOTES); ?></textarea>
              <table border="0" width="100%" class="ntab" style="background-color: white">
                  <tr><td>&nbsp;</td></tr>
                  <tr><td >1. <input type="radio" name="answer" value="optiona" <?php if((strcmp(htmlspecialchars_decode($r1['answered'],ENT_QUOTES),"review")==0 ||strcmp(htmlspecialchars_decode($r1['answered'],ENT_QUOTES),"answered")==0)&& strcmp(htmlspecialchars_decode($r1['stdanswer'],ENT_QUOTES),"optiona")==0 ){echo "checked";} ?>> <?php echo htmlspecialchars_decode($r['optiona'],ENT_QUOTES); ?></input></td></tr>
                  <tr><td >2. <input type="radio" name="answer" value="optionb" <?php if((strcmp(htmlspecialchars_decode($r1['answered'],ENT_QUOTES),"review")==0 ||strcmp(htmlspecialchars_decode($r1['answered'],ENT_QUOTES),"answered")==0)&& strcmp(htmlspecialchars_decode($r1['stdanswer'],ENT_QUOTES),"optionb")==0 ){echo "checked";} ?>> <?php echo htmlspecialchars_decode($r['optionb'],ENT_QUOTES); ?></input></td></tr>
                  <tr><td >3. <input type="radio" name="answer" value="optionc" <?php if((strcmp(htmlspecialchars_decode($r1['answered'],ENT_QUOTES),"review")==0 ||strcmp(htmlspecialchars_decode($r1['answered'],ENT_QUOTES),"answered")==0)&& strcmp(htmlspecialchars_decode($r1['stdanswer'],ENT_QUOTES),"optionc")==0 ){echo "checked";} ?>> <?php echo htmlspecialchars_decode($r['optionc'],ENT_QUOTES); ?></input></td></tr>
                  <tr><td >4. <input type="radio" name="answer" value="optiond" <?php if((strcmp(htmlspecialchars_decode($r1['answered'],ENT_QUOTES),"review")==0 ||strcmp(htmlspecialchars_decode($r1['answered'],ENT_QUOTES),"answered")==0)&& strcmp(htmlspecialchars_decode($r1['stdanswer'],ENT_QUOTES),"optiond")==0 ){echo "checked";} ?>> <?php echo htmlspecialchars_decode($r['optiond'],ENT_QUOTES); ?></input></td></tr>
                  <tr><td>&nbsp;</td></tr>
                  <tr style="background-color: #DCDCDC" >
                      <th style="width:5%;"><h4><input type="submit" name="<?php if($final==true){ echo "viewsummary" ;}else{ echo "next";} ?>" value="<?php if($final==true){ echo "View Summary" ;}else{ echo "Save and Next";} ?>" class="btn btn-primary"/></h4></th>
                        <th style><input type="button" class="btn btn-default" style="margin-left: 5%" value="Clear" onclick="Clear();"></input></th>
                       <th style="width:20%;text-align:right;"><h5 style="color: #af0a36;"><input type="checkbox" name="markreview" class="btn btn-default">Mark for Review</input></h5></th>
                      <th style="width:15%;text-align:right;padding-right :1%"><h4><form onsubmit="return confirm('Do you really want to submit the form?');"> <input type="submit" name="finalsubmit" value="Final Submit" class="btn btn-primary"/></form></h4></th>
                  </tr>
                  
              </table>
              
</div>



<script>
function Clear(){
  $('input[name=answer]').attr('checked',false);
}
</script>
          </div>


     <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12" style="background-color:white" ><br>
     <?php 
echo "<h5>Welcome ".$_SESSION['stdname']."!</h4>";
     ?><hr style="border-top: 2px solid;">
     <h4></h4>
     <div class="row" style="background-color:white" >
&nbsp;&nbsp;&nbsp;&nbsp;Answered&nbsp;&nbsp;  Reviewed&nbsp;&nbsp;  Unanswered 
     </div>
     <div class="row" style="background-color:white" >
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-success">&nbsp;</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-warning">&nbsp;</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-danger">&nbsp;</button> 
     </div>
<h3>No. of Questions</h3>
<table style="background-color:white;margin-left:22%">
 <?php

                        $result=executeQuery("select * from studentquestion where testid=".$_SESSION['testid']." and stdid=".$_SESSION['stdid']." order by qnid ;");
                      while( $row =mysql_fetch_row($result)){
                        if($row[3]=="review")
                        {
                          echo '<form  action="testconducter.php" method="POST">
                          <input type="submit" class="btn btn-warning" value="'.$row[2].'" name="change" />
                          </form>&nbsp;';
                        }

else if($row[3]=="answered")
                        {
                          echo '<form  method="POST">
                          <input type="submit" class="btn btn-success" value="'.$row[2].'" name="change" />
                          </form>&nbsp;';
                        }
                      
if($row[3]=="unanswered")
                        {
                          echo '<form  method="POST">
                          <input type="submit" class="btn btn-danger" value="'.$row[2].'" name="change" />
                          </form>&nbsp;';
                        }

                      }
                       ?>            

                    </table>

</div>
</div>


          <?php
          closedb();
          }
          ?>
      </div>

           </form>
       

          <p style="font-size:70%;color:#ffffff;"> Developed By-<b>Twentyfive</b><br/> </p>
      </div>
      </div>
  </body>
</html>

