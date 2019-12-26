<?php

   
    require("../includes/config.php"); 
if(isset($_GET["submit"]) )
{$row =query("Select symbol,shares from portfolio where id=? and symbol=?",$_SESSION["id"],$_GET["symbol"]);
$share =lookup($_GET["symbol"]);
if($row ==NULL)
{ apologize("You dont own any stock.!!");
}
$val = $share["price"]*$row[0]["shares"];
 $delete =query("Delete from portfolio where id=? and symbol=?",$_SESSION["id"],$_GET["symbol"]);

$update =query("Update users set cash =cash+? where id=?",$val,$_SESSION["id"]);
$shares=$row[0]["shares"];
$history=query("Insert into history (id,symbol,shares,action) values(?,?,?,'sell')",$_SESSION["id"],$_GET["symbol"],$shares);
}
else{
$fetch =query("Select symbol from portfolio where id=?",$_SESSION["id"]);
$select=[];
foreach ($fetch as $fet)
{ $select[] =[
"symbol" =>$fet["symbol"]
] ;
}
}
@render("sell.php",["select"=>$select]);
?>
