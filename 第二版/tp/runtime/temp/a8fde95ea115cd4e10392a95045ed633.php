<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"F:\php\WWW\tp5\tp\public/../application/index/view/index/index.html";i:1558189270;}*/ ?>

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
    <script type='text/javascript'>
        $(function(){
            var chart = iChart.create({
                render:"ichart-render",
                width:478,
                height:140,
                background_color:"#fefefe",
                gradient:false,
                color_factor:0.2,
                border:{
                    color:"BCBCBC",
                    width:0
                },
                align:"center",
                offsetx:0,
                offsety:0,
                sub_option:{
                    border:{
                        color:"#BCBCBC",
                        width:1
                    },
                    label:{
                        fontweight:500,
                        fontsize:11,
                        color:"#4572a7",
                        sign:"square",
                        sign_size:12,
                        border:{
                            color:"#BCBCBC",
                            width:1
                        },
                        background_color:"#fefefe"
                    }
                },
                shadow:true,
                shadow_color:"#666666",
                shadow_blur:2,
                showpercent:false,
                column_width:"70%",
                bar_height:"70%",
                radius:"90%",
                title:{
                    text:"",
                    color:"#111111",
                    fontsize:20,
                    font:"微软雅黑",
                    textAlign:"center",
                    height:0,
                    offsetx:0,
                    offsety:0
                },
                subtitle:{
                    text:"",
                    color:"#111111",
                    fontsize:16,
                    font:"微软雅黑",
                    textAlign:"center",
                    height:20,
                    offsetx:0,
                    offsety:0
                },
                footnote:{
                    text:"",
                    color:"#111111",
                    fontsize:12,
                    font:"微软雅黑",
                    textAlign:"right",
                    height:20,
                    offsetx:0,
                    offsety:0
                },
                legend:{
                    enable:false,
                    background_color:"#fefefe",
                    color:"#333333",
                    fontsize:12,
                    border:{
                        color:"#BCBCBC",
                        width:1
                    },
                    column:1,
                    align:"right",
                    valign:"center",
                    offsetx:0,
                    offsety:0
                },
                coordinate:{
                    width:"80%",
                    height:"84%",
                    background_color:"#ffffff",
                    axis:{
                        color:"#a5acb8",
                        width:[1,"",1,""]
                    },
                    grid_color:"#d9d9d9",
                    label:{
                        fontweight:500,
                        color:"#666666",
                        fontsize:11
                    }
                },
                label:{
                    fontweight:500,
                    color:"#666666",
                    fontsize:11
                },
                type:"column2d",
                data:[
                    {
                        name:"周一",
                        value:<?php echo $studytime1; ?>,
                        color:"#4572a7"
                    },
                    {
                        name:"周二",
                        value:<?php echo $studytime2; ?>,
                        color:"#4572a7"
                    },
                    {
                        name:"周三",
                        value:<?php echo $studytime3; ?>,
                        color:"#4572a7"
                    },
                    {
                        name:"周四",
                        value:<?php echo $studytime4; ?>,
                        color:"#4572a7"
                    },
                    {
                        name:"周五",
                        value:<?php echo $studytime5; ?>,
                        color:"#4572a7"
                    },
                    {
                        name:"周六",
                        value:<?php echo $studytime6; ?>,
                        color:"#4572a7"
                    },
                    {
                        name:"周日",
                        value:<?php echo $studytime7; ?>,
                        color:"#4572a7"
                    }
                ]
            });
            chart.draw();
        });

        $(function(){
            var chart1 = iChart.create({
                render:"ichart-render2",
                width:170,
                height:170,
                background_color:"#fefefe",
                gradient:false,
                color_factor:0.2,
                border:{
                    color:"BCBCBC",
                    width:0
                },
                align:"center",
                offsetx:0,
                offsety:20,
                sub_option:{
                    border:{
                        color:"#BCBCBC",
                        width:0
                    },
                    label:{
                        fontweight:500,
                        fontsize:11,
                        color:"#4572a7",
                        sign:"",
                        sign_size:0,
                        border:{
                            color:"#BCBCBC",
                            width:1
                        },
                        background_color:"#ede6e6"
                    }
                },
                shadow:true,
                shadow_color:"#666666",
                shadow_blur:2,
                showpercent:false,
                column_width:"70%",
                bar_height:"70%",
                radius:"80%",
                title:{
                    text:"填空题",
                    color:"#111111",
                    fontsize:14,
                    font:"Arial",
                    textAlign:"center",
                    height:20,
                    offsetx:0,
                    offsety:0
                },
                subtitle:{
                    text:"",
                    color:"#111111",
                    fontsize:16,
                    font:"微软雅黑",
                    textAlign:"center",
                    height:20,
                    offsetx:0,
                    offsety:0
                },
                footnote:{
                    text:"",
                    color:"#111111",
                    fontsize:12,
                    font:"微软雅黑",
                    textAlign:"right",
                    height:20,
                    offsetx:0,
                    offsety:0
                },
                legend:{
                    enable:false,
                    background_color:"#fefefe",
                    color:"#333333",
                    fontsize:12,
                    border:{
                        color:"#BCBCBC",
                        width:1
                    },
                    column:1,
                    align:"right",
                    valign:"center",
                    offsetx:0,
                    offsety:0
                },
                coordinate:{
                    width:"80%",
                    height:"84%",
                    background_color:"#ffffff",
                    axis:{
                        color:"#a5acb8",
                        width:[1,"",1,""]
                    },
                    grid_color:"#d9d9d9",
                    label:{
                        fontweight:500,
                        color:"#666666",
                        fontsize:11
                    }
                },
                label:{
                    fontweight:500,
                    color:"#666666",
                    fontsize:11
                },
                type:"pie2d",
                data:[
                    {
                        name:"错误",
                        value:<?php echo $xzerr; ?>,
                        color:"#4572a7"
                    },{
                        name:"正确",
                        value:<?php echo $xzright; ?>,
                        color:"#aa4643"
                    }
                ]
            });
            chart1.draw();
        });

        $(function(){
            var chart2 = iChart.create({
                render:"ichart-render3",
                width:170,
                height:170,
                background_color:"#fefefe",
                gradient:false,
                color_factor:0.2,
                border:{
                    color:"BCBCBC",
                    width:0
                },
                align:"center",
                offsetx:0,
                offsety:20,
                sub_option:{
                    border:{
                        color:"#BCBCBC",
                        width:0
                    },
                    label:{
                        fontweight:500,
                        fontsize:11,
                        color:"#4572a7",
                        sign:"",
                        sign_size:0,
                        border:{
                            color:"#BCBCBC",
                            width:1
                        },
                        background_color:"#ede6e6"
                    }
                },
                shadow:true,
                shadow_color:"#666666",
                shadow_blur:2,
                showpercent:false,
                column_width:"70%",
                bar_height:"70%",
                radius:"80%",
                title:{
                    text:"阅读",
                    color:"#111111",
                    fontsize:14,
                    font:"Arial",
                    textAlign:"center",
                    height:20,
                    offsetx:0,
                    offsety:0
                },
                subtitle:{
                    text:"",
                    color:"#111111",
                    fontsize:16,
                    font:"微软雅黑",
                    textAlign:"center",
                    height:20,
                    offsetx:0,
                    offsety:0
                },
                footnote:{
                    text:"",
                    color:"#111111",
                    fontsize:12,
                    font:"微软雅黑",
                    textAlign:"right",
                    height:20,
                    offsetx:0,
                    offsety:0
                },
                legend:{
                    enable:false,
                    background_color:"#fefefe",
                    color:"#333333",
                    fontsize:12,
                    border:{
                        color:"#BCBCBC",
                        width:1
                    },
                    column:1,
                    align:"right",
                    valign:"center",
                    offsetx:0,
                    offsety:0
                },
                coordinate:{
                    width:"80%",
                    height:"84%",
                    background_color:"#ffffff",
                    axis:{
                        color:"#a5acb8",
                        width:[1,"",1,""]
                    },
                    grid_color:"#d9d9d9",
                    label:{
                        fontweight:500,
                        color:"#666666",
                        fontsize:11
                    }
                },
                label:{
                    fontweight:500,
                    color:"#666666",
                    fontsize:11
                },
                type:"pie2d",
                data:[
                    {
                        name:"错误",
                        value:<?php echo $yderr; ?>,
                        color:"#4572a7"
                    },{
                        name:"正确",
                        value:<?php echo $ydright; ?>,
                        color:"#aa4643"
                    }
                ]
            });
            chart2.draw();
        });

        $(function(){
            var chart3 = iChart.create({
                render:"ichart-render4",
                width:170,
                height:170,
                background_color:"#fefefe",
                gradient:false,
                color_factor:0.2,
                border:{
                    color:"BCBCBC",
                    width:0
                },
                align:"center",
                offsetx:0,
                offsety:20,
                sub_option:{
                    border:{
                        color:"#BCBCBC",
                        width:0
                    },
                    label:{
                        fontweight:500,
                        fontsize:11,
                        color:"#4572a7",
                        sign:"",
                        sign_size:0,
                        border:{
                            color:"#BCBCBC",
                            width:1
                        },
                        background_color:"#ede6e6"
                    }
                },
                shadow:true,
                shadow_color:"#666666",
                shadow_blur:2,
                showpercent:false,
                column_width:"70%",
                bar_height:"70%",
                radius:"80%",
                title:{
                    text:"完形填空",
                    color:"#111111",
                    fontsize:14,
                    font:"Arial",
                    textAlign:"center",
                    height:20,
                    offsetx:0,
                    offsety:0
                },
                subtitle:{
                    text:"",
                    color:"#111111",
                    fontsize:16,
                    font:"微软雅黑",
                    textAlign:"center",
                    height:20,
                    offsetx:0,
                    offsety:0
                },
                footnote:{
                    text:"",
                    color:"#111111",
                    fontsize:12,
                    font:"微软雅黑",
                    textAlign:"right",
                    height:20,
                    offsetx:0,
                    offsety:0
                },
                legend:{
                    enable:false,
                    background_color:"#fefefe",
                    color:"#333333",
                    fontsize:12,
                    border:{
                        color:"#BCBCBC",
                        width:1
                    },
                    column:1,
                    align:"right",
                    valign:"center",
                    offsetx:0,
                    offsety:0
                },
                coordinate:{
                    width:"80%",
                    height:"84%",
                    background_color:"#ffffff",
                    axis:{
                        color:"#a5acb8",
                        width:[1,"",1,""]
                    },
                    grid_color:"#d9d9d9",
                    label:{
                        fontweight:500,
                        color:"#666666",
                        fontsize:11
                    }
                },
                label:{
                    fontweight:500,
                    color:"#666666",
                    fontsize:11
                },
                type:"pie2d",
                data:[
                    {
                        name:"错误",
                        value:<?php echo $wxerr; ?>,
                        color:"#4572a7"
                    },{
                        name:"正确",
                        value:<?php echo $wxright; ?>,
                        color:"#aa4643"
                    }
                ]
            });
            chart3.draw();
        });


    </script>
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
                            <li><a href="#"><i class="fa fa-home"></i> 主页 </a>
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
                <div class="row top_tiles">
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                            <div class="count"><?php echo $tnum; ?></div>
                            <h3>已完成的题数</h3>
                            <p>the problem you have finished</p>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-comments-o"></i></div>
                            <div class="count"><?php echo $colnum; ?></div>
                            <h3>已收藏题数</h3>
                            <p>the problem you have collected</p>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                            <div class="count"><?php echo $sumtimes; ?> 小时</div>
                            <h3>累计学习时间</h3>
                            <p>the sum of time that you have study on our platform</p>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-check-square-o"></i></div>
                            <div class="count">LEVEL <?php echo $level; ?></div>
                            <h3>用户等级</h3>
                            <p>The Level You Have Got</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>每周总结 <small>学习统计 </small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
                                    <div class="col-md-5" style="overflow:hidden;">
                                        <!--span class="sparkline_one" style="height: 160px; padding: 10px 25px;">
                                         <!-anvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px; id="myCanvas"></canvas-->
                                        <!--canvas id="myCanvas" width="200" height="100"></canvas-->
                                        <div id='ichart-render'></div>
                                        <!--/span-->
                                        <h4 style="margin:18px">每日学习时间统计/分钟</h4>
                                    </div>

                                    <div class="col-md-7">
                                        <div class="row" style="text-align: center;">
                                            <div class="col-md-4">
                                                <div id='ichart-render2'></div>
                                            </div>
                                            <div class="col-md-4">
                                                <div id='ichart-render3'></div>
                                            </div>
                                            <div class="col-md-4">
                                                <div id='ichart-render4'></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-4">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>每日单词 <small>组一</small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <?php if(is_array($voc1) || $voc1 instanceof \think\Collection || $voc1 instanceof \think\Paginator): $i = 0; $__LIST__ = $voc1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <article class="media event">
                                    <a class="pull-left date">
                                        <p class="month"><?php echo $curmonth; ?></p>
                                        <p class="day"><?php echo $curday; ?></p>
                                    </a>
                                    <div class="media-body">
                                        <a class="title" href="javascript:return false;"><?php echo $vo['vname']; ?></a>
                                        <p><?php echo $vo['explains']; ?></p>
                                    </div>
                                </article>
                                <?php endforeach; endif; else: echo "" ;endif; ?>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>每日单词 <small>组二</small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <?php if(is_array($voc2) || $voc2 instanceof \think\Collection || $voc2 instanceof \think\Paginator): $i = 0; $__LIST__ = $voc2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <article class="media event">
                                    <a class="pull-left date">
                                        <p class="month"><?php echo $curmonth; ?></p>
                                        <p class="day"><?php echo $curday; ?></p>
                                    </a>
                                    <div class="media-body">
                                        <a class="title" href="javascript:return false;"><?php echo $vo['vname']; ?></a>
                                        <p><?php echo $vo['explains']; ?></p>
                                    </div>
                                </article>
                                <?php endforeach; endif; else: echo "" ;endif; ?>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>每日单词<small>组三</small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <?php if(is_array($voc3) || $voc3 instanceof \think\Collection || $voc3 instanceof \think\Paginator): $i = 0; $__LIST__ = $voc3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <article class="media event">
                                    <a class="pull-left date">
                                        <p class="month"><?php echo $curmonth; ?></p>
                                        <p class="day"><?php echo $curday; ?></p>
                                    </a>
                                    <div class="media-body">
                                        <a class="title" href="javascript:return false;"><?php echo $vo['vname']; ?></a>
                                        <p><?php echo $vo['explains']; ?></p>
                                    </div>
                                </article>
                                <?php endforeach; endif; else: echo "" ;endif; ?>

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
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/a2bd7673/cloudflare-static/rocket-loader.min.js" data-cf-settings="8300bef2be837f24e6816e86-|49" defer=""></script></body>
</html>