<?php

   
    require("../includes/config.php");
if(isset($_GET["submit"]) )
{if(!preg_match("/^\d+$/",$_GET["share"])){
 apologize("enter correct form of shares");}

$del=lookup($_GET["symbol"]);
$row=query("Select cash from users where id=? ",$_SESSION["id"]);
$rows=query("Select shares from portfolio where id=? ",$_SESSION["id"]);
$cash =$del["price"]*$_GET["share"];
if($cash <$row[0]["cash"])
{
$insert =query("Insert into portfolio (id,symbol,shares) Values (?,?,?) ON Duplicate Key UPDATE shares =shares + Values(shares)",$_SESSION["id"],$_GET["symbol"],$_GET["share"]);
$delete =query("Update users set cash =cash-? where id=?",$cash ,$_SESSION["id"]);
$history=query("Insert into history (id,symbol,shares,action) values(?,?,?,'buy')",$_SESSION["id"],$_GET["symbol"],$_GET["share"]);
}
else
{
 apologize("You don't have enough money.Cant buy stocks!");
}
}

{

render("buy.php");
}
?>
