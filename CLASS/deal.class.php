<?php
    require_once "time_transform.class.php";
    require_once "mysqli_tool.class.php";
    class deal
    {
        public $user;
        public $result;
        public $current_time;
        function get_time_diff()
        {
            $this->current_time=date('Y-m-d H:i:s');
            $get_start_time=new mysqli_tool();
            $time_sentence="select start_time from time where name='$this->user' && total='0'";
            $res=$get_start_time->dql($time_sentence, "");
            $start_time=$res['res'][0]['start_time'];
            if (!$start_time)
            {
                $start_time=$this->current_time;
            }
            $this->result=strtotime($this->current_time)-strtotime($start_time);
            $get_start_time->close();//获取时间差--一个对象
        }
        function update_stop_time()
        {
            $connect=new mysqli_tool();
            $sentence="update time set stop_time='$this->current_time',total='$this->result' WHERE name='$this->user' && total='0'";
            $connect->dml($sentence, "签退成功,正在返回主菜单");
            $connect->close();
        }
        function add_day()
        {
            $current_day=date('Y-m-d');
            $add_day=new mysqli_tool();
            $check_day_sentence="update day set total=total+'$this->result' where name='$this->user' && day='$current_day'";
            $rows=$add_day->dml($check_day_sentence, "");
            if ($rows['affect_row']<1)
            {
                $add_day_sentence="insert into day values (null,'$this->user','$current_day','$this->result')";
                $add_day->dml($add_day_sentence, "");
                $add_day->dql($check_day_sentence, "");
            }
            $today=date("Y-m-d");
            $check_today_sentence="select total from day where name='$this->user' && day like '$today%'";
            $today_res=$add_day->dql($check_today_sentence, "");
            $time_transform=new time_transform();
            $today_result=$time_transform->h_m_s($today_res['res'][0]['total']);
            echo "你今天已经签了".$today_result;
            $add_day->close();
        }
    function return_url($time,$url)
    {
        header("refresh:$time;".$url);
    }
    }
?>