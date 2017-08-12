
$(function () {
    // 初始化记住用户名
    if (localStorage.name) {
        $(".name").val(localStorage.name);
        // $(".pwd").val(localStorage.pwd);
    } else if (localStorage.name == "") {
        $(".name").val("");
        // $(".pwd").val("");
    }

    /**
     * 正常登录时的验证
     */
    $("#submit").on("click", function () {
        var name = $(".name").val();
        var pwd = $(".pwd").val();

        // 验证手机格式
        if (!(/^1[34578]\d{9}$/.test(name))) {
            bootbox.alert("手机号格式有误，请重填");
            return false;
        }
        // 验证密码格式
        if (!(/^.{6,12}$/).test(pwd)) {
            bootbox.alert("密码格式为6~12位，请重填");
            return false;
        }

        $.ajax({
            url: 'http://fenxiao.qphvip.com/admin.php/Login/PostLogin',
            type: "POST",
            data: {
                P: name,
                M: pwd
            },
            dataType: 'json',
            success: function (data) {
                
                // 记住用户名的判断
                if ($("#check-box").prop("checked") == true) {
                    localStorage.setItem("name", name);
                    // localStorage.setItem("pwd", pwd);
                } else {
                    localStorage.setItem("name", "");
                    // localStorage.setItem("pwd", "");
                }
                // 判断data数据
                if (data.code == "0") { 
                    bootbox.alert(data.message);
                    return false;
                } else if (data.code == "1") { 
                    // bootbox.alert(data.message);
                    $(".submit").val("登陆中...");
                    location.href = "http://fenxiao.qphvip.com/admin.php/index/index.html";
                } else if (data.code == "3") { 
                        bootbox.alert(data.message);
                        $(".submit").hide();
                        $(".display").show();
                        // $(".request").countDown();
                        countDown();
                        return false;
                }
            }
        });
    });

    /**
     * 登录中，出现checkLogin时的验证
     */
    $("#checkLogin_submit").click(function(){
        var name = $(".name").val();
        var pwd = $(".pwd").val();
        var check = $(".verification").val();

        $.ajax({
            url: "http://fenxiao.qphvip.com/admin.php/Login/CheckLogin",
            type: "POST",
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
                    // bootbox.alert(data.message);
                    $(".submit").val("登陆中...");
                    location.href = "http://fenxiao.qphvip.com/admin.php/index/index.html";
                }
            }
        })
    })

    /**
     * ‘获取验证码’倒计时函数
     */
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

    /**
     * ‘获取验证码’点击事件
     */
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