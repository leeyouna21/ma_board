<?php
/* SESSION, COOKIE */
/* CACHE */
/* 
	1) SESSION
		웹서버 : 로그인정보
		
	2) COOKIE
		브라우저에 저장됨
		기초적인 환경값 -> cookie 수집 동의할거임 V
		기간제 옵션값 -> 팝업 오늘하루안보기 내일까지 expire=24*60*60
	3) CACHE
		내 환경
*/

// $_SESSION['LOGIN_STATUS'] = "SUCCESS";
// $_SESSION['LOGIN_ID'] = '미뮤나';

// var_dump($_SESSION);

// if($_SESSION['LOGIN_STATUS']=="SUCCESS"){
// 	echo "로그인 되어 있음 ㅋ(".$_SESSION['LOGIN_ID'].")";
// }

$arr = [];
$arr['name'] = "미뮤";
$arr['과일'] = array("사과","버네너", "watermelon");
$arr['css'] = array("backgroundColor"=>"white", "높이"=>"안알랴줌");
//echo json_encode($arr);
?>


{
	"name" : "미뮤나",
	"fruit" : ["apple","banana", "수박"],
	"style" : {
		"backgroundcolor":"black", 
		"height":"200%",
		"add_information" : {
			"top":"-1",
			"bottom":"500",
			"animation" : [
				"",
				"" : {

				}
			]
		}
	}
}

$json = json;
$json.name
$json.furit[1];
$json.style.height
$json.style.add_information.animation[1];