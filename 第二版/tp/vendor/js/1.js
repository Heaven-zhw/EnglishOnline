var optionABCdata = new Array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "A1", "B1", "C1", "D1");
var itemNumber = 0; //题目题号
var JSFXAnswerData = []; //计算分析题答案
var DoHistoryID = 0; //作答历史id
var DoDateTime = ""; //开始作答时间
var secondNum = 0; //秒
var ssshtml = "";
var htmlStr = ""; //题目字符串拼接 单选
var d = new Date();
DoDateTime += d.getFullYear() + '年'; //获取当前年份
DoDateTime += d.getMonth() + 1 + '月'; //获取当前月份（0——11）
DoDateTime += d.getDate() + '日';
DoDateTime += d.getHours() + '时';
DoDateTime += d.getMinutes() + '分';
DoDateTime += d.getSeconds() + '秒';
var datalist = "";
var ExamRecordList = null; //用户作答记录
var ExamHistory = null;

var allscore = 0; //总分
var infomationArray = [];
var scoreArray = [];
var allaui_close = "";



$(function () {
    //获取笔记的cooki值
    if (getCookie("cookieone") != null && getCookie("cookietwo") != null && getCookie("cookiethree") != null) {
        $.ajax({
            url: '../../Service/ExamRoom/NotesHandler.ashx',
            type: 'POST',
            async: true,
            dataType: 'text',
            data: {
                "TID": getCookie("cookieone"),
                "content": getCookie("#cookietwo"),
                "UID": $("#UID").val(),
                "KID": getCookie("#cookiethree")
            },
            success: function (a) {
            }
        });
        var suspendedcancel = $.dialog({
            title: "&nbsp;<span style='font-size: 16px;color: #666;font-family: 'Microsoft Yahei';'>温馨提示</span>",
            width: "480px",
            height: "260px",
            content: " <div class=\"submitcont\">  <div class=\"submitimg\"> <i></i></div> <span>笔记已提交</span> <div class=\"submitbtn\"> <a class=\"submitcancel\">取消</a><a class=\"submitsubmit\">确定</a> </div></div>",
            lock: true,
            fixed: true,
            opacity: 0.3,
            drag: false,
            padding: 0
        });
        //弹窗取消
        $(".submitcancel").click(function () {
            suspendedcancel.close();
        });
        $(".submitsubmit").click(function () {
            suspendedcancel.close();
        });
    }



    //答题历史ID
    if ($("#HFHID").val() != "") {
        DoHistoryID = $("#HFHID").val();
    }
    //答题题目记录所有题目ID
    if ($("#SID").val() != "") {
        SID = $("#SID").val();
    }
    //
    //题目ID
    var Qid = $("#HFQID").val();
    //题目类型ID
    Tid = $("#TypeID").val();
    if (Tid == "") {
        Tid = 3;
    }
    if (Tid == "0") {
        //章节练习
        GetShowTypeName(Qid);
    } else if (Tid == "1") {
        GetByZID(Qid);

    } else if (Tid == "2") {
        //试卷练习Title_ChapterName
        GetPaper(Qid);
    } else if (Tid == "3") {
        //智能刷题
        GetByID();
    }
    else if (Tid == "4") {
        //随机考场
        var classid = $("#HClassID").val();
        GetByPaperID(classid);
    }

})
function GetByZID(ZID) {
    $.ajax({
        url: '/Service/ExamRoom/ExamHandler.ashx',
        type: 'POST',
        async: true,
        data: {
            "key": "GetKnowQuestions",
            "KnowID": ZID

        },
        dataType: 'text',
        timeout: 900000,
        success: function (e) {
            if (e == "0" || e == "-1") {
                location.href = "javascript: history.back()";
            }
            else {
                var data = eval("[" + e + "]");
                document.getElementById('Title_ChapterName').style.visibility = "visible";
                $("#Title_ChapterName").html("知识点练习");
                var htmlStr = ""; //题目字符串拼接
                var htmlStr = "";//获取简答题

                $("#answer_card").html("");
                document.getElementById('contentleftscoretwo').style.display = "none";
                document.getElementById('intersect').style.display = "block";

                for (var i = 0; i < data[0].showType.length; i++) {
                    $("#answer_card").append("<div class=\"dopronumbertype\"  showTypeID='" + data[0].showType[i].showTypeID + "'>" + data[0].showType[i].showTypeName + "</div><ul  titletpye=\"1\"    showTypeID=\"" + data[0].showType[i].showTypeID + "\"  class=\"dopronumbercont\" id=\"pannelShowType" + data[0].showType[i].showTypeID + "\"></ul><div style=\"height:39px;\"></div>");

                    if (data[0].showType[i].quesNormalData[0].typeNo == "1") {
                        htmlStr += "<div class=\"contentleftconttitletype\"   questiontypes=\"1\" showTypeID='" + data[0].showType[i].showTypeID + "' >  <h3>" + data[0].showType[i].showTypeName + "</h3>  <span id=\"type" + data[0].showType[i].quesNormalData[0].typeNo + "\">本题型共" + data[0].showType[i].quesNormalData.length + "  小题 , 每小题只选择一个正确答案，选对得分，多选、错选、不选均不得分。</span></div>  ";
                    }
                    else if (data[0].showType[i].quesNormalData[0].typeNo == "2") {
                        htmlStr += "<div class=\"contentleftconttitletype\"   questiontypes=\"1\" showTypeID='" + data[0].showType[i].showTypeID + "' >  <h3>" + data[0].showType[i].showTypeName + "</h3>  <span id=\"type" + data[0].showType[i].quesNormalData[0].typeNo + "\">本题型共" + data[0].showType[i].quesNormalData.length + "  小题 , 多选、漏选、错选、不选均不得分。</span></div>  ";
                    }
                    else if (data[0].showType[i].quesNormalData[0].typeNo == "3") {
                        htmlStr += "<div class=\"contentleftconttitletype\"   questiontypes=\"1\" showTypeID='" + data[0].showType[i].showTypeID + "' >  <h3>" + data[0].showType[i].showTypeName + "</h3>  <span id=\"type" + data[0].showType[i].quesNormalData[0].typeNo + "\">本题型共" + data[0].showType[i].quesNormalData.length + "  小题 , 不答、错答不得分，也不扣分。</span></div>  ";
                    }
                    else if (data[0].showType[i].quesNormalData[0].typeNo == "12") {
                        htmlStr += "<div class=\"contentleftconttitletype\"   questiontypes=\"1\" showTypeID='" + data[0].showType[i].showTypeID + "' >  <h3>" + data[0].showType[i].showTypeName + "</h3>  <span id=\"type" + data[0].showType[i].quesNormalData[0].typeNo + "\">本题型共" + data[0].showType[i].quesNormalData.length + "  小题 , 属于主观题</span></div>  ";
                    }
                    else if (data[0].showType[i].quesNormalData[0].typeNo == "9" || data[0].showType[i].quesNormalData[0].typeNo == "28") {
                        htmlStr += "<div class=\"contentleftconttitletype\"   questiontypes=\"1\" showTypeID='" + data[0].showType[i].showTypeID + "' >  <h3>" + data[0].showType[i].showTypeName + "</h3>  <span id=\"type" + data[0].showType[i].quesNormalData[0].typeNo + "\">本题型共" + data[0].showType[i].quesNormalData.length + "  小题 , 多选、漏选、错选、不选均不得分</span></div>  ";
                    }
                    else {
                        htmlStr += "<div class=\"contentleftconttitletype\"   questiontypes=\"1\" showTypeID='" + data[0].showType[i].showTypeID + "' >  <h3>" + data[0].showType[i].showTypeName + "</h3>  <span id=\"type" + data[0].showType[i].quesNormalData[0].typeNo + "\">本题型共" + data[0].showType[i].quesNormalData.length + "  小题 , 属于主观题</span></div>  ";
                    }

                    for (var w = 0; w < data[0].showType[i].quesNormalData.length; w++) {
                        itemNumber++;
                        var typeNo = data[0].showType[i].quesNormalData[w].typeNo;
                        if (typeNo == "1" || typeNo == "2" || typeNo == "3") {

                            $("#pannelShowType" + data[0].showType[i].quesNormalData[w].showTypeID).append("<li  titlenumber=\"" + itemNumber + "\" titletpye=\"1\"   showTypeID=\"" + data[0].showType[i].showTypeID + "\"  questionID=\"" + data[0].showType[i].quesNormalData[w].iD + "\" class=\"" + checked + "\">" + itemNumber + "</li>");
                        }
                        else {
                            $("#pannelShowType" + data[0].showType[i].quesNormalData[w].showTypeID).append("<li  titlenumber=\"" + itemNumber + "\" titletpye=\"1\"   showTypeID=\"" + data[0].showType[i].showTypeID + "\"  questionID=\"" + data[0].showType[i].quesNormalData[w].iD + "\" class=\"" + checked + "\">" + itemNumber + "</li>");
                        }
                        if (typeNo == "1" || typeNo == "2" || typeNo == "3") {  //选择题模板
                            if (typeNo == "2") {  //多选题模板

                                htmlStr += ChoseAnswer(data[0].showType[i].quesNormalData[w], 0, data[0].showType[i].showTypeName);
                            }
                            else if (typeNo == "1") {


                                htmlStr += ChoiceAndAnswer(data[0].showType[i].quesNormalData[w], 0, data[0].showType[i].showTypeName);
                            }
                            else {
                                htmlStr += ChoiceAndAnswer(data[0].showType[i].quesNormalData[w], 0, data[0].showType[i].showTypeName);
                            }
                        }
                        else if (typeNo == "12") {  //简答题模板

                            htmlStr += ChoiceWenAndAnswer(data[0].showType[i].quesNormalData[w], data[0].showType[i].showTypeName);
                        }
                        else if (typeNo == "9" || typeNo == "28") {
                            htmlStr += ChoiceWenanAndAnswer(data[0].showType[i].quesNormalData[w], data[0].showType[i].quesSonData, data[0].showType[i].showTypeName);
                        }
                        else {

                            htmlStr += OtherAnswer(data[0].showType[i].quesNormalData[w], data[0].showType[i].quesSonData, data[0].showType[i].showTypeName);
                        }
                        var checked = "";
                        if (ExamRecordList != null) {
                            for (var f = 0; f < ExamRecordList.length; f++) {
                                if (ExamRecordList[f].qID == data[0].showType[i].quesNormalData[w].iD) {
                                    checked = "dopronumberconton";
                                    break;
                                }
                            }
                        }
                    }
                }
                //加载题目类容
                var ytmlt = "<font></font> <div class=\"doproblemsnumberstate\">   <div class=\"doproblemsnumberstatecont\">    <i class=\"statecont1\"></i><span>正确</span>   </div> <div class=\"doproblemsnumberstatecont\">   <i class=\"statecont2\"></i><span>错误</span>          </div>  <div class=\"doproblemsnumberstatecont\">    <i class=\"statecont4\"></i><span>未答</span> </div></div>";
                $("#doproblemsnumberstate").html(ytmlt);

                htmlStr += "   <div class=\"contentleftcontupordown contentleftconthidden\"> <span> <input type=\"button\" class=\"contentleftcontOnatopic\" value=\"上一题\"></input></span>";
                htmlStr += "<span> <input type=\"button\" class=\"contentleftcontNextquestion\" value=\"下一题\"></input></span></div>";

                ssshtml += "<div class=\"Errorpopupcont\"> <span>请详细填写反馈说明，方便我们改正错误：</span>  <ul class=\"Errorpopupli\"><li><label class=\"one\" ><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 含有错别字</label></li>";
                ssshtml += "<li><label class=\"two\"><input type=\"checkbox\" class=\"Errorcheckbox \"  name=\"Errorpopupli \"  /> 图片不显示</label></li>                <li><label class=\"three\"><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 答案不正确</label></li>";
                ssshtml += "<li><label class=\"four\"><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 解析不正确</label></li><li><label class=\"five\"><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 试题重复</label></li>";
                ssshtml += "  <li><label class=\"six\"><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 其他错误</label></li></ul>  <textarea class=\"Errorpopuptextarea\" id=\"Errorpopuptextarea\"  placeholder=\" 输入内容\" ></textarea> <div class=\"Errorpopupbtn\">  <a class=\"Errorcancel\">取消</a><a class=\"Errorsubmit\">提交</a> </div> </div>";

                $("#Errorpopup").html(ssshtml);
                $(".allQuestionNUM").html(itemNumber);
                writenote();
                var hour = 0;
                var minute = 0;
                var seconds = 0;
                var type = 1;
                startclock(hour, minute, seconds, type);

            }
        }
    });
}

//随机考场
function GetByPaperID(classid) {
    $.ajax({
        url: '/Service/ExamRoom/ExamHandler.ashx',
        type: 'POST',
        async: true,
        data: {
            "key": "GetByPaperID",
            "ClassID": $("#HClassID").val()
        },
        dataType: 'text',
        timeout: 80000,
        success: function (e) {

            if (e == 0) {
                alert("该科目下暂无试题");
            } else {
                var data = eval("[" + e + "]");

                document.getElementById('Title_ChapterName').style.visibility = "visible";
                $("#Title_ChapterName").html(data[0].chapterName);
                document.getElementById('contentleftscoretwo').style.display = "none";
                var htmlStr = ""; //题目字符串拼接
                var hour = 1;
                var minute = 30;
                var seconds = 0;
                var type = 0;
                secondNum = data[0].time;
                if (secondNum > 0) {
                    minute = secondNum;
                    hour = parseInt(minute / 60);

                    minute = parseInt(minute % 60);
                }
                $("#answer_card").html("");
                itemNumber = 0; //初始化。防止再次调用时序号不正确
                var QuesTotal = 0; //总题数
                var ScoreTotal = 0; //总分数
                for (var i = 0; i < data[0].showType.length; i++) {
                    $("#answer_card").append("<div class=\"dopronumbertype\"  showTypeID='" + data[0].showType[i].showTypeID + "'>" + data[0].showType[i].showTypeName + "</div><ul  titletpye=\"1\"    showTypeID=\"" + data[0].showType[i].showTypeID + "\"    class=\"dopronumbercont\" id=\"pannelShowType" + data[0].showType[i].showTypeID + "\"></ul><div style=\"height:39px;\"></div>");

                    htmlStr += "<div class=\"contentleftconttitletype\"   questiontypes=\"1\">  <h3>" + data[0].showType[i].showTypeName + "</h3>  <span>本题型共" + data[0].showType[i].quesNormalData.length + "小题 , 每小题只选择一个正确答案，选对得分，多选、错选、不选均不得分。</span></div>  ";

                    for (var w = 0; w < data[0].showType[i].quesNormalData.length; w++) {
                        itemNumber++;
                        var typeNo = data[0].showType[i].quesNormalData[w].typeNo;

                        if (typeNo == "1" || typeNo == "2" || typeNo == "3") {

                            $("#pannelShowType" + data[0].showType[i].quesNormalData[w].showTypeID).append("<li  titlenumber=\"" + itemNumber + "\" titletpye=\"1\"   score=\"" + data[0].showType[i].quesNormalData[w].score + "\"   showTypeID=\"" + data[0].showType[i].showTypeID + "\"  questionID=\"" + data[0].showType[i].quesNormalData[w].iD + "\" class=\"" + checked + "\">" + itemNumber + "</li>");
                        }
                        else {
                            $("#pannelShowType" + data[0].showType[i].quesNormalData[w].showTypeID).append("<li  titlenumber=\"" + itemNumber + "\" titletpye=\"1\"   score=\"10\"   showTypeID=\"" + data[0].showType[i].showTypeID + "\"  questionID=\"" + data[0].showType[i].quesNormalData[w].iD + "\" class=\"" + checked + "\">" + itemNumber + "</li>");
                        }
                        if (typeNo == "1" || typeNo == "2" || typeNo == "3") {  //选择题模板
                            if (typeNo == "2") {  //多选题模板

                                htmlStr += ChoseAnswer(data[0].showType[i].quesNormalData[w], data[0].showType[i].quesNormalData[w].score, data[0].showType[i].showTypeName);
                            }
                            else if (typeNo == "1") {
                                htmlStr += ChoiceAndAnswer(data[0].showType[i].quesNormalData[w], data[0].showType[i].quesNormalData[w].score, data[0].showType[i].showTypeName);
                            }
                            else {
                                htmlStr += ChoiceAndAnswer(data[0].showType[i].quesNormalData[w], data[0].showType[i].quesNormalData[w].score, data[0].showType[i].showTypeName);
                            }
                        }
                        else if (typeNo == "12") {  //简答题模板

                            htmlStr += ChoiceWenAndAnswer(data[0].showType[i].quesNormalData[w], data[0].showType[i].showTypeName);
                        }
                        else if (typeNo == "27") {  //简答题模板

                            htmlStr += CaoDoAnswer(data[0].showType[i].quesNormalData[w], data[0].showType[i].showTypeName);
                        }
                        else if (typeNo == "9" || typeNo == "28") {
                            htmlStr += ChoiceWenanAndAnswer(data[0].showType[i].quesNormalData[w], data[0].showType[i].quesSonData, data[0].showType[i].showTypeName);
                        }
                        else {
                            htmlStr += OtherAnswer(data[0].showType[i].quesNormalData[w], data[0].showType[i].quesNormalData[w], data[0].showType[i].showTypeName);
                        }
                        var checked = "";
                        if (ExamRecordList != null) {
                            for (var f = 0; f < ExamRecordList.length; f++) {
                                if (ExamRecordList[f].qID == data[0].showType[i].quesNormalData[w].iD) {
                                    checked = "dopronumberconton";
                                    break;
                                }
                            }
                        }
                    }
                }
                //加载题目类容
                var op = "<img src=\"image/DetailTitle_liststye.png\" /><span>本次试卷  共 " + data[0].showType.length + "  大题 ，  " + itemNumber + "  小题 ,  每小题只选择一个正确答案，选对得分，多选、错选、不选均不得分。</span> ";
                var PaperInfo = "    <div class=\"contentleftscorecont\"> <ul class=\"contentleftscoreshow\">"
                PaperInfo += "<li>本次题目共：<span class=\"allQuestionNUM\">0</span>道</li> <li>答对题：<span id=\"ErrorNum\">0</span>道</li>";
                PaperInfo += "  <li>得分：<span id=\"Score\">0</span>分</li><li>剩余时长：<span id=\"hour\" >0</span>时<span  id=\"minute\">0</span>分<span id=\"second\">0</span>秒</li><li>交卷时间：<span id=\"submit\"></span></li>   </ul>   </div>";

                $("#contentlefttopspan").html(op);

                document.getElementById('insterecttwo').style.display = "block";
                document.getElementById('contentlefttopspan').style.display = "block";
                $("#contentleftscoretwo").html(PaperInfo);
                htmlStr += "   <div class=\"contentleftcontupordown contentleftconthidden\"> <span> <input type=\"button\" class=\"contentleftcontOnatopic\" value=\"上一题\"></input></span>";
                htmlStr += "<span> <input type=\"button\" class=\"contentleftcontNextquestion\" value=\"下一题\"></input></span></div>";

                ssshtml += "<div class=\"Errorpopupcont\"> <span>请详细填写反馈说明，方便我们改正错误：</span>  <ul class=\"Errorpopupli\"><li><label class=\"one\" ><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 含有错别字</label></li>";
                ssshtml += "<li><label class=\"two\"><input type=\"checkbox\" class=\"Errorcheckbox \"  name=\"Errorpopupli \"  /> 图片不显示</label></li>                <li><label class=\"three\"><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 答案不正确</label></li>";
                ssshtml += "<li><label class=\"four\"><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 解析不正确</label></li><li><label class=\"five\"><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 试题重复</label></li>";
                ssshtml += "  <li><label class=\"six\"><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 其他错误</label></li></ul>  <textarea class=\"Errorpopuptextarea\" id=\"Errorpopuptextarea\"  placeholder=\" 输入内容\" ></textarea> <div class=\"Errorpopupbtn\">  <a class=\"Errorcancel\">取消</a><a class=\"Errorsubmit\">提交</a> </div> </div>";

                document.getElementById('as').style.display = "none";
                document.getElementById('asc').style.display = "none";
                var ytmlt = "    <font></font> <div class=\"doproblemsnumberstate\">   <div class=\"doproblemsnumberstatecont\" id=\"xo\" style=\"display:none;\">    <i class=\"statecont1\"></i><span>正确</span>   </div> <div class=\"doproblemsnumberstatecont\" id=\"yo\" style=\"display:none;\">   <i class=\"statecont2\"></i><span>错误</span>          </div>  <div class=\"doproblemsnumberstatecont\" id=\"zo\" style=\"display:block;\">     <i class=\"statecont5\"></i><span>已答</span> </div> <div class=\"doproblemsnumberstatecont\">    <i class=\"statecont4\"></i><span>未答</span> </div></div>";
                $("#doproblemsnumberstate").html(ytmlt);

                $("#Errorpopup").html(ssshtml);

                $("#doproblemsnumberstate").html(ytmlt);

                AcountAd();
                //加载题目类容
                // $("#exam").html(htmlStr);
                $(".allQuestionNUM").html(itemNumber);

                writenote();

                startclock(hour, minute, seconds, type);
            }
        }
    })
}




