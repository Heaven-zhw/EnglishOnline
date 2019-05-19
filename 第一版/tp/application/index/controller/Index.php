<?php
namespace app\index\controller;
use Symfony\Component\DomCrawler\Tests\Field\InputFormFieldTest;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use think\Response;
use app\index\controller\Func;
//引用模型
use app\index\model\Paper;
use app\index\model\Squestions;
use app\index\model\Readtext;
use app\index\model\Usertest;
use app\index\model\Userinfo;
use app\index\model\Ulogin;
use app\index\model\Qcollection;
use app\index\model\Voc;
use think\View;
use traits\model\SoftDelete;

class Index extends Controller
{
    public $uid;
   public $pids;
    public $typeids;

    //发送登录页面
    public function index() //访问的初始
    {
        //return
        $views=new View();
        $views->id=1;
        return $this->fetch(APP_PATH.\request()->module().'/view/logandreg/login.html');
    }
    //进行测试
    public function test(){
        $views=new View();
        $views->id=1;
        return $views->fetch(APP_PATH.\request()->module().'/view/test/index.html');
    }
    //检测session是否存在
    //用于退出
    public function logout(){
        Session::delete("username");
        return $this->redirect("index");
    }

    public function register(){
        return $this->fetch(APP_PATH.\request()->module().'/view/logandreg/register.html');
    }
    public function registererr(){
        echo ('<script>alert("用户名已存在!")</script>');
        return $this->fetch(APP_PATH.\request()->module().'/view/logandreg/register.html');
    }

    public function checklogin(){
        $password=md5(input('post.password'));
        $username=input('post.username');
        $result=Db::query('select count(id) as nums,pwd as pwds from ulogin where username=? and pwd=?',[$username,$password]);
        if($result[0]["pwds"]==$password){
            //登录成功
            Session::set('username',$username);
            $this->redirect('Index/indexs'); //重定向到我们的indexs
        }else{
            //登录失败
            Session::set('username',"");
            $this->error('<script>alter("用户名或密码错误!")</script>','index');//重新登录
        }
    }
    public function checkregister(){
        $password=md5(input('post.password'));
        $username=input('post.username');
        $email=input('post.email');
        $phone=input('post.phone');
        $school=input('post.school');
        $result=Db::query('select id as i from ulogin where username=?',[$username]);
       // $res=Ulogin::get(['username'=>$username]);
        var_dump($result);
        if(!empty($result[0])){
            //!!!!!!!!!!!用户名已经存在
            $this->redirect("registererr");
        }else{

            $result1=Db::execute('insert into ulogin(username,pwd) values(?,?);',[$username,$password]);
            //添加用户表
            $result=Db::query('select id as i from ulogin where username=?',[$username]);
            $result1=Db::execute('insert into userinfo (uid,phone,email,school) values(?,?,?,?);',[$result[0]['i'],$phone,$email,$school]);
            //添加信息表
            Session::set('username',$username);
            //!!!!!!!!!!!!应该有注册成功提示 在主页上进行弹出
            $this->redirect("index");
        }
    }

