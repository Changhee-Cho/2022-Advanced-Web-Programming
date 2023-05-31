
function checkid(){
	var userid = document.getElementById("uid").value;
	if(userid)
	{
		url = "check.php?userid="+userid;
		window.open(url,"chkid","width=400,height=200");
	} else {
		alert("아이디를 입력하세요.");
	}
}

function decide(){
	document.getElementById("decide").innerHTML = "<span style='color:red;'>ID 중복 여부를 확인해주세요.</span>"
	document.getElementById("decide_id").value = document.getElementById("uid").value
	document.getElementById("uid").disabled = true
	document.getElementById("join_button").disabled = false
	document.getElementById("check_button").value = "다른 ID로 변경"
	document.getElementById("check_button").setAttribute("onclick", "change()")
}

function change(){
	document.getElementById("decide").innerHTML = "<span style='color:red;'>ID 중복 여부를 확인해주세요.</span>"
	document.getElementById("uid").disabled = false
	document.getElementById("uid").value = ""
	document.getElementById("join_button").disabled = true
	document.getElementById("check_button").value = "ID 중복 검사"
	document.getElementById("check_button").setAttribute("onclick", "checkid()")
}