//智能刷题根据ID获取并绑定题目信息
function GetByID() {
    $.ajax({
        url: '/Service/ExamRoom/ExamHandler.ashx',
        type: 'POST',
        async: true,
        data: {
            "key": "GetByID"
        },
        dataType: 'text',
        timeout: 900000,
        success: function (e) {
            if (e == "0" || e == "{\"chapterID\":0,\"chapterName\":\"智能刷题\",\"classID\":0,\"showType\":[]}") {
                alert("该科目下暂无试题")
            } else if (e == "-1") {
                location.href = "javascript: history.back()";
            }
            else {
                var data = eval("[" + e + "]");
                document.getElementById('Title_ChapterName').style.visibility = "visible";
                $("#Title_ChapterName").html(data[0].chapterName);
                var htmlStr = ""; //题目字符串拼接
                var htmlStr = "";//获取简答题
                if (DoHistoryID > 0) {
                    GetHistoryListByID(DoHistoryID); //获取作答记录
                }
                $("#answer_card").html("");
                document.getElementById('contentleftscoretwo').style.display = "none";
                document.getElementById('intersect').style.display = "block";

                for (var i = 0; i < data[0].showType.length; i++) {
                    $("#answer_card").append("<div class=\"dopronumbertype\"  showTypeID='" + data[0].showType[i].showTypeID + "'>" + data[0].showType[i].showTypeName + "</div><ul  titletpye=\"1\"    showTypeID=\"" + data[0].showType[i].showTypeID + "\"  class=\"dopronumbercont\" id=\"pannelShowType" + data[0].showType[i].showTypeID + "\"></ul><div style=\"height:39px;\"></div>");

                    if (data[0].showType[i].quesNormalData[0].typeNo == "1") {
                        htmlStr += "<div class=\"contentleftconttitletype\"   questiontypes=\"1\" showTypeID='" + data[0].showType[i].showTypeID + "' >  <h3>" + data[0].showType[i].showTypeName + "</h3>  <span id=\"type" + data[0].showType[i].quesNormalData[0].typeNo + "\">本题型共" + data[0].showType[i].quesNormalData.length + "  小题 , 每小题只选择一个正确答案，选对得分，多选、错选、不选均不得分。</span></div>  ";
                    }
                    else if (data[0].showType[i].quesNormalData[0].typeNo == "2") {
                        htmlStr += "<div class=\"contentleftconttitletype\"   questiontypes=\"1\" showTypeID='" + data[0].showType[i].showTypeID + "' >  <h3>" + data[0].showType[i].showTypeName + "</h3>  <span id=\"type" + data[0].showType[i].quesNormalData[0].typeNo + "\">本题型共" + data[0].showType[i].quesNormalData.length + "  小题 , 多选、漏选、错选、不选均不得分。</span></div>  ";
                    }
                    else if (data[0].showType[i].quesNormalData[0].typeNo == "3") {
                        htmlStr += "<div class=\"contentleftconttitletype\"   questiontypes=\"1\" showTypeID='" + data[0].showType[i].showTypeID + "' >  <h3>" + data[0].showType[i].showTypeName + "</h3>  <span id=\"type" + data[0].showType[i].quesNormalData[0].typeNo + "\">本题型共" + data[0].showType[i].quesNormalData.length + "  小题 , 不答、错答不得分，也不扣分。</span></div>  ";
                    }
                    else if (data[0].showType[i].quesNormalData[0].typeNo == "12") {
                        htmlStr += "<div class=\"contentleftconttitletype\"   questiontypes=\"1\" showTypeID='" + data[0].showType[i].showTypeID + "' >  <h3>" + data[0].showType[i].showTypeName + "</h3>  <span id=\"type" + data[0].showType[i].quesNormalData[0].typeNo + "\">本题型共" + data[0].showType[i].quesNormalData.length + "  小题 , 属于主观题</span></div>  ";
                    }
                    else if (data[0].showType[i].quesNormalData[0].typeNo == "9" || data[0].showType[i].quesNormalData[0].typeNo == "28") {
                        htmlStr += "<div class=\"contentleftconttitletype\"   questiontypes=\"1\" showTypeID='" + data[0].showType[i].showTypeID + "' >  <h3>" + data[0].showType[i].showTypeName + "</h3>  <span id=\"type" + data[0].showType[i].quesNormalData[0].typeNo + "\">本题型共" + data[0].showType[i].quesNormalData.length + "  小题 , 多选、漏选、错选、不选均不得分</span></div>  ";
                    }
                    else {
                        htmlStr += "<div class=\"contentleftconttitletype\"   questiontypes=\"1\" showTypeID='" + data[0].showType[i].showTypeID + "' >  <h3>" + data[0].showType[i].showTypeName + "</h3>  <span id=\"type" + data[0].showType[i].quesNormalData[0].typeNo + "\">本题型共" + data[0].showType[i].quesNormalData.length + "  小题 , 属于主观题</span></div>  ";
                    }

                    for (var w = 0; w < data[0].showType[i].quesNormalData.length; w++) {
                        itemNumber++;
                        var typeNo = data[0].showType[i].quesNormalData[w].typeNo;
                        if (typeNo == "1" || typeNo == "2" || typeNo == "3") {

                            $("#pannelShowType" + data[0].showType[i].quesNormalData[w].showTypeID).append("<li  titlenumber=\"" + itemNumber + "\" titletpye=\"1\"   showTypeID=\"" + data[0].showType[i].showTypeID + "\"  questionID=\"" + data[0].showType[i].quesNormalData[w].iD + "\" class=\"" + checked + "\">" + itemNumber + "</li>");
                        }
                        else {
                            $("#pannelShowType" + data[0].showType[i].quesNormalData[w].showTypeID).append("<li  titlenumber=\"" + itemNumber + "\" titletpye=\"1\"   showTypeID=\"" + data[0].showType[i].showTypeID + "\"  questionID=\"" + data[0].showType[i].quesNormalData[w].iD + "\" class=\"" + checked + "\">" + itemNumber + "</li>");
                        }
                        if (typeNo == "1" || typeNo == "2" || typeNo == "3") {  //选择题模板
                            if (typeNo == "2") {  //多选题模板

                                htmlStr += ChoseAnswer(data[0].showType[i].quesNormalData[w], 0, data[0].showType[i].showTypeName);
                            }
                            else if (typeNo == "1") {


                                htmlStr += ChoiceAndAnswer(data[0].showType[i].quesNormalData[w], 0, data[0].showType[i].showTypeName);
                            }
                            else {
                                htmlStr += ChoiceAndAnswer(data[0].showType[i].quesNormalData[w], 0, data[0].showType[i].showTypeName);
                            }
                        }
                        else if (typeNo == "12") {  //简答题模板

                            htmlStr += ChoiceWenAndAnswer(data[0].showType[i].quesNormalData[w], data[0].showType[i].showTypeName);
                        }
                        else if (typeNo == "27") {

                            htmlStr += CaoDoAnswer(data[0].showType[i].quesNormalData[w], data[0].showType[i].showTypeName);
                        }
                        else if (typeNo == "9" || typeNo == "28") {
                            htmlStr += ChoiceWenanAndAnswer(data[0].showType[i].quesNormalData[w], data[0].showType[i].quesSonData, data[0].showType[i].showTypeName);
                        }
                        else {

                            htmlStr += OtherAnswer(data[0].showType[i].quesNormalData[w], data[0].showType[i].quesSonData, data[0].showType[i].showTypeName);
                        }
                        var checked = "";
                        if (ExamRecordList != null) {
                            for (var f = 0; f < ExamRecordList.length; f++) {
                                if (ExamRecordList[f].qID == data[0].showType[i].quesNormalData[w].iD) {
                                    checked = "dopronumberconton";
                                    break;
                                }
                            }
                        }
                    }
                }
                //加载题目类容
                var ytmlt = "<font></font> <div class=\"doproblemsnumberstate\">   <div class=\"doproblemsnumberstatecont\">    <i class=\"statecont1\"></i><span>正确</span>   </div> <div class=\"doproblemsnumberstatecont\">   <i class=\"statecont2\"></i><span>错误</span>          </div>  <div class=\"doproblemsnumberstatecont\">    <i class=\"statecont4\"></i><span>未答</span> </div></div>";
                $("#doproblemsnumberstate").html(ytmlt);

                htmlStr += "   <div class=\"contentleftcontupordown contentleftconthidden\"> <span> <input type=\"button\" class=\"contentleftcontOnatopic\" value=\"上一题\"></input></span>";
                htmlStr += "<span> <input type=\"button\" class=\"contentleftcontNextquestion\" value=\"下一题\"></input></span></div>";

                ssshtml += "<div class=\"Errorpopupcont\"> <span>请详细填写反馈说明，方便我们改正错误：</span>  <ul class=\"Errorpopupli\"><li><label class=\"one\" ><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 含有错别字</label></li>";
                ssshtml += "<li><label class=\"two\"><input type=\"checkbox\" class=\"Errorcheckbox \"  name=\"Errorpopupli \"  /> 图片不显示</label></li>                <li><label class=\"three\"><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 答案不正确</label></li>";
                ssshtml += "<li><label class=\"four\"><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 解析不正确</label></li><li><label class=\"five\"><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 试题重复</label></li>";
                ssshtml += "  <li><label class=\"six\"><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 其他错误</label></li></ul>  <textarea class=\"Errorpopuptextarea\" id=\"Errorpopuptextarea\"  placeholder=\" 输入内容\" ></textarea> <div class=\"Errorpopupbtn\">  <a class=\"Errorcancel\">取消</a><a class=\"Errorsubmit\">提交</a> </div> </div>";

                $("#Errorpopup").html(ssshtml);
                $(".allQuestionNUM").html(itemNumber);
                writenote();
                var hour = 0;
                var minute = 0;
                var seconds = 0;
                var type = 1;
                startclock(hour, minute, seconds, type);

            }
        }
    });
}

//倒计时
var timerID = null;
var stoptime = "";
function showtime(Hours, Minutes, Seconds, timetype) {
                var NowHour = Hours;
                var NowMinute = Minutes;
                var NowSecond = Seconds;
                if (timetype == 0) {
                    NowSecond -= 1;


                    if (NowSecond < 1) {
                        NowSecond = 59;
                        NowMinute = NowMinute - 1;
                    }

                    if (NowMinute < 0) {
                        NowMinute = 59;
                        NowHour = NowHour - 1;
                    }
                    if (NowHour < 0) {
                        NowHour = 0;
                        NowMinute = 0;
                        NowSecond = 0;
                        alert("sdsd");
                        location.href="../index.php";
                        clearTimeout(timerID);

                    } else {
                        alert("sdsd");
                        $(".doproblemstimenow").html("<b>" + NowHour+1 + "</b>时<b>" + NowMinute + "</b>分<b>" + NowSecond + "</b>秒");

                        $("#hour").html(NowHour);
                        $("#minute").html(NowMinute);
                        $("#second").html(NowSecond);
            stoptime = "showtime(" + NowHour + "," + NowMinute + "," + NowSecond + "," + timetype + ")";
            timerID = setTimeout(stoptime, 1000);
        }

    } else if (timetype == 1) {
        NowSecond += 1;
        if (NowSecond > 59) {
            NowSecond = 0;
            NowMinute = NowMinute + 1;
        }
        if (NowMinute > 59) {
            NowMinute = 0;
            NowHour = NowHour + 1;
        }
        $(".doproblemstimenow").html("<b>" + NowHour + "</b>时<b>" + NowMinute + "</b>分<b>" + NowSecond + "</b>秒");
        $("#hour").html(NowHour);
        $("#minute").html(NowMinute);
        $("#second").html(NowSecond);
        secondNum = NowHour * 3600 + NowMinute * 60 + NowSecond;
        stoptime = "showtime(" + NowHour + "," + NowMinute + "," + NowSecond + "," + timetype + ")";
        timerID = setTimeout(stoptime, 1000);
    }

}
//倒计时执行
function startclock(Hours, Minutes, Seconds, timetype) {
    showtime(Hours, Minutes, Seconds, timetype);
}
//获取作答历史
function GetHistoryListByID(hid) {
    $.ajax({
        url: '../../Service/ExamRoom/Exam_HistoryListHandler.ashx',
        type: 'POST',
        async: false,
        data: {
            "key": "GetHistoryList",
            "HID": hid,
            "UID": $("#UID").val()
        },
        dataType: 'text',
        timeout: 80000,
        error: function () {
        },
        success: function (e) {
            ExamHistory = eval(e); //答题历史
            try {
                ExamRecordList = eval(ExamHistory[0].aInformation);  //答题信息集合
                secondNum = eval(ExamHistory[0].aTime);
            } catch (e) {
                layer.msg('无答题记录！');
            }
        }
    });
}
//根据作答题目继续做题
function GetansID() {
    $.ajax({
        url: '../../Service/ExamRoom/Exam_AnswerSheetHandler.ashx',
        type: 'POST',
        async: false,
        data: {
            "key": "selectallAnswerSheet",
            "CID": $("#HFQID").val(),
            "UID": $("#UID").val(),
            "RID": $("#HRID").val(),
            "PARENTID": $("#HPARENTID").val()
        },
        dataType: 'text',
        timeout: 80000,
        error: function () {
        },
        success: function (data) {
            //答题历史
            var datag = eval("[" + data + "]");
            var list = "";
            for (var b = 0; b < datag[0].length; b++) {
                var cao = datag[0][b].solution;
                list += ',' + cao;
            }

            var mlist = list.substring(1);
            var nlist = eval("[" + mlist + "]");

            ExamRecordList = eval(nlist);  //答题信息集合

        }
    });
}



//根据章节ID获取题型并绑定题目信息
function GetShowTypeName(cid) {
    $.ajax({
        url: '/Service/ExamRoom/ExamHandler.ashx',
        type: 'POST',
        async: true,
        data: {
            "key": "GetShowTypeName",
            "CID": $("#HFQID").val()
        },
        dataType: 'text',

        timeout: 100000,

        success: function (e) {
            if (e == "0") {
                alert("获取数据异常")
                location.href = "javascript: history.back()";
            } else if (e == "-1") {
                layer.open({
                    type: 2,
                    title: '登录',
                    shadeClose: true,
                    shade: 0.8,
                    area: ['401px', '502px'],
                    content: '/loginPopupWindow.aspx' //iframe的url
                });
            }
            else {
                var data = eval("[" + e + "]");

                document.getElementById('Title_ChapterName').style.visibility = "visible";
                $("#Title_ChapterName").html(data[0].chapterName);
                document.getElementById('contentleftscoretwo').style.display = "none";

                var caonimar = $("#SID").val();

                var hour = 0;
                var minute = 0;
                var seconds = 0;
                var type = 1;
                if (DoHistoryID > 0) {
                    GetHistoryListByID(DoHistoryID); //获取作答记录
                    hour = Math.floor(secondNum / 3600);
                    minute = Math.floor((secondNum - 3600 * hour) / 60);
                    seconds = secondNum - hour * 3600 - minute * 60
                }
                startclock(hour, minute, seconds, type);
                GetansID();
                $("#answer_card").html("");
                for (var i = 0; i < data[0].showType.length; i++) {

                    $("#answer_card").append("<div class=\"dopronumbertype\"  showTypeID='" + data[0].showType[i].showTypeID + "'>" + data[0].showType[i].showTypeName + "</div><ul  titletpye=\"1\"    showTypeID=\"" + data[0].showType[i].showTypeID + "\"  class=\"dopronumbercont\" id=\"pannelShowType" + data[0].showType[i].showTypeID + "\"></ul><div style=\"height:39px;\"></div>");


                    if (data[0].showType[i].quesNormalData[0].typeNo == "1") {
                        htmlStr += "<div class=\"contentleftconttitletype\"   questiontypes=\"1\" showTypeID='" + data[0].showType[i].showTypeID + "' >  <h3>" + data[0].showType[i].showTypeName + "</h3>  <span id=\"type" + data[0].showType[i].quesNormalData[0].typeNo + "\">本题型共" + data[0].showType[i].quesNormalData.length + "  小题 , 每小题只选择一个正确答案，选对得分，多选、错选、不选均不得分。</span></div>  ";
                    }
                    else if (data[0].showType[i].quesNormalData[0].typeNo == "2") {
                        htmlStr += "<div class=\"contentleftconttitletype\"   questiontypes=\"1\" showTypeID='" + data[0].showType[i].showTypeID + "' >  <h3>" + data[0].showType[i].showTypeName + "</h3>  <span id=\"type" + data[0].showType[i].quesNormalData[0].typeNo + "\">本题型共" + data[0].showType[i].quesNormalData.length + "  小题 , 多选、漏选、错选、不选均不得分。</span></div>  ";
                    }
                    else if (data[0].showType[i].quesNormalData[0].typeNo == "3") {
                        htmlStr += "<div class=\"contentleftconttitletype\"   questiontypes=\"1\" showTypeID='" + data[0].showType[i].showTypeID + "' >  <h3>" + data[0].showType[i].showTypeName + "</h3>  <span id=\"type" + data[0].showType[i].quesNormalData[0].typeNo + "\">本题型共" + data[0].showType[i].quesNormalData.length + "  小题 , 不答、错答不得分，也不扣分。</span></div>  ";
                    }
                    else if (data[0].showType[i].quesNormalData[0].typeNo == "12") {
                        htmlStr += "<div class=\"contentleftconttitletype\"   questiontypes=\"1\" showTypeID='" + data[0].showType[i].showTypeID + "' >  <h3>" + data[0].showType[i].showTypeName + "</h3>  <span id=\"type" + data[0].showType[i].quesNormalData[0].typeNo + "\">本题型共" + data[0].showType[i].quesNormalData.length + "  小题 , 属于主观题</span></div>  ";
                    }
                    else if (data[0].showType[i].quesNormalData[0].typeNo == "9" || data[0].showType[i].quesNormalData[0].typeNo == "28") {
                        htmlStr += "<div class=\"contentleftconttitletype\"   questiontypes=\"1\" showTypeID='" + data[0].showType[i].showTypeID + "' >  <h3>" + data[0].showType[i].showTypeName + "</h3>  <span id=\"type" + data[0].showType[i].quesNormalData[0].typeNo + "\">本题型共" + data[0].showType[i].quesNormalData.length + "  小题 , 多选、漏选、错选、不选均不得分</span></div>  ";
                    }
                    else {
                        htmlStr += "<div class=\"contentleftconttitletype\"   questiontypes=\"1\" showTypeID='" + data[0].showType[i].showTypeID + "' >  <h3>" + data[0].showType[i].showTypeName + "</h3>  <span id=\"type" + data[0].showType[i].quesNormalData[0].typeNo + "\">本题型共" + data[0].showType[i].quesNormalData.length + "  小题 , 属于主观题</span></div>  ";
                    }
                    for (var w = 0; w < data[0].showType[i].quesNormalData.length; w++) {
                        itemNumber++;
                        var checked = "";
                        $("#pannelShowType" + data[0].showType[i].quesNormalData[w].showTypeID).append("<li  titlenumber=\"" + itemNumber + "\" titletpye=\"1\"   showTypeID=\"" + data[0].showType[i].showTypeID + "\"  questionID=\"" + data[0].showType[i].quesNormalData[w].iD + "\" class=\"" + checked + "\">" + itemNumber + "</li>");


                        var typeNo = data[0].showType[i].quesNormalData[w].typeNo;

                        Questions(typeNo, w, i, data, data[0].showType[i].showTypeName);

                    }
                }

                //加载题目类容

                var ytmlt = "    <font></font> <div class=\"doproblemsnumberstate\">   <div class=\"doproblemsnumberstatecont\">    <i class=\"statecont1\"></i><span>正确</span>   </div> <div class=\"doproblemsnumberstatecont\">   <i class=\"statecont2\"></i><span>错误</span>          </div>  <div class=\"doproblemsnumberstatecont\">    <i class=\"statecont4\"></i><span>未答</span> </div></div>";
                htmlStr += "   <div class=\"contentleftcontupordown contentleftconthidden\"> <span> <input type=\"button\" class=\"contentleftcontOnatopic\" value=\"上一题\"></input></span>";
                htmlStr += "<span> <input type=\"button\" class=\"contentleftcontNextquestion\" value=\"下一题\"></input></span></div>";

                ssshtml += "<div class=\"Errorpopupcont\"> <span>请详细填写反馈说明，方便我们改正错误：</span>  <ul class=\"Errorpopupli\"><li><label class=\"one\" ><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 含有错别字</label></li>";
                ssshtml += "<li><label class=\"two\"><input type=\"checkbox\" class=\"Errorcheckbox \"  name=\"Errorpopupli \"  /> 图片不显示</label></li>                <li><label class=\"three\"><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 答案不正确</label></li>";
                ssshtml += "<li><label class=\"four\"><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 解析不正确</label></li><li><label class=\"five\"><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 试题重复</label></li>";
                ssshtml += "  <li><label class=\"six\"><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 其他错误</label></li></ul>  <textarea class=\"Errorpopuptextarea\" id=\"Errorpopuptextarea\"  placeholder=\" 输入内容\" ></textarea> <div class=\"Errorpopupbtn\">  <a class=\"Errorcancel\">取消</a><a class=\"Errorsubmit\">提交</a> </div> </div>";

                $("#doproblemsnumberstate").html(ytmlt);

                $("#Errorpopup").html(ssshtml);
                document.getElementById('yongshi').style.display = "block";

                AcountAd();
                writenote();
                document.getElementById('intersect').style.display = "block";


            }
        }
    });
}



