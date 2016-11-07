<?php

$pageName = "pageNum" . strval($action);
$HList = $_SESSION['HpageList'];
$HPageInfo = $_SESSION['HpageInfo'];
$getReplyList = $_SESSION['getReplyList'];//답글 리스트


$hitTureFalse = 1;//hit수는 게시판 리스트로부터 접근을 할 경우만 올려준다.
$countpaging = 1;


echo "<table border='1' width='1000'><tr ><th>순번</th><th>ID</th><th width='400'>제목</th><th>날짜</th><th>읽음</th></tr>";
if (!$HList) {
    echo "<tr><td colspan='5'>저장된 데이터가 없습니다</td></tr>";
    echo "<a href='../controller/MainCTL.php?action=511'>글쓰기</a>";
} else {
    $cnt = 0;
    for ($cnt = 0; $cnt < count($HList); $cnt++) {
        echo "<tr align='center'>";
        $Paging = ($HPageInfo['currentPageNum'] - 1) * 5 + $countpaging;
        echo "<td>" . $Paging . "</td>";
        $countpaging++;
        echo "<td>" . $HList[$cnt]['name'] . "</td>";
        echo "<td><a href='../controller/MainCTL.php?action=513&num={$HList[$cnt]['num']}&hitTureFalse={$hitTureFalse}'>" . $HList[$cnt]['title'] . "</a></td>";
        echo "<td>" . $HList[$cnt]['date'] . "</td>";
        echo "<td>" . $HList[$cnt]['hit'] . "</td>";
        echo "</tr>";

        for ($cnt2 = 0; $cnt2 < count($getReplyList); $cnt2++) {  //답글 View
            if($getReplyList[$cnt2]['depth'] == 2){ $color = "#4169e1"; }
            else{$color="#1e90ff";}

            if ($getReplyList && ($HList[$cnt]['num'] == $getReplyList[$cnt2]['group_num']))  {
                echo "<tr align='center' bgcolor=$color>";
                echo "<td>↳</td>";
                echo "<td>" . $getReplyList[$cnt2]['id'] . "</td>";
                echo "<td><a href='../controller/MainCTL.php?action=503&replynum={$getReplyList[$cnt2]['replyNum']}&hitTureFalse={$hitTureFalse}'>" . $getReplyList[$cnt2]['title'] . "</a></td>";
                echo "<td>" . $getReplyList[$cnt2]['replyDate'] . "</td>";
                echo "<td>" . $getReplyList[$cnt2]['hit'] . "</td>";
                echo "</tr>";
            }

        }
        echo "</tr>";
    }
    echo "<a href='../controller/MainCTL.php?action=511'>글쓰기</a>";
}

echo "</table>";
if ($HList) {
    // 페이지 네비게이션 모듈
    include_once "./pageNavi.php";

    pageNavigator($HPageInfo, $action, $pageName);
}

?>