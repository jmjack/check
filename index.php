<?php
    $lastlogin=$_COOKIE['lasttime'];
    setcookie("lasttime",date("Y-m-d H-i-s"),time()+3600*24*7);
    if (!empty($lastlogin))
        echo "上次登录时间：".$lastlogin;
    $cookie_user=$_COOKIE['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <meta charset="UTF-8">
    <title>sign</title>
</head>
<body>
    <form action="ensure.php" method="post">
        <h1 id="sign">sign in</h1>
        <div id="input">
        <input type="text" class="enter"name="user" <?php echo "value=$cookie_user"; ?>>
        <br/>
        <input id="buttom_input" class="enter" type="password" name="password">
            <br/>
            <?php
            $message=$_GET['message'];
            if ($message==1)
                echo "<p style='color:red;'>用户名或密码错误</p>";
            ?>
            <br/>
            <input id="button" type="submit" name="login" value="登陆">
            <input id="register" type="submit" name="login" value="注册">
        </div>
    </form>
</body>
</html>