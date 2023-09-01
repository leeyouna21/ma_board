<?php 
    include $_SERVER["DOCUMENT_ROOT"]."/connect/connect.php";

    if (isset($_GET['num']) && isset($_POST['boardTitle']) && isset($_POST['blogcontent'])) {
        $num = $_GET['num'];
        $boardTitle = $_POST['boardTitle'];
        $blogcontent = $_POST['blogcontent'];

        // 게시글 제목과 내용 업데이트
        $boardTitle = $connect->real_escape_string($boardTitle);
        $blogcontent = $connect->real_escape_string($blogcontent);

        $updateSql = "UPDATE boarddata SET title = '{$boardTitle}', content = '{$blogcontent}' WHERE num = {$num}";

        if ($connect->query($updateSql) === TRUE) {
            echo "게시글이 성공적으로 수정되었습니다.";
        } else {
            echo "게시글 수정 중 오류가 발생했습니다: " . $connect->error;
        }

        exit;
    }
?>
