<?php
    class time_transform
    {
        function h_m_s($time)
        {
            $hour=intval($time/3600);
            $minutes=intval(($time%3600)/60);
            $second=((($time%3600))%60);
            return $hour."小时".$minutes."分钟".$second."秒";
        }
    }
?>