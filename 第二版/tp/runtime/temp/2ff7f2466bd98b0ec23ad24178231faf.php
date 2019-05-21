<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"F:\php\WWW\tp5\tp\public/../application/admin/view/additem/addwx.html";i:1558360499;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>添加完型填空</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">

    <link href='http://fonts.useso.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="../../../.././vendor/admin/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../../.././vendor/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../.././vendor/admin/css/templatemo-style.css" rel="stylesheet">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
            <h1 style="margin-top:10px;font-size: 1.6em">管理员 欢迎</h1>
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
                <li><a href="http://127.0.0.1:8090/public/index.php/admin/index/indexs" class="active"><i class="fa fa-home fa-fw"></i>主页</a></li>
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
    <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container" style="height: 40px">
        </div>
        <div class="templatemo-content-container" style="padding-bottom: 0px;padding-top:0px">
            <div class="templatemo-flex-row flex-content-row">
                <div class="col-1">
                    <div class="panel panel-default margin-10">
                        <div class="panel-heading"><h2 class="text-uppercase">完型填空上传</h2></div>
                        <div class="panel-body" style="padding:40px">
                            <form action="http://127.0.0.1:8090/public/index.php/admin/index/add?typeid=3" class="templatemo-login-form" method="post">
                                <label>文章</label>
                                <div class="form-group">
                                    <textarea name="text" class="form-control" rows="4"></textarea>
                                </div>
                                <div >
                                    <label>题目1</label>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label >选项A</label>
                                            <input type="text" class="form-control"  name="choicea1" placeholder="">
                                            <label >选项B</label>
                                            <input type="text" class="form-control"  name="choiceb1" placeholder="">
                                            <label >选项C</label>
                                            <input type="text" class="form-control"  name="choicec1" placeholder="">
                                            <label>选项D</label>
                                            <input type="text" class="form-control"  name="choiced1" placeholder="" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label >答案</label>
                                        <div class="col-lg-12 form-group">
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio1" id="r1" value="A">
                                                <label for="r1" class="font-weight-400"><span></span>A</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio1" id="r2" value="B" checked="">
                                                <label for="r2" class="font-weight-400"><span></span>B</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio1" id="r3" value="C">
                                                <label for="r3" class="font-weight-400"><span></span>C</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio1" id="r4" value="D">
                                                <label for="r4" class="font-weight-400"><span></span>D</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label >解析</label>
                                        <textarea name="analysis1" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox squaredTwo">
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div >
                                    <label>题目2</label>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label >选项A</label>
                                            <input type="text" class="form-control"  name="choicea2" placeholder="">
                                            <label >选项B</label>
                                            <input type="text" class="form-control"  name="choiceb2" placeholder="">
                                            <label >选项C</label>
                                            <input type="text" class="form-control"  name="choicec2" placeholder="">
                                            <label>选项D</label>
                                            <input type="text" class="form-control"  name="choiced2" placeholder="" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label >答案</label>
                                        <div class="col-lg-12 form-group">
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio2" id="ra1" value="A">
                                                <label for="ra1" class="font-weight-400"><span></span>A</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio2" id="ra2" value="B" >
                                                <label for="ra2" class="font-weight-400"><span></span>B</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio2" id="ra3" value="C">
                                                <label for="ra3" class="font-weight-400"><span></span>C</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio2" id="ra4" value="D">
                                                <label for="ra4" class="font-weight-400"><span></span>D</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label >解析</label>
                                        <textarea name="analysis2" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox squaredTwo">
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div >
                                    <label>题目3</label>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label >选项A</label>
                                            <input type="text" class="form-control"  name="choicea3" placeholder="">
                                            <label >选项B</label>
                                            <input type="text" class="form-control"  name="choiceb3" placeholder="">
                                            <label >选项C</label>
                                            <input type="text" class="form-control"  name="choicec3" placeholder="">
                                            <label>选项D</label>
                                            <input type="text" class="form-control"  name="choiced3" placeholder="" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label >答案</label>
                                        <div class="col-lg-12 form-group">
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio3" id="rc1" value="A">
                                                <label for="rc1" class="font-weight-400"><span></span>A</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio3" id="rc2" value="B" checked="">
                                                <label for="rc2" class="font-weight-400"><span></span>B</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio3" id="rc3" value="C">
                                                <label for="rc3" class="font-weight-400"><span></span>C</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio3" id="rc4" value="D">
                                                <label for="rc4" class="font-weight-400"><span></span>D</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label >解析</label>
                                        <textarea name="analysis3" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox squaredTwo">
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div >
                                    <label>题目4</label>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label >选项A</label>
                                            <input type="text" class="form-control"  name="choicea4" placeholder="">
                                            <label >选项B</label>
                                            <input type="text" class="form-control"  name="choiceb4" placeholder="">
                                            <label >选项C</label>
                                            <input type="text" class="form-control"  name="choicec4" placeholder="">
                                            <label>选项D</label>
                                            <input type="text" class="form-control"  name="choiced4" placeholder="" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label >答案</label>
                                        <div class="col-lg-12 form-group">
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio4" id="rd1" value="A">
                                                <label for="rd1" class="font-weight-400"><span></span>A</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio4" id="rd2" value="B" checked="">
                                                <label for="rd2" class="font-weight-400"><span></span>B</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio4" id="rd3" value="C">
                                                <label for="rd3" class="font-weight-400"><span></span>C</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio4" id="rd4" value="D">
                                                <label for="rd4" class="font-weight-400"><span></span>D</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label >解析</label>
                                        <textarea name="analysis4" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox squaredTwo">
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div >
                                    <label>题目5</label>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label >选项A</label>
                                            <input type="text" class="form-control"  name="choicea5" placeholder="">
                                            <label >选项B</label>
                                            <input type="text" class="form-control"  name="choiceb5" placeholder="">
                                            <label >选项C</label>
                                            <input type="text" class="form-control"  name="choicec5" placeholder="">
                                            <label>选项D</label>
                                            <input type="text" class="form-control"  name="choiced5" placeholder="" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label >答案</label>
                                        <div class="col-lg-12 form-group">
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio5" id="re1" value="A">
                                                <label for="re1" class="font-weight-400"><span></span>A</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio5" id="re2" value="B" checked="">
                                                <label for="re2" class="font-weight-400"><span></span>B</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio5" id="re3" value="C">
                                                <label for="re3" class="font-weight-400"><span></span>C</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio5" id="re4" value="D">
                                                <label for="re4" class="font-weight-400"><span></span>D</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label >解析</label>
                                        <textarea name="analysis5" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox squaredTwo">
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div >
                                    <label>题目6</label>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label >选项A</label>
                                            <input type="text" class="form-control"  name="choicea6" placeholder="">
                                            <label >选项B</label>
                                            <input type="text" class="form-control"  name="choiceb6" placeholder="">
                                            <label >选项C</label>
                                            <input type="text" class="form-control"  name="choicec6" placeholder="">
                                            <label>选项D</label>
                                            <input type="text" class="form-control"  name="choiced6" placeholder="" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label >答案</label>
                                        <div class="col-lg-12 form-group">
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio6" id="rf1" value="A">
                                                <label for="rf1" class="font-weight-400"><span></span>A</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio6" id="rf2" value="B" checked="">
                                                <label for="rf2" class="font-weight-400"><span></span>B</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio6" id="rf3" value="C">
                                                <label for="rf3" class="font-weight-400"><span></span>C</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio6" id="rf4" value="D">
                                                <label for="rf4" class="font-weight-400"><span></span>D</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label >解析</label>
                                        <textarea name="analysis6" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox squaredTwo">
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div >
                                    <label>题目7</label>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label >选项A</label>
                                            <input type="text" class="form-control"  name="choicea7" placeholder="">
                                            <label >选项B</label>
                                            <input type="text" class="form-control"  name="choiceb7" placeholder="">
                                            <label >选项C</label>
                                            <input type="text" class="form-control"  name="choicec7" placeholder="">
                                            <label>选项D</label>
                                            <input type="text" class="form-control"  name="choiced7" placeholder="" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label >答案</label>
                                        <div class="col-lg-12 form-group">
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio7" id="rg1" value="A">
                                                <label for="rg1" class="font-weight-400"><span></span>A</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio7" id="rg2" value="B" checked="">
                                                <label for="rg2" class="font-weight-400"><span></span>B</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio7" id="rg3" value="C">
                                                <label for="rg3" class="font-weight-400"><span></span>C</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio7" id="rg4" value="D">
                                                <label for="rg4" class="font-weight-400"><span></span>D</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label >解析</label>
                                        <textarea name="analysis7" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox squaredTwo">
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div >
                                    <label>题目8</label>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label >选项A</label>
                                            <input type="text" class="form-control"  name="choicea8" placeholder="">
                                            <label >选项B</label>
                                            <input type="text" class="form-control"  name="choiceb8" placeholder="">
                                            <label >选项C</label>
                                            <input type="text" class="form-control"  name="choicec8" placeholder="">
                                            <label>选项D</label>
                                            <input type="text" class="form-control"  name="choiced8" placeholder="" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label >答案</label>
                                        <div class="col-lg-12 form-group">
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio8" id="rh1" value="A">
                                                <label for="rh1" class="font-weight-400"><span></span>A</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio8" id="rh2" value="B" checked="">
                                                <label for="rh2" class="font-weight-400"><span></span>B</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio8" id="rh3" value="C">
                                                <label for="rh3" class="font-weight-400"><span></span>C</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio8" id="rh4" value="D">
                                                <label for="rh4" class="font-weight-400"><span></span>D</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label >解析</label>
                                        <textarea name="analysis8" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox squaredTwo">
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div >
                                    <label>题目9</label>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label >选项A</label>
                                            <input type="text" class="form-control"  name="choicea9" placeholder="">
                                            <label >选项B</label>
                                            <input type="text" class="form-control"  name="choiceb9" placeholder="">
                                            <label >选项C</label>
                                            <input type="text" class="form-control"  name="choicec9" placeholder="">
                                            <label>选项D</label>
                                            <input type="text" class="form-control"  name="choiced9" placeholder="" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label >答案</label>
                                        <div class="col-lg-12 form-group">
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio9" id="rj1" value="A">
                                                <label for="rj1" class="font-weight-400"><span></span>A</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio9" id="rj2" value="B" checked="">
                                                <label for="rj2" class="font-weight-400"><span></span>B</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio9" id="rj3" value="C">
                                                <label for="rj3" class="font-weight-400"><span></span>C</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio9" id="rj4" value="D">
                                                <label for="rj4" class="font-weight-400"><span></span>D</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label >解析</label>
                                        <textarea name="analysis9" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox squaredTwo">
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div >
                                    <label>题目10</label>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label >选项A</label>
                                            <input type="text" class="form-control"  name="choicea10" placeholder="">
                                            <label >选项B</label>
                                            <input type="text" class="form-control"  name="choiceb10" placeholder="">
                                            <label >选项C</label>
                                            <input type="text" class="form-control"  name="choicec10" placeholder="">
                                            <label>选项D</label>
                                            <input type="text" class="form-control"  name="choiced10" placeholder="" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label >答案</label>
                                        <div class="col-lg-12 form-group">
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio10" id="rk1" value="A">
                                                <label for="rk1" class="font-weight-400"><span></span>A</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio10" id="rk2" value="B" checked="">
                                                <label for="rk2" class="font-weight-400"><span></span>B</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio10" id="rk3" value="C">
                                                <label for="rk3" class="font-weight-400"><span></span>C</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio10" id="rk4" value="D">
                                                <label for="rk4" class="font-weight-400"><span></span>D</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label >解析</label>
                                        <textarea name="analysis10" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox squaredTwo">
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div >
                                    <label>题目11</label>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label >选项A</label>
                                            <input type="text" class="form-control"  name="choicea11" placeholder="">
                                            <label >选项B</label>
                                            <input type="text" class="form-control"  name="choiceb11" placeholder="">
                                            <label >选项C</label>
                                            <input type="text" class="form-control"  name="choicec11" placeholder="">
                                            <label>选项D</label>
                                            <input type="text" class="form-control"  name="choiced11" placeholder="" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label >答案</label>
                                        <div class="col-lg-12 form-group">
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio11" id="rl1" value="A">
                                                <label for="rl1" class="font-weight-400"><span></span>A</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio11" id="rl2" value="B" checked="">
                                                <label for="rl2" class="font-weight-400"><span></span>B</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio11" id="rl3" value="C">
                                                <label for="rl3" class="font-weight-400"><span></span>C</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio11" id="rl4" value="D">
                                                <label for="rl4" class="font-weight-400"><span></span>D</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label >解析</label>
                                        <textarea name="analysis11" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox squaredTwo">
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div >
                                    <label>题目12</label>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label >选项A</label>
                                            <input type="text" class="form-control"  name="choicea12" placeholder="">
                                            <label >选项B</label>
                                            <input type="text" class="form-control"  name="choiceb12" placeholder="">
                                            <label >选项C</label>
                                            <input type="text" class="form-control"  name="choicec12" placeholder="">
                                            <label>选项D</label>
                                            <input type="text" class="form-control"  name="choiced12" placeholder="" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label >答案</label>
                                        <div class="col-lg-12 form-group">
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio12" id="raa1" value="A">
                                                <label for="raa1" class="font-weight-400"><span></span>A</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio12" id="raa2" value="B" checked="">
                                                <label for="raa2" class="font-weight-400"><span></span>B</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio12" id="raa3" value="C">
                                                <label for="raa3" class="font-weight-400"><span></span>C</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio12" id="raa4" value="D">
                                                <label for="raa4" class="font-weight-400"><span></span>D</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label >解析</label>
                                        <textarea name="analysis12" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox squaredTwo">
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div >
                                    <label>题目13</label>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label >选项A</label>
                                            <input type="text" class="form-control"  name="choicea13" placeholder="">
                                            <label >选项B</label>
                                            <input type="text" class="form-control"  name="choiceb13" placeholder="">
                                            <label >选项C</label>
                                            <input type="text" class="form-control"  name="choicec13" placeholder="">
                                            <label>选项D</label>
                                            <input type="text" class="form-control"  name="choiced13" placeholder="" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label >答案</label>
                                        <div class="col-lg-12 form-group">
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio13" id="rcc1" value="A">
                                                <label for="rcc1" class="font-weight-400"><span></span>A</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio13" id="rcc2" value="B" checked="">
                                                <label for="rcc2" class="font-weight-400"><span></span>B</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio13" id="rcc3" value="C">
                                                <label for="rcc3" class="font-weight-400"><span></span>C</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio13" id="rcc4" value="D">
                                                <label for="rcc4" class="font-weight-400"><span></span>D</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label >解析</label>
                                        <textarea name="analysis13" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox squaredTwo">
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div >
                                    <label>题目14</label>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label >选项A</label>
                                            <input type="text" class="form-control"  name="choicea14" placeholder="">
                                            <label >选项B</label>
                                            <input type="text" class="form-control"  name="choiceb14" placeholder="">
                                            <label >选项C</label>
                                            <input type="text" class="form-control"  name="choicec14" placeholder="">
                                            <label>选项D</label>
                                            <input type="text" class="form-control"  name="choiced14" placeholder="" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label >答案</label>
                                        <div class="col-lg-12 form-group">
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio14" id="rdd1" value="A">
                                                <label for="rdd1" class="font-weight-400"><span></span>A</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio14" id="rdd2" value="B" >
                                                <label for="rdd2" class="font-weight-400"><span></span>B</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio14" id="rdd3" value="C">
                                                <label for="rdd3" class="font-weight-400"><span></span>C</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio14" id="rdd4" value="D">
                                                <label for="rdd4" class="font-weight-400"><span></span>D</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label >解析</label>
                                        <textarea name="analysis14" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox squaredTwo">
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div >
                                    <label>题目15</label>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label >选项A</label>
                                            <input type="text" class="form-control"  name="choicea15" placeholder="">
                                            <label >选项B</label>
                                            <input type="text" class="form-control"  name="choiceb15" placeholder="">
                                            <label >选项C</label>
                                            <input type="text" class="form-control"  name="choicec15" placeholder="">
                                            <label>选项D</label>
                                            <input type="text" class="form-control"  name="choiced15" placeholder="" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label >答案</label>
                                        <div class="col-lg-12 form-group">
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio15" id="ree1" value="A">
                                                <label for="ree1" class="font-weight-400"><span></span>A</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio15" id="ree2" value="B" checked="">
                                                <label for="ree2" class="font-weight-400"><span></span>B</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio15" id="ree3" value="C">
                                                <label for="ree3" class="font-weight-400"><span></span>C</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio15" id="ree4" value="D">
                                                <label for="ree4" class="font-weight-400"><span></span>D</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label >解析</label>
                                        <textarea name="analysis15" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox squaredTwo">
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div >
                                    <label>题目16</label>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label >选项A</label>
                                            <input type="text" class="form-control"  name="choicea16" placeholder="">
                                            <label >选项B</label>
                                            <input type="text" class="form-control"  name="choiceb16" placeholder="">
                                            <label >选项C</label>
                                            <input type="text" class="form-control"  name="choicec16" placeholder="">
                                            <label>选项D</label>
                                            <input type="text" class="form-control"  name="choiced16" placeholder="" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label >答案</label>
                                        <div class="col-lg-12 form-group">
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio16" id="rff1" value="A">
                                                <label for="rff1" class="font-weight-400"><span></span>A</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio16" id="rff2" value="B" checked="">
                                                <label for="rff2" class="font-weight-400"><span></span>B</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio16" id="rff3" value="C">
                                                <label for="rff3" class="font-weight-400"><span></span>C</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio16" id="rff4" value="D">
                                                <label for="rff4" class="font-weight-400"><span></span>D</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label >解析</label>
                                        <textarea name="analysis16" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox squaredTwo">
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div >
                                    <label>题目17</label>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label >选项A</label>
                                            <input type="text" class="form-control"  name="choicea17" placeholder="">
                                            <label >选项B</label>
                                            <input type="text" class="form-control"  name="choiceb17" placeholder="">
                                            <label >选项C</label>
                                            <input type="text" class="form-control"  name="choicec17" placeholder="">
                                            <label>选项D</label>
                                            <input type="text" class="form-control"  name="choiced17" placeholder="" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label >答案</label>
                                        <div class="col-lg-12 form-group">
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio17" id="rgg1" value="A">
                                                <label for="rgg1" class="font-weight-400"><span></span>A</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio17" id="rgg2" value="B" checked="">
                                                <label for="rgg2" class="font-weight-400"><span></span>B</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio17" id="rgg3" value="C">
                                                <label for="rgg3" class="font-weight-400"><span></span>C</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio17" id="rgg4" value="D">
                                                <label for="rgg4" class="font-weight-400"><span></span>D</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label >解析</label>
                                        <textarea name="analysis17" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox squaredTwo">
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div >
                                    <label>题目18</label>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label >选项A</label>
                                            <input type="text" class="form-control"  name="choicea18" placeholder="">
                                            <label >选项B</label>
                                            <input type="text" class="form-control"  name="choiceb18" placeholder="">
                                            <label >选项C</label>
                                            <input type="text" class="form-control"  name="choicec18" placeholder="">
                                            <label>选项D</label>
                                            <input type="text" class="form-control"  name="choiced18" placeholder="" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label >答案</label>
                                        <div class="col-lg-12 form-group">
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio18" id="rhh1" value="A">
                                                <label for="rhh1" class="font-weight-400"><span></span>A</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio18" id="rhh2" value="B" checked="">
                                                <label for="rhh2" class="font-weight-400"><span></span>B</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio18" id="rhh3" value="C">
                                                <label for="rhh3" class="font-weight-400"><span></span>C</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio18" id="rhh4" value="D">
                                                <label for="rhh4" class="font-weight-400"><span></span>D</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label >解析</label>
                                        <textarea name="analysis18" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox squaredTwo">
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div >
                                    <label>题目19</label>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label >选项A</label>
                                            <input type="text" class="form-control"  name="choicea19" placeholder="">
                                            <label >选项B</label>
                                            <input type="text" class="form-control"  name="choiceb19" placeholder="">
                                            <label >选项C</label>
                                            <input type="text" class="form-control"  name="choicec19" placeholder="">
                                            <label>选项D</label>
                                            <input type="text" class="form-control"  name="choiced19" placeholder="" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label >答案</label>
                                        <div class="col-lg-12 form-group">
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio19" id="rjj1" value="A">
                                                <label for="rjj1" class="font-weight-400"><span></span>A</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio19" id="rjj2" value="B" checked="">
                                                <label for="rjj2" class="font-weight-400"><span></span>B</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio19" id="rjj3" value="C">
                                                <label for="rjj3" class="font-weight-400"><span></span>C</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio19" id="rjj4" value="D">
                                                <label for="rjj4" class="font-weight-400"><span></span>D</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label >解析</label>
                                        <textarea name="analysis19" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox squaredTwo">
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                </div>
                                <div >
                                    <label>题目20</label>
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label >选项A</label>
                                            <input type="text" class="form-control"  name="choicea20" placeholder="">
                                            <label >选项B</label>
                                            <input type="text" class="form-control"  name="choiceb20" placeholder="">
                                            <label >选项C</label>
                                            <input type="text" class="form-control"  name="choicec20" placeholder="">
                                            <label>选项D</label>
                                            <input type="text" class="form-control"  name="choiced20" placeholder="" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label >答案</label>
                                        <div class="col-lg-12 form-group">
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio20" id="rkk1" value="A">
                                                <label for="rkk1" class="font-weight-400"><span></span>A</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio20" id="rkk2" value="B" checked="">
                                                <label for="rkk2" class="font-weight-400"><span></span>B</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio20" id="rkk3" value="C">
                                                <label for="rkk3" class="font-weight-400"><span></span>C</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="radio20" id="rkk4" value="D">
                                                <label for="rkk4" class="font-weight-400"><span></span>D</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label >解析</label>
                                        <textarea name="analysis20" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox squaredTwo">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="templatemo-blue-button">Submit</button>
                                    </div>
                                    <hr>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
<script type="text/javascript" src="../../../.././vendor/admin/js/templatemo-script.js"></script>      <!-- Templatemo Script -->

</body>
</html>