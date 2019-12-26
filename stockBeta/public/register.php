<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
               if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You  provide your password.");
        }
else if($_POST["password"] != $_POST["confirmation"]){
apologize("You must type the same password.");
}
$row =query("Insert into users(username,hash,cash) VALUES (?,?,10000.00)",$_POST["username"],crypt($_POST["password"]));
if($row ===false)
{ apologize("Please enter a different username"); 
}
$rows=query("SELECT * from users order by id desc limit 1 ");
$id=$rows[0]["id"];
$_SESSION["id"]=$id["id"];
header("Location:index.php");    
}



?>
