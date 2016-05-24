<?php
require_once "CLASS/login.class.php";
$way=$_POST["login"];
$user=$_POST["user"];
$password=$_POST["password"];
setcookie("name",$user,time()+3600*24*7);

if ($way=="登陆")
{
    $login=new login();
    if ($login->checkuser($user, $password)&&$user!="")
    {
        header("refresh:0;main.php?user=$user");
    }
    else{
        header("refresh:0;index.php?message=1");
    }
}
else if ($way=="注册")
{
    header("refresh:0;register.html");
}
?>