function Questions(typeNo, w, i, data, showTypeName) {

    if (typeNo == "2") {  //多选题模板
        htmlStr += ChoseAnswer(data[0].showType[i].quesNormalData[w], 0, showTypeName);
    }
    else if (typeNo == "1") {
        //单选
        htmlStr += ChoiceAndAnswer(data[0].showType[i].quesNormalData[w], 0, showTypeName);
    }
    else if (typeNo == "3") {
        //判断
        htmlStr += ChoiceAndAnswer(data[0].showType[i].quesNormalData[w], 0, showTypeName);
    }


    else if (typeNo == "12") {  //简答题模板
        htmlStr += ChoiceWenAndAnswer(data[0].showType[i].quesNormalData[w], showTypeName);

    }
    else if (typeNo == "9" || typeNo == "28") {
        //阅读理解题模板
        htmlStr += ChoiceWenanAndAnswer(data[0].showType[i].quesNormalData[w], data[0].showType[i].quesSonData, showTypeName);

    }

    else if (typeNo == "27") {  //简答题模板
        htmlStr += CaoDoAnswer(data[0].showType[i].quesNormalData[w], showTypeName);

    }


    else {

        htmlStr += OtherAnswer(data[0].showType[i].quesNormalData[w], data[0].showType[i].quesSonData, showTypeName);
        $(".jiexi ").removeClass($("jiexi ")).addClass($("jiexi ")).css('display', 'none');
    }

    if (ExamRecordList != null) {
        for (var f = 0; f < ExamRecordList.length; f++) {
            if (ExamRecordList[f].qID == data[0].showType[i].quesNormalData[w].iD) {
                checked = "dopronumberconton";
                break;
            }
        }
    }
}







//作答已完毕 不可答题
function HistoryListOk() {
    //不可选择选项
    $(".DetailTitletitleanswerChoice").click(function (event) {

        event.stopPropagation();
    });
    document.getElementById('intersect').style.display = "none";
    document.getElementById('insterecttwo').style.display = "none";
    stop();
    //计时停止
    clearTimeout(timerID);
}


function predictexam() {

    $("#dReport-papershare").click(function () {
        allaui_close.close();

        Accordingtowronganswer($(".DetailTitletitleactive ul li"));
    });


    $("#dReport-shareshow").click(function () {
        if ($("#HClassID").val() == "") {
            location.href = "Erdietest.aspx";
        } else {
            window.location.reload();
        }
    })


};


function stop() {
    document.getElementById('stop').style.display = "block";

    $("#stop").click(function () {
        var suspendedcancel = $.dialog({
            title: "&nbsp;<span style='font-size: 16px;color: #666;font-family: 'Microsoft Yahei';'>温馨提示</span>",
            width: "480px",
            height: "260px",
            content: " <div class=\"submitcont\">  <div class=\"submitimg\"> <i></i></div> <span> 您已提交</span> </div>",
            lock: true,
            fixed: true,
            opacity: 0.3,
            drag: false,
            padding: 0
        });
    });
    //弹窗取消
}
//根据试卷ID获取题型并绑定题目信息
function GetPaper(pid) {
    $.ajax({
        url: '../../Service/ExamRoom/ExamHandler.ashx',
        type: 'POST',
        async: true,
        data: {
            "key": "GetPaper",
            "PID": pid,
            "UID": $("#UID").val()
        },
        dataType: 'text',
        timeout: 80000,
        success: function (e) {
            if (e == "0") {
                alert("试题无");
            } else if (e == "-1") {
                layer.open({
                    type: 2,
                    title: '登录',
                    shadeClose: true,
                    shade: 0.8,
                    area: ['401px', '502px'],
                    content: '/loginPopupWindow.aspx' //iframe的url
                });
            } else {
                document.getElementById('insterecttwo').style.display = "block";
                var data = eval("[" + e + "]");


                document.getElementById('Title_ChapterName').style.visibility = "visible";
                $("#Title_ChapterName").html(data[0].onlineName);
                document.getElementById('contentleftscoretwo').style.display = "none";
                var htmlStr = ""; //题目字符串拼接
                var htmlStr = "";//获取简答题
                var hour = 1;
                var minute = 30;
                var seconds = 0;
                if (data[0].answerTime != null || data[0].answerTime != "") {
                    hour = 0;
                    minute = data[0].answerTime;
                    hour = parseInt(minute / 60);

                    minute = parseInt(minute % 60);
                    var seconds = 0;
                }
                var type = 0;
                if (DoHistoryID > 0) {
                    GetHistoryListByID(DoHistoryID); //获取作答记录
                    hour = Math.floor(secondNum / 3600);
                    minute = Math.floor((secondNum - 3600 * hour) / 60);
                    seconds = secondNum - hour * 3600 - minute * 60
                }
                $("#answer_card").html("");
                itemNumber = 0; //初始化。防止再次调用时序号不正确
                var QuesTotal = 0; //总题数
                var ScoreTotal = 0; //总分数


                for (var i = 0; i < data[0].stemList.length; i++) {
                    if (data[0].stemList[i].stemParentQuesList[0].question.showTypeID != 120) {
                        $("#answer_card").append("<div class=\"dopronumbertype\"  showTypeID='" + data[0].stemList[i].stemParentQuesList[0].question.showTypeID + "'>" + data[0].stemList[i].stemName + "</div><ul  titletpye=\"1\"    showTypeID=\"" + data[0].stemList[i].stemParentQuesList[0].question.showTypeID + "\"    class=\"dopronumbercont\" id=\"pannelShowType" + data[0].stemList[i].stemParentQuesList[0].question.showTypeID + "\"></ul><div style=\"height:39px;\"></div>");
                        htmlStr += "<div class=\"contentleftconttitletype\"   questiontypes=\"1\">  <h3>" + data[0].stemList[i].stemName + "</h3>  <span>本题型共 " + data[0].stemList[i].stemParentQuesList.length + "小题 , 每小题只选择一个正确答案，选对得分，多选、错选、不选均不得分。</span></div>  ";
                    }

                    for (var w = 0; w < data[0].stemList[i].stemParentQuesList.length; w++) {
                        itemNumber++;
                        var typeNo = data[0].stemList[i].stemParentQuesList[w].question.typeNo;
                        if (typeNo == "1" || typeNo == "2" || typeNo == "3") {
                            $("#pannelShowType" + data[0].stemList[i].stemParentQuesList[w].question.showTypeID).append("<li  titlenumber=\"" + itemNumber + "\" titletpye=\"1\"  score=\"" + data[0].stemList[i].stemParentQuesList[w].quesScore + "\"  showTypeID=\"" + data[0].stemList[i].stemParentQuesList[0].question.showTypeID + "\"  questionID=\"" + data[0].stemList[i].stemParentQuesList[w].question.iD + "\" class=\"" + checked + "\">" + itemNumber + "</li>");
                        }
                        else {
                            if (data[0].stemList[i].stemParentQuesList[w].question.showTypeID != 120) {
                                $("#pannelShowType" + data[0].stemList[i].stemParentQuesList[w].question.showTypeID).append("<li  titlenumber=\"" + itemNumber + "\" titletpye=\"1\" score=\"" + data[0].stemList[i].stemParentQuesList[w].quesScore + "\"   showTypeID=\"" + data[0].stemList[i].stemParentQuesList[0].question.showTypeID + "\"  questionID=\"" + data[0].stemList[i].stemParentQuesList[w].question.iD + "\" class=\"" + checked + "\">" + itemNumber + "</li>");
                            }

                        }
                        if (typeNo == "1" || typeNo == "2" || typeNo == "3") {  //选择题模板
                            if (typeNo == "2") {  //多选题模板

                                htmlStr += ChoseAnswer(data[0].stemList[i].stemParentQuesList[w].question, data[0].stemList[i].stemParentQuesList[w].quesScore, data[0].stemList[i].stemName);
                            }
                            else if (typeNo == "1") {


                                htmlStr += ChoiceAndAnswer(data[0].stemList[i].stemParentQuesList[w].question, data[0].stemList[i].stemParentQuesList[w].quesScore, data[0].stemList[i].stemName);
                            }
                            else {
                                htmlStr += ChoiceAndAnswer(data[0].stemList[i].stemParentQuesList[w].question, data[0].stemList[i].stemParentQuesList[w].quesScore, data[0].stemList[i].stemName);
                            }
                        }
                        else if (typeNo == "12") {  //简答题模板

                            htmlStr += ChoiceWenAndAnswer(data[0].stemList[i].stemParentQuesList[w].question, data[0].stemList[i].stemName);
                        }
                        else if (typeNo == "27") {  //操作题模版

                            htmlStr += CaoDoAnswer(data[0].stemList[i].stemParentQuesList[w].question, data[0].stemList[i].stemName);
                        }
                        else if (typeNo == "9" || typeNo == "28") {
                            htmlStr += ChoiceWenanAndAnswer(data[0].stemList[i].stemParentQuesList[w].question, data[0].stemList[i].stemSonQuesList, data[0].stemList[i].stemName);

                        }
                        else if (typeNo == "29") {

                        }
                        else {

                            //  htmlStr += OtherAnswer(data[0].stemList[i].stemParentQuesList[w].question, data[0].stemList[i].stemParentQuesList[w].question);
                        }
                        var checked = "";
                        if (ExamRecordList != null) {
                            for (var f = 0; f < ExamRecordList.length; f++) {
                                if (ExamRecordList[f].qID == data[0].stemList[i].stemParentQuesList[w].question.iD) {
                                    checked = "dopronumberconton";
                                    break;
                                }
                            }
                        }
                    }
                }

                var PaperInfo = "    <div class=\"contentleftscorecont\"><h3>" + data[0].onlineName + "</h3> <ul class=\"contentleftscoreshow\">"
                PaperInfo += "<li>本次题目共：<span class=\"allQuestionNUM\">0</span>道</li> <li>答对题：<span id=\"ErrorNum\">0</span>道</li>";
                PaperInfo += "  <li>得分：<span id=\"Score\">0</span>分</li><li>剩余时长：<span id=\"hour\" >0</span>时<span  id=\"minute\">0</span>分<span id=\"second\">0</span>秒</li><li>交卷时间：<span id=\"submit\"></span></li>   </ul>   </div>"

                document.getElementById('contentlefttopspan').style.display = "block";
                $("#contentleftscoretwo").html(PaperInfo);
                htmlStr += "   <div class=\"contentleftcontupordown contentleftconthidden\"> <span> <input type=\"button\" class=\"contentleftcontOnatopic\" value=\"上一题\"></input></span>";
                htmlStr += "<span> <input type=\"button\" class=\"contentleftcontNextquestion\" value=\"下一题\"></input></span></div>";

                ssshtml += "<div class=\"Errorpopupcont\"> <span>请详细填写反馈说明，方便我们改正错误：</span>  <ul class=\"Errorpopupli\"><li><label class=\"one\" ><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 含有错别字</label></li>";
                ssshtml += "<li><label class=\"two\"><input type=\"checkbox\" class=\"Errorcheckbox \"  name=\"Errorpopupli \"  /> 图片不显示</label></li>                <li><label class=\"three\"><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 答案不正确</label></li>";
                ssshtml += "<li><label class=\"four\"><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 解析不正确</label></li><li><label class=\"five\"><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 试题重复</label></li>";
                ssshtml += "  <li><label class=\"six\"><input type=\"checkbox\" class=\"Errorcheckbox \" name=\"Errorpopupli\"  /> 其他错误</label></li></ul>  <textarea class=\"Errorpopuptextarea\" id=\"Errorpopuptextarea\"  placeholder=\" 输入内容\" ></textarea> <div class=\"Errorpopupbtn\">  <a class=\"Errorcancel\">取消</a><a class=\"Errorsubmit\">提交</a> </div> </div>";

                document.getElementById('as').style.display = "none";
                document.getElementById('asc').style.display = "none";
                var ytmlt = "    <font></font> <div class=\"doproblemsnumberstate\">   <div class=\"doproblemsnumberstatecont\" id=\"xo\" style=\"display:none;\">    <i class=\"statecont1\"></i><span>正确</span>   </div> <div class=\"doproblemsnumberstatecont\" id=\"yo\" style=\"display:none;\">   <i class=\"statecont2\"></i><span>错误</span>          </div>  <div class=\"doproblemsnumberstatecont\" id=\"zo\" style=\"display:block;\">     <i class=\"statecont5\"></i><span>已答</span> </div> <div class=\"doproblemsnumberstatecont\">    <i class=\"statecont4\"></i><span>未答</span> </div></div>";
                $("#doproblemsnumberstate").html(ytmlt);
                AcountAd();

                $("#Errorpopup").html(ssshtml);

                $("#doproblemsnumberstate").html(ytmlt);

                document.getElementById('daojishi').style.display = "block";

                $(".jiexi ").removeClass($("jiexi ")).addClass($("jiexi ")).css('display', 'none');
                $(".allQuestionNUM").html(itemNumber);

                writenote();

                startclock(hour, minute, seconds, type);

            }
        }
    });
}

//答题卡数目统计
function doproblemssheet() {
    var conttitlenumber = $(".contentleft .contentleftcont").find(".DetailTitlecontent");

    var answerShortnumber = $("#answer_card .dopronumberconton1").length;

    $(".contentright .doproblemssheet b").text(answerShortnumber + "/" + conttitlenumber.length);
}

//答题卡题目样式
function doproblemsnumberstyle(one, showTypeID) {
    var titlenumber = $(one).parent().parent().parent().parent().attr("titlenumber");

    var questiontypes = $(one).parent().parent().parent().parent().attr("questiontypes");

    if (questiontypes == 1) {
        var titletpye = $(".doproblemsnumber .dopronumbercont[titletpye='" + questiontypes + "']").find("li[titlenumber='" + titlenumber + "']");
    }

    else {

        var titletpye = $(".doproblemsnumber  .dopronumbercont[titletpye='" + questiontypes + "']").find("li[titlenumber='" + titlenumber + "']");

    }

    $(titletpye).parent().parent().find(".dopronumberconton4").removeClass("dopronumberconton4");

    $(titletpye).removeClass("dopronumberconton1");
    $(titletpye).removeClass("dopronumberconton2");
    $(titletpye).removeClass("dopronumberconton3");

    if (showTypeID != 0) {
        $(titletpye).addClass("dopronumberconton1");
    }
}
//答题卡新增样式3
function doproblemsnumberstyletthree(titlenumber, questiontypes, showTypeID) {

    if (questiontypes == 1) {
        var titletpye = $(".doproblemsnumber .dopronumbercont[titletpye='" + questiontypes + "']").find("li[titlenumber='" + titlenumber + "']");
    }
    else {
        var titletpye = $(".doproblemsnumber  .dopronumbercont[titletpye='" + questiontypes + "']").find("li[titlenumber='" + titlenumber + "']");
    }

    $(titletpye).parent().parent().find(".dopronumberconton4").removeClass("dopronumberconton4");
    if (true) {
        $(titletpye).removeClass("dopronumberconton1");
    }


    $(titletpye).removeClass("dopronumberconton2");
    $(titletpye).removeClass("dopronumberconton3");
    if (showTypeID != 0) {
        $(titletpye).addClass("dopronumberconton1");
    }
}



var problemnumber = 0;//切换单题模式题目位置变量


//赞和踩
function zancai() {
    //顶，踩
    $(".netfriendassiston .netfriendpraise").click(function () {
        if ($(this).hasClass('netfriendpraise2')) {
            $(this).removeClass("netfriendpraise2");
        }
        else {
            $(this).addClass("netfriendpraise2");
            $(this).next().removeClass("netfriendstamp2");
        }
    });
    $(".netfriendassiston .netfriendstamp").click(function () {
        if ($(this).hasClass('netfriendstamp2')) {
            $(this).removeClass("netfriendstamp2");
        }
        else {
            $(this).addClass("netfriendstamp2");
            $(this).prev().removeClass("netfriendpraise2");
        }
    });

}



function AcountAd() {
    // $(document)
    $(document).on("click", ".m-sonitem_item .AcountAdd", function () {

        var temp_obj = $(this).parent().parent().parent();
        $(temp_obj).append("<div class=\"m-sonitem_item\">" + AccountingConf + "</div>");

    });
    //会计分录题删除
    $(document).on("click", ".m-sonitem_item .AcountDelete", function () {

        var temp_obj = $(this).parent().parent().parent();
        var totalTemp = $(temp_obj).find(".m-sonitem_item").length;

        var titlenumber = $(this).parent().parent().parent().parent().parent().parent().attr("titlenumber");
        var questiontypes = $(this).parent().parent().parent().parent().parent().parent().attr("questiontypes");
        var showtypeid = $(this).parent().parent().parent().parent().parent().parent().attr("showtypeid");

        var parentObj = $(this).parent().parent();
        if (totalTemp > 1) {
            $(parentObj).remove();
            var dolen = $(".AccountOneValue,.m-sonitem_item .AccountValue").parents('.DetailTitlecontent').find("select[data-check='1']").length;
            var dolen2 = $(".AccountOneValue,.m-sonitem_item .AccountValue").parents('.DetailTitlecontent').find("input[data-check='1']").length;
            var dolen3 = dolen + dolen2;

            if (dolen3 > 0) {
                doproblemsnumberstyletthree(titlenumber, questiontypes, showtypeid);

                doproblemssheet();
            }
            else {
                doproblemsnumberstyletthree(titlenumber, questiontypes, 0);
                doproblemssheet();
            }
        }


    });

}




