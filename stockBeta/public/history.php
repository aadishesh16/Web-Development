<?php

   
    require("../includes/config.php");
$stocks=array();
$fetch=query("Select * from history where id=? order by time Desc" , $_SESSION["id"]);
foreach($fetch as $row)
{ $stocks[] =[ 
"symbol" =>$row["symbol"],
"share"=>$row["shares"],
"action"=>$row["action"],
"time" =>$row["time"]
];
}
render("history.php",["rows" =>$stocks]);
?>
