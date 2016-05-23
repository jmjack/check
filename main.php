<?php
$user=$_GET['user'];
echo "<h1>hello<span>$user</span></h1>";
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <link rel='stylesheet' type='text/css' href='css/main.css'>
    <meta charset='UTF-8'>
    <title>main</title>
</head>
<body>

<form action="deal.php" method="post">
    <input type='submit' value='签到' name='option' id='start'>
    <input type='submit' value='签退' name="option" id="stop">
    <input type='submit' value='查询近7天记录' name='option' id='ask_1'>
    <input type='submit' value='查询本月记录' name="option" id='ask_2'>
    <input type='submit' value='查询所有记录' name='option' id='ask_3'>
    <input type='submit' value='退出登陆' name='option' id="exit" >
    <?php
    echo "<input type='password' name='user' value='$user' id='user'>";
    ?>
</form>
</body>
</html>