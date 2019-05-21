<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"F:\php\WWW\tp5\tp\public/../application/admin/view/userinfo/userinfo.html";i:1558402751;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>用户管理</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">

    <link href='http://fonts.useso.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="../../../.././vendor/admin/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../../.././vendor/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../.././vendor/admin/css/templatemo-style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="../../../.././vendor/vendors/bootstrap/dist/js/bootstrap.min.js" type="8300bef2be837f24e6816e86-text/javascript"></script>
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
                <li><a href="http://127.0.0.1:8090/public/index.php/admin/index/indexs" ><i class="fa fa-bar-chart fa-fw"></i>主页</a></li>
                <li><a href="#" id="showhello" onclick="showhello()"><i class="fa fa-bar-chart fa-fw"></i>题源上传</a></li>
                <ul  class="nav child_menu" id="hello" style="display: none">
                    <li><a  href="http://127.0.0.1:8090/public/index.php/admin/index/adddx">单选题</a></li>
                    <li><a  href="http://127.0.0.1:8090/public/index.php/admin/index/addyd">阅读题</a></li>
                    <li><a  href="http://127.0.0.1:8090/public/index.php/admin/index/addwx">完型填空</a></li>
                </ul>
                <li><a href="#" class="active"><i class="fa fa-database fa-fw"></i>用户管理</a></li>
            </ul>
        </nav>
    </div>
    <!-- Main content -->
    <div class="templatemo-content col-1 light-gray-bg" style="overflow: hidden">
        <div class="templatemo-top-nav-container" style="height: 40px">
        </div>
        <div class="templatemo-content-container" style="padding-bottom: 0px">
            <div class="templatemo-content-widget no-padding">
                <div class="panel panel-default table-responsive">
                    <table class="table table-striped table-bordered templatemo-user-table">
                        <thead>
                        <tr>
                            <td><a href="#" class="white-text templatemo-sort-by"># <span class="caret"></span></a></td>
                            <td><a href="#" class="white-text templatemo-sort-by">Username Name <span class="caret"></span></a></td>
                            <td><a href="#" class="white-text templatemo-sort-by">email <span class="caret"></span></a></td>
                            <td><a href="#" class="white-text templatemo-sort-by">phone <span class="caret"></span></a></td>
                            <td><a href="#" class="white-text templatemo-sort-by">school <span class="caret"></span></a></td>
                            <td>Delete</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($userlist) || $userlist instanceof \think\Collection || $userlist instanceof \think\Paginator): $i = 0; $__LIST__ = $userlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?>
                        <tr >
                            <td><?php echo $i; ?>.</td>
                            <td id="<?php echo $i; ?>u" uid="<?php echo $user['username']; ?>"><?php echo $user['username']; ?></td>
                            <td id="<?php echo $i; ?>email"><?php echo $user['email']; ?></td>
                            <td id="<?php echo $i; ?>phone"><?php echo $user['phone']; ?></td>
                            <td id="<?php echo $i; ?>school"><?php echo $user['school']; ?></td>
                            <td><form action="http://127.0.0.1:8090/public/index.php/admin/index/deleteuser" method="post">
                                <input type="hidden" value="<?php echo $user['username']; ?>" name="username">
                                <button type="submit" class="templatemo-edit-btn">Delete</button>
                            </form>
                            </td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="templatemo-flex-row flex-content-row">
                <div class="col-2">
                    <div class="panel panel-default margin-10">
                        <div class="panel-heading"><h2 class="text-uppercase">管理员注册</h2></div>
                        <div class="panel-body" style="padding:40px">
                            <form action="http://127.0.0.1:8090/public/index.php/admin/index/createadmin" class="templatemo-login-form" method="post">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                                </div>
                                <div class="form-group">
                                    <div class="checkbox squaredTwo">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="templatemo-blue-button">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="templatemo-content-widget white-bg col-1">
                    <i class="fa fa-times"></i>
                    <div class="media margin-bottom-30">
                        <div class="media-left padding-right-25">
                            <a href="#">
                                <img class="media-object img-circle templatemo-img-bordered" src="../../../.././vendor/admin/images/person.jpg" alt="Sunset">
                            </a>
                        </div>
                        <div class="media-body">
                            <h2 class="media-heading text-uppercase blue-text">Bugless 小组</h2>
                            <p>Project Manager</p>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td><div class="circle green-bg"></div></td>
                                <td>张翰文</td>
                                <td>爬虫,数据库</td>
                            </tr>
                            <tr>
                                <td><div class="circle pink-bg"></div></td>
                                <td>林军任</td>
                                <td>后端</td>
                            </tr>
                            <tr>
                                <td><div class="circle blue-bg"></div></td>
                                <td>张嘉宁</td>
                                <td>前端</td>
                            </tr>
                            <tr>
                                <td><div class="circle yellow-bg"></div></td>
                                <td>曹宇哲</td>
                                <td>前端</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="templatemo-content-widget white-bg col-1 templatemo-position-relative templatemo-content-img-bg">
                    <img src="../../../.././vendor/admin/images/sunset-big.jpg" alt="Sunset" class="img-responsive content-bg-img">
                    <i class="fa fa-heart"></i>
                    <h2 class="templatemo-position-relative white-text">Sunset</h2>
                    <div class="view-img-btn-wrap">
                        <a href="" class="btn btn-default templatemo-view-img-btn">View</a>
                    </div>
                </div>
                <!--div class="templatemo-content-widget white-bg col-1">
                    <i class="fa fa-times"></i>
                    <h2 class="text-uppercase">当前管理员上传题目数</h2>
                    <h3 class="text-uppercase">类型占比</h3><hr>
                    <div class="progress">
                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                    </div>
                    <p>单选题</p>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                    </div>
                    <p>阅读题</p>
                    <div class="progress">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                    </div>
                    <p>完型填空</p>
                </div>
            </div> <Second row ends -->
            </div>

            <div class="pagination-wrap">
                <ul class="pagination">
                    <?php if(is_array($usernumlist) || $usernumlist instanceof \think\Collection || $usernumlist instanceof \think\Paginator): $i = 0; $__LIST__ = $usernumlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$num): $mod = ($i % 2 );++$i;?>
                    <li><a href="http://127.0.0.1:8090/public/index.php/index/index/userinfo?page=<?php echo $num['k']; ?>"><?php echo $num['k']; ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
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
    $(function () { $("[data-toggle='tooltip']").tooltip(); });
</script>
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
    function deleteuser(ids){
        var strs=ids+"u";
        var usernames=$("#"+strs).text();
       /* $.ajax({
            type: 'post', // 提交方式 get/post
            url: 'http://127.0.0.1:8090/public/index.php/admin/index/deleteuser', // 需要提交的 url
            data:{
                'username':usernames
            }
            , success : function(data){
                alter("更新成功");
            },
            error : function(XMLHttpRequest, textStatus, errorThrown) {
                alert("失败!");
            }
        });*/
    }
</script>
<script type="text/javascript" src="../../../.././vendor/admin/js/templatemo-script.js"></script>      <!-- Templatemo Script -->

</body>
</html>