//事件
function writenote() {


    //阅读理解
    $(".DetailTitletitReading ul li").click(function () {
        //var linumber = $(this).index();
        //var li = $(this).parent().parent().next().children();

        if ($(this).hasClass('cont-topic-answer-this')) {
            $(this).removeClass("cont-topic-answer-this");//当前标签移除样式
            $(this).find("i").attr("data-check", "0");
            if ($(this).parents('.DetailTitlecontent').find("i[data-check='1']").length==0) {
                doproblemsnumberstyle(this, 0);
                doproblemssheet();//答题数目
            }
        } else {
            $(this).parent().find("li").removeClass("cont-topic-answer-this");//清楚当前样式
            $(this).addClass("cont-topic-answer-this");//当前标签加入样式

            doproblemsnumberstyle(this, 1);
            $(this).parent().find("i").attr("data-check", "0");
            $(this).find("i").attr("data-check", "1");
            console.info("31");

            if ($(this).parents('.DetailTitlecontent').find("i[data-check='1']").length > 0) {
                doproblemssheet();//答题数目
                Accordingtowronganswer(this);
            }




        }
    });


    //计算分析题作答
    $(document).on("keyup", ".AccountOneValue,.m-sonitem_item .AccountValue", function () {

        var word = $.trim($(this).val());

        if (!isNaN(word)) {
        }
        else {

        }

        if (word == "") {
            $(this).attr("data-check", "0");
        } else {
            $(this).attr("data-check", "1");
        }
        //判断是否已答

        var dolen = $(this).parents('.DetailTitlecontent').find("select[data-check='1']").length;
        var dolen2 = $(this).parents('.DetailTitlecontent').find("input[data-check='1']").length;
        var dolen3 = dolen + dolen2;


        var QuestID = $(this).parents('.DetailTitlecontent').attr("ID");

        var titlenumber = $(this).parent().parent().parent().parent().attr("titlenumber");
        if (titlenumber == undefined) {
            titlenumber = $(this).parent().parent().parent().parent().parent().attr("titlenumber");
        }

        var questiontypes = $(this).parent().parent().parent().parent().attr("questiontypes");
        var showtypeid = $(this).parents('.DetailTitlecontent').attr("showtypeid");
        if (questiontypes == undefined) {
            questiontypes = $(this).parent().parent().parent().parent().parent().attr("questiontypes");
        }


        if (dolen3 > 0) {
            doproblemsnumberstyletthree(titlenumber, questiontypes, showtypeid);

            doproblemssheet();

        } else {
            doproblemsnumberstyletthree(titlenumber, questiontypes, 0);
            doproblemssheet();
        }


    });




    //计算分析题-会计分录-选项
    $(document).on("change", " .m-sonitem_item .ddlOne,.m-sonitem_item .ddlTwo", function () {
        var word = $.trim($(this).val());
        if (word == "") {
            $(this).attr("data-check", "0");
        } else {
            $(this).attr("data-check", "1");
        }

        //判断是否已答
        var dolen = $(this).parents('.DetailTitlecontent').find("select[data-check='1']").length;
        var dolen2 = $(this).parents('.DetailTitlecontent').find("input[data-check='1']").length;
        var dolen3 = dolen + dolen2;

        var QuestID = $(this).parents('.DetailTitlecontent').attr("ID");
        var showtypeid = $(this).parents('.DetailTitlecontent').attr("showtypeid");
        var titlenumber = $(this).parent().parent().parent().parent().parent().attr("titlenumber");
        var questiontypes = $(this).parent().parent().parent().parent().parent().attr("questiontypes");

        if (dolen3 > 0) {
            doproblemsnumberstyletthree(titlenumber, questiontypes, showtypeid);
            doproblemssheet();
        } else {
            doproblemsnumberstyletthree(titlenumber, questiontypes, 0);
            doproblemssheet();
        }
    });
    ///简答题答案输入
    $(".multiple-text").keyup(function () {
        var QuestID = $(this).parents('.DetailTitlecontent').attr("ID");
        var showtypeid = $(this).parents('.DetailTitlecontent').attr("showtypeid");

        doproblemsnumberstyle(this, showtypeid);
        doproblemssheet();
    });


    //切换单题模式，多题模式
    $(".doproblemssetmodel div span").click(function () {
        $(".doproblemssetmodel div span").removeClass("doproblemssetmodelclick");
        $(this).addClass("doproblemssetmodelclick");
        if ($(this).text() == "单题模式") {
            $(".contentleft .contentleftcont").children().addClass("contentleftconthidden");
            $(".contentleft .contentleftcont").find(".contentleftcontupordown").removeClass("contentleftconthidden");

            var questiontypes = $(".contentleft .contentleftcont ").find(".contentleftconttitletop:eq(" + problemnumber + ")").attr("questiontypes") - 1;
            $(".contentleft .contentleftcont ").find(".contentleftconttitletype:eq(" + questiontypes + ")").removeClass("contentleftconthidden");
            $(".contentleft .contentleftcont ").find(".contentleftconttitletop:eq(" + problemnumber + ")").removeClass("contentleftconthidden");
            $(".contentleft .contentleftcont ").find(".DetailTitlecontent:eq(" + problemnumber + ")").removeClass("contentleftconthidden");

            $(".DetailTitletitleactive ul li .packupparsing").removeClass("packupparsing2");
            $(".DetailTitletitleactive ul li .parsing").removeClass("parsing2");
            $(".DetailTitlecontent .DetailTitleparsing").removeClass("DetailTitleparsing2");

            $("body,html").animate({ scrollTop: $(".contentleft").offset().top - 60 });


        } else {
            $(".contentleft .contentleftcont").children().removeClass("contentleftconthidden");
            $(".contentleft .contentleftcont").find(".contentleftcontupordown").addClass("contentleftconthidden");

            $(".DetailTitletitleactive ul li .packupparsing").removeClass("packupparsing2");
            $(".DetailTitletitleactive ul li .parsing").removeClass("parsing2");
            $(".DetailTitlecontent .DetailTitleparsing").removeClass("DetailTitleparsing2");

        }
    });





    //调整字体的大小
    $(".doproblemssetfont a").click(function () {
        $(".doproblemssetfont a").removeClass("doproblemssetfontclick");
        $(this).addClass("doproblemssetfontclick");
        $(".contentleft .contentleftcont .DetailTitlecontent .DetailTitletitle").find(".DetailTitletitlecont").removeClass("DetailTitletitlecontfontsize1");
        $(".contentleft .contentleftcont .DetailTitlecontent .DetailTitletitle").find(".DetailTitletitlecont").removeClass("DetailTitletitlecontfontsize2");
        $(".contentleft .contentleftcont .DetailTitlecontent .DetailTitletitle").find(".DetailTitletitlecont").removeClass("DetailTitletitlecontfontsize3");
        $(".contentleft .contentleftcont .DetailTitlecontent .DetailTitletitle").find(".DetailTitletitlecontmoreselect").removeClass("DetailTitletitlecontfontsize1");
        $(".contentleft .contentleftcont .DetailTitlecontent .DetailTitletitle").find(".DetailTitletitlecontmoreselect").removeClass("DetailTitletitlecontfontsize2");
        $(".contentleft .contentleftcont .DetailTitlecontent .DetailTitletitle").find(".DetailTitletitlecontmoreselect").removeClass("DetailTitletitlecontfontsize3");
        $(".contentleft .contentleftcont .DetailTitlecontent .DetailTitletitle").find(".DetailTitletitlecontShort").removeClass("DetailTitletitlecontfontsize1");
        $(".contentleft .contentleftcont .DetailTitlecontent .DetailTitletitle").find(".DetailTitletitlecontShort").removeClass("DetailTitletitlecontfontsize2");
        $(".contentleft .contentleftcont .DetailTitlecontent .DetailTitletitle").find(".DetailTitletitlecontShort").removeClass("DetailTitletitlecontfontsize3");
        if ($(this).text() == "大") {
            $(".contentleft .contentleftcont .DetailTitlecontent .DetailTitletitle").find(".DetailTitletitlecont").addClass("DetailTitletitlecontfontsize1");
            $(".contentleft .contentleftcont .DetailTitlecontent .DetailTitletitle").find(".DetailTitletitlecontmoreselect").addClass("DetailTitletitlecontfontsize1");
            $(".contentleft .contentleftcont .DetailTitlecontent .DetailTitletitle").find(".DetailTitletitlecontShort").addClass("DetailTitletitlecontfontsize1");
        }
        else if ($(this).text() == "小") {
            $(".contentleft .contentleftcont .DetailTitlecontent .DetailTitletitle").find(".DetailTitletitlecont").addClass("DetailTitletitlecontfontsize3");
            $(".contentleft .contentleftcont .DetailTitlecontent .DetailTitletitle").find(".DetailTitletitlecontmoreselect").addClass("DetailTitletitlecontfontsize3");
            $(".contentleft .contentleftcont .DetailTitlecontent .DetailTitletitle").find(".DetailTitletitlecontShort").addClass("DetailTitletitlecontfontsize3");
        }
        else {
            $(".contentleft .contentleftcont .DetailTitlecontent .DetailTitletitle").find(".DetailTitletitlecont").addClass("DetailTitletitlecontfontsize2");
            $(".contentleft .contentleftcont .DetailTitlecontent .DetailTitletitle").find(".DetailTitletitlecontmoreselect").addClass("DetailTitletitlecontfontsize2");
            $(".contentleft .contentleftcont .DetailTitlecontent .DetailTitletitle").find(".DetailTitletitlecontShort").addClass("DetailTitletitlecontfontsize2");
        }
    });

    //调用计算答题数目
    doproblemssheet();
    //单选 选项
    $(".DetailTitletitlecont ul li").click(function () {
        var linumber = $(this).index();
        var li = $(this).parent().parent().next().children();
        $(this).parent().children().attr("data-check", 0);
        if ($(this).hasClass('cont-topic-answer-this')) {
            $(this).removeClass("cont-topic-answer-this");//当前标签移除样式

            doproblemsnumberstyle(this, 0);
            doproblemssheet();//答题数目
        } else {
            $(this).parent().find("li").removeClass("cont-topic-answer-this");//清楚当前样式
            $(this).addClass("cont-topic-answer-this");//当前标签加入样式

            doproblemsnumberstyle(this, 1);
            $(this).attr("data-check", 1);
            doproblemssheet();//答题数目
            var SelectedRadioAnswer = $(this).attr("answer");//用户选中的答案是否正确  1正确 0错误

            var idd = $(this).attr("data-id");

            if ($(".doproblemssetanswer select").val() == "作答后显示答案") {
                if (SelectedRadioAnswer == 1) {
                    $("#answer_card").find("li[questionid='" + idd + "']").removeClass("dopronumberconton1");
                    $("#answer_card").find("li[questionid='" + idd + "']").addClass("dopronumberconton3");
                } else {
                    $("#answer_card").find("li[questionid='" + idd + "']").removeClass("dopronumberconton1");
                    $("#answer_card").find("li[questionid='" + idd + "']").addClass("dopronumberconton2");
                }
                Accordingtowronganswer(this);//显示答案
            } else if ($(".doproblemssetanswer select").val() == "作答正确下一题，错误显示答案") {
                if (SelectedRadioAnswer == 1) {
                    $("#answer_card").find("li[questionid='" + idd + "']").removeClass("dopronumberconton1");
                    $("#answer_card").find("li[questionid='" + idd + "']").addClass("dopronumberconton3");
                    automaticNextquestion(this);//正确下一题
                }
                else {
                    $("#answer_card").find("li[questionid='" + idd + "']").removeClass("dopronumberconton1");
                    $("#answer_card").find("li[questionid='" + idd + "']").addClass("dopronumberconton2");
                    Accordingtowronganswer(this);
                }
            }
            else if ($(".doproblemssetanswer select").val() == "自动下一题") {
                automaticNextquestion(this);
            }


        }




    });

    //多项选择
    $(".DetailTitletitlecontmoreselect ul li").click(function () {

        if ($(this).hasClass('cont-topic-answer-this')) {
            $(this).removeClass("cont-topic-answer-this");//当前标签移除样式

            var datatype = $('.DetailTitlecontent').attr("data-type");
            if (datatype == 9) {
                var idd = $(this).attr("data-id");
                datatype = $(this).attr("data-type");
                if (datatype == 2) {

                    return;
                }

                var dc = $(this).parents().find("li[data-check='1']li[data-id='" + idd + "']").length;

                var titlenumber = $(this).parent().parent().parent().parent().attr("titlenumber");

                var questiontypes = $(this).parent().parent().parent().parent().attr("questiontypes");
                doproblemsnumberstyle(this, 0);
                doproblemssheet();//答题数目
            } else {
                $(this).attr("data-check", 0);
                var idd = $(this).attr("data-id");

                var dc = $(this).parents().find("li[data-check='1']li[data-id='" + idd + "']").length;

                var titlenumber = $(this).parent().parent().parent().parent().attr("titlenumber");

                var questiontypes = $(this).parent().parent().parent().parent().attr("questiontypes");
                if (dc == 0) {
                    doproblemsnumberstyletthree(titlenumber, questiontypes, 0);

                    doproblemssheet();//答题数目
                }
            }
        } else {

            $(this).attr("data-check", 1);
            var idd = $(this).attr("data-id");
            $(this).addClass("cont-topic-answer-this");//当前标签加入样式
            var datatype = $('.DetailTitlecontent').attr("data-type");
            var showtypeid = $('.DetailTitlecontent').attr("showtypeid");
            if (datatype == 9) {

                doproblemsnumberstyletthree(titlenumber, questiontypes, showtypeid);
                doproblemssheet();
            } else {
                var dc = $(this).parents().find("li[data-check='1']li[data-id='" + idd + "']").length;

                var titlenumber = $(this).parent().parent().parent().parent().attr("titlenumber");

                var questiontypes = $(this).parent().parent().parent().parent().attr("questiontypes");
                if (dc > 0) {
                    doproblemsnumberstyletthree(titlenumber, questiontypes, showtypeid);
                    doproblemssheet();
                }


            }


        }




    });

    //多选答题选项
    $(".DetailTitletitleanswermoreselect ul li").click(function () {

        if ($(this).children().hasClass('DetailTitletitleansweronclick')) {

            if ($(this).children().hasClass('DetailTitletitleansweronclick')) {
                var datatype = $('.DetailTitlecontent').attr("data-type");
                //
                if (datatype == 9) {
                    var idd = $(this).attr("data-id");
                    var id2 = $(this).parent().parent().prev().attr("id");
                    datatype = $(this).parent().parent().prev().attr("data-type");
                    if (datatype == 2) {
                        $(this).children().removeClass("DetailTitletitleansweronclick").addClass(".DetailTitletitleansweronclick").attr("data-check", 0);
                        $(this).children().children().removeClass("DetailTitletitleanswerChoice2");
                        $('.DetailTitletitleanswerChoice2').addClass("DetailTitletitleanswerChoice2").attr("data-check", 0);
                        datacheck = $('.DetailTitletitleansweronclick').attr("data-check");
                        var dc = $(this).parents().find("a[data-check='1']a[data-id='" + idd + "']").length;


                        var titlenumber = $(this).parent().parent().parent().parent().attr("titlenumber");

                        var questiontypes = $(this).parent().parent().parent().parent().attr("questiontypes");
                        if (dc == 0) {
                            doproblemsnumberstyletthree(titlenumber, questiontypes, 0);
                            doproblemssheet();
                        }
                        return;
                    }

                }
                $(this).children().removeClass("DetailTitletitleansweronclick").addClass(".DetailTitletitleansweronclick").attr("data-check", 0);
                $(this).children().children().removeClass("DetailTitletitleanswerChoice2");
                $('.DetailTitletitleanswerChoice2').addClass("DetailTitletitleanswerChoice2").attr("data-check", 0);
                var idd = $(this).attr("data-id");

                var dc = $(this).parents().find("a[data-check='1']a[data-id='" + idd + "']").length;
                var titlenumber = $(this).parent().parent().parent().parent().attr("titlenumber");

                var questiontypes = $(this).parent().parent().parent().parent().attr("questiontypes");
                if (dc == 0) {
                    doproblemsnumberstyletthree(titlenumber, questiontypes, 0);

                    doproblemssheet();//答题数目
                }


            }
        }
        else {

            var showtypeid = $('.DetailTitlecontent').attr("showtypeid");
            var datatype = $('.DetailTitlecontent').attr("data-type");

            if (datatype != "" || datatype != null) {
                if (datatype == 9) {
                    var idd = $(this).attr("data-id");
                    var id2 = $(this).parent().parent().prev().attr("id");
                    datatype = $(this).parent().parent().prev().attr("data-type");
                    if (datatype == 2) {
                        datacheck = $('.DetailTitletitleansweronclick').attr("data-check");
                        $(this).children().children().addClass("DetailTitletitleanswerChoice2");
                        $(this).children().addClass("DetailTitletitleansweronclick");
                        $('.DetailTitletitleansweronclick').removeClass(".DetailTitletitleansweronclick").addClass(".DetailTitletitleansweronclick").attr("data-check", 1);
                        $('.DetailTitletitleanswerChoice2').removeClass(".DetailTitletitleanswerChoice2").addClass("DetailTitletitleanswerChoice2").attr("data-check", 1);
                        datacheck = $('.DetailTitletitleansweronclick').attr("data-check");
                        var dc = $(this).parents().find("a[data-check='1']a[data-id='" + idd + "']").length;
                        var titlenumber = $(this).parent().parent().parent().parent().attr("titlenumber");

                        var questiontypes = $(this).parent().parent().parent().parent().attr("questiontypes");
                        if (dc > 0) {

                            doproblemsnumberstyletthree(titlenumber, questiontypes, showtypeid);
                            doproblemssheet();
                        }

                        return;
                    }
                }
                var idd = $(this).attr("data-id");

                datacheck = $('.DetailTitletitleansweronclick').attr("data-check");
                var dc = $(this).parents().find("a[data-check='1']a[data-id='" + idd + "']").length + 1;

                $(this).children().children().addClass("DetailTitletitleanswerChoice2");
                $(this).children().addClass("DetailTitletitleansweronclick");

                $('.DetailTitletitleansweronclick').removeClass(".DetailTitletitleansweronclick").addClass(".DetailTitletitleansweronclick").attr("data-check", 1);
                $('.DetailTitletitleanswerChoice2').removeClass(".DetailTitletitleanswerChoice2").addClass("DetailTitletitleanswerChoice2").attr("data-check", 1);
                var titlenumber = $(this).parent().parent().parent().parent().attr("titlenumber");

                var questiontypes = $(this).parent().parent().parent().parent().attr("questiontypes");
                if (dc > 0) {
                    doproblemsnumberstyletthree(titlenumber, questiontypes, showtypeid);
                    doproblemssheet();
                }


            }
        }

    });




    //收起和显示解析，收藏，纠错
    $(".DetailTitletitleactive ul li").click(function () {

        //解析
        var parsing = $(this).parent().parent().parent().next();
        var id = $(this).parent().parent().parent().parent().attr("id");
        var idd = id + id + id + id + id;

        if ($(this).parent().parent().parent().parent().attr("data-type")==27) {
            //解析
            Showhiddenparsing(this);
            //视频解析
            if ($(this).children().hasClass('videoresolution')) {
                var dataid = $(this).children().attr("data-id");
                // window.top.location.href = "/DetailVideo/" + dataid + ".html";

                window.open("/DetailVideo/" + dataid + ".html");
            }
        }


        var notesingbtn = $(this).parent().parent().parent().next().find(".DetailTitleparsingnotes");
        var notesing = $(this).parent().parent().parent().next().find(".DetailTitleparsingtakenotes");
        if ($(this).children().hasClass('packupparsing') && $(this).children().hasClass('packupparsing2')) {
            $(this).children().removeClass('packupparsing2');
            $(this).find(".parsing").text("查看答案");
            $(parsing).removeClass("DetailTitleparsing2");
            $(this).parent().parent().parent().find(".DetailTitletitReadingYouranswerthis").css('display', 'none');
            $(notesingbtn).find(".netfriendnotes").removeClass("netfriendnotes2");
            $(notesingbtn).find(".takenotes").removeClass("takenotes2")
            $(notesing).removeClass("DetailTitleparsingtakenotes2");
            $(notesing).next().removeClass("DetailTitlenetfriendnotes2");
            return;
        }
        if ($(this).children().hasClass('collectioning') && $(this).children().hasClass('collectioning2')) {
            $(this).find(".collectioning").removeClass('collectioning2');
            $(this).find(".collectionontology").removeClass('collectionontology2');
        }
        else if ($(this).children().hasClass('collectioning')) {
            $(this).find(".collectioning").addClass('collectioning2');
            $(this).find(".collectionontology").addClass('collectionontology2');
        }
        else if ($(this).children().hasClass('packupparsing')) {
            $('.' + idd + '').removeClass($('.' + idd + '')).addClass($('.' + idd + '')).css('display', 'block');
            $(this).parent().parent().parent().find(".DetailTitletitReadingYouranswerthis").css('display', 'block');
            $(this).children().addClass('packupparsing2');
            $(this).find(".parsing").text("隐藏答案")
            $(parsing).addClass("DetailTitleparsing2");
        }
        //纠错弹窗
        if ($(this).children().hasClass('Erroring')) {
            //纠错弹窗取消

            $(".Errorpopupli li label input").click(function () {
                if ($(this).parent().hasClass('checkboxclick')) {
                    $(this).parent().removeClass("checkboxclick");
                }
                else {
                    $(this).parent().addClass("checkboxclick");

                }
            });
        }
    });

    //上一题，下一题
    $(".contentleftcontOnatopic").click(function () {
        $(".contentleft .contentleftcont").find(".contentleftconttitletop").addClass("contentleftconthidden");
        $(".contentleft .contentleftcont").find(".DetailTitlecontent").addClass("contentleftconthidden");
        $(".contentleft .contentleftcont").find(".contentleftcontupordown").removeClass("contentleftconthidden");
        var divlenght = $(".contentleft .contentleftcont").find(".DetailTitlecontent").length - 1;
        if (problemnumber <= 0) {
            problemnumber = 0;
        } else {
            problemnumber = problemnumber - 1;
        }
        var questiontypes = $(".contentleft .contentleftcont").find(".contentleftconttitletop:eq(" + problemnumber + ")").attr("questiontypes") - 1;
        $(".contentleft .contentleftcont ").find(".contentleftconttitletype").addClass("contentleftconthidden");
        $(".contentleft .contentleftcont ").find(".contentleftconttitletype:eq(" + questiontypes + ")").removeClass("contentleftconthidden");
        $(".contentleft .contentleftcont").find(".contentleftconttitletop:eq(" + problemnumber + ")").removeClass("contentleftconthidden");
        $(".contentleft .contentleftcont").find(".DetailTitlecontent:eq(" + problemnumber + ")").removeClass("contentleftconthidden");
    });
    $(".contentleftcontNextquestion").click(function () {
        Nextquestion();
    });
    //提交，交卷，下次继续，返回弹窗
    $(".doproblemsactive .answersubmit").click(function () {
        if ($("#UID").val() == "" || $("#UID").val() == 0) {
            layer.open({
                type: 2,
                title: '登录',
                shadeClose: true,
                shade: 0.8,
                area: ['401px', '502px'],
                content: '/loginPopupWindow.aspx' //iframe的url
            });
            return;
        };

        $(".jiexi ").removeClass($("jiexi ")).addClass($("jiexi ")).css('display', 'block');
        var answerShortnumber = parseInt($("#answer_card .dopronumberconton1").length) + parseInt($("#answer_card .dopronumberconton2").length) + parseInt($("#answer_card .dopronumberconton3").length);
        var conttitlenumber = $(".contentleft .contentleftcont").find(".DetailTitlecontent").length;

        var RemainingNumber = conttitlenumber - answerShortnumber;
        var suspendedcancel = $.dialog({
            title: "&nbsp;<span style='font-size: 16px;color: #666;font-family: 'Microsoft Yahei';'>温馨提示</span>",
            width: "480px",
            height: "260px",
            content: " <div class=\"submitcont\">  <div class=\"submitimg\"> <i></i></div> <span>确定要提交吗？<br/>还剩" + RemainingNumber + "道题没做。</span> <div class=\"submitbtn\"> <a class=\"submitcancel\">取消</a><a class=\"submitsubmit\">确定</a> </div></div>",
            lock: true,
            fixed: true,
            opacity: 0.3,
            drag: false,
            padding: 0
        });
        //弹窗取消
        $(".submitcancel").click(function () {
            suspendedcancel.close();
        });
        $(".submitsubmit").click(function () {
            var number = 0; //没有作答数量
            clearTimeout(timerID);//暂停计时
            $("#answer_card li").each(function (x, v) {
                if ($(v).attr("class") != "dopronumberconton1") {
                    number++;
                }
            })
            var ajson = "";
            var titile = "";
            ajson = SubmitAnswer(1); //获取题目答案
            if (ajson != "") {
                ajson = "[" + ajson + "]";
                if ($("#HFQID").val() != 0) {
                    if (DoHistoryID != 0) {
                        $.ajax({
                            url: '../../Service/ExamRoom/Exam_HistoryListHandler.ashx',
                            type: 'POST',
                            async: false,
                            data: {
                                "key": "updateHistoryList",
                                "HID": DoHistoryID,
                                "QuestionNum": itemNumber,
                                "ErrorNum": ErrorNum,
                                "Score": 0,
                                "UID": $("#UID").val(),
                                "ATime": parseInt(secondNum),
                                "AInformation": ajson,
                                "AState": 0
                            },
                            dataType: 'text',
                            timeout: 80000,
                            success: function (Nodes) {
                                ErrorNum = 0;
                                if (Nodes != "-1") {
                                    if (Nodes >= 1) {
                                        $.ajax({
                                            url: '../../Service/ExamRoom/Exam_AnswerSheetHandler.ashx',
                                            type: 'POST',
                                            async: false,
                                            data: {
                                                "key": "addUpAnswerSheet",
                                                "ajson": ajson,
                                                "UID": $("#UID").val(),
                                                "CID": $("#HFQID").val(),
                                                "RID": $("#HRID").val(),
                                                "PARENTID": $("#HPARENTID").val()
                                            },
                                            dataType: 'text',
                                            timeout: 80000,
                                            success: function (Nodes) {
                                                //       console.info(Nodes);
                                                if (Nodes != "-1") {
                                                    if (Nodes == "1") {
                                                        art.dialog({ id: 'Tips' }).close(); //关闭加载提示
                                                        HistoryListOk();
                                                        suspendedcancel.close();
                                                        art.dialog.tips("提交答案成功", "3");


                                                    }
                                                    if (Nodes == "0") {
                                                        art.dialog({ id: 'Tips' }).close(); //关闭加载提示
                                                        suspendedcancel.close();
                                                        art.dialog.tips("提交答案失败", "3");

                                                    }
                                                }
                                            }
                                        });
                                    }
                                    if (Nodes == "0") {
                                        art.dialog({ id: 'Tips' }).close(); //关闭加载提示
                                        //    suspendedcancel.close();
                                        art.dialog.tips("更新失败", "2");
                                    }
                                }
                            }
                        });
                        return true;
                    }
                    else {
                        $.ajax({
                            url: '../../Service/ExamRoom/Exam_HistoryListHandler.ashx',
                            type: 'POST',
                            async: false,
                            data: {
                                "key": "addHistoryList",
                                "DoName": $("#Title_ChapterName").text(),
                                "TypeID": $("#TypeID").val(), //0章节 1知识点 2试卷
                                "CID": $("#HFQID").val(),
                                "QuestionNum": itemNumber,
                                "ErrorNum": ErrorNum,
                                "UID": $("#UID").val(),
                                "Score": 0,  //得分
                                "SanswerTime": DoDateTime,
                                "ATime": parseInt(secondNum),
                                "AInformation": ajson,
                                "AState": 0
                            },
                            dataType: 'text',
                            timeout: 80000,
                            success: function (Nodes) {
                                ErrorNum = 0;
                                if (Nodes != "-1") {
                                    if (Nodes >= 1) {
                                        $("#HFHID").val(Nodes);
                                        $.ajax({
                                            url: '../../Service/ExamRoom/Exam_AnswerSheetHandler.ashx',
                                            type: 'POST',
                                            async: false,
                                            data: {
                                                "key": "addUpAnswerSheet",
                                                "ajson": ajson,
                                                "UID": $("#UID").val(),
                                                "CID": $("#HFQID").val(),
                                                "RID": $("#HRID").val(),
                                                "PARENTID": $("#HPARENTID").val()
                                            },
                                            dataType: 'text',
                                            timeout: 80000,
                                            success: function (Nodes) {
                                                if (Nodes != "-1") {
                                                    if (Nodes == "1") {
                                                        art.dialog({ id: 'Tips' }).close(); //关闭加载提示
                                                        HistoryListOk();
                                                        suspendedcancel.close();

                                                        art.dialog.tips("提交答案成功", "3");

                                                        $(".packupparsing packupparsing2").show();
                                                        //  location.href = "DetailReport.aspx?CID=" + $("#HFQID").val() + "&UID=" + $("#UID").val();
                                                    }
                                                    if (Nodes == "0") {
                                                        art.dialog({ id: 'Tips' }).close(); //关闭加载提示
                                                        suspendedcancel.close();
                                                        art.dialog.tips("提交答案失败", "3");
                                                    }
                                                }
                                            }
                                        });
                                    }
                                    if (Nodes == "0") {

                                        suspendedcancel.close();

                                    }
                                }

                            }
                        });
                    }
                }

                else {
                    //art.dialog({ id: 'Tips' }).close(); //关闭加载提示
                    //suspendedcancel.close();
                    //art.dialog.tips("作答完毕", "3");
                    var dReporthtml = " <div class='dReport-contleftcont'>     <div> <div class='dReport-paperstat'> <i>" + allscore + "<b>分</b> </i></div> <ul class='dReport-questitu'>";
                    dReporthtml += " <li class='dReport-questitutitle'><span>题型</span> <span>得分</span>  <span>答对/总题</span> <span>错题数量</span>  <span>正确率</span></li>";


                    for (var l = 0; l < $("#answer_card").find(".dopronumbertype").length; l++) {

                        dReporthtml += "<li><span>" + $("#answer_card").find(".dopronumbertype").eq(l).text() + "</span>";
                        if (l == parseFloat($("#answer_card").find(".dopronumbertype").length - 1)) {
                            dReporthtml += " <span> " + totalscore + "</span>";


                        } else {
                            dReporthtml += " <span> " + parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='undefined dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton2 dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton1 dopronumberconton3']").length) * parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li").eq(0).attr("score")) + "</span>";
                        }


                        dReporthtml += " <span> <font>" + parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='undefined dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton2 dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton1 dopronumberconton3']").length) + "</font> / " + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li").length + "</span > <span><em>" + parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton2']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='undefined dopronumberconton2']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton3 dopronumberconton2']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton1 dopronumberconton2']").length) + "</em></span><span>" + parseFloat(parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='undefined dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton2 dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton1 dopronumberconton3']").length) * 100 / parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li").length)).toFixed(2) + "%</span></li >";

                    }
                    dReporthtml += "</ul></div> <ul class='dReport-papershare'><li><a href='javascript:void(0);' id='dReport-papershare'>全部解析</a></li> <li class='dReport-shareshow'><a id='dReport-shareshow' href='javascript:void(0);'>再来一批</a></li> </ul> </div>";

                    $("#detailReport").html(dReporthtml);
                    allaui_close = $.dialog({
                        title: "&nbsp;<span style='font-size: 16px;color: #666;font-family: 'Microsoft Yahei';'>答题情况</span>",
                        width: "965px",
                        height: "260px",
                        content: $("#detailReport").html(),
                        lock: true,
                        fixed: true,
                        opacity: 0.3,
                        drag: false,
                        padding: 0
                    });


                    predictexam();
                    return false;
                }
            }
            else {
                suspendedcancel.close();
                layer.msg('未作答');
            }

        });



    });
    $(".doproblemsactive .theirpapers").click(function () {
        if ($("#UID").val() == "" || $("#UID").val() == 0) {
            layer.open({
                type: 2,
                title: '登录',
                shadeClose: true,
                shade: 0.8,
                area: ['401px', '502px'],
                content: '/loginPopupWindow.aspx' //iframe的url
            });
            return;
        };
        var answerShortnumber = $("#answer_card .dopronumberconton1").length;
        var conttitlenumber = $(".contentleft .contentleftcont").find(".DetailTitlecontent").length;

        var RemainingNumber = conttitlenumber - answerShortnumber;

        var suspendedcancel = $.dialog({
            title: "&nbsp;<span style='font-size: 16px;color: #666;font-family: 'Microsoft Yahei';'>温馨提示</span>",
            width: "480px",
            height: "260px",
            content: $("#theirpapers").html(),
            content: "<div class=\"submitcont\">  <div class=\"submitimg\"> <i></i></div> <span>确定要提交吗？<br/>还剩" + RemainingNumber + "道题没做。</span> <div class=\"submitbtn\"> <a class=\"submitcancel\">取消</a><a class=\"submitsubmit\">确定</a> </div></div>",
            lock: true,
            fixed: true,
            opacity: 0.3,
            drag: false,
            padding: 0
        });

        //弹窗取消
        $(".submitcancel").click(function () {
            suspendedcancel.close();
        });
        $(".submitsubmit").click(function () {
            suspendedcancel.close();
            $(".jiexi ").removeClass($("jiexi ")).addClass($("jiexi ")).css('display', 'block');


            var number = 0; //没有作答数量
            clearTimeout(timerID);//暂停计时
            $("#answer_card li").each(function (x, v) {
                if ($(v).attr("class") != "dopronumberconton1") {
                    number++;
                }
            })
            var ajson = "";

            var titile = "";
            ajson = SubmitAnswer(1); //获取题目答案
            //做题时长
            if (ajson != "") {
                ajson = "[" + ajson + "]";
                if ($("#HFQID").val() != 0) {

                    if (DoHistoryID != 0) {

                        ErrorNum = 0;

                        var dReporthtml = "";
                        if (isNaN(allscore)) {
                            dReporthtml += " <div class='dReport-contleftcont'>     <div> <div class='dReport-paperstat'> <i>0<b>分</b> </i></div> <ul class='dReport-questitu'>";
                        } else {
                            dReporthtml += " <div class='dReport-contleftcont'>     <div> <div class='dReport-paperstat'> <i>" +allscore+ "<b>分</b> </i></div> <ul class='dReport-questitu'>";
                        }

                        dReporthtml += " <li class='dReport-questitutitle'><span>题型</span> <span>得分</span>  <span>答对/总题</span> <span>错题数量</span>  <span>正确率</span></li>";


                        for (var l = 0; l < $("#answer_card").find(".dopronumbertype").length; l++) {

                            dReporthtml += "<li><span>" + $("#answer_card").find(".dopronumbertype").eq(l).text() + "</span>";
                            if (l == parseFloat($("#answer_card").find(".dopronumbertype").length - 1)) {
                                if (isNaN(totalscore)) {
                                    dReporthtml += " <span> 0</span>";

                                } else {
                                    dReporthtml += " <span> " + totalscore + "</span>";

                                }
                            } else {
                                if (isNaN(parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li").eq(0).attr("score")))) {
                                    dReporthtml += " <span>0</span>";
                                } else {
                                    dReporthtml += " <span> " + parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='undefined dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton2 dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton1 dopronumberconton3']").length) * parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li").eq(0).attr("score")) + "</span>";
                                }
                            }


                            dReporthtml += " <span> <font>" + parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='undefined dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton2 dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton1 dopronumberconton3']").length) + "</font> / " + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li").length + "</span > <span><em>" + parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton2']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='undefined dopronumberconton2']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton3 dopronumberconton2']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton1 dopronumberconton2']").length) + "</em></span><span>" + parseFloat(parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='undefined dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton2 dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton1 dopronumberconton3']").length) * 100 / parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li").length)).toFixed(2) + "%</span></li >";

                        }
                        dReporthtml += "</ul></div> <ul class='dReport-papershare'><li><a href='javascript:void(0);' id='dReport-papershare'>全部解析</a></li> <li class='dReport-shareshow'><a id='dReport-shareshow' href='javascript:void(0);'>再来一批</a></li> </ul> </div>";

                        $("#detailReport").html(dReporthtml);
                        allaui_close = $.dialog({
                            title: "&nbsp;<span style='font-size: 16px;color: #666;font-family: 'Microsoft Yahei';'>答题情况</span>",
                            width: "965px",
                            height: "260px",
                            content: $("#detailReport").html(),
                            lock: true,
                            fixed: true,
                            opacity: 0.3,
                            drag: false,
                            padding: 0
                        });


                        predictexam();
                        return false;


                        $.ajax({
                            url: '../../Service/ExamRoom/Exam_AnswerSheetHandler.ashx',
                            type: 'POST',
                            async: false,
                            data: {
                                "key": "addUpAnswerSheet",
                                "ajson": ajson,
                                "UID": $("#UID").val(),
                                "CID": $("#HFQID").val(),
                                "RID": $("#HRID").val(),
                                "PARENTID": $("#HPARENTID").val()
                            },
                            dataType: 'text',
                            timeout: 600,
                            success: function (Nodes) {
                                if (Nodes != "-1") {
                                    if (Nodes == "1") {
                                        art.dialog({ id: 'Tips' }).close(); //关闭加载提示
                                        HistoryListOk();
                                        suspendedcancel.close();
                                        //   art.dialog.tips("提交答案成功", "3");
                                        //      window.open("DetailReport.aspx?ajson=" + ajson + "&score=" + allscore + ");
                                    }
                                    if (Nodes == "0") {
                                        art.dialog({ id: 'Tips' }).close(); //关闭加载提示
                                        suspendedcancel.close();
                                        //   art.dialog.tips("提交答案失败", "3");
                                    }
                                }
                            }
                        });

                        return true;
                    }
                    else {

                        ErrorNum = 0;


                        var dReporthtml = "";
                        if (isNaN(allscore)) {
                            dReporthtml += " <div class='dReport-contleftcont'>     <div> <div class='dReport-paperstat'> <i>0<b>分</b> </i></div> <ul class='dReport-questitu'>";
                        } else {
                            dReporthtml += " <div class='dReport-contleftcont'>     <div> <div class='dReport-paperstat'> <i>" +allscore+ "<b>分</b> </i></div> <ul class='dReport-questitu'>";
                        }

                        dReporthtml += " <li class='dReport-questitutitle'><span>题型</span> <span>得分</span>  <span>答对/总题</span> <span>错题数量</span>  <span>正确率</span></li>";


                        for (var l = 0; l < $("#answer_card").find(".dopronumbertype").length; l++) {

                            dReporthtml += "<li><span>" + $("#answer_card").find(".dopronumbertype").eq(l).text() + "</span>";
                            if (l == parseFloat($("#answer_card").find(".dopronumbertype").length - 1)) {
                                if (isNaN(totalscore)) {
                                    dReporthtml += " <span> 0</span>";

                                } else {
                                    dReporthtml += " <span> " + totalscore + "</span>";

                                }


                            } else {
                                if (isNaN(parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li").eq(0).attr("score")))) {
                                    dReporthtml += " <span>0</span>";
                                } else {
                                    dReporthtml += " <span> " + parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='undefined dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton2 dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton1 dopronumberconton3']").length) * parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li").eq(0).attr("score")) + "</span>";
                                }

                            }


                            dReporthtml += " <span> <font>" + parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='undefined dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton2 dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton1 dopronumberconton3']").length) + "</font> / " + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li").length + "</span > <span><em>" + parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton2']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='undefined dopronumberconton2']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton3 dopronumberconton2']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton1 dopronumberconton2']").length) + "</em></span><span>" + parseFloat(parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='undefined dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton2 dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton1 dopronumberconton3']").length) * 100 / parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li").length)).toFixed(2) + "%</span></li >";

                        }
                        dReporthtml += "</ul></div> <ul class='dReport-papershare'><li><a href='javascript:void(0);' id='dReport-papershare'>全部解析</a></li> <li class='dReport-shareshow'><a  id='dReport-shareshow' href='javascript:void(0);'>再来一批</a></li> </ul> </div>";

                        $("#detailReport").html(dReporthtml);
                        allaui_close = $.dialog({
                            title: "&nbsp;<span style='font-size: 16px;color: #666;font-family: 'Microsoft Yahei';'>答题情况</span>",
                            width: "965px",
                            height: "260px",
                            content: $("#detailReport").html(),
                            lock: true,
                            fixed: true,
                            opacity: 0.3,
                            drag: false,
                            padding: 0
                        });


                        predictexam();
                        return false;
                        $.ajax({
                            url: '../../Service/ExamRoom/Exam_AnswerSheetHandler.ashx',
                            type: 'POST',
                            async: false,
                            data: {
                                "key": "addUpAnswerSheet",
                                "ajson": ajson,
                                "UID": $("#UID").val(),
                                "CID": $("#HFQID").val(),
                                "RID": $("#HRID").val(),
                                "PARENTID": $("#HPARENTID").val()
                            },
                            dataType: 'text',
                            timeout: 600,
                            success: function (Nodes) {
                                if (Nodes != "-1") {
                                    if (Nodes == "1") {
                                        art.dialog({ id: 'Tips' }).close(); //关闭加载提示
                                        HistoryListOk();
                                        suspendedcancel.close();

                                        //      art.dialog.tips("提交答案成功", "3");

                                        //  $(".packupparsing packupparsing2").show();
                                        //     window.open("DetailReport.aspx?PID=" + $("#HFQID").val() + "&UID=" + $("#UID").val());
                                    }
                                    if (Nodes == "0") {
                                        art.dialog({ id: 'Tips' }).close(); //关闭加载提示
                                        suspendedcancel.close();
                                        //  art.dialog.tips("提交答案失败", "3");
                                    }
                                }
                            }
                        });

                    }
                }
                else {
                    //art.dialog({ id: 'Tips' }).close(); //关闭加载提示
                    //suspendedcancel.close();
                    //art.dialog.tips("作答完毕", "3");
                    //document.getElementById('contentleftscoretwo').style.display = "block";

                    //document.getElementById('xo').style.display = "block";

                    //document.getElementById('yo').style.display = "block";
                    //document.getElementById('zo').style.display = "none";
                    var dReporthtml = " <div class='dReport-contleftcont'>     <div> <div class='dReport-paperstat'> <i>" + allscore + "<b>分</b> </i></div> <ul class='dReport-questitu'>";
                    dReporthtml += " <li class='dReport-questitutitle'><span>题型</span> <span>得分</span>  <span>答对/总题</span> <span>错题数量</span>  <span>正确率</span></li>";


                    for (var l = 0; l < $("#answer_card").find(".dopronumbertype").length; l++) {

                        dReporthtml += "<li><span>" + $("#answer_card").find(".dopronumbertype").eq(l).text() + "</span>";
                        if (l == parseFloat($("#answer_card").find(".dopronumbertype").length - 1)) {
                            dReporthtml += " <span> " + totalscore + "</span>";


                        } else {
                            dReporthtml += " <span> " + parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='undefined dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton2 dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton1 dopronumberconton3']").length) * parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li").eq(0).attr("score")) + "</span>";
                        }


                        dReporthtml += " <span> <font>" + parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='undefined dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton2 dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton1 dopronumberconton3']").length) + "</font> / " + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li").length + "</span > <span><em>" + parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton2']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='undefined dopronumberconton2']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton3 dopronumberconton2']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton1 dopronumberconton2']").length) + "</em></span><span>" + parseFloat(parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='undefined dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton2 dopronumberconton3']").length + $("#answer_card").find(".dopronumbertype").eq(l).next().find("li[class='dopronumberconton1 dopronumberconton3']").length) * 100 / parseInt($("#answer_card").find(".dopronumbertype").eq(l).next().find("li").length)).toFixed(2) + "%</span></li >";

                    }
                    dReporthtml += "</ul></div> <ul class='dReport-papershare'><li><a href='javascript:void(0);' id='dReport-papershare'>全部解析</a></li> <li class='dReport-shareshow'><a id='dReport-shareshow' href='javascript:void(0);'>再来一批</a></li> </ul> </div>";

                    $("#detailReport").html(dReporthtml);
                    allaui_close = $.dialog({
                        title: "&nbsp;<span style='font-size: 16px;color: #666;font-family: 'Microsoft Yahei';'>答题情况</span>",
                        width: "965px",
                        height: "260px",
                        content: $("#detailReport").html(),
                        lock: true,
                        fixed: true,
                        opacity: 0.3,
                        drag: false,
                        padding: 0
                    });


                    predictexam();
                    return false;
                    return;
                }
            }


            document.getElementById('contentleftscoretwo').style.display = "block";

            document.getElementById('xo').style.display = "block";

            document.getElementById('yo').style.display = "block";
            document.getElementById('zo').style.display = "none";


            // location.href = "DetailReport.aspx?PID=" + $("#HFQID").val() + "&UID=" + $("#UID").val();
            //   location.href = "Erdietest.aspx";
        });
    });
    $(".doproblemsactive .nexttocontinue").click(function () {
        if ($("#UID").val() == "" || $("#UID").val() == 0) {
            layer.open({
                type: 2,
                title: '登录',
                shadeClose: true,
                shade: 0.8,
                area: ['401px', '502px'],
                content: '/loginPopupWindow.aspx' //iframe的url
            });
        }
        var suspendedcancel = $.dialog({
            title: "&nbsp;<span style='font-size: 16px;color: #666;font-family: 'Microsoft Yahei';'>温馨提示</span>",
            width: "480px",
            height: "260px",
            content: $("#nexttocontinue").html(),
            lock: true,
            fixed: true,
            opacity: 0.3,
            drag: false,
            padding: 0
        });
        //弹窗取消
        $(".submitcancel").click(function () {

            suspendedcancel.close();
        });
        $(".submitsubmit").click(function () {


            var number = 0; //没有作答数量
            var ajson = "";
            if ($("#HFHID").val() != "") { //did不为空时 为继续做题
                DoHistoryID = $("#HFHID").val();
            }
            var doNum = $("#answer_card .dopronumberconton").length;
            var cid = $("#HFQID").val();
            ajson = SubmitAnswer(1); //获取题目答案
            if (ajson != "") {
                ajson = "[" + ajson + "]";
                if (DoHistoryID < 1) {
                    $.ajax({
                        url: ' ../../Service/ExamRoom/Exam_HistoryListHandler.ashx',
                        type: 'POST',
                        async: false,
                        data: {
                            "key": "addHistoryList",
                            "DoName": $("#Title_ChapterName").text(),
                            "TypeID": $("#TypeID").val(), //0章节 1知识点 2试卷
                            "CID": $("#HFQID").val(),
                            "QuestionNum": itemNumber,
                            "ErrorNum": ErrorNum,
                            "Score": 1,
                            "UID": $("#UID").val(),
                            "SanswerTime": DoDateTime,
                            "ATime": 0,
                            "AInformation": ajson,
                            "AState": 1
                        },
                        dataType: 'text',
                        timeout: 80000,
                        success: function (Nodes) {
                            if (Nodes != "-1") {
                                if (Nodes >= 1) {
                                    $("#HFHID").val(Nodes);
                                    art.dialog({ id: 'Tips' }).close(); //关闭加载提示
                                    HistoryListOk();
                                    art.dialog.tips("答案已保存", "3");
                                    $("#HFHID").val(Nodes);
                                }
                                if (Nodes == "0") {
                                    art.dialog({ id: 'Tips' }).close(); //关闭加载提示
                                    art.dialog.tips("保存失败", "3");
                                }
                            }
                            ErrorNum = 0;
                        }
                    });
                } else {
                    $.ajax({
                        url: ' ../../Service/ExamRoom/Exam_HistoryListHandler.ashx',
                        type: 'POST',
                        async: false,
                        data: {
                            "key": "updateHistoryList",
                            "HID": DoHistoryID,
                            "QuestionNum": itemNumber,
                            "ErrorNum": ErrorNum,
                            "Score": 0,
                            "UID": $("#UID").val(),
                            "ATime": 1,
                            "AInformation": ajson,
                            "AState": 1
                        },
                        dataType: 'text',
                        timeout: 80000,
                        success: function (Nodes) {
                            if (Nodes != "-1") {

                                if (Nodes >= 1) {
                                    $("#HFHID").val(Nodes);
                                    art.dialog({ id: 'Tips' }).close(); //关闭加载提示
                                    art.dialog.tips("答案已更新", "3");
                                }
                                if (Nodes == "0") {
                                    $("#HFHID").val(Nodes);
                                    art.dialog({ id: 'Tips' }).close(); //关闭加载提示
                                    art.dialog.tips("更新失败", "3");
                                }
                            }
                            ErrorNum = 0;
                        }
                    });
                }
            }
            location.href = "Chapter.aspx";
        });
    });

    $(".doproblemsactive .gettoback").click(function () {
        var suspendedcancel = $.dialog({
            title: "&nbsp;<span style='font-size: 16px;color: #666;font-family: 'Microsoft Yahei';'>温馨提示</span>",
            width: "480px",
            height: "260px",
            content: $("#gettoback").html(),
            lock: true,
            fixed: true,
            opacity: 0.3,
            drag: false,
            padding: 0
        });
        //弹窗取消
        $(".submitcancel").click(function () {
            suspendedcancel.close();
        });
        $(".submitsubmit").click(function () {
            location.href = "Chapter.aspx";
        });
    });

    //答题卡锚点定位
    $(".doproblemsnumber .dopronumbercont li").click(function () {
        var titlenumber = $(this).attr("titlenumber");
        var titletpye = $(this).attr("titletpye");
        var showtypeid = $(this).attr("showtypeid");
        if ($(".doproblemsset .doproblemssetmodel div").find(".doproblemssetmodelclick").text() == "单题模式") {

            $(".contentleft .contentleftcont").children().addClass("contentleftconthidden");
            $(".contentleft .contentleftcont").find(".contentleftcontupordown").removeClass("contentleftconthidden");
            $(".contentleft .contentleftcont ").find(".contentleftconttitletype[questiontypes='" + titletpye + "'][showtypeid='" + showtypeid + "'] ").removeClass("contentleftconthidden");//标题

            $(".contentleft .contentleftcont ").find(".DetailTitlecontent[questiontypes='" + titletpye + "'][titlenumber='" + titlenumber + "']").removeClass("contentleftconthidden");

        } else {
            $(this).parent().parent().find(".dopronumberconton4").removeClass("dopronumberconton4");
            $(this).addClass("dopronumberconton4");


            $("body,html").animate({ scrollTop: $(".contentleft .contentleftcont ").find(".contentleftconttitletop[questiontypes='" + titletpye + "'][titlenumber='" + titlenumber + "']").offset().top - 60 });
        }
    });


    //记笔记和网友笔记
    $(".DetailTitleparsingnotes a").click(function () {
        var anumber = $(this).index();
        var aparent = $(this).parent();
        if (anumber == 1) {
            $(this).next().removeClass("netfriendnotes2");
            $(this).addClass("takenotes2")
            $(aparent).next().addClass("DetailTitleparsingtakenotes2");
            $(aparent).next().next().removeClass("DetailTitlenetfriendnotes2");
        } else if (anumber == 2) {
            $(this).addClass("netfriendnotes2");
            $(this).prev().removeClass("takenotes2")
            $(aparent).next().removeClass("DetailTitleparsingtakenotes2");
            $(aparent).next().next().addClass("DetailTitlenetfriendnotes2");
        }
    });
    //笔记重置
    $(".takenotesbotton .takenotesreset").click(function () {
        $(".textareaval").val("");
    });

    //暂停弹窗
    $(".doproblemstimeleft div").click(function () {
        //暂停计时
        clearTimeout(timerID);
        var suspendedcancel = $.dialog({
            title: "",
            width: "320px",
            height: "210px",
            content: "dsdsds<h1>21312</h1>",
            lock: true,
            fixed: true,
            opacity: 0.3,
            drag: false,
            esc: false,
            dblclick_hide: false,
            cancel: false,
            padding: 0
        });
        //暂停弹窗取消
        $(".suspendednext").click(function () {
            suspendedcancel.close();
            //继续计时
            setTimeout(stoptime, 1000);
        });
    });



    //纠错弹出框错题反馈
    $('.Erroring').click(function () {

        var tid = $(this).attr('id');
        var nummm = $(this).attr('data-id');
        var Errorcancel = $.dialog({
            title: "&nbsp;<span style='font-size: 16px;color: #333333;font-family: 'Microsoft Yahei';'>第" + nummm + "题纠错反馈</span>",
            width: "520px",
            height: "340px",
            content: $("#Errorpopup").html(),
            lock: true,
            fixed: true,
            opacity: 0.3,
            drag: false,
            padding: 0
        });

        $(".Errorcancel").click(function () {
            Errorcancel.close();
        });

        $('.Errorsubmit').click(function () {
            var xs = document.getElementById('Errorpopuptextarea').value;
            if ($(".Errorpopupli li label input").parent().hasClass('checkboxclick')) {
                var eee = "";
                if ($(".one").hasClass('checkboxclick')) {
                    eee += "[含有错别字]";
                }
                if ($(".two").hasClass('checkboxclick')) {
                    eee += "[图片不显示]"
                }
                if ($(".three").hasClass('checkboxclick')) {
                    eee += "[答案不正确]"
                }
                if ($(".four").hasClass('checkboxclick')) {
                    eee += "[解析不正确]"
                }
                if ($(".five").hasClass('checkboxclick')) {
                    eee += "[试题重复]"
                }
                if ($(".six").hasClass('checkboxclick')) {
                    eee += "[其他错误]"
                }
            }
            else {
                alert("请你选择错误类型");
                return;
            }


            if (eee != "" && tid != "") {
                var content = "题型ID:" + tid + eee + "反馈说明：" + xs + " "
            }
            else {
                alert("请你选择错误类型");
                return;
            }

            $.ajax({
                url: "/Service/ExamRoom/ExamHandler.ashx",
                type: "post",
                async: true,
                datatype: 'text',
                data: {
                    "FeedBackContent": content,
                    "key": "FeedBackContent",
                    "ClassID": $("#KID").val(),
                    "ChapterID": $("#HFQID").val(),
                    "TID": tid,
                    "FeedbackType": eee,
                    "Content": xs
                },
                success: function (data) {
                    layer.open({
                        title: '温馨提示',
                        content: '您已成功提交反馈,谢谢您的支持!'
                    });
                }
            });
        });


    });

    $('.Errorcorrection').click(function () {

        var tid = $(this).attr('id');
        var nummm = $(this).attr('data-id');
        var Errorcancel = $.dialog({
            title: "&nbsp;<span style='font-size: 16px;color: #333333;font-family: 'Microsoft Yahei';'>第" + nummm + "题纠错反馈</span>",
            width: "520px",
            height: "340px",
            content: $("#Errorpopup").html(),
            lock: true,
            fixed: true,
            opacity: 0.3,
            drag: false,
            padding: 0
        });

        $(".Errorcancel").click(function () {
            Errorcancel.close();
        });

        $('.Errorsubmit').click(function () {

            var xs = document.getElementById('Errorpopuptextarea').value;
            if ($(".Errorpopupli li label input").parent().hasClass('checkboxclick')) {
                var eee = "";

                if ($(".one").hasClass('checkboxclick')) {
                    eee += "[含有错别字]"
                }
                if ($(".two").hasClass('checkboxclick')) {
                    eee += "[图片不显示]"
                }
                if ($(".three").hasClass('checkboxclick')) {
                    eee += "[答案不正确]"
                }
                if ($(".four").hasClass('checkboxclick')) {
                    eee += "[解析不正确]"
                }
                if ($(".five").hasClass('checkboxclick')) {
                    eee += "[试题重复]"
                }
                if ($(".six").hasClass('checkboxclick')) {
                    eee += "[其他错误]"
                }
            }
            else {
                alert("请你选择错误类型");
                return;
            }


            if (eee != "" && tid != "") {
                var content = "题型ID:" + tid + eee + "反馈说明：" + xs + " "
            }
            else {
                alert("请你选择错误类型");
                return;
            }

            $.ajax({
                url: "/Service/ExamRoom/ExamHandler.ashx",
                type: "post",
                async: true,
                datatype: 'text',
                data: {
                    "FeedBackContent": content,
                    "key": "FeedBackContent",
                    "ClassID": $("#KID").val(),
                    "ChapterID": $("#HFQID").val(),
                    "TID": tid,
                    "FeedbackType": eee,
                    "Content": xs
                },
                success: function (data) {
                    if (data == "[1]") {
                        Errorcancel.close();

                        var Errorcancelsuccess = $.dialog({
                            title: "&nbsp;<span style='font-size: 16px;color: #666;font-family: 'Microsoft Yahei';'>温馨提示</span>",
                            width: "480px",
                            height: "260px",
                            content: " <div class=\"submitcont\">  <div class=\"submitimg\"> <i></i></div> <span>您已成功提交反馈,谢谢您的支持！</span> <div class=\"submitbtn\"> <a class=\"esubmitcancel\">取消</a><a class=\"esubmitsubmit\">确定</a> </div></div>",
                            lock: true,
                            fixed: true,
                            opacity: 0.3,
                            drag: false,
                            padding: 0
                        });
                        $(".esubmitcancel").click(function () {
                            Errorcancelsuccess.close();
                        });
                        $(".esubmitsubmit").click(function () {
                            Errorcancelsuccess.close();
                        });

                    }
                    else {
                        alert("提交失败");
                    }
                }
            });
        });


    });





    //选择题笔记提交
    $('.takenotesrefer').click(function () {
        var obj = $(this);
        var tid = $(this).attr('data-id');
        var text = null;
        if ($(this).hasClass('tijiao')) {
            var d = ((tid) + "two");
            text = document.getElementById('' + d + '').value;
        } else {
            var c = ((tid) + "one");
            text = document.getElementById('' + c + '').value;
        }
        if (text.length < 1) {
            alert("内容为空，请输入文字");
        }
        else if (text.length > 200) {
            alert("字数已超过最大限制！");
        }
        if ($("#UID").val() == "0") {
            setCookie("cookieone", tid, "d7");
            setCookie("cookietwo", text, "d7");
            setCookie("cookiethree", $("#KID").val(), "d7");
            layer.open({
                type: 2,
                title: '登录',
                shadeClose: true,
                shade: 0.8,
                area: ['401px', '502px'],
                content: '/loginPopupWindow.aspx' //iframe的url
            });
        }

        else {

            delCookie("cookieone");
            delCookie("cookietwo");
            delCookie("cookiethree");
            $.ajax({
                url: '../../Service/ExamRoom/NotesHandler.ashx',
                type: 'POST',
                async: true,
                dataType: 'text',
                data: {
                    "TID": tid,
                    "content": text,
                    "UID": $("#UID").val(),
                    "KID": $("#KID").val()
                },
                success: function (a) {
                }
            });
            var suspendedcancel = $.dialog({
                title: "&nbsp;<span style='font-size: 16px;color: #666;font-family: 'Microsoft Yahei';'>温馨提示</span>",
                width: "480px",
                height: "260px",
                content: " <div class=\"submitcont\">  <div class=\"submitimg\"> <i></i></div> <span>笔记已提交</span> <div class=\"submitbtn\"> <a class=\"submitcancel\">取消</a><a class=\"submitsubmit\">确定</a> </div></div>",
                lock: true,
                fixed: true,
                opacity: 0.3,
                drag: false,
                padding: 0
            });
            //弹窗取消
            $(".submitcancel").click(function () {
                suspendedcancel.close();
            });
            $(".submitsubmit").click(function () {
                suspendedcancel.close();
            });
            document.getElementById('' + c + '').value = null;

        }
    });
    //简答题笔记提交
    $('#tijiao').click(function () {
        if ($("#UID").val() == "0") {
            layer.open({
                type: 2,
                title: '登录',
                shadeClose: true,
                shade: 0.8,
                area: ['401px', '502px'],
                content: '/loginPopupWindow.aspx' //iframe的url
            });
        }
        var obj = $(this);
        var tid = $(this).attr('data-id');
        var d = ((tid) + "two");
        var text = document.getElementById('' + d + '').value;

        if (text.length < 1) {
            alert("内容为空，请输入文字");
        }
        else if (text.length > 200) {
            alert("字数已超过最大限制！");
        }
        else {
            $.ajax({
                url: '../../Service/ExamRoom/NotesHandler.ashx',
                type: 'POST',
                async: true,
                dataType: 'text',
                data: {
                    "TID": tid,
                    "content": text,
                    "UID": $("#UID").val(),
                    "KID": $("#KID").val()
                },
                success: function (a) {
                }
            });


        }
    });


    //网友笔记
    $('.netfriendnotes').click(function () {
        var obj = $(this);
        var tid = $(this).attr('data-id');
        $.ajax({
            url: "Service/SelectInertnetfriendnotesHandle.ashx",
            type: "post",
            async: true,
            datatype: 'json',
            data: {
                "tid": tid
            },
            success: function (data) {
                var datae = eval("[" + data + "]");
                if (data == "[]") {
                    var ccchtml = "";
                    ccchtml += "<div class=\"DetailTitlenetfriendnotesnot\">  <i></i>";
                    ccchtml += "   <span>暂无网友笔记哦~</span>    </div> ";
                    $('#' + tid + tid + '').html(ccchtml);
                    return;
                }
                var ccchtml = "";
                var zhtml = "";
                var hourzhuanghua = "";
                for (var i = 0; i < datae[0].length; i++) {
                    var empt = datae[0][i];

                    hourzhuanghua = empt.nTime2;

                    hourzhuanghua = hourzhuanghua.substring(0, hourzhuanghua.length - 6);


                    ccchtml += "<div class=\"netfriendnotescont\"  data-id=\"" + tid + "\" > <span class=\"netfriendname\"><img height=\"40\" width=\"40\"src=\"image/DetailTitle_netfriendpicture.png\" />" + empt.useName + "<i runat=\"server\"  id=\"txtStartDate\" name=\"txtStartDate\">" + hourzhuanghua + "</i> </span><span class=\"netfriendcontent\">" + empt.nText + "</span> ";

                    ccchtml += " <div class=\"netfriendassiston\"  data-id=\"" + tid + "\"> </div></div>";//<a class=\"netfriendpraise\">顶</a><a class=\"netfriendstamp\">踩</a>
                }
                zhtml += ccchtml;

                $('#' + tid + tid + '').html(zhtml);
            },
            error: function () {
                var ccchtml = "";
                ccchtml += "<div class=\"netfriendnotescont\"> <span class=\"netfriendname\"><img height=\"40\" width=\"40\"src=\"image/DetailTitle_netfriendpicture.png\" /><i>2016-11-19</i> </span><span class=\"netfriendcontent\"></span> ";
                ccchtml += " <div class=\"netfriendassiston\"> </div></div>  ";//<a class=\"netfriendpraise\">顶</a><a class=\"netfriendstamp\">踩</a>
                $('#' + tid + tid + '').html(ccchtml);
                zancai();
                return ccchtml;
            }
        });
    });


    //右边答题信息跟随滚动条加载数据
    elFix = document.getElementById('contentright');
    elFix2 = document.getElementById('contentleft').scrollHeight;
    quesnumberlenght = $(".contentleft .contentleftcont").find(".DetailTitlecontent").length;
    htmlPosition(elFix);


    $('.collectioning').click(function () {
        if ($("#UID").val() == "0") {
            layer.open({
                type: 2,
                title: '登录',
                shadeClose: true,
                shade: 0.8,
                area: ['401px', '502px'],
                content: '/loginPopupWindow.aspx' //iframe的url
            });
            $(".DetailTitletitleactive ul li").find(".collectioning").removeClass('collectioning2');
            $(".DetailTitletitleactive ul li").find(".collectionontology").removeClass('collectionontology2');
            return false;
        }

        var obj = $(this);
        var tid = $(this).attr('data-id');

        $.ajax({
            url: "/Service/ExamRoom/ExamHandler.ashx",
            type: "post",
            async: true,
            datatype: 'text',
            timeout: 80000,
            data: {
                "key": "AddCollectHandle",
                "tid": tid,
                "UID": $("#UID").val(),
                "KID": $("#KID").val(),
                "chapterID": $("#HFQID").val()
            }
        });
    });
    $('.collectionontology').click(function () {
        if ($("#UID").val() == "0") {
            layer.open({
                type: 2,
                title: '登录',
                shadeClose: true,
                shade: 0.8,
                area: ['401px', '502px'],
                content: '/loginPopupWindow.aspx' //iframe的url
            });
            $(".DetailTitletitleactive ul li").find(".collectioning").removeClass('collectioning2');
            $(".DetailTitletitleactive ul li").find(".collectionontology").removeClass('collectionontology2');
            return false;
        }

        var obj = $(this);
        var tid = $(this).attr('data-id');
        $.ajax({
            url: "/Service/ExamRoom/ExamHandler.ashx",
            type: "post",
            async: true,
            datatype: 'text',
            timeout: 80000,
            data: {
                "key": "AddCollectHandle",
                "tid": tid,
                "UID": $("#UID").val(),
                "KID": $("#KID").val(),
                "chapterID": $("#HFQID").val()
            }
        });

    });


}
//做题模式（自动下一题）
function automaticNextquestion(one) {
    if ($(".doproblemssetanswer select").val() == "自动下一题") {
        if ($(".doproblemsset .doproblemssetmodel div").find(".doproblemssetmodelclick").text() == "单题模式") {
            Nextquestion();
        }
        else {
            var titlenumber = parseInt($(one).parent().parent().parent().parent().attr("titlenumber")) + 1;
            var questiontypes = $(one).parent().parent().parent().parent().attr("questiontypes");
            if (titlenumber < ($(".contentleftcont .DetailTitlecontent[questiontypes='1']").length + 1)) {
                $("body,html").animate({ scrollTop: $(".contentleft .contentleftcont ").find(".contentleftconttitletop[questiontypes='" + questiontypes + "'][titlenumber='" + titlenumber + "']").offset().top - 60 });
            }
        }
    }

    if ($(".doproblemssetanswer select").val() == "作答正确下一题，错误显示答案") {
        if ($(".doproblemsset .doproblemssetmodel div").find(".doproblemssetmodelclick").text() == "单题模式") {
            Nextquestion();
        } else {


            var titlenumber = parseInt($(one).parent().parent().parent().parent().attr("titlenumber")) + 1;
            var questiontypes = $(one).parent().parent().parent().parent().attr("questiontypes");

            if (titlenumber < ($(".contentleftcont .DetailTitlecontent[questiontypes='1']").length + 1)) {
                $("body,html").animate({ scrollTop: $(".contentleft .contentleftcont ").find(".contentleftconttitletop[questiontypes='" + questiontypes + "'][titlenumber='" + titlenumber + "']").offset().top - 60 });
            }
        }
    }
}

