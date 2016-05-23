<?php
class mysqli_tool
{
    public $host="localhost";
    public $user="jm";
    public $password="ming0147";
    public $dbname="check_in";
    function __construct()
    {
        $this->connect=new mysqli($this->host,$this->user,$this->password,$this->dbname);
        $this->connect->get_connection_stats() or die("连接数据库错误:".$this->connect->connect_error);
    }
    function dml($sentence,$message)
    {
        $res=$this->connect->query($sentence) or die("向数据库发送请求错误".$this->connect->error);
        if ($message)
        {
            echo $message;
        }
        $affect_row=$this->connect->affected_rows;
        $result=array();
        $result['res']=$res;
        $result['affect_row']=$affect_row;
        return $result;
    }
    function dql($sentence,$message)
    {
        $res=$this->connect->query($sentence) or die("向数据库发送请求错误".$this->connect->error);
        $i=0;
        $temp=array();
        while ($row=$res->fetch_assoc())
        {
            $temp[$i++]=$row;
        }
        $res->free();
        if ($message)
        {
            echo $message;
        }
        $affect_row=$this->connect->affected_rows;
        $result=array();
        $result['res']=$temp;
        $result['affect_row']=$affect_row;
        return $result;
    }
    function page_dql($sentence)
    {
        $res=$this->connect->query($sentence) or die("向数据库发送请求错误".$this->connect->error);
        $i=0;
        $temp=array();
        while ($row=$res->fetch_assoc())
        {
            $temp[$i++]=$row;
        }
        $res->free();
        return $temp;
    }
    function close()
    {
        if (!empty($this->connect))
            $this->connect->close();
    }
}
?>