    public function indexs(){
        if(!(Session::has('username'))){ //判断
            return $this->fetch(APP_PATH.\request()->module().'/view/logandreg/login.html'); //给用户发送登录页面
        }
        $func=new Func;
        $username=Session::get("username");
        $result1=$result1=Db::query('select id from ulogin where username=?',[$username]);
        $this->uid=$result1[0]['id'];
        $uid2=$result1[0]['id'];
        Session::set('uid',$result1[0]['id']);

        $sql="select count(id) as c1 from dx where typeid=1 "; //找出选择题的数量
        $result1=Db::query($sql);
        $count1=$func->nulltozero($result1[0]['c1']);
        $sql="select count(id) as c2  from  textread where typeid=2";
        $result1=Db::query($sql);
        $count2=$func->nulltozero($result1[0]['c2']);
        $sql="select count(id) as c3  from  readtext where typeid=3";
        $result1=Db::query($sql);
        $count3=$func->nulltozero($result1[0]['c3']); //获取了试卷的数量

        $sql='select count(id) as col from qcollection where uid=?';
        $result1=Db::query($sql,[$this->uid]); //获取用户
        $colnum=$func->nulltozero($result1[0]['col']); //用户收藏题目数量

        $result1=Db::query('select count(id) as  level from usertest where uid=?',[$this->uid]); //获取用户
    //对于用户等级,做题在1-10次为1级,其后逐次递增
        $level=ceil($result1[0]['level']/10);

        $result1=Db::query('select sum(num) as num,sum(stime) as stimes from usertest where uid=?',[$this->uid]);
        $tnum=$result1[0]['num'];  //做的总题数
        $sumtimes=ceil($func->nulltozero($result1[0]['stimes'])/60); //结果


        $dates=$func->getmon();  //获取月份和日期
        $day=$dates['2']; //获取当前日期
        $mon=$dates['1']; //获取当前月份
        $voc=$func->getvoc(); //获取单词表
        $voc1=$voc[1];
        $voc2=$voc[2];
        $voc3=$voc[3];
        $paperxz=$func->createrpaper($count1,1);
        $paperyd=$func->createrpaper($count2,2);
        $paperwx=$func->createrpaper($count3,3);
        //获取填充字符
        $sql="select sum(num) as xzsum,sum(errnum) as xzerr from usertest WHERE uid=? and ptype=?";
        $result1=Db::query($sql,[$this->uid,1]);
        $xzsum=$func->nulltozero($result1[0]['xzsum']);
        $xzerr=$func->nulltozero($result1[0]['xzerr']);  //获取选择题的情况
        $xzright=$xzsum-$xzerr;
        $sql="select sum(num) as ydsum,sum(errnum) as yderr from usertest WHERE uid=? and ptype=?";
        $result1=Db::query($sql,[$this->uid,2]);
        $ydsum=$func->nulltozero($result1[0]['ydsum']);
        $yderr=$func->nulltozero($result1[0]['yderr']); //获取阅读的正确情况
        $ydright=$ydsum-$yderr;
        $sql="select sum(num) as wxsum,sum(errnum) as wxerr from usertest WHERE uid=? and ptype=?";
        $result1=Db::query($sql,[$this->uid,3]);
        $wxsum=$func->nulltozero($result1[0]['wxsum']);
        $wxerr=$func->nulltozero($result1[0]['wxerr']); //获取完型的正确情况
        $wxright=$wxsum-$wxerr;
        //下面是获取我们的学习时间
        $sql="select weekdays as wk ,sum(stime) as stimes from usertest where YEARWEEK(studyday)= YEARWEEK(curdate()) and uid=? group by weekdays";
        $res=Db::query($sql,[$this->uid]);
        $studytime=array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0); //优先定义
        foreach ($res as $li){
            $studytime[$li['wk']]=$li['stimes'];
        }
        $sql="select * from userinfo where uid=?";
        $res2=Db::query($sql,[$uid2]);
        $view=new View();
        $view->email=$res2[0]['email'];
        $view->phone=$res2[0]['phone'];
        $view->school=$res2[0]['school'];
        $view->username=$username;
        $view->studytime1=$studytime[1];
        $view->studytime2=$studytime[2];
        $view->studytime3=$studytime[3];
        $view->studytime4=$studytime[4];
        $view->studytime5=$studytime[5];
        $view->studytime6=$studytime[6];
        $view->studytime7=$studytime[7];
        $view->xzerr=$xzerr;
        $view->xzright=$xzright;
        $view->yderr=$yderr;
        $view->ydright=$ydright;
        $view->wxerr=$wxerr;
        $view->wxright=$wxright;

        $view->tnum=$tnum;
        $view->colnum=$colnum;
        $view->sumtimes=$sumtimes;
        $view->level=$level;
        $view->curmonth=$mon;
        $view->curday=$day;
        $view->voc1=$voc1;
        $view->voc2=$voc2;
        $view->voc3=$voc3;

        $view->dxlist=$paperxz;
        $view->ydlist=$paperyd;
        $view->wxlist=$paperwx;


