<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"F:\php\WWW\tp5\tp\public/../application/index/view/collocation/collocation.html";i:1558250330;}*/ ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>在线考试系统 </title>

    <script type="text/javascript">
        var cxt=document.getElementById("myCanvas").getContext("2d");//getContext(<context>) 为画布返回绘图上下文
        cxt.fillstyle="#FF0000";//获取或设置用于实心图形的样式，默认为black
        cxt.fillRect(0,0,150,75);//fillRect(x,y,w,h)绘制一个实心矩形，前两个参数是从canvas元素左上角算起的偏移量
    </script>
    <!-- Bootstrap -->
    <link  rel="stylesheet" href="../../../.././vendor/css/publicCss.css" />
    <link  rel="stylesheet" href="../../../.././vendor/css/publictest.css" />
    <link  rel="stylesheet" href="../../../.././vendor/css/detailtitle.css" />
    <link href="../../../.././vendor/css/cat_smoking.css" rel="stylesheet" />
    <link href="../../../.././vendor/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../../.././vendor/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../../.././vendor/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../../../.././vendor/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="../../../.././vendor/css/style.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,300,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Custom Theme Style -->
    <link href="../../../.././vendor/build/css/custom.min.css" rel="stylesheet">
    <script src='http://www.ichartjs.com/ichart.latest.min.js'></script>
    <script>
        function showmodel(){
            // alert("sdsd");
            $("#myModal").modal("show");
        }
    </script>
    <script>
        function updates(){
            $.ajax({
                type: 'post', // 提交方式 get/post
                url: 'http://127.0.0.1:8090/public/index.php/index/index/userinfo', // 需要提交的 url
                data:{
                    'username':$("#checkusername").val(),
                    'email':$("#checkemail").val(),
                    'phone':$("#checkphone").val(),
                    'school':$("#checkschool").val()
                }
                , success : function(data){
                    alter("更新成功");
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(XMLHttpRequest.status + "," + textStatus);
                }
            });
        }
    </script>

