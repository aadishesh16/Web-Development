<?php

    // configuration
    require("../includes/config.php"); 

    // render portfolio
  
$positions =array();
$rows= query("SELECT symbol,shares from portfolio where id=?",
$_SESSION["id"]);
$bring =query("SELECT * from users where id =?",$_SESSION["id"]);

foreach($rows as $row){

$stock =lookup($row["symbol"]);

if($stock!== false){
$positions[] =[
"symbol" =>$row["symbol"],
"nam" =>$stock["name"],

"shares" => $row["shares"],
"pric" =>$stock["price"],
"total" => $stock["price"] * $row["shares"]
];
}}

render("portfolio.php",["w" =>$positions,"title"=>"Portfolio","user" =>$bring[0]["username"],"bring" => $bring[0]["cash"]]);
?>

