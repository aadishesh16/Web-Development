


<?php
ob_start();
/*
***************************************************
*** Online Examination System                   ***
***---------------------------------------------***
*** Title: Summary Report                       ***
***************************************************
*/

error_reporting(0);
session_start();
include_once 'oesdb.php';

if(!isset($_SESSION['stdname'])) {
    $_GLOBALS['message']="Session Timeout.Click here to <a href=\"index.php\">Re-LogIn</a>";
}


    if(isset($_REQUEST['change']))
    {
        //redirect to testconducter
       
       $_SESSION['qn']=$_REQUEST['change'];
       header("location:testconducter.php");

    }
    
   

   
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css"/>

</head>
              </table>
          <?php

                        $result=executeQuery("select * from studentquestion where testid=".$_SESSION['testid']." and stdid=".$_SESSION['stdid']." order by qnid ;");
                        $data =array();
                       ?>
                        <table cellpadding="30" cellspacing="10" >
<form >
                        	
                        	<tr>
                        <?php	while( $row =mysql_fetch_row($result)){

                       $data[] =$row;

                   } 
                   ob_end_clean();
                   echo json_encode($data);
                  ?>

</tr> 






             </form>           </table>
                      
                  <?php      
                           //editing components
                 ?>
                            
         </html>             