<?php
require_once "time_transform.class.php";
class check
{
    function print_table($arr,$arr_element_name,$table_head)
        //$arr为需要遍历的数组,$arr_element_name为需要时间转化的键值名称
    {
        $trans_time=new time_transform();
        echo "<table border='1px' cellpadding='30px' cellspacing='0px'>";
        echo $table_head;
        $temp=1;
        $length=count($arr);
        for ($i=0;$i<$length;$i++)
        {
            $arr[$i][$arr_element_name]=$trans_time->h_m_s($arr[$i][$arr_element_name]);
            echo "<tr>";
            echo "<th>".$temp."</th>";
            $temp++;
            foreach ($arr[$i] as $value)
            {
                echo "<th>".$value."</th>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
}
?>