<?php
namespace app\index\controller;
use app\index\controller\Numtohz;
use Symfony\Component\DomCrawler\Tests\Field\InputFormFieldTest;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use think\Response;
class Func extends Controller{
    public function getmon(){
        $date=date('Y-m-d');
//转换成时间戳
        $timestrap=strtotime($date);
//格式化，取出月份
        $mon=date('m',$timestrap);
        $day=date('d',$timestrap);
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
                $mons=$months[1];
                break;
            case 2:
                $mons=$months[2];
                break;
            case 3:
                $mons=$months[3];
                break;
            case 4:
                $mons=$months[4];
                break;
            case 5:
                $mons=$months[5];
                break;
            case 6:
                $mons=$months[6];
                break;
            case 7:
                $mons=$months[7];
                break;
            case 8:
                $mons=$months[8];
                break;
            case 9:
                $mons=$months[9];
                break;
            case 10:
                $mons=$months[10];
                break;
            case 11:
                $mons=$months[11];
                break;
            case 12:
                $mons=$months[12];
                break;
        }
        $dates=array(
           1=>$mons,
           2=>$day
        );
        return $dates;
    }
    public function getvoc(){
          $num=rand(1,2090); //随机产生随机数
          $sql="select vname,explains from voc where id>=? limit 5";
          $voc1=Db::query($sql,[$num]); //获取单词表1
          $voc2=Db::query("select vname,explains from voc where id>=? limit 5",[$num+5]);
          $voc3=Db::query("select vname,explains from voc where id>=? limit 5",[$num+10]);
          $voc=array(1=>$voc1,2=>$voc2,3=>$voc3);
          return $voc;
    }

    public function createrpaper($count,$type){
        $hz=new Numtohz();
        if ($type==1){
            //选择题
            $sum=ceil($count/10);

            $papername1=array();
            for($i=1;$i<=$sum;$i++){
                $papername1[$i]="选择模拟试题(".$hz->num2ch($i).")";
            }
            return $papername1;
        }else if($type==2){
            $sum=ceil($count/2);
            $papername2=array();
            for($i=1;$i<=$sum;$i++){
                $papername2[$i]="阅读模拟试题(".$hz->num2ch($i).")";
            }
            return $papername2;
        }else{
            $sum=ceil($count/2);
            $papername3=array();
            for($i=1;$i<=$sum;$i++){
                $papername3[$i]="完型模拟试题(".$hz->num2ch($i).")";
            }
            return $papername3;
        }

    }
    public function nulltozero($nums){
        if($nums==null){
            return 0;
        }else{
            return $nums;
        }
    }
    public function createpaper2($pid,$type){
        $hz=new Numtohz();
        if ($type==1){
             $papername1="单选模拟试题(".$hz->num2ch($pid).")";


            return $papername1;
        }else if($type==2){
                $papername2="阅读模拟试题(".$hz->num2ch($pid).")";
                return $papername2;
        }else{

                $papername3="完型模拟试题(".$hz->num2ch($pid).")";
                 return $papername3;
        }
    }
    public function createarray($nums){
        $arrays=array();
        for($i=1;$i<=$nums;$i++){
            $arrays[$i]['id']=$i;
        }
        return $arrays;
    }

}