</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="#" class="site_title"><i class="fa fa-paw"></i> <span>软件工程大作业</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="../../../../vendor/./img/timg.jpg" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>欢迎您</span>
                        <h2><?php echo $username; ?></h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>通用</h3>
                        <ul class="nav side-menu">
                            <li><a href="http://127.0.0.1:8090/public/index.php/index/index/indexs"><i class="fa fa-home"></i> 主页 </a>
                            </li>
                            <li><a><i class="fa fa-edit"></i> 单项选择 <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <?php if(is_array($dxlist) || $dxlist instanceof \think\Collection || $dxlist instanceof \think\Paginator): $i = 0; $__LIST__ = $dxlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dx): $mod = ($i % 2 );++$i;?>
                                    <li><a  href="http://127.0.0.1:8090/public/index.php/index/index/testpage?pid=<?php echo $i; ?>&typeid=1"><?php echo $dx; ?></a></li>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-edit"></i> 阅读 <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <!--?php
                                    $i=ceil(($countyd/$count2)); //获取试卷的套数
                                    for($j=0;$j<$i;$j++) {
                                        echo '<li><a  href="test.php/ydid=' . $j . '">模拟试题(' . $j . ')</a></li>';
                                    }
                                    ?-->
                                    <?php if(is_array($ydlist) || $ydlist instanceof \think\Collection || $ydlist instanceof \think\Paginator): $i = 0; $__LIST__ = $ydlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$yd): $mod = ($i % 2 );++$i;?>
                                    <li><a  href="http://127.0.0.1:8090/public/index.php/index/index/testpage?pid=<?php echo $i; ?>&typeid=2"><?php echo $yd; ?></a></li>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-edit"></i> 完型填空 <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <?php if(is_array($wxlist) || $wxlist instanceof \think\Collection || $wxlist instanceof \think\Paginator): $i = 0; $__LIST__ = $wxlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$wx): $mod = ($i % 2 );++$i;?>
                                    <li><a  href="http://127.0.0.1:8090/public/index.php/index/index/testpage?pid=<?php echo $i; ?>&typeid=3"><?php echo $wx; ?></a></li>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </li>
                            <li><a href="http://127.0.0.1:8090/public/index.php/index/index/collshow"><i class="fa fa-bar-chart-o"></i> 收藏夹 </a>
                            </li>
                            <!--li><a><i class="fa fa-clone"></i>保留 <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                                    <li><a href="fixed_footer.html">Fixed Footer</a></li>
                                </ul>
                            </li-->
                            <li><a data-toggle="model" data-target="#myModa" onclick="showmodel()"><i class="fa fa-laptop"></i> 用户管理 <span class="label label-success pull-right">Coming Soon</span></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="" data-placement="" title="">
                        <span class="" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="" data-placement="" title="">
                        <span class="" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="http://127.0.0.1:8090/public/index.php/index/index/logout">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span><?php echo $username; ?></span>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li>
                                    <a data-toggle="model" data-target="#myModa" onclick="showmodel()">
                                        <span>用户信息</span>
                                    </a>
                                </li>
                                <li><a href="javascript:">帮助</a></li>
                                <li><a href="http://127.0.0.1:8090/public/index.php/index/index/logout"><i class="fa fa-sign-out pull-right"></i>退出</a></li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel" >
                            <div class="x_title">
                                <h2>收藏夹 <small>学习成果展示 </small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#dx" data-toggle="tab">单选题</a>
                                    </li>
                                    <li><a href="#yd" data-toggle="tab">阅读</a></li>
                                    <li>
                                        <a href="#wx" data-toggle="tab"> 完型填空</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="dx">
                                        <div class="row" style="padding-left:10px;padding-bottom: 5px; margin-bottom: 5px;">
                                            <?php if(($dxenable==1)): if(is_array($coldx) || $coldx instanceof \think\Collection || $coldx instanceof \think\Paginator): $i = 0; $__LIST__ = $coldx;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ts): $mod = ($i % 2 );++$i;?>
                                            <div class="col-md-6">
                                                <div class="panel panel-default" style="margin-top: 10px">
                                                    <div class="panel-body" style="padding: 0px">
                                                        <div class="DetailTitletitlecont">
                                                            <h4><i><?php echo $i; ?>[出自<?php echo ceil($ts['id']/10); ?>套练习题]</i>
                                                                　<?php echo $ts['title']; ?>
                                                            </h4>
                                                        </div>
                                                        <div  class="DetailTitletitlecontmoreselect" data-type="2" >
                                                            <ul  answer="<?php echo $ts['answer']; ?>" useranswer="" tid=<?php echo $ts['id']; ?>>
                                                                <li style="overflow: hidden" class="xuanxinag" name="A" data-check=0  data-value="A" data-type="9" >
                                                                    <i> A</i>
                                                                    <span style="width:400px"> <?php echo $ts['choiceA']; ?></span>
                                                                </li>
                                                                <li style="overflow: hidden" class="xuanxinag" name="B" data-check=0  data-value="B" data-type="9" >
                                                                    <i> B</i>
                                                                    <span style="width:400px"> <?php echo $ts['choiceB']; ?></span>
                                                                </li>
                                                                <li style="overflow: hidden" class="xuanxinag" name="C" data-check=0  data-value="C" data-type="9">
                                                                    <i> C</i>
                                                                    <span style="width:400px"> <?php echo $ts['choiceC']; ?></span>
                                                                </li>
                                                                <li style="overflow: hidden" class="xuanxinag" name="D" data-check=0  data-value="D" data-type="9" >
                                                                    <i> D</i>
                                                                    <span style="width:400px"> <?php echo $ts['choiceD']; ?></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="DetailTitletitleanswermoreselect" data-type="2">
                                                        </div>
                                                        <div class="a-questionToolbar">
                                                            <div>
                                                                <div class="cankaodaan" style="display:block" >
                                                                    <div style="padding-left:10px;width:800px">
                                                                    <span class="spantext">&nbsp;&nbsp;参考答案：</span>
                                                                    <span class="sanwer" data-id="A"><?php echo $ts['answer']; ?></span>
                                                                    </div>
                                                                     <div style="padding-left:10px;width:550px">
                                                                         <span style="color:#f6a395"> <?php echo $ts['analysis']; ?></span>
                                                                     </div>
                                                                    <form  class="form-inline" role="form" action="http://127.0.0.1:8090/public/index.php/index/index/cancercol" method="post">
                                                                        <div style="text-align:right;width:560px;" >
                                                                            <input  type="hidden" value="<?php echo $ts['id']; ?>" hidden="hidden" name="tid" tid="<?php echo $ts['id']; ?>">
                                                                            <input  type="hidden" value="1" hidden="hidden" name="typeid" >
                                                                            <button  type="submit" name="1" class="btn btn-success" style="padding: 10px 30px; ">取消收藏</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; endif; else: echo "" ;endif; endif; ?>

                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="yd" style="overflow: hidden">
                                        <div class="row" style="padding-left:10px;padding-bottom: 5px; margin-bottom: 5px;">
                                            <?php if(($ydenable==1)): if(is_array($colyd) || $colyd instanceof \think\Collection || $colyd instanceof \think\Paginator): $i = 0; $__LIST__ = $colyd;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ts): $mod = ($i % 2 );++$i;?>
                                            <div class="col-md-6">
                                                <div class="panel panel-default" style="margin-top: 10px">
                                                    <div class="panel-body" style="padding: 0px">
                                                        <div class="DetailTitlecontent">
                                                            <div class="DetailTitletitle">
                                                                <div class="DetailTitletitlecont">
                                                                    <h4><i><?php echo $i; ?>[阅读理解]</i>
                                                                        <?php echo $ts['texts']; ?>
                                                                    </h4>
                                                                </div>
                                                                <?php if(is_array($ts['yd']) || $ts['yd'] instanceof \think\Collection || $ts['yd'] instanceof \think\Paginator): $k = 0; $__LIST__ = $ts['yd'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$td): $mod = ($k % 2 );++$k;?>
                                                                <div  class="DetailTitletitlecontmoreselect" data-type="2" >
                                                                    <div class="DetailTitletitlecont">
                                                                        <h4><i><?php echo $k; ?>.</i>
                                                                            <?php echo $td['title']; ?>
                                                                        </h4>
                                                                    </div>
                                                                    <div class="DetailTitletitlecontmoreselect" data-type="2">
                                                                    <ul >
                                                                        <li style="overflow: hidden" class="xuanxinag" name="A" data-check=0  data-value="A" data-type="9" >
                                                                            <i> A</i>
                                                                            <span style="width:400px"> <?php echo $td['choiceA']; ?></span>
                                                                        </li>
                                                                        <li style="overflow: hidden" class="xuanxinag" name="B" data-check=0  data-value="B" data-type="9" >
                                                                            <i> B</i>
                                                                            <span style="width:400px"> <?php echo $td['choiceB']; ?></span>
                                                                        </li>
                                                                        <li  style="overflow: hidden" class="xuanxinag" name="C" data-check=0  data-value="C" data-type="9" >
                                                                            <i> C</i>
                                                                            <span style="width:400px"> <?php echo $td['choiceC']; ?></span>
                                                                        </li>
                                                                        <li style="overflow: hidden" class="xuanxinag" name="D" data-check=0  data-value="D" data-type="9" >
                                                                            <i> D</i>
                                                                            <span style="width:400px"> <?php echo $td['choiceD']; ?></span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="DetailTitletitleanswermoreselect" data-type="2">
                                                                </div>
                                                                <div class="a-questionToolbar">
                                                                    <div >
                                                                        <div class="cankaodaan" style="display:block" >
                                                                            <div style="padding-left:10px;width:800px">
                                                                                <span class="spantext">参考答案：</span>
                                                                                <span class="sanwer" data-id="<?php echo $td['answer']; ?>">
                                                                                            <?php echo $td['answer']; ?>
                                                                                </span>
                                                                            </div>
                                                                            <div style="padding-left:10px;width:800px">
                                                                                <span style="color:#f6a395"><?php echo $td['analysis']; ?>
                                                                                </span>
                                                                            </div>
                                                                            <?php if(($k==1)): ?>
                                                                            <form  class="form-inline" role="form" action="http://127.0.0.1:8090/public/index.php/index/index/cancercol" method="post">
                                                                                <div style="text-align:right;width:560px;" >
                                                                                    <input  type="hidden" value="2" hidden="hidden" name="typeid" >
                                                                                    <input  type="hidden" value="<?php echo $ts['textid']; ?>" hidden="hidden" name="tid" >
                                                                                    <button  type="submit" name="1" class="btn btn-success" style="padding: 10px 30px; ">取消收藏</button>
                                                                                </div>
                                                                            </form>
                                                                            <?php endif; ?>
                                                                        </div>​
                                                                    </div>
                                                                </div>
                                                                </div>    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="wx">
                                        <div class="row" style="padding-left:10px;padding-bottom: 5px; margin-bottom: 5px;">
                                            <?php if(($wxenable==1)): if(is_array($colwx) || $colwx instanceof \think\Collection || $colwx instanceof \think\Paginator): $i = 0; $__LIST__ = $colwx;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ts): $mod = ($i % 2 );++$i;?>
                                            <div class="col-md-6">
                                                <div class="panel panel-default" style="margin-top: 10px">
                                                    <div class="panel-body" style="padding: 0px">
                                                        <div class="DetailTitlecontent">
                                                            <div class="DetailTitletitle">
                                                                <div class="DetailTitletitlecont">
                                                                    <h4><i><?php echo $i; ?>[完型填空]</i>
                                                                        <?php echo $ts['text']; ?>
                                                                    </h4>
                                                                </div>
                                                                <?php if(is_array($ts['wx']) || $ts['wx'] instanceof \think\Collection || $ts['wx'] instanceof \think\Paginator): $k = 0; $__LIST__ = $ts['wx'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$td): $mod = ($k % 2 );++$k;?>
                                                                <div  class="DetailTitletitlecontmoreselect" data-type="2" >
                                                                    <div class="DetailTitletitlecont">
                                                                        <h4><i><?php echo $k; ?>.</i>
                                                                            <?php echo $td['title']; ?>
                                                                        </h4>
                                                                    </div>
                                                                    <ul >
                                                                        <li style="overflow: hidden" class="xuanxinag" name="A" data-check=0  data-value="A" data-type="9" >
                                                                            <i> A</i>
                                                                            <span style="width:400px"> <?php echo $td['choiceA']; ?></span>
                                                                        </li>
                                                                        <li style="overflow: hidden" class="xuanxinag" name="B" data-check=0  data-value="B" data-type="9" >
                                                                            <i> B</i>
                                                                            <span style="width:400px"> <?php echo $td['choiceB']; ?></span>
                                                                        </li>
                                                                        <li  style="overflow: hidden" class="xuanxinag" name="C" data-check=0  data-value="C" data-type="9" >
                                                                            <i> C</i>
                                                                            <span style="width:400px"> <?php echo $td['choiceC']; ?></span>
                                                                        </li>
                                                                        <li  style="overflow: hidden" class="xuanxinag" name="D" data-check=0  data-value="D" data-type="9" >
                                                                            <i> D</i>
                                                                            <span style="width:400px"> <?php echo $td['choiceD']; ?></span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="DetailTitletitleanswermoreselect" data-type="2">
                                                                    <ul>
                                                                    </ul>
                                                                </div>
                                                                <div class="a-questionToolbar">
                                                                    <div >
                                                                        <div class="cankaodaan" style="display:block" >
                                                                            <div style="padding-left:10px;width:800px">
                                                                                <span class="spantext">参考答案：</span>
                                                                                <span class="sanwer" data-id="<?php echo $td['answer']; ?>">
                                                                                            <?php echo $td['answer']; ?>
                                                                                </span>
                                                                            </div>
                                                                            <div style="padding-left:10px;width:800px">
                                                                                <span style="color:#f6a395"><?php echo $td['analysis']; ?>
                                                                                </span>
                                                                            </div>
                                                                            <?php if(($k==1)): ?>
                                                                            <form  class="form-inline" role="form" action="http://127.0.0.1:8090/public/index.php/index/index/cancercol" method="post">
                                                                                <div style="text-align:right;width:560px;" >
                                                                                    <input  type="hidden" value="3" hidden="hidden" name="typeid" >
                                                                                    <input  type="hidden" value="<?php echo $ts['textid']; ?>" hidden="hidden" name="tid" >
                                                                                    <button  type="submit" name="1" class="btn btn-success" style="padding: 10px 30px; ">取消收藏</button>
                                                                                </div>
                                                                            </form>
                                                                            <?php endif; ?>
                                                                        </div>​
                                                                    </div>
                                                                </div>
                                                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
        <div>
            <div style="width: 1800px; display: none; padding-right: 160px;padding-top:50px"class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" >
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <form action="#" method="post" >
                                    <div class="resp-tabs-container">
                                        <h2 class="resp-accordion resp-tab-active" role="tab" aria-controls="tab_item-0"><span class="resp-arrow"></span><span></span></h2><div class="tab-1 resp-tab-content resp-tab-content-active" aria-labelledby="tab_item-0" style="display:block">
                                        <div class="profile-content">
                                            <h3>用户名</h3>
                                            <div class="school-group">
                                                <div class="school-icon"><span></span></div>
                                                <div class="cell-form">
                                                    <input disabled="disabled" id="checkusername" style="width: 80%;height: 35px" type="text" name="username" class="form-control" value="<?php echo $username; ?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '<?php echo $username; ?>';}">
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <h3>邮箱</h3>
                                            <div class="email-group">
                                                <div class="email-icon"><span></span></div>
                                                <div class="email-form">
                                                    <input id="checkemail" style="width: 80%;height: 35px" type="text" name="email" class="fb-ico" value="<?php echo $email; ?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '<?php echo $email; ?>';}">
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <h3>电话号码</h3>
                                            <div class="phone-group">
                                                <div class="cell-icon"><span></span></div>
                                                <div class="cell-form">
                                                    <input id="checkphone" style="width: 80%;height: 35px" type="text" value="<?php echo $phone; ?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '<?php echo $phone; ?>';}">
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <h3>在读学校</h3>
                                            <div class="school-group">
                                                <div class="school-icon"><span></span></div>
                                                <div class="cell-form">
                                                    <input id="checkschool" style="width: 80%;height: 35px" type="text" value="<?php echo $school; ?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '<?php echo $school; ?>';}">
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                        <div class="update" >
                                            <a href="#" data-dismiss="modal" aria-hidden="true" onclick="updates()">Update</a>
                                            <!--button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">提交</button-->
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--div class="modal-footer">

                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">提交</button>
                        </div-->
                    </div><!-- /.modal-content -->
                </div><!-- /.modal -->
            </div>
        </div>
        <!-- footer content -->
        <footer>
            <div class="pull-right">
                bugless 小组倾情制作
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>


