<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<style>
		h2 {
			text-align: center;
		}
	.container {
		/* height: 100vh; */
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.calculator {
		background-color: #000;
		width: 300px;
		height: 500px;
		border-radius: 30px;
		padding: 10px 20px;
		border: solid 6px #ffffff;
	}
	.calculator__display--for-advanced {
		background-color: #fff;
		height: 100px;
		width: 100%;
		border-radius: 10px;
		font-size: 30px;
		text-align: center;
		vertical-align: middle;
		/* padding: 25px 15px; */
		overflow: hidden;
		overflow-wrap: break-word;
	}
	.calculator__buttons {
		background-color: #ffffff;
		width: 100%;
		height: 330px;
		margin-top: 10px;
		/* padding: 10px; */
		border-radius: 10px;
		font-size: 25px;
	}
	.clear__and__enter {
		text-align: center;
		height: 70px;
		margin: 10px;
		border-radius: 10px;
		background-color: #ffffff;
	}
	.clear__and__enter > button {
		border-radius: 10px;
		width: 125px;
		height: 50px;
		margin: 15px 0px;
		background-color: #DEDEDE; 
		cursor: pointer;
		outline: none;
		border: 0px solid #30bb98;
		font-size: 20px;

	}
	.button__row {
		border-radius: 10px;
		text-align: center;
		height: 50px;
		margin: 10px;
		background-color: #ffffff;
	}
	.button__row > button {
		width: 60px;
		height: 50px;
		border-radius: 100px;
		cursor: pointer;
		outline: none;
		background-color: #C6C6C6;
		border: none;
		font-size: 20px;
	}
	.button__row > .operator {
		color: #ffffff;
		font-size: 30px;
		background-color: orange;
	}
	.button__row > .double {
		width: 125px;
	}

	</style>

</head>
<body>
	<h2>계산기 입니다</h2>
		<div class="container">
		<div class="calculator">
			<div class="calculator__display--for-advanced">0</div>
			<div class="calculator__buttons">
			<div class="clear__and__enter">
				<button class="clear">AC</button>
				<button class="calculate">Enter</button> <!-- 버튼 클래스 수정 -->
			</div>
			<div class="button__row">
				<button class="number">7</button>
				<button class="number">8</button>
				<button class="number">9</button>
				<button class="operator">+</button>
			</div>
			<div class="button__row">
				<button class="number">4</button>
				<button class="number">5</button>
				<button class="number">6</button>
				<button class="operator">-</button>
			</div>
			<div class="button__row">
				<button class="number">1</button>
				<button class="number">2</button>
				<button class="number">3</button>
				<button class="operator">*</button>
			</div>
			<div class="button__row">
				<button class="number double">0</button>
				<button class="decimal">.</button>
				<button class="operator">/</button>
			</div>
			</div>
		</div>
	</div>
	<script>
		// firstNum: 현재 계산 중인 첫 번째 숫자를 저장하는 변수
		// operatorForAdvanced 현재 선택 된 연산자를 저장하는 변수
		// previousKey 직전에 눌린 버튼의 내용을 저장하는 변수
		// previousNum 직전에 입력 된 숫자를 저장하는 변수
		// performCalculation 두 숫자와 연산자를 받아 계산을 수행하고 결과를 문자열 형태로 반환하는 함수임 사칙연산 (+,-,*,/)을 처리함

		const calculatorContainer = document.querySelector('.calculator'); //calculator 엘리먼트 , 자식엘리먼트 모두 담고있음
		const buttons = document.querySelector('.calculator__buttons');	 	// calculator__keys 엘리먼트와 자식 엘리먼트의 정보를 모두 담고있음
		const display = document.querySelector('.calculator__display--for-advanced'); 	//calculator__display 엘리먼트와, 자식 엘리먼트의 정보를 모두 담고 있ㅇ,ㅁ
		let firstNum = '';
		let operatorForAdvanced = '';
		let previousKey = '';
		let previousNum = '';

		function performCalculation(n1, operator, n2) {
			let result = 0;
			if (operator === '+') {
				result = Number(n1) + Number(n2); //+ 버튼을 눌렀을 때
			} else if (operator === '-') {
				result = Number(n1) - Number(n2); //- 버튼을 눌렀을 때
			} else if (operator === '*') {
				result = Number(n1) * Number(n2); //* 버튼을 눌렀을 때
			} else if (operator === '/') {
				result = Number(n1) / Number(n2); // / 버튼을 눌렀을 때
			}
			return String(result);
		}

	buttons.addEventListener('click', function (event) {
		const target = event.target; //클릭된 html 엘리먼트의 정보가 저장 돼 있음
		const action = target.classList[0]; //클릭된 html 엘리먼트에 클래스 정보를 가져옴
		const buttonContent = target.textContent; //클릭된 html 엘리먼트의 텍스트 정보를 가져옴

		if (target.matches('button')) {
			if (action === 'number') { 			//클릭된 html 엘리먼트의 클래스 네임이 number라면
					if (display.textContent === '0' && operatorForAdvanced === '') {
					display.textContent = buttonContent;
					firstNum = display.textContent;
					//기존 계산기의 숫자가 0이고 오퍼레이터 버튼이 안 눌린 상태의 분기

				} else if (display.textContent !== '0' && operatorForAdvanced === '') {
					display.textContent += buttonContent;
					// textContent는 문자열이기 때문에 기존 계산기에서 보여지는 숫자에 +로 구현 
					firstNum = display.textContent;
					//기존 계산기 숫자가 0이 아니고 오퍼레이터 버튼이 안 눌린 상태의 분기
					//ex) 15를 누르기 위해 1을 누른 상태의 분기 (두자리 연속 누르기 위한 코드)

				} else if (display.textContent !== '0' && operatorForAdvanced !== '') {
					if (previousKey === operatorForAdvanced) {
						display.textContent = buttonContent;
						previousKey = display.textContent;
						//직전 키를 변수에 할당 (직전키가 오퍼레이터냐 숫자냐에 따라 계산기의 다양한 기능을 구현)
						previousNum = display.textContent;	//직접 숫자를 변수에 할당
						//기존 계산기 숫자가 0이 아니고 오퍼레이터 버튼이 눌린 상태의 분기
						//ex) 15+17울 하기 위해 15와 +,1을 누른 상태 (두번째 숫자를 누르기 위한 코드)
					} else if (previousKey !== operatorForAdvanced) {
						display.textContent += buttonContent;
						previousNum = display.textContent;
						//ex) 15+17울 하기 위해 15와 +,1을 누른 상태 (17을 완성하기 위한 코드)
						}
					}
				}
			if (action === 'operator') { 	//클릭 된 html 엘리먼틑의 클래스 네임이 operator일 때
				operatorForAdvanced = buttonContent; 	//오퍼레이터 누를 때 누른 텍스트 정보를 할당
				previousKey = operatorForAdvanced;		//직전키에 오퍼레이터 텍스트 정보 할당
			}
			if (action === 'clear') {		//AC(초기화) 버튼을 누를 때 분기
				display.textContent = '0';
				firstNum = '';
				previousNum = '';
				operatorForAdvanced = '';
				previousKey = '';
			}
			if (action === 'calculate') {	//Enter(계산) 버튼을 누를 때
				if (firstNum !== '' && operatorForAdvanced !== '' && previousNum !== '') {
				display.textContent = performCalculation(firstNum, operatorForAdvanced, previousNum);
				firstNum = display.textContent;
				operatorForAdvanced = '';
				previousNum = '';
				previousKey = '';
				}
			}
		}
	});
</script>
</body>
</html>


<!-- -------------------------------------------------------------------------------------------------------------------- -->


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		table {
			width: 800px;
			height: 100px;
		}
		table td input {
			width: 100px;
			height: 50px;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<td>숫자입력</td>
			<td><input type = "text" id="n1" size = "10"></td>
		</tr>
			<td>숫자입력</td>
			<td><input type = "text" id="n2" size = "10"></td>
		<tr>
			<td></td>
			<td>
				<input type= "button" value= "+" onclick="add()">
				<input type= "button" value="-" onclick="sub()">
				<input type= "button" value="*" onclick="mul()">
				<input type= "button" value="/" onclick="div()">
			</td> 
		</tr>
		<tr>
			<td>결과</td>
			<td><input type="text" id="result" size="10"></td>
		</tr> 
	</table>

	<script>
		// parseInt 문자열을 정수 형태로 변환하는데 사용하고 이 함수는 두 개의 인수를 받는다
		function add() {
			let n1 = parseInt(document.getElementById("n1").value);
			let n2 = parseInt(document.getElementById("n2").value);
			let sum = n1+n2;
			document.getElementById("result").value = sum;
		}
		function sub() {
			let n1 = parseInt(document.getElementById("n1").value);
			let n2 = parseInt(document.getElementById("n2").value);
			let sub = n1-n2;
			document.getElementById("result").value = sub;
		}
		function mul() {
			let n1 = parseInt(document.getElementById("n1").value);
			let n2 = parseInt(document.getElementById("n2").value);
			let mul = n1 * n2;
			document.getElementById("result").value = mul;
		}
		function div() {
			let n1 = parseInt(document.getElementById("n1").value);
			let n2 = parseInt(document.getElementById("n2").value);
			let div = n1 / n2;
			document.getElementById("result").value = div;
		}
	</script>
</body>
</html>