//下一题
function Nextquestion() {

    $(".contentleft .contentleftcont").find(".contentleftconttitletop").addClass("contentleftconthidden");
    $(".contentleft .contentleftcont").find(".DetailTitlecontent").addClass("contentleftconthidden");
    $(".contentleft .contentleftcont").find(".contentleftcontupordown").removeClass("contentleftconthidden");

    var divlenght = $(".contentleft .contentleftcont").find(".DetailTitlecontent").length - 1;

    if (problemnumber >= divlenght) {
        problemnumber = divlenght;
    } else {
        problemnumber = problemnumber + 1;
    }

    var questiontypes = $(".contentleft .contentleftcont").find(".contentleftconttitletop:eq(" + problemnumber + ")").attr("questiontypes") - 1;

    $(".contentleft .contentleftcont ").find(".contentleftconttitletype").addClass("contentleftconthidden");
    $(".contentleft .contentleftcont ").find(".contentleftconttitletype:eq(" + questiontypes + ")").removeClass("contentleftconthidden");

    $(".contentleft .contentleftcont").find(".contentleftconttitletop:eq(" + problemnumber + ")").removeClass("contentleftconthidden");

    $(".contentleft .contentleftcont").find(".DetailTitlecontent:eq(" + problemnumber + ")").removeClass("contentleftconthidden");
}

