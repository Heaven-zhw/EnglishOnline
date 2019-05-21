<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use think\Response;
use think\View;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch(APP_PATH.\request()->module().'/view/login/login.html');
    }
    public function login(Request $request){
        $username=$request->post("username");
        $password=$request->post("password");

        $sql="select * from alogin where username=?";
        $res=Db::query($sql,[$username]);
        if($res==null){
            //没有此账号
            $this->error("不存在此账号!",'index');
        }else{

            if($res[0]['pwd']==md5($password)){
                Session::set('username',$username);
                Session::set("uid",$res[0]['id']);
                $this->redirect("indexs");
            }else{
                $this->error("密码错误",'index');
            }
        }
    }
    public function logout(){
        Session::delete("username");
        Session::delete("uid");
        return $this->redirect("index");
    }
    public function indexs(){
        $view=new View();
        $func=new Func();
        if(!(Session::has('username'))){ //判断
            return $this->redirect("index"); //给用户发送登录页面
        }
        $view->username=Session::get("username");
        $sql="select sum(num) as nums,ptype from  usertest group by ptype ";
        $tnum=Db::query($sql);
        $wei=count($tnum);
        if($wei == 0){
            $view->dxp=0;
            $view->wxp=0;
            $view->ydp=0;
        }else if($wei==1){
            $view->ydp=0;
            $view->dxp=100;
            $view->wxp=0;
        }else if($wei==2){
            $view->dxp=$tnum[0]['nums']/($tnum[0]['nums']+$tnum[1]['nums']);
            $view->ydp=$tnum[1]['nums']/($tnum[0]['nums']+$tnum[1]['nums']);
            $view->wxp=0;
        }else{
            $view->dxp=$tnum[0]['nums']/($tnum[0]['nums']+$tnum[1]['nums']+$tnum[2]['nums']);
            $view->ydp=$tnum[1]['nums']/($tnum[0]['nums']+$tnum[1]['nums']+$tnum[2]['nums']);
            $view->wxp=$tnum[2]['nums']/($tnum[0]['nums']+$tnum[1]['nums']+$tnum[2]['nums']);
        }
        $sql="select username,sum(num) as tnum ,sum(stime) as times from  usertest,ulogin,userinfo  where userinfo.uid=usertest.uid and usertest.uid=ulogin.id group by usertest.uid  order by count(usertest.uid) desc limit 0,5";
        $userlist=Db::query($sql);
        $view->userlist=$userlist;
        return $view->fetch(APP_PATH.\request()->module().'/view/index/index.html');
    }
    public function userinfo(Request $request){
        $view=new View();
        $func=new Func();
        if(!(Session::has('username'))){ //判断
            return $this->redirect("index"); //给用户发送登录页面
        }
        $page=$request->get("page");
        if($page==null){
            $page=1;
        }
        $sql="select count(id) as unum from ulogin";
        $res=Db::query($sql);
        $usernum=$res[0]['unum'];
        $sql="select username,phone,email,school from userinfo,ulogin where userinfo.uid=ulogin.id limit ?,5";
        if(($page-1)*5 > $usernum){
            //
            $this->error("输入了错误的数字,返回首页",'indexs');
        }else{
           $res=Db::query($sql,[($page-1)*5]);
           $pageusernum=count($res);
        }
        $view->username=Session::get("username");
        $view->userlist=$res;
        $view->usernumlist=$func->createarrayk(ceil($usernum/5));
        return $view->fetch(APP_PATH.\request()->module().'/view/userinfo/userinfo.html');
    }

    public function adddx(){
        $view=new View();
        $func=new Func();
        if(!(Session::has('username'))){ //判断
            return $this->redirect("index"); //给用户发送登录页面
        }
        $sql="select count(id) as nums from aupload group by typeid ";
        $tnum=Db::query($sql);
        $view->username=Session::get("username");
        $wei=count($tnum);
        if($wei == 0){
            $view->dxp=0;
            $view->wxp=0;
            $view->ydp=0;
            $view->dxnum=0;
            $view->ydnum=0;
            $view->wxnum=0;
        }else if($wei==1){
            $view->ydp=0;
            $view->dxp=100;
            $view->wxp=0;
            $view->dxnum=$tnum[0]['nums'];
            $view->ydnum=0;
            $view->wxnum=0;
        }else if($wei==2){
            $view->dxp=$tnum[0]['nums']/($tnum[0]['nums']+$tnum[1]['nums']);
            $view->ydp=$tnum[1]['nums']/($tnum[0]['nums']+$tnum[1]['nums']);
            $view->wxp=0;
            $view->dxnum=$tnum[0]['nums'];
            $view->ydnum=$tnum[1]['nums'];
            $view->wxnum=0;
        }else{
            $view->dxp=$tnum[0]['nums']/($tnum[0]['nums']+$tnum[1]['nums']+$tnum[2]['nums']);
            $view->ydp=$tnum[1]['nums']/($tnum[0]['nums']+$tnum[1]['nums']+$tnum[2]['nums']);
            $view->wxp=$tnum[2]['nums']/($tnum[0]['nums']+$tnum[1]['nums']+$tnum[2]['nums']);
            $view->dxnum=$tnum[0]['nums'];
            $view->ydnum=$tnum[1]['nums'];
            $view->wxnum=$tnum[1]['nums'];
        }
        return $view->fetch(APP_PATH.\request()->module().'/view/additem/adddx.html');
    }
    public function addwx(){
        return $this->fetch(APP_PATH.\request()->module().'/view/additem/addwx.html');
    }
    public function addyd(){
        return $this->fetch(APP_PATH.\request()->module().'/view/additem/addyd.html');
    }
    public function add(Request$request){
        $view=new View();
        $func=new Func();
        $uid=Session::get("uid");
        if(!(Session::has('username'))){ //判断
            return $this->redirect("index"); //给用户发送登录页面
        }
        $typeid=$request->get("typeid");
        $contant=$request->post();
        var_dump($contant);
        $title1="title";
        $choicea1="choicea";
        $choiceb1="choiceb";
        $choicec1="choicec";
        $choiced1="choiced";
        $answer1="radio";
        $analysis1="analysis";

        if($typeid==1){
            $title=$contant['title'];
            $choicea=$contant['choicea'];
            $choiceb=$contant['choiceb'];
            $choicec=$contant['choicec'];
            $choiced=$contant['choiced'];
            $answer=$contant['radio'];
            $analysis=$contant['analysis'];
            $sql="insert into dx(title,choiceA,choiceB,choiceC,choiceD,answer,analysis,typeid) values(?,?,?,?,?,?,?,1)";
            $res=Db::execute($sql,[$title,$choicea,$choiceb,$choicec,$choiced,$answer,$analysis]);
            $sql="insert into aupload(uid,uploadtime,typeid) values(?,CURDATE(),1)";
            $res=Db::execute($sql,[$uid]);
            $this->success("提交成功！","adddx");
        }else if($typeid==2){
            //阅读
            $text=$contant['text'];
            $sql="select max(textid) as ids from textread where typeid=2";
            $res=Db::query($sql);
            $maxtextid=$res[0]['ids']+1;
            $sql="insert into textread(textid,texts,qnum,typeid) values(?,?,5,2)";
            $res=Db::execute($sql,[$maxtextid,$text]);
            for($i=1;$i<=5;$i++){
                $title=$contant[$title1.(string)$i];
                $choicea=$contant[$choicea1.(string)$i];
                $choiceb=$contant[$choiceb1.(string)$i];
                $choicec=$contant[$choicec1.(string)$i];
                $choiced=$contant[$choiced1.(string)$i];
                $answer=$contant[$answer1.(string)$i];
                $analysis=$contant[$analysis1.(string)$i];
                $sql="insert into squestion(title,choiceA,choiceB,choiceC,choiceD,answer,analysis,typeid,textid) values(?,?,?,?,?,?,?,2,?)";
                $res=Db::execute($sql,[$title,$choicea,$choiceb,$choicec,$choiced,$answer,$analysis,$maxtextid]);
                $sql="insert into aupload(uid,uploadtime,typeid) values(?,CURDATE(),2)";
                $res=Db::execute($sql,[$uid]);
            }
            $this->success("提交成功！","addyd");
        }else if($typeid==3){
            $text=$contant['text'];
            $sql="select max(textid) as ids from readtext";
            $res=Db::query($sql);
            $maxtextid=$res[0]['ids']+1;
            $sql="insert into readtext(textid,text,qnum,typeid) values(?,?,20,3)";
            $res=Db::execute($sql,[$maxtextid,$text]);
            for($i=1;$i<=20;$i++){
                $choicea=$contant[$choicea1.(string)$i];
                $choiceb=$contant[$choiceb1.(string)$i];
                $choicec=$contant[$choicec1.(string)$i];
                $choiced=$contant[$choiced1.(string)$i];
                $answer=$contant[$answer1.(string)$i];
                $analysis=$contant[$analysis1.(string)$i];
                $sql="insert into squestions(title,choiceA,choiceB,choiceC,choiceD,answer,analysis,typeid,textid) values(?,?,?,?,?,?,?,3,?)";
                $res=Db::execute($sql,["[小题".$i."]",$choicea,$choiceb,$choicec,$choiced,$answer,$analysis,$maxtextid]);
                $sql="insert into aupload(uid,uploadtime,typeid) values(?,CURDATE(),2)";
                $res=Db::execute($sql,[$uid]);
            }
            $this->success("提交成功！","addwx");
        }
    }
    public function deleteuser(Request $request){
        $username=$request->post("username");
        $sql="select id from ulogin where username=?";
        $res=Db::query($sql,[$username]);
        $uid=$res[0]['id'];
        $sql="delete from ulogin where id=?";
       $res1=Db::execute($sql,[$uid]);
        $sql="delete from qcollection where uid=?";
        $res1=Db::execute($sql,[$uid]);
        $sql="delete from usertest where uid=?";
       $res1=Db::execute($sql,[$uid]);
       $this->redirect("userinfo");
    }
    public function createadmin(Request $request){
        $username=$request->post("username");
        $pwd=$request->post("password");
        $sql="select * from alogin where username=?";
        $res=Db::query($sql,[$username]);
        if($res!=null){
            $this->error("此用户名已存在！",'userinfo');
        }else{
            $sql="insert into alogin(username,pwd) values (?,?)";
            $res=Db::execute($sql,[$username,md5($pwd)]);
            $this->redirect('userinfo');
        }
    }
}
