<button type="button" class="save" id="goToBoard">목록으로</button>

<script>
	document.getElementById("goToBoard").addEventListener("click", function() {
		window.location.href = "board.php";
	});
</script>
<?php 
    include $_SERVER["DOCUMENT_ROOT"]."/connect/connect.php";
    
    if(isset($_POST['boardTitle']) && isset($_POST['blogcontent'])) {
        $boardTitle = $_POST['boardTitle'];
        $blogcontent = $_POST['blogcontent'];

        // 폼으로 전송된 게시글 제목과 내용 저장
        $boardView = 1;
        //$regTime = time();
        // 현재 시간을 타임스탬프 형식으로 얻어 게시글 등록 시간으로 저장
        $boardTitle = $connect->real_escape_string($boardTitle);
        $blogcontent = $connect->real_escape_string($blogcontent);

        $sql = "INSERT INTO boarddata( title, content, view, regtime, etc) VALUES ( '{$boardTitle}', '{$blogcontent}', 0, NOW(), '')";
		//$connect->query($sql);

        // 데이터베이스에 쿼리 실행
        if ($connect->query($sql) === TRUE) {
            // 게시글이 성공적으로 저장되었을 경우 처리
            echo '<script>
                    window.location.href = "boardView.php?num=' . $connect->insert_id . '";
                </script>';
        } else {
            // 게시글 저장 중 오류가 발생한 경우 처리
            echo "게시글 저장 중 오류가 발생했습니다: " . $connect->error;
        }
        exit;
    }
?>