<?php 
    //print_r($_SERVER);
    include $_SERVER["DOCUMENT_ROOT"]."/connect/connect.php";
    
    $sql = "SELECT count(title) AS 'count' FROM boarddata";
    $result = $connect -> query($sql);
    // print_r($result);
    $boardTotalCount = $result -> fetch_array(MYSQLI_ASSOC);
    // fetch_array를 사용해 db쿼리 결과의 다음행을 연관 배열 형태로 가져옴
    $boardTotalCount = $boardTotalCount["count"];
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/assets/css/style.css">
	<title>글쓰기</title>
</head>
<body>
	<main id="main" class="container">
        <div class="blog__search">
            <h2>🎉 블로그 게시글 작성</h2>
            <p>여기서 작성해서 전송하면 데이터가 넘어와야합니다,,, 제발요</p>
        </div>
        <div class="blog__inner">
            <div class="blog__write">
            <form action="boardWriteSave.php" name="frmWrite" method="post">
                <fieldset>
                    <legend class="blind">게시글 작성하기</legend>
                    <div>
                        <label for="boardTitle">제목</label>
                        <input type="text" id="boardTitle" name="boardTitle" class="inputStyle mb50"
                            placeholder="제목을 입력해주세요">
                    </div>
                    <div>
                        <label for="blogcontent">내용</label>
                        <div id="editor">
                            <textarea name="blogcontent" id="blogcontent" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="save">저장하기</button>
                    <!-- <button type="submit" class="save">수정하기</button> -->
                </fieldset>
            </form>

            </div>
        </div>
    </main>
</body>

</html>