<!-- jQuery -->
<script src="../../../../vendor/vendors/jquery/dist/jquery.min.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<!-- Bootstrap -->
<script src="../../../.././vendor/vendors/bootstrap/dist/js/bootstrap.min.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<!-- FastClick -->
<script src="../../../.././vendor/vendors/fastclick/lib/fastclick.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<!-- NProgress -->
<script src="../../../.././vendor/vendors/nprogress/nprogress.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<!-- Chart.js -->
<script src="../../../.././vendor/vendors/Chart.js/dist/Chart.min.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<!-- jQuery Sparklines -->
<script src="../../../.././vendor/vendors/jquery-sparkline/dist/jquery.sparkline.min.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<!-- Flot -->
<script src="../../../.././vendor/vendors/Flot/jquery.flot.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<script src="../../../.././vendor/vendors/Flot/jquery.flot.pie.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<script src="../../../.././vendor/vendors/Flot/jquery.flot.time.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<script src="../../../.././vendor/vendors/Flot/jquery.flot.stack.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<script src="../../../.././vendor/vendors/Flot/jquery.flot.resize.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<!-- Flot plugins -->
<script src="../../../.././vendor/vendors/flot.orderbars/js/jquery.flot.orderBars.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<script src="../../../.././vendor/vendors/flot-spline/js/jquery.flot.spline.min.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<script src="../../../.././vendor/vendors/flot.curvedlines/curvedLines.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<!-- DateJS -->
<script src="../../../.././vendor/vendors/DateJS/build/date.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<!-- bootstrap-daterangepicker -->
<script src="../../../.././vendor/vendors/moment/min/moment.min.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<script src="../../../.././vendor/vendors/bootstrap-daterangepicker/daterangepicker.js" type="8300bef2be837f24e6816e86-text/javascript"></script>

<!-- Custom Theme Scripts -->
<script src="../../../.././vendor/build/js/custom.min.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<!-- Google Analytics -->
<script type="8300bef2be837f24e6816e86-text/javascript">
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-23581568-13', 'auto');
ga('send', 'pageview');

</script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/a2bd7673/cloudflare-static/rocket-loader.min.js" data-cf-settings="8300bef2be837f24e6816e86-|49" defer=""></script>
</body>
</html>