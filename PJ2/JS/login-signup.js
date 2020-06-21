var pass=6;
function cleanspan() {
    var sp = document.getElementById("myspan");
    sp.replace(sp.value,' ');
}
function check() {
    var password = document.getElementById("set").value;
    var sp = document.getElementById("myspan");
    if (password.length === 0) {
        sp.innerHTML = "密码不能为空";
    } else if(password.length<6){sp.innerHTML = "密码等级'较弱' 请加强";}
    else if (password.length >= 6 && password.length < 16) {
            sp.innerHTML = "密码等级'中等'";
            pass--;
    } else if (password.length >= 16) {
        sp.innerHTML = "密码等级'较强'";
        pass--;
    }
}

function com(){
    cleanspan();
    var password = document.getElementById("set").value;
    var compass = document.getElementById("com").value;
    var sp = document.getElementById("myspan");
    if (compass.length === 0) {
        sp.innerHTML = "请再次输入密码";}
    else if(compass.value === password.value){
        sp.innerHTML = "请再次输入密码";
    }
}