var ErrorNum = 0; //答对个数

var totalscore = 0;

//获取用户答案
function SubmitAnswer(next) {

    var ajson = ""; //用户答案json
    var Score = 0; //得分
    var questionid = ""; //试题ID
    var yesorno = 0; //1回答正确 0没有作答或回答错误
    var answer = ""; //答案
    var dyesorno = 1; //用于多选题判断选项是否全对 1全对 0有错
    var turfas = true; //判断是否为多选题  true是 false否
    $("#exam .DetailTitlecontent").each(function (s, v) { //遍历选择题所有选项答案（单选多选）
        answer = "";
        dyesorno = 1;

        if ($(v).attr("data-type") == "1" || $(v).attr("data-type") == "2" || $(v).attr("data-type") == "3") {
            questionid = $(v).attr("data-id"); //题目id
            var obj = $(this);
            yesorno = 1;
            $(v).find("li").each(function (w, f) {
                if ($(f).parents(".DetailTitlecontent").attr("data-type") == 1 || $(f).parent("div.DetailTitlecontent").attr("data-type") == 3) { //单选题
                    turfas = false;
                    if ($(f).attr("data-check") == "1" && $(f).attr("answer") == "1")  //答对
                    {
                        answer = $(f).attr("data-value");
                        yesorno = 1;

                        $("li[questionid='" + questionid + "']").removeClass("dopronumberconton1");
                        $("li[questionid='" + questionid + "']").addClass("dopronumberconton3");
                        var an = ((questionid) + "answer");
                        $("#" + an + " ").html(answer);
                    }
                    else if ($(f).attr("data-check") == "1") { //答错
                        answer = $(f).attr("data-value");
                        yesorno = 0;

                        $("li[questionid='" + questionid + "']").removeClass("dopronumberconton1");
                        $("li[questionid='" + questionid + "']").addClass("dopronumberconton2");
                        var an = ((questionid) + "answer");
                        $("#" + an + " ").html(answer);
                    }
                    else { //没有作答
                        answer = "";
                        yesorno = 0;
                    }

                    if (answer != "") {
                        if (yesorno == 1) {
                            ErrorNum++;
                            Score += parseInt($("#" + questionid).attr("score"));
                        }
                        ajson += "{\"qID\": \"" + questionid + "\",\"pDID\": \"" + questionid + "\",\"Score\": \"" + Score + "\",\"answer\": \"" + answer + "\",\"result\": \"" + yesorno + "\"}" + ",";

                    }
                }

                else if ($(f).parents(".DetailTitlecontent").attr("data-type") == 2) { //多选题
                    turfas = true;
                    if ($(f).attr("data-check") == "1" && $(f).attr("answer") == "1")  //答对
                    {
                        answer += $(f).attr("data-value");
                        $("li[questionid='" + questionid + "']").removeClass("dopronumberconton1");
                        $("li[questionid='" + questionid + "']").addClass("dopronumberconton3");
                        var an = ((questionid) + "answer");
                        $("#" + an + " ").html(answer);
                    }
                    else if ($(f).attr("data-check") == "1" && $(f).attr("answer") == "0") { //答错

                        answer += $(f).attr("data-value");

                        dyesorno = 0;
                        var an = ((questionid) + "answer");
                        $("#" + an + " ").html(answer);

                        $("li[questionid='" + questionid + "']").removeClass("dopronumberconton1");
                        $("li[questionid='" + questionid + "']").addClass("dopronumberconton2");
                    }
                    else if ($(f).attr("data-check") == "0" && $(f).attr("answer") == "1") { //答错 没有作答
                        dyesorno = 0;

                    }

                    var xyz = answer;
                    var ss = $("#" + questionid + questionid + questionid + " ").attr("data-id")

                    if (xyz == ss) {
                        yesorno = 1;
                        $("li[questionid='" + questionid + "']").removeClass("dopronumberconton1");
                        $("li[questionid='" + questionid + "']").addClass("dopronumberconton3");
                    }

                    else if (xyz == "") {
                        dyesorno = 0;
                    }

                    else {
                        if (xyz != ss) {
                            yesorno = 0;
                            $("li[questionid='" + questionid + "']").removeClass("dopronumberconton3");
                            $("li[questionid='" + questionid + "']").addClass("dopronumberconton2");

                        } else {
                            yesorno = 0;
                            $("li[questionid='" + questionid + "']").removeClass("dopronumberconton1");
                            $("li[questionid='" + questionid + "']").addClass("dopronumberconton2");
                        }

                    }
                }
                else {
                    turfas = false;
                    if ($(f).attr("data-check") == "1" && $(f).attr("answer") == "1")  //答对
                    {
                        answer = $(f).attr("data-value");
                        yesorno = 1;
                        var an = ((questionid) + "answer");
                        $("#" + an + " ").html(answer);
                        $("li[questionid='" + questionid + "']").removeClass("dopronumberconton1");
                        $("li[questionid='" + questionid + "']").addClass("dopronumberconton3");
                    }
                    else if ($(f).attr("data-check") == "1") { //答错
                        answer = $(f).attr("data-value");
                        yesorno = 0;
                        var an = ((questionid) + "answer");
                        $("#" + an + " ").html(answer);
                        $("li[questionid='" + questionid + "']").removeClass("dopronumberconton1");
                        $("li[questionid='" + questionid + "']").addClass("dopronumberconton2");


                    }
                    else { //没有作答
                        answer = "";
                        yesorno = 0;
                    }

                    if (answer != "") {
                        if (yesorno == 1) {
                            ErrorNum++;
                            Score += parseInt($("#" + questionid).attr("score"));
                        }
                        ajson += "{\"qID\": \"" + questionid + "\",\"pDID\": \"" + questionid + "\",\"answer\": \"" + answer + "\",\"Score\": \"" + Score + "\",\"result\": \"" + yesorno + "\"}" + ",";

                    }
                }


            })

            if (turfas == true) {

                if (answer != "") {
                    if (yesorno == 1) {
                        ErrorNum++;
                        Score += parseInt($("#" + questionid).attr("score"));
                    }
                    ajson += "{\"qID\": \"" + questionid + "\",\"pDID\": \"" + questionid + "\",\"answer\": \"" + answer + "\",\"Score\": \"" + Score + "\",\"result\": \"" + yesorno + "\"}" + ",";

                }


            }
        }
        //案例分析题
        else if ($(v).attr("data-type") == "11" || $(v).attr("data-type") == "9") {//多题干公用选项题
            yesorno = 1;
            var questionidid = $(v).attr("data-id");//大题ID
            var correctnum = 0;
            var DetailTitletitReadingSelect = "";
            try {
                DetailTitletitReadingSelect = $(v).find(".DetailTitletitReadingSelect").eq(0).attr("data-type");
            } catch (e) {

            }

            if (DetailTitletitReadingSelect!="31") {
                if ($(v).find(".DetailTitletitleanswermoreselect").eq(0).attr("data-type") == "2") {
                    for (var r = 0; r < $(v).find(".DetailTitletitlecontmoreselect").length; r++) {

                        questionid = $(v).find(".DetailTitletitlecontmoreselect").eq(r).attr("id");


                        var correctAnswer = "";
                        for (var s = 0; s < $(v).find(".DetailTitletitlecontmoreselect").eq(r).find("li").length; s++) {
                            if ($(v).find(".DetailTitletitlecontmoreselect").eq(r).find("li").eq(s).attr("data-check") == 1) {
                                correctAnswer += $(v).find(".DetailTitletitlecontmoreselect").eq(r).find("li").eq(s).attr("data-value");
                            }
                        }

                        if (correctAnswer.length > 0) {
                            if ($(v).find(".DetailTitletitlecontmoreselect").eq(r).next().next().children().children().find(".sanwer").attr("data-id") == correctAnswer) {
                                correctnum++;
                                totalscore = parseInt($("#" + questionid).attr("score"));
                                Score = parseInt($("#" + questionid).attr("score"));

                                ajson += "{\"qID\": \"" + questionid + "\",\"pDID\": \"" + questionidid + "\",\"answer\": \"" + correctAnswer + "\",\"Score\": \"" + Score + "\",\"result\": \"" + 1 + "\"}" + ",";
                                if (correctnum == $(v).find(".DetailTitletitlecontmoreselect").length) {
                                    $("li[questionid='" + questionidid + "']").removeClass("dopronumberconton2");
                                    $("li[questionid='" + questionidid + "']").addClass("dopronumberconton3");
                                }
                            } else {
                                ajson += "{\"qID\": \"" + questionid + "\",\"pDID\": \"" + questionidid + "\",\"answer\": \"" + correctAnswer + "\",\"Score\": \"" + 0 + "\",\"result\": \"" + 0 + "\"}" + ",";
                                $("li[questionid='" + questionidid + "']").removeClass("dopronumberconton1");
                                $("li[questionid='" + questionidid + "']").addClass("dopronumberconton2");
                            }
                        }
                    }
                }
                else {

                    for (var r = 0; r < $(v).find(".DetailTitletitlecont").length; r++) {

                        questionid = $(v).find(".DetailTitletitlecont").eq(r).attr("id");


                        var correctAnswer = "";
                        for (var s = 0; s < $(v).find(".DetailTitletitlecont").eq(r).find("li").length; s++) {
                            if ($(v).find(".DetailTitletitlecont").eq(r).find("li").eq(s).attr("data-check") == 1) {
                                correctAnswer += $(v).find(".DetailTitletitlecont").eq(r).find("li").eq(s).attr("data-value");
                            }
                        }

                        if (correctAnswer.length > 0) {
                            if ($(v).find(".DetailTitletitlecont").eq(r).next().next().children().children().find(".sanwer").attr("data-id") == correctAnswer) {
                                correctnum++;
                                Score = parseInt($("#" + questionid).attr("score"));
                                totalscore = parseInt($("#" + questionid).attr("score"));
                                ajson += "{\"qID\": \"" + questionid + "\",\"pDID\": \"" + questionidid + "\",\"answer\": \"" + correctAnswer + "\",\"Score\": \"" + Score + "\",\"result\": \"" + 1 + "\"}" + ",";
                                if (correctnum == $(v).find(".DetailTitletitlecont").length) {
                                    $("li[questionid='" + questionidid + "']").removeClass("dopronumberconton2");
                                    $("li[questionid='" + questionidid + "']").addClass("dopronumberconton3");
                                }
                            } else {
                                ajson += "{\"qID\": \"" + questionid + "\",\"pDID\": \"" + questionidid + "\",\"answer\": \"" + correctAnswer + "\",\"Score\": \"" + 0 + "\",\"result\": \"" + 0 + "\"}" + ",";
                                $("li[questionid='" + questionidid + "']").removeClass("dopronumberconton1");
                                $("li[questionid='" + questionidid + "']").addClass("dopronumberconton2");
                            }
                        }
                    }


                }
            }
            else {


                for (var r = 0; r < $(v).find(".DetailTitletitReadingSelect").length; r++) {

                    questionid = $(v).find(".DetailTitletitReadingSelect").eq(r).attr("id");


                    var correctAnswer = "";
                    for (var s = 0; s < $(v).find(".DetailTitletitReadingSelect").eq(r).find("i").length; s++) {
                        if ($(v).find(".DetailTitletitReadingSelect").eq(r).find("i").eq(s).attr("data-check") == 1) {
                            correctAnswer += $(v).find(".DetailTitletitReadingSelect").eq(r).find("i").eq(s).attr("data-value");
                        }
                    }

                    var questionAnswer = "";
                    for (var s = 0; s < $(v).find(".DetailTitletitReadingSelect").eq(r).find("i").length; s++) {
                        if ($(v).find(".DetailTitletitReadingSelect").eq(r).find("i").eq(s).attr("answer") == 1) {
                            questionAnswer += $(v).find(".DetailTitletitReadingSelect").eq(r).find("i").eq(s).attr("data-value");
                        }
                    }

                    if (correctAnswer.length > 0) {

                        if (questionAnswer != "" && questionAnswer == correctAnswer) {
                            correctnum++;
                            Score = parseInt($("#" + questionid).attr("score"));
                            totalscore = parseInt($("#" + questionid).attr("score"));
                            ajson += "{\"qID\": \"" + questionid + "\",\"pDID\": \"" + questionidid + "\",\"answer\": \"" + correctAnswer + "\",\"Score\": \"" + Score + "\",\"result\": \"" + 1 + "\"}" + ",";
                            if (correctnum == $(v).find(".DetailTitletitReadingSelect").length) {
                                $("li[questionid='" + questionidid + "']").removeClass("dopronumberconton2");
                                $("li[questionid='" + questionidid + "']").addClass("dopronumberconton3");
                            }
                        } else {
                            ajson += "{\"qID\": \"" + questionid + "\",\"pDID\": \"" + questionidid + "\",\"answer\": \"" + correctAnswer + "\",\"Score\": \"" + 0 + "\",\"result\": \"" + 0 + "\"}" + ",";
                            $("li[questionid='" + questionidid + "']").removeClass("dopronumberconton1");
                            $("li[questionid='" + questionidid + "']").addClass("dopronumberconton2");
                        }
                    }
                }

            }

        }


        //会计分析题获取
        else if ($(v).attr("data-type") == "28") {
            var xxx = $(v).attr("id");

            $('.' + xxx + xxx + xxx + xxx + xxx + '').removeClass($('.' + xxx + xxx + xxx + xxx + xxx + '')).addClass($('.' + xxx + xxx + xxx + xxx + xxx + '')).css('display', 'block');
            //--------------开始---------------
            var minamber = 0; //小题个数
            var errnamber = 0; //做对个数
            var jsfx = $(v).find("div .m-sonitem");

            //遍历所有计算分析题
            $(jsfx).each(function (f, s) { //计算分析题小题遍历
                questionid = $(s).attr("id");


                if ($(s).attr("data-type") == "29")//填空题
                {
                    if ($(s).find("input.AccountOneValue").val() == $(s).find("input.AccountOneValue").attr("answer").replace(/\s/g, "")) { //答对
                        yesorno = 1;
                        minamber++;
                        errnamber++;
                        Score += parseInt($("#" + questionid).attr("score"));  //XXX
                        totalscore += parseInt($("#" + questionid).attr("score"));
                        ajson += "{\"qID\": \"" + questionid + "\",\"pDID\": \"" + xxx + "\",\"answer\": \"" + $(s).find("input.AccountOneValue").val() + "\",\"Score\": \"" + Score + "\",\"result\": \"" + yesorno + "\"}" + ",";
                    } else if ($(s).find("input.AccountOneValue").val() != "") {
                        yesorno = 0;
                        minamber++;
                        ajson += "{\"qID\": \"" + questionid + "\",\"pDID\": \"" + xxx + "\" ,\"answer\": \"" + $(s).find("input.AccountOneValue").val() + "\",\"Score\": \"" + Score + "\",\"result\": \"" + yesorno + "\"}" + ",";
                    }
                    else {
                        yesorno = 0;
                        minamber++;
                        ajson += "";
                    }
                }
                else if ($(s).attr("data-type") == "30")//会计分录
                {

                    answer = "";
                    if (JSFXAnswerData.length > 0) { //所有会计分录的答案个数大于0

                        if ($(s).attr("mode") == "1")  //moda=1 传统模式
                        {
                            var towrdLen = 0;
                            var towardIndexStr = "";
                            var towardIndex = ""; //方向
                            var valueIsTureLen = 0; //判断值一致
                            for (var i = 0; i < JSFXAnswerData.length; i++) { //题目答案
                                var myAnswerData = []; //用户选择和输入的答案
                                var AnswerData = eval(JSFXAnswerData[i][0]); //答案集合
                                if (AnswerData.iD == $(s).attr("id")) { //本题id对应的答案
                                    answer = ""; //答案

                                    var ansnaber = $(s).find("select[data-check='1']").length; //选中个数

                                    if (ansnaber > 0) {
                                        var answerdate = eval(AnswerData.answer); //这道题的答案
                                        var answerlength = answerdate.length;
                                        for (var d = 0; d < answerdate.length; d++) { //答案中选项个数
                                            if (answerdate[d].One == "借") {
                                                towardIndex = d + ","; //借 所在的位置
                                            }
                                        }
                                        $(s).find("div.m-sonitem_item").each(function (w, f) {
                                            if ($(f).find(".ddlOne option:selected").text() != "" || $(f).find(".ddlTwo option:selected").text() != "" || $(f).find(".AccountValue").val() != "") {
                                                myAnswerData.push($(f).find(".ddlOne option:selected").text() + "," + $(f).find(".ddlTwo option:selected").val() + "," + $(f).find(".AccountValue").val()); //获取所有选项答案
                                                answer += "{'one': '" + $(f).find(".ddlOne option:selected").text() + "','two': '" + $(f).find(".ddlTwo option:selected").val() + "','three': '" + $(f).find(".AccountValue").val() + "'}" + ",";
                                            }
                                            for (var d = 0; d < answerdate.length; d++) { //答案中选项个数
                                                if (answerdate[d].One == $(f).find(".ddlOne option:selected").text() && answerdate[d].Two == $(f).find(".ddlTwo option:selected").val() && answerdate[d].Three == $(f).find(".AccountValue").val()) {
                                                    valueIsTureLen++; //正确的答案个数
                                                }
                                            }

                                        })

                                        if (towardIndex != "") {
                                            towardIndex = towardIndex.substring(0, towardIndex.length - 1);
                                        }
                                        var indexdata = towardIndex.split(',');
                                        for (var v = 0; v < indexdata.length; v++) {
                                            for (var j = 0; j < myAnswerData.length; j++) {
                                                if (indexdata[v] == j) { //答案中借的位置与选项要一致
                                                    var mySonAnswerData = myAnswerData[j].split(',');
                                                    //    alert(mySonAnswerData);
                                                    if (mySonAnswerData[0] == "借") {
                                                        towrdLen++; //借 的个数
                                                        break;
                                                    }
                                                }
                                            }
                                        }
                                        answer = answer.substring(0, answer.length - 1);

                                        //值&方向一致
                                        if (answerlength == myAnswerData.length && valueIsTureLen == myAnswerData.length && towrdLen == indexdata.length) {
                                            yesorno = 1;
                                            if (answer != "") {
                                                errnamber++;
                                                minamber++;//

                                                Score += parseInt($("#" + AnswerData.iD).attr("score"));
                                                totalscore += parseInt($("#" + AnswerData.iD).attr("score"));
                                                ajson += "{\"qID\": \"" + AnswerData.iD + "\" ,\"pDID\": \"" + xxx + "\",\"answer\": \"" + answer + "\",\"Score\": \"" + Score + "\",\"result\": \"" + yesorno + "\"}" + ",";
                                            }

                                        }

                                        else {
                                            yesorno = 0;
                                            minamber++;//
                                            if (answer != "") {
                                                ajson += "{\"qID\": \"" + AnswerData.iD + "\",\"pDID\": \"" + xxx + "\",\"answer\": \"" + answer + "\",\"Score\": \"" + Score + "\",\"result\": \"" + yesorno + "\"}" + ",";
                                            }
                                        }
                                    }
                                    else { //没有作答
                                        yesorno = 0;
                                        minamber++;//
                                        if (answer != "") {
                                            ajson += "{\"qID\": \"" + AnswerData.iD + "\",\"pDID\": \"" + xxx + "\",\"answer\": \"" + answer + "\",\"Score\": \"" + Score + "\",\"result\": \"" + yesorno + "\"}" + ",";
                                        }
                                    }

                                }

                            }
                        }
                        else if ($(s).attr("mode") == "2")// mode=2 固定模式
                        {
                            for (var i = 0; i < JSFXAnswerData.length; i++) {
                                var AnswerData = eval(JSFXAnswerData[i][0]);
                                if (AnswerData.iD == questionid) {
                                    minamber++;
                                    var answerdate = eval(AnswerData.answer); //这道题的答案
                                    var ansnaber = $(s).find("select[data-check='1']").length; //选中个数
                                    var valueIsTureLen = 0; //答对个数
                                    if (ansnaber > 0) {
                                        $(s).find(".m-sonitem_item").each(function (w, f) { //所有选项答案
                                            for (var d = 0; d < answerdate.length; d++) { //答案中选项个数
                                                if ($(f).find(".ddlOne option:selected").val() == answerdate[d].One && $(f).find(".ddlTwo option:selected").val() == answerdate[d].Two && $(f).find(".AccountValue").val() == answerdate[d].Three) {
                                                    valueIsTureLen++;
                                                }
                                                else {
                                                    yesorno = 0;
                                                }

                                            }
                                            if ($(f).find(".ddlOne option:selected").text() != "" || $(f).find(".ddlTwo option:selected").text() != "" || $(f).find(".AccountValue").val() != "") {
                                                answer += "{'one': '" + $(f).find(".ddlOne option:selected").text() + "','two': '" + $(f).find(".ddlTwo option:selected").val() + "','three': '" + $(f).find(".AccountValue").val() + "'}" + ",";
                                            }
                                        })
                                        if (valueIsTureLen == answerdate.length) {
                                            yesorno = 1;
                                            errnamber++;
                                            Score += parseInt($("#" + AnswerData.iD).attr("score"));

                                            totalscore += parseInt($("#" + AnswerData.iD).attr("score"));
                                        }
                                        else {
                                            yesorno = 0;
                                        }

                                        if (answer != "") {

                                            answer = answer.substring(0, answer.length - 1);
                                            ajson += "{\"qID\": \"" + AnswerData.iD + "\",\"pDID\": \"" + xxx + "\",\"answer\": \"" + answer + "\",\"Score\": \"" + Score + "\",\"result\": \"" + yesorno + "\"}" + ",";
                                        }
                                    }
                                    else {
                                        yesorno = 0;
                                        if (answer != "") {
                                            ajson += "{\"qID\": \"" + AnswerData.iD + "\",\"pDID\": \"" + xxx + "\",\"answer\": \"" + answer + "\",\"Score\": \"" + Score + "\",\"result\": \"" + yesorno + "\"}" + ",";
                                        }
                                    }

                                }
                            }

                        }

                    }
                }
            })
            if (minamber == errnamber && minamber != 0) { //小题个数和答对个数相等 ErrorNum+1
                ErrorNum++;

                $("li[questionid='" + xxx + "']").removeClass("dopronumberconton1");
                $("li[questionid='" + xxx + "']").addClass("dopronumberconton3");
            }
            else {
                if ($("li[questionid='" + xxx + "']").hasClass('dopronumberconton1')) {
                    if (minamber == errnamber) {
                        $("li[questionid='" + xxx + "']").removeClass("dopronumberconton2");
                        $("li[questionid='" + xxx + "']").addClass("dopronumberconton3");
                    }
                    else {
                        $("li[questionid='" + xxx + "']").removeClass("dopronumberconton1");
                        $("li[questionid='" + xxx + "']").addClass("dopronumberconton2");
                    }

                } else {

                }

            }
        }

        //--------------结束---------------

        //简答题答案获取
        else {
            //简答题遍历
            questionid = $(v).attr("data-id"); //题目id

            var multi = $(v).find(".multiple-text");
            questionid = $(v).attr("id");
            $(multi).each(function (n, s) {
                if ($(s).val() != "") { //只有答案不为空时添加
                    answer = $(s).val();
                    $("li[questionid='" + questionid + "']").removeClass($("li[questionid='" + questionid + "']")).addClass($("li[questionid='" + questionid + "']")).css('background', '#f6fdfa');

                    $("li[questionid='" + questionid + "']").removeClass($("li[questionid='" + questionid + "']")).addClass($("li[questionid='" + questionid + "']")).css('border', '1px solid #56e198');

                    yesorno = 1;
                    ErrorNum++;
                    Score += parseInt($("#" + questionid).attr("score"));
                    totalscore += parseInt($("#" + questionid).attr("score"));
                    ajson += "{\"qID\": \"" + questionid + "\",\"pDID\": \"" + questionid + "\",\"answer\": \"" + answer + "\",\"Score\": \"" + Score + "\",\"result\": \"" + yesorno + "\"}" + ",";
                }
                else {
                    questionid = $(v).attr("id");
                    answer = "";
                    yesorno = 1;
                }
            })
        }



    });




    allscore = Score;
    if (ajson != "") {
        ajson = ajson.substr(0, ajson.length - 1); //去除最后一个逗号
    }


    if ($("#HFHID").val() != "") {
        DoHistoryID = $("#HFHID").val();
    }
    $(".answeranswer").removeClass($("answeranswer")).addClass($("answeranswer")).css('display', 'block');
    var SbDateTime = "";//交卷时间
    SbDateTime = "";
    var e = new Date();
    SbDateTime += e.getFullYear() + '年'; //获取当前年份
    SbDateTime += e.getMonth() + 1 + '月'; //获取当前月份（0——11）
    SbDateTime += e.getDate() + '日';
    SbDateTime += e.getHours() + '时';
    SbDateTime += e.getMinutes() + '分';
    SbDateTime += e.getSeconds() + '秒';

    $("#submit").html(SbDateTime);
    $("#ErrorNum").html(ErrorNum);
    $("#Score").html(allscore);

    return ajson;
}




