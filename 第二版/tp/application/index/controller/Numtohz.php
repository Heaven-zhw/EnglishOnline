<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
class Numtohz extends Controller{

//将数字转换为汉字，比如1210转换为一千二百一十

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    public function del0($num) //去掉数字段前面的0
    {
        return "" . intval($num);
    }

    public function n2c($x) //单个数字变汉字
    {
        $arr_n = array("零", "一", "二", "三", "四", "五", "六", "七", "八", "九", "十");
        return $arr_n[$x];
    }

    public function num_r($abcd) //读取数值（4位）
    {
        $arr = array();
        $str = ""; //读取后的汉字数值
        $flag = 0; //该位是否为零
        $flag_end = 1; //是否以“零”结尾
        $size_r = strlen($abcd);
        for ($i = 0; $i < $size_r; $i++) {
            $arr[$i] = $abcd{$i};
        }
        $arrlen = count($arr);
        for ($j = 0; $j < $arrlen; $j++) {
            $ch = $this->n2c($arr[$arrlen - 1 - $j]); //从后向前转汉字
            if ($ch == "零" && $flag == 0) { //如果是第一个零
                $flag = 1; //该位为零
                $str = $ch . $str; //加入汉字数值字符串
                continue;
            } elseif ($ch == "零") { //如果不是第一个零了
                continue;
            }  // （脚本学堂 www.# 编辑整理）
            $flag = 0; //该位不是零
            switch ($j) {
                case 0:
                    $str = $ch;
                    $flag_end = 0;
                    break; //第一位（末尾），没有以“零”结尾
                case 1:
                    $str = $ch . "十" . $str;
                    break; //第二位
                case 2:
                    $str = $ch . "百" . $str;
                    break; //第三位
                case 3:
                    $str = $ch . "千" . $str;
                    break; //第四位
            }
        }
        if ($flag_end == 1) //如果以“零”结尾
        {
            mb_internal_encoding("UTF-8");
            $str = mb_substr($str, 0, mb_strlen($str) - 1); //把“零”去掉
        }
        return $str;
    }

    public function num2ch($num) //整体读取转换
    {
        $num_real = $this->del0($num);//去掉前面的“0”
        $numlen = strlen($num_real);
        if ($numlen >= 9)//如果满九位，读取“亿”位
        {
            $y = substr($num_real, -9, 1);
//echo $y;
            $wsbq = substr($num_real, -8, 4);
            $gsbq = substr($num_real, -4);
            $a = $this->num_r($this->del0($gsbq));
            $b = $this->num_r($this->del0($wsbq)) . "万";
            $c = $this->num_r($this->del0($y)) . "亿";
        } elseif ($numlen <= 8 && $numlen >= 5) //如果大于等于“万”
        {
            $wsbq = substr($num_real, 0, $numlen - 4);
            $gsbq = substr($num_real, -4);
            $a = $this->num_r($this->del0($gsbq));
            $b = $this->num_r($this->del0($wsbq)) . "万";
            $c = "";
        } elseif ($numlen <= 4) //如果小于等于“千”
        {
            $gsbq = substr($num_real, -$numlen);
            $a = $this->num_r($this->del0($gsbq));
            $b = "";
            $c = "";
        }
        $ch_num = $c . $b . $a;
        return $ch_num;
    }


}