<?php


//session_start();


$pageName = "pageNum" . strval($action);
$noticeList = isset($_SESSION['productList']) ? $_SESSION['productList'] : null;
$productPageInfo = isset($_SESSION['PageInfo']) ? $_SESSION['PageInfo'] : null;

$hitTureFalse = 1;//hit수는 게시판 리스트로부터 접근을 할 경우만 올려준다.
$countpaging = 1;//페이지에 보여질 순번을 계산하는 식

if ($userLevel == 999) {
    echo "<table border='1' width='1000'><tr ><th>순번</th><th>ID</th><th width='400'>제목</th><th>날짜</th><th>읽음</th><th colspan='2'>관리</th></tr>";
} else {
    echo "<table border='1' width='1000'><tr ><th>순번</th><th>ID</th><th width='400'>제목</th><th>날짜</th><th>읽음</th></tr>";
}
if (!$noticeList) {
    echo "<tr><td colspan='10'>저장된 데이터가 없습니다</td></tr>";
} else {

    $cnt = 0;
    if ($userLevel == 999) {
        echo "<a href='../controller/MainCTL.php?action=600'>공지작성</a>";
    }

    for ($cnt = 0; $cnt < count($noticeList); $cnt++) {
        echo "<tr align='center'>";

        $Paging = ($productPageInfo['currentPageNum'] - 1) * 10 + $countpaging;
        echo "<td>" . $Paging . "</td>";
        $countpaging++;

        echo "<td>" . $noticeList[$cnt]['name'] . "</td>";
        echo "<td><a href='../controller/MainCTL.php?action=615&num={$noticeList[$cnt]['num']}&hitTureFalse={$hitTureFalse}'>" . $noticeList[$cnt]['title'] . "</a></td>";
        echo "<td>" . $noticeList[$cnt]['date'] . "</td>";
        echo "<td>" . $noticeList[$cnt]['hit'] . "</td>";
        if ($userLevel == 999) {
            echo "<td><a href='../controller/MainCTL.php?action=611&num={$noticeList[$cnt]['num']}'>수정</a></td>";
            echo "<td><a href='../controller/MainCTL.php?action=614&num={$noticeList[$cnt]['num']}&category={$noticeList[$cnt]['category']}'>삭제</a></td>";
        }
        echo "</tr>";
    }
}

echo "</table>";
if ($noticeList) {
    // 페이지 네비게이션 모듈
    include_once "./pageNavi.php";

    pageNavigator($productPageInfo, $action, $pageName);
}


?>

