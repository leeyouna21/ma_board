<?php 
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
    $boardTotalCount = $result -> fetch_array(MYSQLI_ASSOC);
    $boardTotalCount = $boardTotalCount["count"];
	if(isset($_GET['page'])) {
		$page = (int) $_GET['page'];
	} else {
		$page = 1;
	}
	$viewNum = 10;
	$viewLimit = ($viewNum * $page) - $viewNum;

	$sql = "SELECT num, title, userId, view, regtime, etc FROM boarddata A {$add_sql} ORDER BY num DESC LIMIT {$viewLimit}, {$viewNum}";
	$result = $connect -> query($sql);

	if($result){
		$count = $result -> num_rows;
		$tmp = [];
		if($count > 0) {
			for($i=0; $i<$count; $i++){
				$info = $result -> fetch_array(MYSQLI_ASSOC);
				$tmp[] = $info;
			}
		}
	}
	header('Content-type: application/json');
	$fjson = json_encode($tmp);
    echo $fjson;
?>
