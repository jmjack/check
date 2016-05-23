<?php
    class paging
    {
        public $res_array;
        public $all_rows;
        public $page_row=10;
        public $page_num;
        public $now_page=1;
        function mysql_option($sentence_row,$sentence_res)
        {
            $connect=new mysqli_tool();
            $row=$connect->page_dql($sentence_row);
            $this->all_rows=$row[0]['count(name)'];
            $temp=$connect->page_dql($sentence_res);
            $arr=array();
            for ($i=0;$i<count($temp);$i++)
            {
                $arr[]=$temp[$i];
            }
            $this->res_array=$arr;
            $this->page_num=ceil($this->all_rows/$this->page_row);
        }
        function create_table($table_head,$user,$url)
        {
            echo "<table border='1px' cellpadding='30px' cellspacing='0px'>";
            echo $table_head;
            for ($i=0;$i<count($this->res_array);$i++)
            {
                echo "<tr>";
                $num=($this->now_page-1)*$this->page_row+$i+1;
                echo "<th>".$num."</th>";
                foreach ($this->res_array[$i] as $value)
                {
                    echo "<th>$value</th>";
                }
                echo "<th><a href='$url?user=$user&delete=$num'>删除</a></th>";
                echo "</tr>";
            }
            echo "</table>";
        }
        function guide($name,$user,$url,$large_page_num)
        {
            $start=floor(($this->now_page-1)/$large_page_num)*$large_page_num+1;
            if ($this->now_page>1)
            {
                $temp=$this->now_page-1;
            echo "<a href='$url?$name=$user&now_page=$temp'>上一页</a>";
            }
            if ($this->now_page>$large_page_num)
            {
                $temp=$start-$large_page_num+1;
                echo "<a href='$url?now_page=$temp&$name=$user'><<</a>";
            }
            $temp=$start;
            for (;$start<$temp+$large_page_num;$start++)
            {
                if ($start>$this->page_num)
                    break;
                echo "<a href='$url?now_page=$start&$name=$user'>[$start]</a>";
            }
            if ($this->now_page<$this->page_num&&$large_page_num<$this->page_num)
            {
                echo "<a href='$url?now_page=$start&$name=$user'>>></a>";
            }
            if ($this->now_page<$this->page_num)
            {
                $temp=$this->now_page+1;
            echo "<a href='$url?$name=$user&now_page=$temp'>下一页</a>";
            }
            echo "<form action='$url' method='get'>
            <input style='width: 50px; height: 30px;' type='text' name='now_page'/>
            <input style='display: none' type='password' name='$name' value=$user />
            <input style='width: 50px; height: 30px;' type='submit' value='submit'/>
            </form>";
        }
    }
?>