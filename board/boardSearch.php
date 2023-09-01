<?php
	include $_SERVER["DOCUMENT_ROOT"]."/connect/connect.php";

	if(isset($_GET['page'])) {
		$page = (int) $_GET['page'];
	} else {
		$page = 1;
	}

	$searchKeyword = $_GET ['searchKeyword'];

	$searchKeyword = $connect -> real_escape_string($searchKeyword);

	$sql = "select * from boarddata where title LIKE '%첫번째%'";
	$result = $connect -> query($sql);

    $totalCount = $result -> num_rows;
?>