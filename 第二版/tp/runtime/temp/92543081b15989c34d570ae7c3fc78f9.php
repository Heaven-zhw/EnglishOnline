<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"F:\php\WWW\tp5\tp\public/../application/admin/view/index/index.html";i:1558365450;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>管理员主页</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">

    <link href='http://fonts.useso.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="../../../.././vendor/admin/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../../.././vendor/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../.././vendor/admin/css/templatemo-style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<!-- Left column -->
<div class="templatemo-flex-row">
    <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
            <div class="square"></div>
            <h1 style="margin-top:10px;font-size: 1.6em"><?php echo $username; ?> 欢迎</h1>
        </header>
        <div class="profile-photo-container">
            <img src="../../../.././vendor/admin/images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">
            <div class="profile-photo-overlay"></div>
        </div>
        <!-- Search box -->
        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
        </div>
        <nav class="templatemo-left-nav">
            <ul>
                <li><a href="#" class="active"><i class="fa fa-home fa-fw"></i>主页</a></li>
                <li><a href="#" id="showhello" onclick="showhello()"><i class="fa fa-bar-chart fa-fw"></i>题源上传</a></li>
                <ul  class="nav child_menu" id="hello" style="display: none">
                    <li><a  href="http://127.0.0.1:8090/public/index.php/admin/index/adddx">单选题</a></li>
                    <li><a  href="http://127.0.0.1:8090/public/index.php/admin/index/addyd">阅读题</a></li>
                    <li><a  href="http://127.0.0.1:8090/public/index.php/admin/index/addwx">完型填空</a></li>
                </ul>
                <li><a href="http://127.0.0.1:8090/public/index.php/admin/index/userinfo?page=1"><i class="fa fa-database fa-fw"></i>用户管理</a></li>
            </ul>
        </nav>
    </div>
    <!-- Main content -->
    <div class="templatemo-content col-1 light-gray-bg" style="overflow: hidden">
        <div class="templatemo-top-nav-container" style="height: 40px">
        </div>
        <div class="templatemo-content-container" style="padding-bottom: 0px ">
            <div class="templatemo-flex-row flex-content-row">
                <div class="templatemo-content-widget white-bg col-2">
                    <i class="fa fa-times"></i>
                    <div class="square"></div>
                    <h2 class="templatemo-inline-block">系统介绍</h2><hr>
                    <br>
                    <p>该系统是为了解决在线学习过程中,缺少pc端英语在线做题的网站,为广大英语爱好者,高考学生等人群提供一个公开,免费学习的网站</p>
                    <br>
                    <p>本系统提供阅读题,完型填空,和单项选择题目的练习,后端使用thinkphp5搭建,前端使用bootstrap框架搭建,开源易用,欢迎使用者批评指正</p>
                </div>
                <div class="templatemo-content-widget white-bg col-1 text-center">
                    <i class="fa fa-times"></i>
                    <h2 class="text-uppercase">Mutual encouragement</h2>
                    <h3 class="text-uppercase margin-bottom-10">Science and Technology Change the World</h3>
                    <img src="../../../.././vendor/admin/images/bicycle.jpg" alt="Bicycle" class="img-circle img-thumbnail">
                </div>
                <div class="templatemo-content-widget white-bg col-1">
                    <i class="fa fa-times"></i>
                    <h2 class="text-uppercase">各类题型</h2>
                    <h3 class="text-uppercase">用户做题占比</h3><hr>
                    <div class="progress">
                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $dxp*100; ?>%;"></div>
                    </div>
                    <p>单选题</p>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style='width:<?php echo $ydp*100; ?>%;'></div>
                    </div>
                    <p>阅读题</p>
                    <div class="progress">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $wxp*100; ?>%;"></div>
                    </div>
                    <p>完型填空</p>
                </div>
            </div>
            <div class="templatemo-flex-row flex-content-row">
                <div class="col-1">
                    <div class="templatemo-content-widget orange-bg">
                        <i class="fa fa-times"></i>
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object img-circle" src="../../../.././vendor/admin/images/sunset.jpg" alt="Sunset">
                                </a>
                            </div>
                            <div class="media-body">
                                <h2 class="media-heading text-uppercase">用户a留言</h2>
                                <p>Phasellus dapibus nulla quis risus auctor, non placerat augue consectetur.</p>
                            </div>
                        </div>
                    </div>
                    <div class="templatemo-content-widget white-bg">
                        <i class="fa fa-times"></i>
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object img-circle" src="../../../.././vendor/admin/images/sunset.jpg" alt="Sunset">
                                </a>
                            </div>
                            <div class="media-body">
                                <h2 class="media-heading text-uppercase">用户b留言</h2>
                                <p>Phasellus dapibus nulla quis risus auctor, non placerat augue consectetur.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1">
                    <div class="panel panel-default templatemo-content-widget white-bg no-padding templatemo-overflow-hidden">
                        <i class="fa fa-times"></i>
                        <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">日活跃用户</h2></div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <td>No.</td>
                                    <td>User Name</td>
                                    <td>Number of submissions</td>
                                    <td>Learning Time/mins</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($userlist) || $userlist instanceof \think\Collection || $userlist instanceof \think\Paginator): $i = 0; $__LIST__ = $userlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?>
                                <tr>
                                    <td><?php echo $i; ?>.</td>
                                    <td><?php echo $user['username']; ?></td>
                                    <td><?php echo $user['tnum']; ?></td>
                                    <td><?php echo $user['times']; ?></td>
                                </tr>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- Second row ends -->
            <footer class="text-right" style="padding-bottom: 0px">
                <div class="templatemo-top-nav-container" style="padding:25px;height: 20px;margin-bottom: 0px">
                    <p>Copyright &copy; 2019 Company Name
                        | Bugless <a href="#"> 在线考试系统入口</a> </p>
                </div>
            </footer>
        </div>
    </div>
