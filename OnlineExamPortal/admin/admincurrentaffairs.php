<?php



error_reporting(0);
/********************* Step 1 *****************************/
session_start();
include_once '../oesdb.php';
             if(!isset($_SESSION['admname'])){
            $_GLOBALS['message']="Session Timeout.Click here to <a href=\"index.php\">Re-LogIn</a>";
        }
        else if(isset($_REQUEST['logout'])){
           unset($_SESSION['admname']);
            $_GLOBALS['message']="You are Loggged Out Successfully.";
            header('Location: index.php');
        }

?>


<DOCTYPE! html>
<html>
<head>
<title>Current Affairs backend</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" type="text/css" href="../oes.css"/>
            <link rel="stylesheet" type="text/css" href="bootstrap.min.css"/>


</head>
<body>
<?php
       /********************* Step 2 *****************************/
        if(isset($_GLOBALS['message'])) {
            echo "<div class=\"message\">".$_GLOBALS['message']."</div>";
        }
        ?>
<div id="container">
 <div class="header">
                <img style="margin:10px 2px 2px 10px;float:left;" height="80" width="200" src="../images/logo.png" alt="OES"/><h3 class="headtext"> &nbsp;Practice Adda </h3><h4 style="color:#ffffff;text-align:center;margin:0 0 5px 5px;"><i>...आओ परीक्षा सरल बनाएं|</i></h4>
            </div>
            <div class="menubar">

                <form name="admwelcome" action="admwelcome.php" method="post">
                    <ul id="menu">
                        <?php if(isset($_SESSION['admname'])){ ?>
                        <li><input type="submit" value="LogOut" name="logout" class="btn btn-primary" title="Log Out"/></li>
                        <?php } ?>
                    </ul>
                </form>
            </div>
               <?php if(isset($_SESSION['admname'])){ ?>

<div class="row">
 <div class="col-sm-3">
</div>
 <div class="col-sm-6">
<p style="color:red">Note: After every story, put asterisk (*) </p>
<form method="POST">
<div class="form-group"><br>
<label for="title">Title</label><input type="text" class="form-control" placeholder="Enter Title" name="title"><br></div>
<div class="form-group">
<label for="news">Enter Data</label>
<textarea class="form-control" rows="3" name="news"></textarea><br></div>

<input type="submit" class="btn btn-default" name="submit" value="Submit">

</form>

</div></div>

<?php 
if(isset($_POST['submit']))
{ $title =$_POST['title'];
$news =$_POST['news'];
   executeQuery("Insert into currentaffairs(title,data) values ('$title','$news')");
}
?>
 <?php } ?>


 <table class="table table-bordered">
 <?php 
$sql =executeQuery("Select * from currentaffairs order by id desc");
 ?>
    <thead>
      <tr>
        <th>Title</th>
        <th>News</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    <?php
    while ($row =mysql_fetch_row($sql)) {
    
    
    ?>
      <tr>
        <td><?= $row[1]; ?></td>
        <td><?= $row[1]; ?></td>
        <td><a href="delete.php?id=<?= $row[0]?>" onclick="return confirm('Are you sure?')" > <button type="button" class="primary"  >Delete</button></a></td> <?php } ?>
      </tr>
     
    </tbody>
  </table>


  <?php 
require("footer.php");
  ?>