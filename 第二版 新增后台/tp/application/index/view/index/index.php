
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
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
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
                        value:{$studytime[1]},
                        color:"#4572a7"
                    },
                    {
                        name:"周二",
                        value:{$studytime[2]},
                        color:"#4572a7"
                    },
                    {
                        name:"周三",
                        value:{$studytime[3]},
                        color:"#4572a7"
                    },
                    {
                        name:"周四",
                        value:{$studytime[4]},
                        color:"#4572a7"
                    },
                    {
                        name:"周五",
                        value:{$studytime[5]},
                        color:"#4572a7"
                    },
                    {
                        name:"周六",
                        value:{$studytime[6]},
                        color:"#4572a7"
                    },
                    {
                        name:"周日",
                        value:{$studytime[7]},
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
                        name:"错误数",
                        value:{$xzerr},
                        color:"#4572a7"
                    },{
                        name:"正确数",
                        value:{$xzright},
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
                        name:"错误数",
                        value:{$yderr},
                        color:"#4572a7"
                    },{
                        name:"正确数",
                        value:{$ydright},
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
                        name:"错误数",
                        value:{$wxerr},
                        color:"#4572a7"
                    },{
                        name:"正确数",
                        value:{$wxright},
                        color:"#aa4643"
                    }
                ]
            });
            chart3.draw();
        });


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
                        <img src="./picture/timg.jpg" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>欢迎您</span>
                        <h2>{$username}</h2>
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
                                    {volist name="dxlist" id="dx" }
                                    <li><a  href="http:127.0.0.1:8090/index.php/index/index/test/?id={$i}&&type=1"></a>{$dx}</li>
                                    {/volist}
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
                                    {volist name="ydlist" id="yd" }
                                    <li><a  href="http:127.0.0.1:8090/index.php/index/index/test/?id={$i}&&type=2"></a>{$yd}</li>
                                    {/volist}
                                </ul>
                            </li>
                            <li><a><i class="fa fa-edit"></i> 完型填空 <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    {volist name="wxlist" id="wx" }
                                    <li><a  href="http:127.0.0.1:8090/index.php/index/index/test/?id={$i}&&type=3"></a>{$wx}</li>
                                    {/volist}
                                </ul>
                            </li>
                            <li><a href="http:127.0.0.1:8090/index.php/index/collocation/collshow"><i class="fa fa-bar-chart-o"></i> 收藏夹 </a>
                            </li>
                            <!--li><a><i class="fa fa-clone"></i>保留 <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                                    <li><a href="fixed_footer.html">Fixed Footer</a></li>
                                </ul>
                            </li-->
                            <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> 用户管理 <span class="label label-success pull-right">Coming Soon</span></a></li>
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
                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="#">
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
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="images/img.jpg" alt=""><span>{$username}</span>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li>
                                    <a href="javascript:;">
                                        <span>用户信息</span>
                                    </a>
                                </li>
                                <li><a href="javascript:;">帮助</a></li>
                                <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i>退出</a></li>
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
                            <div class="count">{$tnum}</div>
                            <h3>已完成的题数</h3>
                            <p>the problem you have finished</p>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-comments-o"></i></div>
                            <div class="count">{$colnum}</div>
                            <h3>已收藏题数</h3>
                            <p>the problem you have collected</p>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                            <div class="count">{$sumtimes} 小时</div>
                            <h3>累计学习时间</h3>
                            <p>the sum of time that you have study on our platform</p>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-check-square-o"></i></div>
                            <div class="count">LEVEL {$level}</div>
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
                                    <div class="col-md-6" style="overflow:hidden;">
                                        <!--span class="sparkline_one" style="height: 160px; padding: 10px 25px;">
                                         <!-anvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px; id="myCanvas"></canvas-->
                                        <!--canvas id="myCanvas" width="200" height="100"></canvas-->
                                        <div id='ichart-render'></div>
                                        <!--/span-->
                                        <h4 style="margin:18px">每日学习时间统计/分钟</h4>
                                    </div>

                                    <div class="col-md-5">
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
                                {volist name="voc1" id="vo" }
                                <article class="media event">
                                    <a class="pull-left date">
                                        <p class="month">{$curmonth}</p>
                                        <p class="day">{$curday}</p>
                                    </a>
                                    <div class="media-body">
                                        <a class="title" href="#">{}</a>
                                        <p></p>
                                    </div>
                                </article>
                                <article class="media event">
                                    <a class="pull-left date">
                                        <p class="month">April</p>
                                        <p class="day">23</p>
                                    </a>
                                    <div class="media-body">
                                        <a class="title" href="#">Item Two Title</a>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </article>
                                <article class="media event">
                                    <a class="pull-left date">
                                        <p class="month">April</p>
                                        <p class="day">23</p>
                                    </a>
                                    <div class="media-body">
                                        <a class="title" href="#">Item Two Title</a>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </article>
                                <article class="media event">
                                    <a class="pull-left date">
                                        <p class="month">April</p>
                                        <p class="day">23</p>
                                    </a>
                                    <div class="media-body">
                                        <a class="title" href="#">Item Two Title</a>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </article>
                                <article class="media event">
                                    <a class="pull-left date">
                                        <p class="month">April</p>
                                        <p class="day">23</p>
                                    </a>
                                    <div class="media-body">
                                        <a class="title" href="#">Item Three Title</a>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </article>
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
                                <article class="media event">
                                    <a class="pull-left date">
                                        <p class="month">April</p>
                                        <p class="day">23</p>
                                    </a>
                                    <div class="media-body">
                                        <a class="title" href="#">Item One Title</a>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </article>
                                <article class="media event">
                                    <a class="pull-left date">
                                        <p class="month">April</p>
                                        <p class="day">23</p>
                                    </a>
                                    <div class="media-body">
                                        <a class="title" href="#">Item Two Title</a>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </article>
                                <article class="media event">
                                    <a class="pull-left date">
                                        <p class="month">April</p>
                                        <p class="day">23</p>
                                    </a>
                                    <div class="media-body">
                                        <a class="title" href="#">Item Two Title</a>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </article>
                                <article class="media event">
                                    <a class="pull-left date">
                                        <p class="month">April</p>
                                        <p class="day">23</p>
                                    </a>
                                    <div class="media-body">
                                        <a class="title" href="#">Item Two Title</a>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </article>
                                <article class="media event">
                                    <a class="pull-left date">
                                        <p class="month">April</p>
                                        <p class="day">23</p>
                                    </a>
                                    <div class="media-body">
                                        <a class="title" href="#">Item Three Title</a>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </article>
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
                                <article class="media event">
                                    <a class="pull-left date">
                                        <p class="month">April</p>
                                        <p class="day">23</p>
                                    </a>
                                    <div class="media-body">
                                        <a class="title" href="#">Item One Title</a>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </article>
                                <article class="media event">
                                    <a class="pull-left date">
                                        <p class="month">April</p>
                                        <p class="day">23</p>
                                    </a>
                                    <div class="media-body">
                                        <a class="title" href="#">Item Two Title</a>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </article>
                                <article class="media event">
                                    <a class="pull-left date">
                                        <p class="month">April</p>
                                        <p class="day">23</p>
                                    </a>
                                    <div class="media-body">
                                        <a class="title" href="#">Item Two Title</a>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </article>
                                <article class="media event">
                                    <a class="pull-left date">
                                        <p class="month">April</p>
                                        <p class="day">23</p>
                                    </a>
                                    <div class="media-body">
                                        <a class="title" href="#">Item Two Title</a>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </article>
                                <article class="media event">
                                    <a class="pull-left date">
                                        <p class="month">April</p>
                                        <p class="day">23</p>
                                    </a>
                                    <div class="media-body">
                                        <a class="title" href="#">Item Three Title</a>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

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
<script src="../vendors/jquery/dist/jquery.min.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<!-- Chart.js -->
<script src="../vendors/Chart.js/dist/Chart.min.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<!-- jQuery Sparklines -->
<script src="../vendors/jquery-sparkline/dist/jquery.sparkline.min.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<!-- Flot -->
<script src="../vendors/Flot/jquery.flot.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<script src="../vendors/Flot/jquery.flot.pie.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<script src="../vendors/Flot/jquery.flot.time.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<script src="../vendors/Flot/jquery.flot.stack.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<script src="../vendors/Flot/jquery.flot.resize.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<!-- Flot plugins -->
<script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<script src="../vendors/flot-spline/js/jquery.flot.spline.min.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<script src="../vendors/flot.curvedlines/curvedLines.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<!-- DateJS -->
<script src="../vendors/DateJS/build/date.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<!-- bootstrap-daterangepicker -->
<script src="../vendors/moment/min/moment.min.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js" type="8300bef2be837f24e6816e86-text/javascript"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
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