</div>

<!-- JS -->
<script src="../../../.././vendor/admin/js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
<script src="../../../.././vendor/admin/js/jquery-migrate-1.2.1.min.js"></script> <!--  jQuery Migrate Plugin -->
<script src="https://www.google.com/jsapi"></script> <!-- Google Chart -->
<script>
    /* Google Chart
    -------------------------------------------------------------------*/
    // Load the Visualization API and the piechart package.
    google.load('visualization', '1.0', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
            ['Mushrooms', 3],
            ['Onions', 1],
            ['Olives', 1],
            ['Zucchini', 1],
            ['Pepperoni', 2]
        ]);

        // Set chart options
        var options = {'title':'How Much Pizza I Ate Last Night'};

        // Instantiate and draw our chart, passing in some options.
        var pieChart = new google.visualization.PieChart(document.getElementById('pie_chart_div'));
        pieChart.draw(data, options);

        var barChart = new google.visualization.BarChart(document.getElementById('bar_chart_div'));
        barChart.draw(data, options);
    }

    $(document).ready(function(){
        if($.browser.mozilla) {
            //refresh page on browser resize
            // http://www.sitepoint.com/jquery-refresh-page-browser-resize/
            $(window).bind('resize', function(e)
            {
                if (window.RT) clearTimeout(window.RT);
                window.RT = setTimeout(function()
                {
                    this.location.reload(false); /* false to get page from cache */
                }, 200);
            });
        } else {
            $(window).resize(function(){
                drawChart();
            });
        }
    });
    function showhello() {
        if($("#hello").css("display")== 'none'){
            $("#hello").fadeIn("slow");
        }else{
            $("#hello").css("display",'none');
        }

    }
</script>
<script type="text/javascript" src="../../../.././vendor/./admin/js/templatemo-script.js"></script>      <!-- Templatemo Script -->

</body>
</html>