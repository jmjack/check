<?php
$user=$_POST['user'];
$password=$_POST['password'];
$check_repeat=new mysqli("localhost","jm","ming0147","check_in");
$check_sentence="select name from user where name='$user'";
$check_res=$check_repeat->query($check_sentence);
$bool=$check_res->fetch_row();
if (isset($bool[0]))
{
    echo "该用户已存在,等待返回注册界面重新输入";
    header("refresh:2;register.html");

}
else {
    $connect = new mysqli("localhost", "jm", "ming0147", "check_in");
    $connect->get_connection_stats() or die("连接数据库失败" . $connect->connect_error);
    $connect->set_charset("utf8");
    $sentence = "insert into user values ('$user','$password')";
    $res = $connect->query($sentence);
    echo "<br/>注册成功,即将返回登陆界面";
    header("refresh:1;sign.html");
}
$check_res->free();
$check_repeat->close();
?>