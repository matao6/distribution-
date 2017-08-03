$(function () {
    if (localStorage.name) {
        $(".name").val(localStorage.name);
        // $(".pwd").val(localStorage.pwd);
    } else if (localStorage.name == "") {
        $(".name").val("");
        // $(".pwd").val("");
    }
})

var secondC = false; // 对于已经出现了验证码框的判断值
$(".submit").on("click", function () {
    var name = $(".name").val();
    var pwd = $(".pwd").val();
    var check = $(".check").val();

    if (!(/^1[34578]\d{9}$/.test(name)) || !(/^.{6,12}$/).test(pwd)) {
        bootbox.alert("手机号码输入有误，请重填");
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
            if (data.code == "0") { // "账号或密码有误"
                bootbox.alert(data.message);
                return false;
            } else if (data.code == "1") { // "登录成功"
                bootbox.alert(data.message);
                $(".submit").val("登陆中...");
                location.href = "?login-success";
            } else if (data.code == "3") { // "检测到您登录地址与上次登录地址不同，请进行身份核实登录"
                if (secondC) { // 第一次点击阻止ajax提交，已经显示验证码框。第二次点击时，对验证码验证
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
                                return false;
                            } else if (data.code == "1") {
                                bootbox.alert(data.message);
                                $(".submit").val("登陆中...");
                            }
                        }
                    })
                } else {
                    bootbox.alert(data.message);
                    $(".display").show();
                    // $(".request").countDown();
                    countDown();
                    secondC = true;
                    return false;
                }
            }
        }
    });
})

var time = 60;

function countDown() {
    if (time == 0) {
        $(".request").val("获取验证码");
        $(".request").attr("disabled", false);
        $(".request").css("cursor", "pointer");
        time = 60;
        clearInterval(set);
    } else {
        $(".request").val(time + 's');
        $(".request").attr("disabled", true);
        $(".request").css("cursor", "default");
        time--;
        var set = setTimeout(function () {
            countDown()
        }, 1000);
    }
}

$(".request").click(function () {
    var name = $(".name").val();
    $.ajax({
        url: "http://fenxiao.qphvip.com/admin.php/Login/SendCode",
        type: "POST",
        data: {
            P: name
        },
        dataType: "json",
        success: function (data) {
            countDown();
            // data.code=1;
            if (data.code == "0") {
                bootbox.alert(data.message);
                return false;
            } else if (data.code == "1") {
                bootbox.alert(data.message);
            }
        }
    })
})

// $.fn.extend({
//     countDown: function () {
//         if ($(this).prop(setTime)) {
//             if ($(this).attr(setTime) == 0) {
//                 $(this).text("获取验证码");
//                 clearInterval(set);
//             } else {
//                 $(this).text(time + 's');
//                 $(this).attr(setTime)--;
//             }
//         } else {
//             $(this).attr(setTime) = 60;
//         }
//         var set = setTimeout(function () {
//             $(this).countDown();
//         }, 1000);
//     }
// });