$(function () {
    if (localStorage.name) {
        $(".name").val(localStorage.name);
        // $(".pwd").val(localStorage.pwd);
    } else if (localStorage.name == "") {
        $(".name").val("");
        $(".pwd").val("");
    }
})

var secondC = false; // 对于已经出现了验证码框的判断值
$("input:submit").on("click", function () {
    var name = $(".name").val();
    var pwd = $(".pwd").val();
    var check = $(".check").val();
    var stopForm = true; // 阻止表单提交的判断值

    if (!(/^1[34578]\d{9}$/.test(name)) || !(/^.{6,12}$/).test(pwd)) {
        bootbox.alert("手机号码或密码输入有误，请重填");
        return false;
    }
    $.ajax({
        url: 'http://fenxiao.qphvip.com/admin.php/Login/PostLogin',
        type: "POST",
        async: false,
        data: {
            P: name,
            M: pwd
        },
        dataType: 'json',
        success: function (data) {
            // console.log(data);
            if ($("#check-box").prop("checked") == true) {
                localStorage.setItem("name", name);
                localStorage.setItem("pwd", pwd);
            } else {
                localStorage.setItem("name", "");
                localStorage.setItem("pwd", "");
            }
            data.code = 3;
            data.message = "检测到您登录地址与上次登录地址不同，请进行身份核实登录";
            if (data.code == "0") { // "账号或密码有误"
                bootbox.alert(data.message);
                stopForm = false;
            } else if (data.code == "1") { // "登录成功"
                bootbox.alert(data.message);
                $(".submit").val("登陆中...");
                stopForm = true;
            }
            if (data.code == "3") { // "检测到您登录地址与上次登录地址不同，请进行身份核实登录"
                if (secondC) { // 第一次点击阻止表单提交，已经显示验证码框。第二次点击时，对验证码验证
                    $.ajax({
                        url: "http://fenxiao.qphvip.com/admin.php/Login/CheckLogin",
                        type: "POST",
                        async: false,
                        data: {
                            P: name,
                            M: pwd,
                            C: check
                        },
                        dataType: "json",
                        success: function (data) {
                            if (data.code == "0") {
                                bootbox.alert(data.message);
                                stopForm = false;
                            } else if (data.code == "1") {
                                bootbox.alert(data.message);
                                $(".submit").val("登陆中...");
                                stopForm = true;
                            }
                        }
                    })
                } else {
                    bootbox.alert(data.message);
                    $(".display").show();
                    secondC = true;
                    stopForm = false;
                }
            }
        }
    });
    return stopForm;
})



    /* $.ajax({  
            url : 'http://fenxiao.qphvip.com/admin.php/Home/Index/PostLogin',  
            data : {  
                P:name,
                M:pwd
            },  
            dataType : 'json',  
            success : function(data) {  
                console.log(data);
                if (data.code == "0") {  
                    alert("账号或密码错误");  
                } else if (data.code=="1") {
                    alert("登录成功");
                }else if (data.code=="2") {
                    alert("该账号已禁用，请联系总管理员");
                }else if (data.code=="3") {
                    alert("检测到您登录地址与上次登录地址不同，请进行身份核实验证");

                }

            } 
    });  */