        return $view->fetch(APP_PATH.\request()->module().'/view/index/index.html');

    }

    //向用户发送test的页面
    public function testpage(Request $request){
        if(!(Session::has('username'))){ //判断
            return $this->fetch(APP_PATH.\request()->module().'/view/logandreg/login.html'); //给用户发送登录页面
        }
        //$this->redirect("exam");
        $pidss=$request->get('pid');
        $types=$request->get('typeid');
        $views=new View();
        $func=new Func();
        $username=Session::get("username");
        if($types==1){ //选择题
            $sql="select count(id) as c1 from dx where typeid=1 "; //找出选择题的数量
            $result1=Db::query($sql);
            $count1=$func->nulltozero($result1[0]['c1']);
            if($pidss > ceil($count1/10)){  //当$pid是伪造时
                // return $this->error("请不要随便输入!","indexs");
            }else{
                if($pidss == ceil($count1/10)){   //总体数
                    $views->sumtnum=$count1-($this->pids-1)*10;

                }else {
                    $views->sumtnum = 10;
                }
                $views->pids=$pidss;
                $views->username=$username;
                $views->pname=$func->createpaper2($pidss,1);
                $sql="select *  from dx where typeid=1 limit ?,10"; //找出选择题的数量
                $res=Db::query($sql,[($pidss-1)*10]);
                $views->dxlist=$res;
                $views->userpid=$pidss;
                return $views->fetch(APP_PATH.\request()->module().'/view/exam/dx.html');
            }

        }else if($types==2){   //阅读题
            $sql="select count(id) as c2 from textread where typeid=2 "; //找出选择题的数量
            $result1=Db::query($sql);
            $count1=$func->nulltozero($result1[0]['c2']);
            if($pidss > ceil($count1/2)){  //当$pid是伪造时
                 return $this->error("请不要随便输入!","indexs");
            }else{

                $views->ydnuma=5;
                $views->username=$username;
                $views->yd1=$func->createarray(5);
              //  var_dump($func->createarray(5));
                $views->pname=$func->createpaper2($pidss,2);
                $sql="select textid,texts from textread where textid>=? and typeid=2 limit 2";
                $res=Db::query($sql,[($pidss*2-1)]);
                $views->text1=$res[0]['texts'];
                $sql="select * from squestion where textid=? and typeid=?";
                $restext1=Db::query($sql,[$pidss*2-1,2]);
                $views->tid1=$pidss*2-1;
                $views->tid2=$pidss*2;
                $views->yda=$restext1;
                if($pidss == ceil($count1/2)){   //总体数
                    $views->sumtnum=1;
                    $views->ydnumb=0;
                    $views->yd2=$func->createarray(0);
                    $views->ydenable=0;
                }else {
                    $views->text2=$res[1]['texts'];
                    $restext2=Db::query($sql,[$pidss*2,2]);
                    $views->ydb=$restext2;
                    $views->sumtnum = 2;
                    $views->ydnumb=5;
                    $views->yd2=$func->createarray(5);
                    $views->ydenable=1;
                }
                $views->userpid=$pidss;
                return $views->fetch(APP_PATH.\request()->module().'/view/exam/yd.html');
            }

        }else if($types==3){  //完形填空
            $sql="select count(id) as c3 from readtext where typeid=3 "; //找出选择题的数量
            $result1=Db::query($sql);
            $count1=$func->nulltozero($result1[0]['c3']);
            if($pidss > ceil($count1/2)){  //当$pid是伪造时
                 return $this->error("请不要随便输入!","indexs");
            }else{

                $views->wxnuma=20;
                $views->username=$username;
                $views->wx1=$func->createarray(20);
                //  var_dump($func->createarray(5));
                $views->pname=$func->createpaper2($pidss,3);
                $sql="select textid,text from readtext where typeid=3 order by textid limit ?,2";
                $res=Db::query($sql,[($pidss-1)*2]);
                $views->text1=$res[0]['text'];
                $sql="select * from squestions where textid=? and typeid=3";
                $restext1=Db::query($sql,[$res[0]['textid']]);
              //  $restext2=Db::query($sql,[$res[1]['textid']]);
                $views->tid1=$res[0]['textid'];
                if($pidss == ceil($count1/2)){   //总体数
                    $views->sumtnum=1;
                    $views->wxnumb=0;
                    $views->wx2=$func->createarray(0);
                    $views->wxenable=0;
                }else {
                    $views->text2=$res[1]['text'];
                    $restext2=Db::query($sql,[$res[1]['textid']]);
                    $views->wxb=$restext2;
                    $views->tid2=$res[1]['textid'];
                    $views->sumtnum = 2;
                    $views->wxnumb=20;
                    $views->wx2=$func->createarray(20);
                    $views->wxenable=1;
                }

                $views->wxa=$restext1;
                $views->userpid=$pidss;
                return $views->fetch(APP_PATH.\request()->module().'/view/exam/wx.html');
            }

        }else {  //
            return $this->error("请要随便输入!","indexs");
        }
    }
    //用于接收用户的做题情况
    public function usertest(Request $request){  //用于添加用户做题记录
        $uids=Session::get("uid");
        $ptype=$request->post("ptype"); //获取用户做的题目类型
        $errnum=$request->post("errnum");
        $rightnum=$request->post("rightnum");
        $sumnum=$errnum+$rightnum;
        $testtime=$request->post("testtime");
        $pid=$request->post("pid");
        $sql="insert into usertest(uid,pid,num,stime,errnum,ptype,studyday,weekdays) values(?,?,?,?,?,?,curdate(),?)";
        $res=Db::execute($sql,[$uids,$pid,$sumnum,$testtime,$errnum,$ptype,(int)date("w")]);
    }
    //用于进行
    public function collocationdx(Request $request){ //收藏
        $uids=Session::get("uid");
        $ptype=1; //获取类型
        $pid=$request->post("pid1"); //获取用户做的题目类型
        $sql="select count(id) as num from qcollection where uid=? and qid=? and typeid=?";
        $res=Db::query($sql,[$uids,$pid,$ptype]);
        $func=new Func();
        $num=$func->nulltozero($res[0]['num']); //检测是否有相应的记录,有就不进行插入
        if($num==0) {
            $sql = "insert into qcollection(uid,qid,typeid) values(?,?,?)";
            $res=Db::execute($sql,[$uids,$pid,$ptype]);
        }
    }

    public function collocationyd(Request $request){
        $uid=Session::get("uid");
        $typeid=2;
        $pid=$request->post("pid1");
        $sql="select count(id) as num from qcollection where uid=? and qid=? and typeid=?";
        $res=Db::query($sql,[$uid,$pid,$typeid]);
        $func=new Func();
        $num=$func->nulltozero($res[0]['num']); //检测是否有相应的记录,有就不进行插入
        if($num==0) {
            $sql = "insert into qcollection(uid,qid,typeid) values(?,?,?)";
            $res=Db::execute($sql,[$uid,$pid,$typeid]);
        }
    }
    public function collocationwx(Request $request){
        $uid=Session::get("uid");
        $typeid=3;
        $pid=$request->post("pid1");
        $sql="select count(id) as num from qcollection where uid=? and qid=? and typeid=?";
        $res=Db::query($sql,[$uid,$pid,$typeid]);
        $func=new Func();
        $num=$func->nulltozero($res[0]['num']); //检测是否有相应的记录,有就不进行插入
        if($num==0) {
            $sql = "insert into qcollection(uid,qid,typeid) values(?,?,?)";
            $res=Db::execute($sql,[$uid,$pid,$typeid]);
        }
    }
    public function userinfo(Request $request){
        $username=$request->post("username");
        $phone=$request->post("phone");
        $email=$request->post("email");
        $school=$request->post("school");
        $sql="update userinfo set phone=? , email=?,school=? where uid=?";
        $res=Db::execute($sql,[$phone,$email,$school,Session::get("uid")]);

    }
    public function collshow(){ //收藏夹的渲染
        $username=Session::get("username");
        $uid2=Session::get("uid");
        $func=new Func();
        $view=new View();
        $sql="select count(id) as c1 from dx where typeid=1 "; //找出选择题的数量
        $result1=Db::query($sql);
        $count1=$func->nulltozero($result1[0]['c1']);
        $sql="select count(id) as c2  from  textread where typeid=2";
        $result1=Db::query($sql);
        $count2=$func->nulltozero($result1[0]['c2']);
        $sql="select count(id) as c3  from  readtext where typeid=3";
        $result1=Db::query($sql);
        $count3=$func->nulltozero($result1[0]['c3']); //获取了试卷的数量

        $sql='select count(id) as col from qcollection where uid=?';
        $result1=Db::query($sql,[$this->uid]); //获取用户
        $colnum=$func->nulltozero($result1[0]['col']); //用户收藏题目数量

        $result1=Db::query('select count(id) as  level from usertest where uid=?',[$this->uid]); //获取用户
        //对于用户等级,做题在1-10次为1级,其后逐次递增
        $level=ceil($result1[0]['level']/10);

        $result1=Db::query('select sum(num) as num,sum(stime) as stimes from usertest where uid=?',[$this->uid]);
        $tnum=$result1[0]['num'];  //做的总题数
        $sumtimes=ceil($func->nulltozero($result1[0]['stimes'])/60); //结果


        $dates=$func->getmon();  //获取月份和日期
        $day=$dates['2']; //获取当前日期
        $mon=$dates['1']; //获取当前月份
        $voc=$func->getvoc(); //获取单词表
        $voc1=$voc[1];
        $voc2=$voc[2];
        $voc3=$voc[3];
        $paperxz=$func->createrpaper($count1,1);
        $paperyd=$func->createrpaper($count2,2);
        $paperwx=$func->createrpaper($count3,3);
        //获取填充字符
        //下面是获取我们的学习时间
        $sql="select * from userinfo where uid=?";
        $res2=Db::query($sql,[$uid2]);
        $sql="select dx.id as id,dx.title as title,dx.choiceA as choiceA,dx.choiceB as choiceB,dx.choiceC as choiceC,dx.choiceD as choiceD,dx.answer as answer ,dx.analysis as analysis from qcollection,dx where qcollection.uid=? and qcollection.typeid=1 and qcollection.qid=dx.id "; //单选
        $res3=Db::query($sql,[$uid2]);
        //阅读题的渲染
        if($func->nulltozero($res3)==0){
            $view->dxenable=0;
        }else{
            $view->dxenable=1;
        }
        $sql="select textread.textid as textid,texts from textread, qcollection where qcollection.typeid=2 and qcollection.qid=textread.textid";
        $resyd=Db::query($sql);
        if($func->nulltozero($resyd)==0){
            $view->ydenable=0;
            $view->colyd=$resyd;
        }else {
            for ($i = 0; $i < count($resyd); $i++) {
                $sql = "select * from squestion where textid=? and typeid=2";
                $temp = Db::query($sql, [$resyd[$i]['textid']]);
                $resyd[$i]['yd'] = $temp;
            }
            $view->ydenable=1;
            $view->colyd=$resyd;
        }
        $sql="select readtext.textid as textid,text from readtext, qcollection where qcollection.typeid=3 and readtext.typeid=3 and qcollection.qid=readtext.textid";
        $reswx=Db::query($sql);
        if($func->nulltozero($reswx)==0){
            $view->wxenable=0;
            $view->colwx=$reswx;
        }else {
            for ($i = 0; $i < count($reswx); $i++) {
                $sql = "select * from squestions where textid=? and typeid=3";
                $temp = Db::query($sql, [$reswx[$i]['textid']]);
                $reswx[$i]['wx'] = $temp;
            }
            $view->wxenable=1;
            $view->colwx=$reswx;
        }
        $view->email=$res2[0]['email'];
        $view->phone=$res2[0]['phone'];
        $view->school=$res2[0]['school'];
        $view->username=$username;
        $view->tnum=$tnum;
        $view->colnum=$colnum;
        $view->sumtimes=$sumtimes;
        $view->level=$level;
        $view->curmonth=$mon;
        $view->curday=$day;
        $view->dxlist=$paperxz;
        $view->ydlist=$paperyd;
        $view->wxlist=$paperwx;
        $view->coldx=$res3;
        return $view->fetch(APP_PATH.\request()->module().'/view/collocation/collocation.html');
    }
    public function cancercol(Request $request){
        $pid=$request->post("tid");
        $typeid=$request->post("typeid");
        $sql="delete from qcollection where qid=? and uid=? and typeid=?";
        $res=Db::execute($sql,[$pid,Session::get("uid"),$typeid]);
        $this->redirect("collshow");
    }


}
