<?php 
    include $_SERVER["DOCUMENT_ROOT"]."/connect/connect.php";

	if(isset($_GET['num'])){
		$num = $_GET['num'];
		$num = $connect -> real_escape_string($num);

		$sql = "UPDATE boarddata SET delyn =  'Y' WHERE num = {$num}";
		$result = $connect -> query($sql);

		if($result) {
			echo "
			<script>
				alert('게시글이 삭제되었습니다.');
				window.location.href = 'board.php';
			</script>";
		} else {
			echo "게시글 삭제 실패하였습니다.";
		}
	}
?>