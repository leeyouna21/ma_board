<?php 
    include $_SERVER["DOCUMENT_ROOT"]."/connect/connect.php";

    if(isset($_GET['num'])) {
        $num = $_GET['num'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $modifiedTitle = $_POST['boardTitle'];
            $modifiedContent = $_POST['blogcontent'];
            
            $modifiedTitle = $connect->real_escape_string($modifiedTitle);
            $modifiedContent = $connect->real_escape_string($modifiedContent);

            $updateSql = "UPDATE boarddata SET title = '$modifiedTitle', content = '$modifiedContent' WHERE num = $num";
            $updateResult = $connect->query($updateSql);

            if ($updateResult) {
                echo '<script>
                            window.location.href = "boardView.php?num=' . $num . '";
                        </script>';
            } else {
                echo "게시물 수정 중 오류가 발생했습니다.";
            }
        }

        $sql = "SELECT title, content FROM boarddata WHERE num = {$num}";
        $result = $connect->query($sql);

        if($result) {
            $info = $result->fetch_array(MYSQLI_ASSOC);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/assets/css/style.css">
    <title>수정하기</title>
</head>
<body>
    <main id="main" class="container">
        <div class="blog__search">
            <h2>❤ 게시글 수정</h2>
            <p>게시글을 수정하는 곳입니다.</p>
        </div>
        <div class="blog__inner">
            <div class="blog__write">
                <form action="boardModify.php?num=<?php echo $num; ?>" name="modify" method="post">                <fieldset>
                    <legend class="blind">게시글 수정하기</legend>
                <div>
                    <label for="boardTitle">제목</label>
                    <input type="text" id="boardTitle" name="boardTitle" class="inputStyle mb50" placeholder="제목을 입력해주세요" value="<?php echo $info['title']; ?>">
                </div>
                <div>
                    <label for="blogcontent">내용</label>
                    <div id="editor">
                        <textarea name="blogcontent" id="blogcontent" cols="30" rows="10"><?php echo $info['content']; ?></textarea>
                    </div>
                </div>
                    <button type="submit" class="save">저장하기</button>
                    <!-- <button type="submit" class="save">수정하기</button> -->
                </form>
            </div>
        </div>
    </main>
</body>
</html>
