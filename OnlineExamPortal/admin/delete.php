<?php 
include_once("../oesdb.php");

                $id =$_GET["id"];
                $sql =executeQuery("Delete from currentaffairs where id ='$id' ");
                if($sql)
                {
                	header("location:admincurrentaffairs.php");
                }

?>