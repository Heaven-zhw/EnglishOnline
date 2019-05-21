
<!DOCTYPE html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>
        在线题库-多题模式
    </title><link type="text/css" rel="stylesheet" href="./css/publicCss.css" />
    <link type="text/css" rel="stylesheet" href="./css/navBar.css" />
    <link type="text/css" rel="stylesheet" href="./css/footerbottom.css" />
    <link type="text/css" rel="stylesheet" href="./css/publictest.css" />
    <link type="text/css" rel="stylesheet" href="./css/detailtitle.css" />
    <link href="./css/cat_smoking.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script src="./js/jquery-1.9.1.js" type="text/javascript"></script>
    <script src="./js/source.js" type="text/javascript"></script>
    <script src="./js/publiconlinetest.js" type="text/javascript"></script>
    <script src="./js/detail.js" type="text/javascript"></script>
    <script src="./js/detali2.js" type="text/javascript"></script>
    <script type="text/javascript" src="./js/navbar.js" charset="gb2312"></script>
    <script src="./js/layer.js" type="text/javascript"></script>
    <!--script>@import url("https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css")
    </script-->

    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>
<body style="background-color:#f5f5f5;" >
<form method="post" action="#" id="form1"> <!-- 把整个网页当做表单 ok-->
    <div class="aspNetHidden">
        <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUJMTMwNzU1NTE5ZGQIS1gUeFU3/fksrgexC4HWxwGqgLqqVGMoMWz89WLB5A==" />
    </div>

    <div class="aspNetHidden">

        <input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="194E3B21" />
        <input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEWCwK2n723CQKC847vBgKPn4uFDALT3ZvrBwLM/9uZAwKD847vBgLV7ZLjAQKyiZ/KDQL78o7vBgKB847vBgK+v7uIBXc1gG4r10uZVJc3/QLpFYD++mtkKxfLUXF67xpl+BKe" />
    </div>
    <input type="hidden" name="TID" id="TID" />
    <input type="hidden" name="HFQID" id="HFQID" value="83656" />
    <!--题目ID-->

    <input type="hidden" name="TypeID" id="TypeID" value="0" />
    <!--类型ID-->
    <input type="hidden" name="HFHID" id="HFHID" />
    <!--答题历史ID-->
    <input type="hidden" name="SID" id="SID" />


    <input type="hidden" name="HRID" id="HRID" value="19865" />

    <input type="hidden" name="HPARENTID" id="HPARENTID" value="19861" />

    <input type="hidden" name="KID" id="KID" value="19861" />


    <input type="hidden" name="UID" id="UID" value="0" />
    <input type="hidden" name="HClassID" id="HClassID" />

    <div class="nav">
        <div class="nav-cont">

            <ul class="nav-bar">
                <li class="nav-logo-control"><a  href="/">在线英语考试</a></li>
            </ul>

            <ul class="nav-user">
            <li class="nav-my">
                <a><?php echo "ljryjy123" ?>
                <img style="width:40px;height:40px;" src="./picture/timg.jpg" onload="showtimes(0,0,20)">

                </a>
                <ul class="nav-my-infor nav-my-center" style="display: none">
                    <li class="nav-my-center-cont">
                        <a href="#">个人中心</a>
                    </li>
                    <li class="nav-my-center-cont">
                        <a href="#">安全退出</a>
                    </li>
                </ul>
            </li>
            </ul>
        </div>
    </div>
    <div class="nav-perch-height"></div>

    <div id="nav">
        <div class="chapContent">
            <div class="contentleft" id="contentleft">
                <div class="contentlefttop"  id="contentlefttoptitletwo">
                    <div class="contentlefttoptitle">
                        <i></i>
                        <h2 id="Title_ChapterName" style="visibility:visible" ><?php echo"英语阅读模拟试题一"?></h2>
                        <hr style="visibility:visible;width=700px" >
                    </div>
                    <!---考试模式下的说明显示--->
                    <span class="contentlefttopspan" id="contentlefttopspan"  style="display: none" >
                    </span>
                    <!---考试模式下的说明显示结束--->
                </div>

                <div class="contentleftscore" id="contentleftscoretwo" >

                </div>


                <!---考试结果下的分数显示结束--->
                <div class="contentleftcont" id="exam">

                </div>
            </div>

            <div class="contentright" id="contentright"style="position: static; top: 91.2px; right: 0px;">
                <div class="doproblemstime" style="height: 80px">

                    <!-- 答题报告开始-->
                    <!-- <h1>答题报告</h1>-->
                    <!-- 答题报告结束-->

                    <!-- 答题倒计时正计时-->
                    <div class="doproblemstimeright">
                        <span id="yongshi" style="display: none">用时</span>
                        <span id="daojishi" style="display:block">倒计时</span>
                        <!--  <span>做题用时</span>-->
                        <span class="doproblemstimenow">

                        </span>
                    </div>
                    <div class="doproblemstimeleft" data-toggle="modal" data-target="#myModal" onclick="">
                        <div>
                            <i></i>
                            <span >暂停</span>
                        </div>
                    </div>
                    <!-- 答题倒计时正计时结束-->
                </div>
                <div class="doproblemssheet" style="height: 40px">
                    <img src="./picture/ka.jpg" style="height: 20px; width: 20px;">

                    <span>答题卡</span>
                    <b>   <span class="DoQuestionNum">0</span>&nbsp;/&nbsp;<span class="allQuestionNUM">0</span></b>
                </div>
                <!--考试结果提示-->
                <!--考试结果提示结束-->
                <div id="ceshi"  style="display:none;"></div>

                <div class="doproblemsnumber" id="answer_card">

                </div>
                <div class="doproblemsactive">
                    <div class="doproblemsactivered answersubmit"  id="intersect" style="display:none">保存</div>
                    <div class="doproblemsactivered"  id="stop" style="display:none"  >保存</div>
                    <div class="doproblemsactivered theirpapers"  id="insterecttwo"  style="display:none">交卷</div>
                    <div class="doproblemsactiveblue nexttocontinue"  id="hold">下次继续</div>
                    <div class="doproblemsactiveblue gettoback">返回</div>
                </div>
            </div>
        </div>
    </div>

    <div class="suspensionright" id="suspensionright">
        <ul>
            <li><a class="Alitalk"></a></li>
            <li><a class="tencentqq"></a></li>
            <li><a  class="backtotop"></a></li>
        </ul>
    </div>
    <div id="SelectCheck" style="display: none;">
    </div>


    <div id="Errorpopup" style="display:none;" >
    </div>


    <!--div id="suspendedPopupwind" style="display:block;">
        <div class="suspendedPopupwindcont">
            <div>
                <i></i>
                <span>休息一下</span>
            </div>
        </div>
            <div class="suspendednextdiv">
                <a class="suspendednext">继续答题</a>
            </div>
        </div>
    </div-->
    <div style="width: 1800px; display: none; padding-right: 106px;padding-top:200px"class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                </div>
                <div class="modal-body">休息一下馬上回來</div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">結束休息</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>



    <div id="answersubmit" style="display:none;">
        <div class="submitcont">
            <div class="submitimg">
                <i></i>
            </div>
            <span>确定要提交吗？</span>
            <div class="submitbtn">
                <a class="submitcancel">取消</a>
                <a class="submitsubmit">确定</a>
            </div>
        </div>
    </div>

    <div id="theirpapers" style="display:none;">
        <div class="submitcont">
            <div class="submitimg">
                <i></i>
                <span>确定要交卷吗？</span>
            </div>
            <div class="submitbtn">
                <a class="submitcancel">取消</a>
                <a class="submitsubmit">确定</a>
            </div>
        </div>
    </div>

    <div id="nexttocontinue" style="display:none;">
        <div class="submitcont">
            <div class="submitimg">
                <i></i>
                <span>系统将为您保存，是否下次继续？</span>
            </div>
            <div class="submitbtn">
                <a class="submitcancel">取消</a>
                <a class="submitsubmit">确定</a>
            </div>
        </div>
    </div>

    <div id="gettoback" style="display:none;">
        <div class="submitcont">
            <div class="submitimg">
                <i></i>
                <span>确定要返回吗？</span>
            </div>
            <div class="submitbtn">
                <a class="submitcancel">取消</a>
                <a class="submitsubmit">确定</a>
            </div>
        </div>
    </div>



    <div id="detailReport">

    </div>
</form>
<script>
    function showtimes(Hours1, Minutes1, Seconds1) {
        var NowHour = Hours1;
        var NowMinute = Minutes1;
        var NowSecond = Seconds1;
            NowSecond -= 1;
        var stoptime;
        var timeID;
            if (1 > NowSecond) {
                NowSecond = 59;
                NowMinute = NowMinute - 1;
            }

            if (0 > NowMinute) {
                NowMinute = 59;
                NowHour = NowHour - 1;
            }
            if (0 > NowHour) {
                NowHour = 0;
                NowMinute = 0;
                NowSecond = 0;
                alert("sdsd");
                location.href = "./index.php";
                clearTimeout(timerID);

            } else {
                $(".doproblemstimenow").html("<b>" + NowHour + "</b>时<b>" + NowMinute + "</b>分<b>" + NowSecond + "</b>秒");

                stoptime = "showtimes(" + NowHour + "," + NowMinute + "," + NowSecond + ")";
                timerID = setTimeout(stoptime, 1000);
            }

    }
</script>
</body>
</html>
