<?php 
    include $_SERVER["DOCUMENT_ROOT"]."/connect/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/assets/css/style.css">
	<title>Document</title>
	
</head>
<body>
	<main id="main" class="container">
        <div class="boardIntro__inner center">
            <picture class="boardIntro__img">
                <img src="/assets/images/pp.jpg" alt="게시판이미지" />
            </picture>
            <h2>게시글 보기</h2>
            <p class="boardIntro__text">
                내가 쓴 글 보러올래요
            </p>
        </div>
        <!-- //boardIntro__inner -->
        <div class="board__inner">
            <div class="board__view">
                <table>
                    <colgroup>
                        <col style="width: 20%">
                        <col style="width: 80%">
                    </colgroup>
                    <tbody>
                        <!-- <tr>
                            <th>제목</th>
                            <td>게시판 제목입니다.</td>
                        </tr>-->
<?php
    if(isset($_GET['num'])){
        $num = $_GET['num'];
        // print_r($num);

        // 보드뷰 + 1
		$sql = "UPDATE boarddata SET view = view + 1 WHERE num = {$num}";
		$connect -> query($sql);
		
        // print_r($connect);

        //수정일
        $sqlUpdateModtime = "UPDATE boarddata SET modtime = NOW() WHERE num = {$num}";
        $connect->query($sqlUpdateModtime);

        $sql = "SELECT num, title, view, modtime, content, regtime, etc FROM boarddata WHERE num = {$num}";
        $result = $connect -> query($sql);
        // print_r($result);

        if($result) {
            $info = $result -> fetch_array(MYSQLI_ASSOC);
        
            echo "<tr><th>제목</th><td>".$info['title']."</td></tr>";
			// echo "<tr><th>등록자</th><td>".$info['etc']."</td></tr>";
            echo "<tr><th>등록일</th><td>".$info['regtime']."</td></tr>";
            echo "<tr><th>수정일</th><td>".$info['modtime']."</td></tr>";
            if (isset($info['view'])) {
                echo "<tr><th>조회수</th><td>".$info['view']."</td></tr>";
            } else {
                echo "<tr><th>조회수</th><td>조회수 정보 없음</td></tr>";
            }   
            echo "<tr><th>내용</th><td>".$info['content']."</td></tr>";
        }
    } else {
        echo "<tr><td colspan='5'>게시글이 없습니다ㅠㅠ. 왜 없어요...</td></tr>";
    }
?>
                    </tbody>
                </table>
            </div>
            <div class="board__btn">
                <a href="boardModify.php?num=<?php echo $num; ?>" class="btnStyle3">수정하기</a>
                <a href="boardRemove.php?num=<?php echo $num; ?>" class="btnStyle4">삭제하기</a>
                <a href="board.php" class="btnStyle3">목록보기</a>
            </div>
        </div>

    </main>
</body>
</html>