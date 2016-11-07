<?php

// 회원리스트 보기 뷰

//session_start();

$memberList = isset($_SESSION['memberList'])?$_SESSION['memberList']:null;
$memberPageInfo = isset($_SESSION['memberPageInfo'])?$_SESSION['memberPageInfo']:null;


/*
echo "{$_SESSION['sql']}";
unset($_SESSION['sql']);
*/

echo "<h2>회원정보관리</h2><br/>";

echo "<table border='1'><tr><th>순번</th><th>아이디</th><th>비밀번호</th><th>성명</th><th>전화번호</th><th>등급</th><th>수정</th><th>삭제</th></tr>";
if( ! $memberList ){
    echo "<tr><td colspan='7'>저장된 데이터가 없습니다</td></tr>";
}else {
    foreach ($memberList as $member) {
        echo "<tr>";
        foreach ($member as $myKey => $myValue) {
            echo "<td>";
            echo "$myValue";
            echo "</td>";
        }
        echo "<td><a href='../controller/MainCTL.php?action=916&num={$member['num']}'>UPD</a></td>";
        echo "<td><a href='../controller/MainCTL.php?action=917&num={$member['num']}&mpageNum={$memberPageInfo['currentPageNum']}'>DEL</a></td>";
        echo "</tr>";
    }
}

echo "</table>";

if( $memberList ){
// 페이지 네비게이션 모듈
include_once "./pageNavi.php";

$targetAction = 913;
$pageNumParaName = "mpageNum";
pageNavigator( $memberPageInfo , $targetAction, $pageNumParaName );
}
//unset($_SESSION['memberList']);