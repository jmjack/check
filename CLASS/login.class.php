<?php
require_once "mysqli_tool.class.php";
class login
{
    function checkuser($username,$password)
    {
        $deal=new mysqli_tool();
        $sentence="select password from user where name='$username'";
        $result=$deal->dql($sentence);
        if (isset($result['res'][0])) {
            if ($password == $result['res'][0]['password']) {
                return 1;
            }
        }
        return 0;
    }
}
?>