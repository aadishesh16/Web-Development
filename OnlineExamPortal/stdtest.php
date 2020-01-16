


<?php

error_reporting(0);
session_start();
include_once 'oesdb.php';
if (!isset($_SESSION['stdname'])) {
    $_GLOBALS['message'] = "Session Timeout.Click here to <a href=\"index.php\">Re-LogIn</a>";
} else if (isset($_SESSION['starttime'])) {
    header('Location: testconducter.php');
} else if (isset($_REQUEST['logout'])) {
    //Log out and redirect login page
    unset($_SESSION['stdname']);
    header('Location: index.php');
} else if (isset($_REQUEST['dashboard'])) {
    //redirect to dashboard
    //
    header('Location: stdwelcome.php');
} else if (isset($_REQUEST['starttest']) && isset($_REQUEST['instructions'])) {
    //Prepare the parameters needed for Test Conducter and redirect to test conducter
    if (!empty($_REQUEST['tc'])) {
        $result = executeQuery("select DECODE(testcode,'oespass') as tcode from test where testid=" . $_SESSION['testid'] . ";");

        if ($r = mysql_fetch_array($result)) {
            if (strcmp(htmlspecialchars_decode($r['tcode'], ENT_QUOTES), htmlspecialchars($_REQUEST['tc'], ENT_QUOTES)) != 0) {
                $display = true;
                $_GLOBALS['message'] = "You have entered an Invalid Test Code.Try again.";
            } else {
                //now prepare parameters for Test Conducter and redirect to it.
                //first step: Insert the questions into table

                $result = executeQuery("select * from question where testid=" . $_SESSION['testid'] . " order by qnid;");
                if (mysql_num_rows($result) == 0) {
                    $_GLOBALS['message'] = "Tests questions cannot be selected.Please Try after some time!";
                } else {
                  //  executeQuery("COMMIT");
                    $error = false;
                //    executeQuery("delimiter |");
                 /*   if (!executeQuery("create event " . $_SESSION['stdname'] . time() . "
ON SCHEDULE AT (select endtime from studenttest where stdid=" . $_SESSION['stdid'] . " and testid=" . $_SESSION['testid'] . ") + INTERVAL (select duration from test where testid=" . $_SESSION['testid'] . ") MINUTE
DO update studenttest set correctlyanswered=(select count(*) from studentquestion as sq,question as q where sq.qnid=q.qnid and sq.testid=q.testid and sq.answered='answered' and sq.stdanswer=q.correctanswer and sq.stdid=" . $_SESSION['stdid'] . " and sq.testid=" . $_SESSION['testid'] . "),status='over' where stdid=" . $_SESSION['stdid'] . " and testid=" . $_SESSION['testid'] . "|"))
                        $_GLOBALS['message'] = "error" . mysql_error();
                    executeQuery("delimiter ;");*/
                    if (!executeQuery("insert into studenttest values(" . $_SESSION['stdid'] . "," . $_SESSION['testid'] . ",(select CURRENT_TIMESTAMP),date_add((select CURRENT_TIMESTAMP),INTERVAL (select duration from test where testid=" . $_SESSION['testid'] . ") MINUTE),0,'inprogress')"))
                        $_GLOBALS['message'] = "error" . mysql_error();
                    else {
                        while ($r = mysql_fetch_array($result)) {
                            if (!executeQuery("insert into studentquestion values(" . $_SESSION['stdid'] . "," . $_SESSION['testid'] . "," . $r['qnid'] . ",'unanswered',NULL)")) {
                                $_GLOBALS['message'] = "Failure while preparing questions for you.Try again";
                                $error = true;
                            }
                        }
                        if ($error == true) {
                      //      executeQuery("rollback;");
                        } else {
                            $result = executeQuery("select totalquestions,duration from test where testid=" . $_SESSION['testid'] . ";");
                            $r = mysql_fetch_array($result);
                            $_SESSION['tqn'] = htmlspecialchars_decode($r['totalquestions'], ENT_QUOTES);
                            $_SESSION['duration'] = htmlspecialchars_decode($r['duration'], ENT_QUOTES);
                            $result = executeQuery("select DATE_FORMAT(starttime,'%Y-%m-%d %H:%i:%s') as startt,DATE_FORMAT(endtime,'%Y-%m-%d %H:%i:%s') as endt from studenttest where testid=" . $_SESSION['testid'] . " and stdid=" . $_SESSION['stdid'] . ";");
                            $r = mysql_fetch_array($result);
                            $_SESSION['starttime'] = $r['startt'];
                            $_SESSION['endtime'] = $r['endt'];
                            $_SESSION['qn'] = 1;
                            header('Location: testconducter.php');
                        }
                    }
                }
            }
        } else {
            $display = true;
            $_GLOBALS['message'] = "You have entered an Invalid Test Code.Try again.";
        }
    } else {
        $display = true;
        $_GLOBALS['message'] = "Enter the Test Code First!";
    }
} else if (isset($_REQUEST['testcode'])) {
    //test code preparation
    if ($r = mysql_fetch_array($result = executeQuery("select testid from test where testname='" . htmlspecialchars($_REQUEST['testcode'], ENT_QUOTES) . "';"))) {
        $_SESSION['testname'] = $_REQUEST['testcode'];
        $_SESSION['testid'] = $r['testid'];
    }
} else if (isset($_REQUEST['savem'])) {
    //updating the modified values
    if (empty($_REQUEST['cname']) || empty($_REQUEST['password']) || empty($_REQUEST['email'])) {
        $_GLOBALS['message'] = "Some of the required Fields are Empty.Therefore Nothing is Updated";
    } else {
        $query = "update student set stdname='" . htmlspecialchars($_REQUEST['cname'], ENT_QUOTES) . "', stdpassword=ENCODE('" . htmlspecialchars($_REQUEST['password'], ENT_QUOTES) . "','oespass'),emailid='" . htmlspecialchars($_REQUEST['email'], ENT_QUOTES) . "',contactno='" . htmlspecialchars($_REQUEST['contactno'], ENT_QUOTES) . "',address='" . htmlspecialchars($_REQUEST['address'], ENT_QUOTES) . "',city='" . htmlspecialchars($_REQUEST['city'], ENT_QUOTES) . "',pincode='" . htmlspecialchars($_REQUEST['pin'], ENT_QUOTES) . "' where stdid='" . $_REQUEST['student'] . "';";
        if (!@executeQuery($query))
            $_GLOBALS['message'] = mysql_error();
        else
            $_GLOBALS['message'] = "Your Profile is Successfully Updated.";
    }
    closedb();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>OES-Offered Tests</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="CACHE-CONTROL" content="NO-CACHE"/>
        <meta http-equiv="PRAGMA" content="NO-CACHE"/>
        <meta name="ROBOTS" content="NONE"/>

        <link rel="stylesheet" type="text/css" href="oes.css"/>
        <link rel="stylesheet" type="text/css" href="bootstrap.min.css"/>
        <script type="text/javascript" src="validate.js" ></script>
        <style >
            
div.scroll {
    background-color: #F0F0F0 ;
    width: 100%;
    height:500px;
    overflow: scroll;
}


        </style>
    </head>
    <body >
        <?php
        if ($_GLOBALS['message']) {
            echo "<div class=\"message\">" . $_GLOBALS['message'] . "</div>";
        }
        ?>
        <div id="container">
            <div class="header">
                <img style="margin:10px 2px 2px 10px;float:left;" height="80" width="200" src="images/logo.png" alt="OES"/><h3 class="headtext"> &nbsp;Practice Adda</h3><h4 style="color:#ffffff;text-align:center;margin:0 0 5px 5px;"><i>...आओ परीक्षा सरल बनाएं|</i></h4>
            </div>
            <form id="stdtest" action="stdtest.php" method="post">
                    <ul id="menu" class="nav nav-pills"><br>
                        <?php
                        if (isset($_SESSION['stdname'])) {
                            // Navigations
                        ?>
                            <li><input type="submit" value="LogOut" name="logout" class="btn btn-primary" title="Log Out"/></li>
                            <li><input type="submit" value="DashBoard" name="dashboard" class="btn btn-primary" title="Dash Board"/></li>


                        </ul>
                    <div class="page">
                    <?php
                            if (isset($_REQUEST['testcode'])) {
                                echo "<div class=\"pmsg\" style=\"text-align:center;\">Read the instructions carefully </div>";
                            } else {
                                echo "<div class=\"pmsg\" style=\"text-align:center;\">Offered Tests</div>";
                            }
                    ?>
                    <?php
                            if (isset($_REQUEST['testcode']) || $display == true) {
                    ?>

                            <div class="scroll" style="font-family: times new roman;padding-left: 3%">
                          <h4 style="text-align: center;"> <b>General Instructions:</b></h4>
                          1.  Total duration of examination is 30 minutes.<br>
2.  The clock will be set at the server. The countdown timer in the top right corner of screen will display the remaining time available for you to complete the examination. When the timer reaches zero, the examination will end by itself. You will not be required to end or submit your examination.<br>
3.  The Question Palette displayed on the right side of screen will show the status of each question using one of the following symbols:<br>
&nbsp;&nbsp;&nbsp;<button class="btn-danger">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>  You have not answered the question.<br><br>
&nbsp;&nbsp;&nbsp;<button class="btn-success">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>   You have answered the question.<br><br>
&nbsp;&nbsp;&nbsp;<button class="btn-warning">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>  You have NOT answered the question, but have marked the question for review.<br><br>
4.  The Marked for Review status for a question simply indicates that you would like to look at that question again. If a question is answered and Marked for Review, your answer for that question will be considered in the evaluation.<br>
Navigating to a Question :<br>
5.  To answer a question, do the following:<br>
a.  Click on the question number in the Question Palette at the right of your screen to go to that numbered question directly. Note that using this option does NOT save your answer to the current question.<br>
b.  Click on Save &Next to save your answer for the current question and then go to the next question.<br>
c.  Click on Mark for Review & Next to save your answer for the current question, mark it for review, and then go to the next question.
<br><br>
Answering a Question :<br>
6.  Procedure for answering a multiple choice type question:<br>
a.  To select your answer, click on the button of one of the options<br>
b.  To deselect your chosen answer, click on the button of the chosen option again or click on the Clear Response button<br>
c.  To change your chosen answer, click on the button of another option<br>
d.  To save your answer, you MUST click on the Save & Next button<br>
e.  To mark the question for review, click on the Mark for Review & Next button.If an answer is selected for a question that is Marked for Review, that answer will be considered in the evaluation.<br>
7.  To change your answer to a question that has already been answered, first select that question for answering and then follow the procedure for answering that type of question.<br>
8.  Note that ONLY Questions for which answers are saved or marked for review after answering will be considered for evaluation.
<br>
Navigating through sections:
9.  Sections in this question paper are displayed on the top bar of the screen. Questions in a section can be viewed by clicking on the section name. The section you are currently viewing is highlighted.
10. After clicking the Save & Next button on the last question for a section, you will automatically be taken to the first question of the next section.
11. You can shuffle between tests and questions anytime during the examination as per your convenience only during the time stipulated.
12. Candidate can view the corresponding section summary as part of the legend that appears in every section above the question palette.
<br><input type="checkbox" name="instructions" style="margin-left: 35%" ><b>I have read all the instructions. I am ready to take the test</b></input>
<br>
                                <table cellpadding="30" cellspacing="10">
                                    <tr>
                                        <td>Enter Test Code:</td>
                                        <td><input type="text" tabindex="1" name="tc" value="" size="16" /></td>
                                        <td><div class="help"><b>Note:</b><br/>Once you press start test<br/>button timer will be started</div></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <input type="submit" class="btn btn-primary" tabindex="3" value="Start Test" name="starttest" class="subbtn" />
                                        </td>
                                    </tr>
                                </table>
</div>

                    <?php
                            } else {
                                $result = executeQuery("select t.*,s.subname from test as t, subject as s where s.subid=t.subid and CURRENT_TIMESTAMP<t.testto and t.totalquestions=(select count(*) from question where testid=t.testid) and NOT EXISTS(select stdid,testid from studenttest where testid=t.testid and stdid=" . $_SESSION['stdid'] . ");");
                                if (mysql_num_rows($result) == 0) {
                                    echo"<h3 style=\"color:#0000cc;text-align:center;\">Sorry...! For this moment, You have not Offered to take any tests.</h3>";
                                } else {
                                    //editing components
                    ?>
                                    <table cellpadding="30" cellspacing="10" class="datatable">
                                        <tr>
                                            <th>Test Name</th>
                                            <th>Test Description</th>
                                            <th>Subject Name</th>
                                            <th>Duration</th>
                                            <th>Total Questions</th>
                                            <th>Take Test</th>
                                        </tr>
                        <?php
                                    while ($r = mysql_fetch_array($result)) {
                                        $i = $i + 1;
                                        if ($i % 2 == 0) {
                                            echo "<tr class=\"alt\">";
                                        } else {
                                            echo "<tr>";
                                        }
                                        echo "<td>" . htmlspecialchars_decode($r['testname'], ENT_QUOTES) . "</td><td>" . htmlspecialchars_decode($r['testdesc'], ENT_QUOTES) . "</td><td>" . htmlspecialchars_decode($r['subname'], ENT_QUOTES)
                                        . "</td><td>" . htmlspecialchars_decode($r['duration'], ENT_QUOTES) . "</td><td>" . htmlspecialchars_decode($r['totalquestions'], ENT_QUOTES) . "</td>"
                                        . "<td class=\"tddata\"><a title=\"Start Test\" href=\"stdtest.php?testcode=" . htmlspecialchars_decode($r['testname'], ENT_QUOTES) . "\"><img src=\"images/starttest.png\" height=\"30\" width=\"40\" alt=\"Start Test\" /></a></td></tr>";
                                    }
                        ?>
                                </table>
                    <?php
                                }
                                closedb();
                            }
                        }
                    ?>

                </div>




            </form>
        </div>


                <script type="text/javascript" src="js.bootstrap.min.js" ></script>

    </body>

</html>

