<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    </style>
</head>
<body>
    <h2>⏱timer 입니다</h2>
    <p>
		⏱ : <span id="timer"></span>
    </p>
    <script>
        const timerSpan = document.getElementById('timer');
        let time = 10000; // 10 seconds
        let min = 0;
        let sec = 10;
		//getElementById 함수를 사용해 timer라는 id를 가진 span 요소를 timerSpan 변수에 할당함 남은 시간을 나타내는 변수를 초기화 함

        timerSpan.textContent = min + ":" + '10';
		// 초기에 화면에 나오는 내용을 설정함 나는 10초 부터 시작하니까 10으로 설정함 !

        function TIMER() {
            playtime = setInterval(function() {
				//setInterval을 사용해 1초마다 내부 함수가 실행 됨
                time = time - 1000;
				// 1초씩 타임 변수를 감소시킴

                if (sec > 0) {
                    sec = sec - 1;
                    timerSpan.textContent = Math.floor(min) + ":" + (sec < 10 ? '0' + sec : sec);
                }
				//남은 초가 0보다 큰 경우 1초씩 감소 , sec가 10 미만인 경우 초 앞에 0을 추가함

                if (sec === 0) {
                    sec = 60;
                    timerSpan.textContent = Math.floor(min) + ":" + '00'
                }
				//초가 0이 되면 다시 60으로 설정하고 분을 줄여 분:00 형식으로 표시함

                if (time === 0) {
                    clearInterval(playtime);
                    alert("완료되었습니다.")
                }
				//0이 되면 clearInterval을 사용해 타이머를 멈추고 alert창을 통해 종료 됐음을 알림
            }, 1000)
        }

        TIMER();
    </script>
</body>
</html>
