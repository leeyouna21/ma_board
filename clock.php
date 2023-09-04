<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<style>
		#time {
			font-size: 30px;
			color: #000;
		}
		#date {
			font-size: 30px;
			color: #000;
		}
		#week {
			font-size: 30px;
			color: #000;
		}
	</style>

</head>
<body>
	<h2>clock 입니다</h2>
    <div id="time"></div>
    <div id="date"></div>
    <div id="week"></div>
		
	<script>
        function Clock() {    //Clock함수를 정의해 날짜와 시간을 업데이트
            let dateinfo = new Date(); //현재 시간, 날짜를 포함하는 Date 객체를 생성, 이를 dateinfo에 저장
			// modifyNumber주어진 숫자를 형식화하는 함수임 시간 , 분 초와 같은 숫자를 받아와 한 자리 숫자인 경우 앞에 0을 추가해
			// 두자리 숫자로 만들어줌 이 함수는 시계나 타이마같은 시간 정보를 표시하거나 두 자리 숫자 형식이 필요할 때 사용함

            let hour = modifyNumber(dateinfo.getHours()); //Date 객체에서 시간을 가져오고 modifyNumber 함수를 사용해 시간을 형식화하고 hour 변수에 저장
			//getHours 생성된 데이터 객체에서 시간 (0-23)을 가져옴

            let minute = modifyNumber(dateinfo.getMinutes());//Date 객체에서 시간을 가져오고 modifyNumber 함수를 사용해 시간을 형식화하고 minute 변수에 저장
			//getMinutes 생성된 데이터 객체에서 분(0-59)을 가져옴


            let second = modifyNumber(dateinfo.getSeconds());//Date 객체에서 시간을 가져오고 modifyNumber 함수를 사용해 시간을 형식화하고 second 변수에 저장
			//getSeconds 생성된 데이터 객체에서 초(0-59)를 가져옴


            let year = dateinfo.getFullYear(); //Date 객체에서 연도를 가져와 year 변수에 저장
			//getFullYear() 메서드는 주어진 날짜의 현지 시간 기준 연도를 반환

            let month = dateinfo.getMonth() + 1; //객체에서 월을 가져오고 1을 더해 월을 형식화 한 뒤 month에 저장함
			//왜 +1 ? getMonth의 반환은 0부터 시작하므로 +1을 해주어야함

            let day = dateinfo.getDate();  //Date 객체에서 일을 가져와 day 변수에 저장

            let weekDays  = ["일","월","화","수","목","금","토"]; // 요일을 문자열배열로 정의함

			let weekDay = weekDays[dateinfo.getDay()]; //Date 객체에서 현재 요일을 가져오고 weekDays 배열을 사용하여 해당 요일 문자열로 형식화하여 weekDay 변수에 저장

            document.getElementById("time").innerHTML = hour + ":" + minute + ":" + second; //html에서 id가 time인 요소를 찾아 시간 정보 업데이트
            document.getElementById("date").innerHTML = year + "-" + month + "-" + day ; //html에서 id가 date 요소를 찾아 시간 정보 업데이트
            document.getElementById("week").innerHTML = weekDay + "요일"; //html에서 id가 week인 요소를 찾아 시간 정보 업데이트

            requestAnimationFrame(Clock); //cloc 함수를 다시 호출 , 1초마다 업데이트
        }

        function modifyNumber(time) {   //time 매개변수로 전달된 숫자를 받음
            if (parseInt(time) < 10) { //parseInt(time)을 사용해 time을 정수로 변환함 왜냐면 입력이 문자열 형태로 돌아올 수 있기 때문에 숫자로 변환한 것임 변환 수가 10보다 작으면 다음을 수행
                return "0" + time; //0을 추가하면 두자릿수로 형식화 됨

            } else {
                return time; 
            }
        }

        // 최초 호출, 시계 시작
        Clock();
    </script>
</body>
</html>
