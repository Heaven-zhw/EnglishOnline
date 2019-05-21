<?php


 namespace app\admin\controller;
 use app\index\controller\Numtohz;
 use think\Controller;
 use think\Db;
 use think\Request;
 use think\Session;
 use think\Response;
class Func extends Controller
{
    public function getmon()
    {
        $date = date('Y-m-d');
//转换成时间戳
        $timestrap = strtotime($date);
//格式化，取出月份
        $mon = date('m', $timestrap);
        $day = date('d', $timestrap);
        $months = array(
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Aug',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dec'
        );
        switch ($mon) {
            case 1:
                $mons = $months[1];
                break;
            case 2:
                $mons = $months[2];
                break;
            case 3:
                $mons = $months[3];
                break;
            case 4:
                $mons = $months[4];
                break;
            case 5:
                $mons = $months[5];
                break;
            case 6:
                $mons = $months[6];
                break;
            case 7:
                $mons = $months[7];
                break;
            case 8:
                $mons = $months[8];
                break;
            case 9:
                $mons = $months[9];
                break;
            case 10:
                $mons = $months[10];
                break;
            case 11:
                $mons = $months[11];
                break;
            case 12:
                $mons = $months[12];
                break;
        }
        $dates = array(
            1 => $mons,
            2 => $day
        );
        return $dates;
    }

    public function getvoc()
    {
        $num = rand(1, 2090); //随机产生随机数
        $sql = "select vname,explains from voc where id>=? limit 5";
        $voc1 = Db::query($sql, [$num]); //获取单词表1
        $voc2 = Db::query("select vname,explains from voc where id>=? limit 5", [$num + 5]);
        $voc3 = Db::query("select vname,explains from voc where id>=? limit 5", [$num + 10]);
        $voc = array(1 => $voc1, 2 => $voc2, 3 => $voc3);
        return $voc;
    }

    public function nulltozero($nums)
    {
        if ($nums == null) {
            return 0;
        } else {
            return $nums;
        }
    }

    public function createarray($nums)
    {
        $arrays = array();
        for ($i = 1; $i <= $nums; $i++) {
            $arrays[$i]['id'] = $i;
        }
        return $arrays;
    }
    public function createarrayk($nums)
    {
        $arrays = array();
        for ($i = 1; $i <= $nums; $i++) {
            $arrays[$i]['k'] = $i;
        }
        return $arrays;
    }

 }