$(function () {
    //切换分类
    $("#switchOneClass").click(function () {
        sitchOneClassification();
    });

    //智能刷题
    //$(".leftcontent .threeli").click(function () {
    //    brushtopi();
    //});
    $(".homeContentLi .homebrushtopi").click(function () {
        brushtopi();
    });

    //继续上次练习
    //$(".leftcontent .eightli").click(function () {
    //    lasttimeprac();
    //});
    //$(".homeContentLi .homelasttimeprac").click(function () {
    //    lasttimeprac();
    //});

    // 切换科目科目样式
    $(".chapright .lefttop ul li a").click(function () {
        $(".chapright .lefttop ul li a").removeClass("lefttop-a-this");
        $(this).addClass("lefttop-a-this");

    });


});

//});
//切换分类弹窗
function sitchOneClassification() {
    $.dialog({
        title: "&nbsp;<span style='font-size: 14px;color: #2d374b;'>请选择您参加的考试</span>",
        width: "770px",
        height: "450px",
        content: $("#Popupwindow").html(),
        lock: true,
        //fixed: true,
        opacity: 0.3,
        drag: false,
        padding: 0
    });
    //重新加载一次
    //switchClassOverloading();
}

//智能刷题
function brushtopi() {
    var html = '<div id="brushtopi"><div class="brushtopicont"><div class="brushtopiimg"><i></i><span>智能练习将为您随机抽取习题<br />'
        + ' 是否开始练习？</span></div><div class="brushtopibtn"><a class="brushtopicancel">取消</a><a class="brushtopisubmit">确定</a>'
        + '</div></div></div>';
    var suspendedcancel = $.dialog({
        title: "&nbsp;<span style='font-size: 16px;color: #000;'>智能刷题</span>",
        width: "480px",
        height: "310px",
        content: html,
        lock: true,
        fixed: true,
        opacity: 0.3,
        drag: false,
        padding: 0
    });
    //弹窗取消
    $(".brushtopicancel").click(function () {
        suspendedcancel.close();
    });
}
////继续上次练习
//function lasttimeprac() {
//    var html = '<div id="lasttimeprac">'
//         +'<div class="lasttimepraccont">'
//            +'<div class="lasttimepracimg">'
//                +'<i></i>'
//                +'<span>是否继续上次练习？</span>'
//            +'</div>'
//            +'<div class="lasttimepracbtn">'
//                +'<a class="lasttimepraccancel">取消</a>'
//                +'<a class="lasttimepracsubmit">确定</a>'
//            +'</div>'
//        + '</div>'
//    +'</div>';
//    var suspendedcancel = $.dialog({
//        title: "&nbsp;<span style='font-size: 16px;color: #000;'>继续上次练习</span>",
//        width: "480px",
//        height: "310px",
//        content: html,
//        lock: true,
//        fixed: true,
//        opacity: 0.3,
//        drag: false,
//        padding: 0
//    });
//    //弹窗取消
//    $(".lasttimepraccancel").click(function () {
//        suspendedcancel.close();
//    });
//}