////右边答题信息跟随滚动条
var elFix = "";
var elFix2 = "";
var elFix3 = 0;
var suspensionright = "";
var quesnumberlenght = -1;
$(function () {
    suspensionright = document.getElementById('suspensionright');
});

function htmlScroll() {
    if ($(".doproblemsset .doproblemssetmodel div").find(".doproblemssetmodelclick").text() == "单题模式") {
        elFix.style.position = 'absolute';
        elFix.style.top = "30px";
        elFix.style.right = 0;
        return;
    }
    var top = document.body.scrollTop || document.documentElement.scrollTop;

    if (elFix.data_top < top && elFix2 > (top + elFix.scrollHeight) && elFix3 == 0 && quesnumberlenght > 2) {
        elFix.style.position = 'absolute';
        elFix.style.top = top + "px";
        elFix.style.right = 0;
    }
    else if (elFix2 <= (top + elFix.scrollHeight) && elFix3 == 0 && quesnumberlenght > 1) {
        elFix.style.position = 'absolute';
        elFix.style.top = elFix2 - elFix.scrollHeight + 30 + "px";
        elFix.style.right = 0;
    }
    else {
        elFix = document.getElementById('contentright');
        elFix.style.position = 'static';
    }
    if ((elFix2 - 650) < top) {
        suspensionright.style.position = 'fixed';
        suspensionright.style.top = "";
        suspensionright.style.bottom = "400px";
        suspensionright.style.right = 0;

    } else {
        suspensionright.style.position = 'fixed';
        suspensionright.style.top = "";
        suspensionright.style.bottom = "200px";
        suspensionright.style.right = 0;
    }

}
function stopload() {

    suspendedcancel.close();
}


