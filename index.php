<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script src="/js/jquery-1.11.2.min.js"></script>
	<script>
		$(function(){
			$('button').on('click' , function(e){
				$.get("/board/ajax_board.php", function(data){
					//console.log('data1');
					/* 데이터가 정상적으로 들어왔는지만 판단함
					보통 갯수나 상태값 확인 */
					if(data.length!=0){
						//console.log('success'+data.length);
					}
				},"json")
				.done(function(data){ /* 정상적으로 데이터를 가져왔을 경우 실행됨 */
					//console.log('data2');
					/* 실제 데이터 처리
					값들을 element 에 실제 적용하는 부분.
					해당 이벤트를 완료시키는 부분.
					*/
					$.each($(data), function(i,value){
						//console.log(value);
						//console.log(value);
						$('ul').append('<li>'+ value.userId + value.regtime +'</li>');
					});
					
				})
				.fail(function(err, code, text){ /* 에러났을 때만 나옴 ㅋ */
					console.log(err.statusText);
					console.log(code);
					console.log(text);
					alert("에러났음 어캄?");
				})
				.always(function(dd){ /* 항상 실행됨 */
					//console.log('data3');
					/* object */
				});
			});
		});

		function a(){
			console.log('ee');
		}
		
		// window.addEventListener("DOMContentLoaded", function(e){
		// 	//console.log('domload3');
		// });
		// window.onload = function(){
		// 	//console.log('onload4');
		// }
	</script>
</head>
<body>
	<button>데이터 가져오기 ㅋ</button>
	<ul>
		
	</ul>
</body>
</html>