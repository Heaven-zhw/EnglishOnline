// JavaScript Document

$(document).ready(function () {

    //涓汉鐢ㄦ埛涓嬫媺鑿滃崟鐨勫垏鎹紙鏈€鍙宠竟瀵艰埅鏍忥級
    $('.nav-user li').mousemove(function () {
        $(this).find("ul").show();//you can give it a speed
    });
    $('.nav-user li').mouseleave(function () {
        $(this).find("ul").hide();
    });

    //娉ㄥ唽寮圭獥
    $(".nav-reg").click(function () {
        navregisterPopup();
    });

    //鐧诲綍寮圭獥
    $(".nav-login").click(function () {
        navloginPopup();
    });


});


//娉ㄥ唽寮圭獥
function navregisterPopup() {
    //iframe灞�
    layer.open({
        type: 2,
        title: false,
        closeBtn: 1, //涓嶆樉绀哄叧闂寜閽�
        shade: [0],
        area: ['450px', '557px'],
        anim: 0,
        content: '../../registerPopup.html', //iframe鐨剈rl(娉ㄦ剰璺緞闂)锛坔ttp://localhost鏈€濂斤級
        end: function () { //姝ゅ鐢ㄤ簬婕旂ず
            //alert("fgdfgdfsgdfs");
            //鍏抽棴鐨勬椂鍊欐墽琛�
        }
    });
}

//鐧诲綍寮圭獥
function navloginPopup() {
    //iframe灞�
    layer.open({
        type: 2,
        title: false,
        closeBtn: 1, //涓嶆樉绀哄叧闂寜閽�
        shade: [0],
        area: ['450px', '475px'],
        anim: 0,
        content: '../../loginPopup.html', //iframe鐨剈rl(娉ㄦ剰璺緞闂)锛坔ttp://localhost鏈€濂斤級
        end: function () { //姝ゅ鐢ㄤ簬婕旂ず
            //alert("fgdfgdfsgdfs");
            //鍏抽棴鐨勬椂鍊欐墽琛�
        }
    });
}



//鍏煎鍏朵粬涓嶆敮鎸乸laceholder鐨勬祻瑙堝櫒锛�
//浠嬬粛涓€涓秴寮虹殑璁㊣E涓嬫敮鎸乸laceholder鐨勫睘鎬ф彃浠�, 浠ｇ爜濡備笅锛�
$(document).ready(function () {
    function initPlaceHolders() {
        if ('placeholder' in document.createElement('input')) { //濡傛灉娴忚鍣ㄥ師鐢熸敮鎸乸laceholder
            return;
        }
        function target(e) {
            var e = e || window.event;
            return e.target || e.srcElement;
        };
        function _getEmptyHintEl(el) {
            var hintEl = el.hintEl;
            return hintEl && g(hintEl);
        };
        function blurFn(e) {
            var el = target(e);
            if (!el || el.tagName != 'INPUT' && el.tagName != 'TEXTAREA') return;//IE涓嬶紝onfocusin浼氬湪div绛夊厓绱犺Е鍙�
            var emptyHintEl = el.__emptyHintEl;
            if (emptyHintEl) {
                //clearTimeout(el.__placeholderTimer||0);
                //el.__placeholderTimer=setTimeout(function(){//鍦�360娴忚鍣ㄤ笅锛宎utocomplete浼氬厛blur鍐峜hange
                if (el.value) emptyHintEl.style.display = 'none';
                else emptyHintEl.style.display = '';
                //},600);
            }
        };
        function focusFn(e) {
            var el = target(e);
            if (!el || el.tagName != 'INPUT' && el.tagName != 'TEXTAREA') return;//IE涓嬶紝onfocusin浼氬湪div绛夊厓绱犺Е鍙�
            var emptyHintEl = el.__emptyHintEl;
            if (emptyHintEl) {
                //clearTimeout(el.__placeholderTimer||0);
                emptyHintEl.style.display = 'none';
            }
        };
        if (document.addEventListener) {//ie
            document.addEventListener('focus', focusFn, true);
            document.addEventListener('blur', blurFn, true);
        }
        else {
            document.attachEvent('onfocusin', focusFn);
            document.attachEvent('onfocusout', blurFn);
        }

        var elss = [document.getElementsByTagName('input'), document.getElementsByTagName('textarea')];
        for (var n = 0; n < 2; n++) {
            var els = elss[n];
            for (var i = 0; i < els.length; i++) {
                var el = els[i];
                var placeholder = el.getAttribute('placeholder'),
                    emptyHintEl = el.__emptyHintEl;
                if (placeholder && !emptyHintEl) {
                    emptyHintEl = document.createElement('span');
                    emptyHintEl.innerHTML = placeholder;
                    emptyHintEl.className = 'emptyhint';
                    emptyHintEl.onclick = function (el) { return function () { try { el.focus(); } catch (ex) { } } }(el);
                    if (el.value) emptyHintEl.style.display = 'none';
                    el.parentNode.insertBefore(emptyHintEl, el);
                    el.__emptyHintEl = emptyHintEl;
                }
            }
        }
    }
    initPlaceHolders();
});
