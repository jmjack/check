<?php
    require_once "CLASS/mysqli_tool.php";
    $a=new mysqli_tool();
    print_r($a->dql("select * from time"));
?>