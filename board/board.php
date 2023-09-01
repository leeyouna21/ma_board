<?php 
    //print_r($_SERVER);
    include $_SERVER["DOCUMENT_ROOT"]."/connect/connect.php";
    
    $searchKeyword = "";
    if(isset($_GET['searchKeyword'])) 
        $searchKeyword = $_GET['searchKeyword'];

    $sql = "SELECT count(title) AS 'count' FROM boarddata A ";
    /* Where */
    $add_sql = " WHERE A.delyn = 'N' ";
    if ($searchKeyword!="")
        $add_sql .= sprintf(" AND A.title like '%%%s%%' ", $searchKeyword);

    $sql .= $add_sql;
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
	<title>게시판 메인페이지</title>
	<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
	<main id="main" class="container">
        <div class="boardIntro__inner">
            <picture class="boardIntro__img">
                <img src="/assets/images/pp.jpg" alt="게시판이미지" />
            </picture>
            <h2>게시판</h2>
            <p class="boardIntro__text">
                게시판만들기 🤗 오늘은수요일임니다<br> 언제쯤 그묘???일 ,,
            </p>
        </div>
        <!-- //intro__inner -->
        <div class="board__inner">
            <div class="board__search">
                <div class="left">
                    *총 <em><?=$boardTotalCount?></em>건의 게시물이 등록되어 있습니다.
                </div>
                <div class="right">
                    <form action="board.php" name="#" method="get">
                        <fieldset>
                            <legend class="blind">게시판 검색 영역</legend>
                            <input type="search" name="searchKeyword" id="searchKeyword" placeholder="검색어를 입력하세요" value="<?=$searchKeyword?>">
                            
                            <!-- <select name="#" id="#">
                                <option value="title">제목</option>
                                <option value="content">내용</option>
                                <option value="name">등록자</option>
                            </select> -->
                            <button type="submit" class="btnStyle3">검색</button>
                            <a href="boardWrite.php" class="btnStyle3">글쓰기</a>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="board__table">
                <table>
                    <colgroup>
                        <col style="width: 5%">
                        <col>
                        <col style="width: 10%">
                        <col style="width: 15%">
                        <col style="width: 7%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>번호</th>
                            <th>제목</th>
                            <th>등록자</th>
                            <th>등록일</th>
                            <th>조회수</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr>
                            <td>10</td>
                            <td><a href="boardView.php">게시판 제목</a></td>
                            <td>미뮤나</td>
                            <td>2023-08-23</td>
                            <td>10</td>
                        </tr>  -->
                    <?php
                        // 페이지 번호 존재 유무
                        if(isset($_GET['page'])) {
                            $page = (int) $_GET['page'];
                        } else {
                            $page = 1;
                        }
                        // 표시하고픈 게시글 수
                        $viewNum = 10;
                        // $step = 1;
                        // 게시글 시작 위치 계산
                        $viewLimit = ($viewNum * $page) - $viewNum;

                        $sql = "SELECT num, title, userId, view, regtime, etc FROM boarddata A {$add_sql} ORDER BY num DESC LIMIT {$viewLimit}, {$viewNum}";
                        $result = $connect -> query($sql);

                        // 쿼리 실행 결과 처리 num_rows사용해서 결과 집합에 포함된 행의 수 확인
                        if($result){
                            $count = $result -> num_rows;
                            //행이 만약 존재할 경우 각 행 반복
                            $tmp = [];
                            if($count > 0) {
                                for($i=0; $i<$count; $i++){
                                    $info = $result -> fetch_array(MYSQLI_ASSOC);
                                    $tmp[] = $info;
                                    //fetch_array 사용해 결과를 배열로 가져옴
                                    echo "<tr>";
                                    //echo "<td>".$info['num']."</td>";
                                    //게시판 등록순대로 나열하기
                                    echo "<td>".($boardTotalCount - ($page - 1) * $viewNum -$i)."</td>";
                                    echo "<td><a href='boardView.php?num={$info['num']}'>".$info['title']."</a></td>";
                                    echo "<td>".$info['userId']."</td>";
                                    echo "<td>".date('Y-m-d', strtotime($info['regtime']))."</td>";
                                    echo "<td>".$info['view']."</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>게시글이 없습니다.</td></tr>";
                            }
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="board__pages">
                <ul>
                    <!-- <li><a href="#">처음으로</a></li>
                    <li><a href="#">이전</a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">다음</a></li>
                    <li><a href="#">마지막으로</a></li> -->
<?php
    //게시글 총 갯수

    $sql = "SELECT count(num) AS count FROM boarddata";
    $result = $connect -> query($sql);
    // print_r($result);
    $boardTotalCount = $result -> fetch_array(MYSQLI_ASSOC);
    $boardTotalCount = $boardTotalCount['count'];
    // print_r($boardTotalCount);

    //총 페이지 갯수
    $boardTotalCount = ceil($boardTotalCount/$viewNum);
    //ceil을 사용해서 올림 처리해 소수점 아래 데이터가 존재하면 다음 페이지로

    $pageView = 2;
    $startPage = $page - $pageView;
    $endPage = $page + $pageView;

    //처음 페이지 초기화
    if($startPage < 1 ) $startPage = 1;

    //마지막 페이지 초기화
    if($endPage >= $boardTotalCount) $endPage = $boardTotalCount;

    //처음으로 , 이전
    if($page != 1 && $page <= $boardTotalCount) {
        $prevPage = $page - 1;
        echo "<li><a href='board.php?page=1'>처음으로</a></li>";
        // echo "<li><a href='board.php?page={$prevPage}'>이전</a></li>";
    }

    //현재 페이지 active 붙게하기
    for($i=$startPage; $i<=$endPage; $i++){
        $active = "";
        if($page <= $boardTotalCount){
            if($i == $page) $active = 'active';
            echo "<li class='{$active}'><a href='board.php?page={$i}'>{$i}</a></li>";
        }
    }

    //마지막으로 , 다음
    if($page < $boardTotalCount){
        $nextPage = $page + 1;
        // echo "<li><a href='board.php?page={$nextPage}'>다음</a></li>";
        echo "<li><a href= 'board.php? page={$boardTotalCount}'>마지막으로</a></li>";
    }
?>
                </ul>
            </div>
        <div>
    </main>

<?php

    $fjson = json_encode($tmp);
    print_r(json_decode($fjson));
?>

</body>
</html>