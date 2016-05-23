<?php
    require_once "CLASS/time_transform.class.php";
    require_once "CLASS/mysqli_tool.class.php";
    require_once "CLASS/deal.class.php";
    require_once "CLASS/check.php";
    require_once "CLASS/paging.class.php";
    $delete=$_GET['delete'];
    $trans_time=new time_transform();
    $check=new check();
    $option=$_POST['option'];
    if ($_POST['user'])
    {
        $user=$_POST['user'];
    }
    else if ($_GET['user'])
    {
        $user=$_GET['user'];
    }
    $now_page = $_GET['now_page'];
    if ($option=="签到")
    {
        $current_time=date('Y-m-d H:i:s');
        $sentence="insert into time values ('$user',null,'$current_time','$current_time','0')";
        $connect=new mysqli_tool();
        $connect->dml($sentence,"签到成功.正在返回主菜单");
        $connect->close();
        header("refresh:2;main.php?user=$user");
    }
    else if ($option=="签退")
    {
        $connect=new deal();
        $connect->user=$user;
        $connect->get_time_diff();
        $connect->update_stop_time();
        $connect->add_day();
        $connect->return_url(1,"main.php?user=$user" );
    }
    else if ($option=="查询近7天记录")
    {
        $connect=new mysqli_tool();
        $sentence="select name,day,total from day where name='$user' order by num desc limit 0,7";
        $res=$connect->dql($sentence, "");
        $check->print_table($res['res'],"total","<tr><th>序号</th><th>姓名</th><th>日期</th><th>签到时间</th></tr>");
        $connect->close();
    }
    else if($option=="查询本月记录")
    {
        $today=date("Y-m");
        $connect=new mysqli_tool();
        $sentence="select name,day,total from day where day like '$today%' && name='$user' order by num asc";
        $res=$connect->dql($sentence, "");
        $check->print_table($res['res'],"total" , "<tr><th>序号</th><th>姓名</th><th>日期</th><th>签到时间</th></tr>");
        $res->free();
        $connect->close();
    }
    else if ($option=="查询所有记录"||!empty($now_page))
    {
        $page=new paging();
        if (!empty($now_page)) {
            $page->now_page = $now_page;
        }
        $page->mysql_option("select count(name) from time where name='$user'",
            "select name,start_time,stop_time,total from time where name='$user' order by num desc limit ".
            ($page->now_page-1)*($page->page_row).",$page->page_row");
        $page->create_table("<tr><th>序号</th></th><th>用户名</th><th>签到时间</th><th>签退时间</th><th>总时间</th></tr>"
        ,$user,"deal.php");
        $page->guide("user", $user, "deal.php",2);
    }
    else if($option=="退出登陆")
    {
        header("refresh:2;url=index.php");
    }
?>