function htmlPosition(obj) {
    var o = obj;
    var t = o.offsetTop;
    var l = o.offsetLeft;
    while (o = o.offsetParent) {
        t += o.offsetTop;
        l += o.offsetLeft;
    }
    obj.data_top = t;
    obj.data_left = l;
    htmlScroll();
}
window.onscroll = htmlScroll;

//显示隐藏解析
function Showhiddenparsing(one) {
    var parsing = $(one).parent().parent().parent().next();
    var notesingbtn = $(one).parent().parent().parent().next().find(".DetailTitleparsingnotes");
    var notesing = $(one).parent().parent().parent().next().find(".DetailTitleparsingtakenotes");
    if ($(one).children().hasClass('packupparsing') && $(one).children().hasClass('packupparsing2')) {
        $(one).children().removeClass('packupparsing2');
        $(one).find(".parsing").text("查看答案");
        $(parsing).removeClass("DetailTitleparsing2");
        $(notesingbtn).find(".netfriendnotes").removeClass("netfriendnotes2");
        $(notesingbtn).find(".takenotes").addClass("takenotes2")
        $(notesing).addClass("DetailTitleparsingtakenotes2");
        $(notesing).next().removeClass("DetailTitlenetfriendnotes2");
    }
    else if ($(one).children().hasClass('packupparsing')) {
        $(one).children().addClass('packupparsing2');
        $(one).find(".parsing").text("隐藏答案")
        $(parsing).addClass("DetailTitleparsing2");
    }
    else if ($(one).children().hasClass('textparsing')) {//文字解析
        if ($(parsing).hasClass('DetailTitleparsing2')) {
            $(parsing).removeClass("DetailTitleparsing2");
            $(notesingbtn).find(".netfriendnotes").removeClass("netfriendnotes2");
            $(notesingbtn).find(".takenotes").removeClass("takenotes2")
            $(notesing).removeClass("DetailTitleparsingtakenotes2");
            $(notesing).next().removeClass("DetailTitlenetfriendnotes2");
        } else {
            $(parsing).addClass("DetailTitleparsing2");
        }
    }

}

//做题模式（显示答案）
function Accordingtowronganswer(one) {

    if ($(".doproblemssetanswer select").val() != "0") {
        var parsing = $(one).parent().parent().parent().find(".DetailTitletitleactive").children().children();
        var DetailTitleparsing = $(one).parent().parent().parent().parent().find(".DetailTitleparsing");
        $(one).parent().parent().parent().find(".DetailTitletitleactive").find(".parsing").text("隐藏答案");
        $(parsing).find(".packupparsing").addClass("packupparsing2");
        $(parsing).find(".parsing").addClass("packupparsing2");
        $(DetailTitleparsing).addClass("DetailTitleparsing2");

    }
}





//写cookies 一路径为标准,Path – 路径
function setCookie(name, value, time) {
    var strsec = getsec(time);
    var exp = new Date();
    exp.setTime(exp.getTime() + strsec * 1);
    document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString() + ";path=/";
}

//设定cookies过期时间
function getsec(str) {
    var str1 = str.substring(1, str.length) * 1;
    var str2 = str.substring(0, 1);
    if (str2 == "s") {
        return str1 * 1000;
    }
    else if (str2 == "h") {
        return str1 * 60 * 60 * 1000;
    }
    else if (str2 == "d") {
        return str1 * 24 * 60 * 60 * 1000;
    }
    else if (str2 == "m") {
        return str1 * 30 * 24 * 60 * 60 * 1000;
    }
}
//读取cookies
function getCookie(name) {
    var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
    if (arr = document.cookie.match(reg))

        return unescape(arr[2]);
    else
        return null;
}
//删除cookies
function delCookie(name) {
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = getCookie(name);
    if (cval != null)
        document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString() + ";path=/";
}


$(function () {
    //返回顶部
    $(".suspensionright ul li .backtotop").click(function () {
        $("body,html").animate({ scrollTop: $("#nav").offset().top - 20 });
    });

})

