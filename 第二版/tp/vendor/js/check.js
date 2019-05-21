function checksubs(){
    var myReg=/^[a-zA-Z0-9_-]+@([a-zA-Z0-9]+\.)+(com|cn|net|org)$/;
    if($("#username").val()==""){
        //用户名没有输入
        alert("请输入用户名!");
        return false;
    }else if($("#password").val()==""){
        alert("请输入密码");
        return false;
    }else if($("#password").val()!= $("#password2").val()){
        alert("两次输入密码不一致!");
        alert($("#password").val());
        alert($("#password2").val());
        return false;
    }else if(!myReg.test($("#email").val())){
            alert("邮箱格式不正确！");
             return false;
    }else if (!(/^1[3|4|5|7|8][0-9]\d{8,11}$/.test($("#phone").val()))){
        alter("手机号格式不正确!");
        return false;
    }


}