<?php
    include $_SERVER["DOCUMENT_ROOT"]."/connect/connect.php";

	$boardTitle = $_POST['title'];
	$boardContents = $_POST['content'];
	// 폼으로 전송된 게시글 제목과 내용 저장
	$boardView = 1;
	$regTime = time();
	// 현재 시간을 타임스탬프 형식으로 얻어 게시글 등록 시간으로 저장
	$boardTitle = $connect -> real_escape_string($boardTitle);
	$boardContents = $connect -> real_escape_string($boardContents);
	// real_escape_string? 게시글 제목과 내용을 sql 인젝션과 같은 보안 문제로부터 보호하기 위헤 데베에 삽입하기 전
	// 이스케잎 처리함

	$sql = "INSERT INTO boarddata(num, title, content, view, regtime, etc) VALUES ('$num', '$title', '$content', '$view', '$regtime', '$etc')";
	$connect -> query($sql);
?>

<script>
    location.href = "board.php";
</script>