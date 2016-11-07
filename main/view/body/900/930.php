<?php

// 회원리스트 보기 뷰

//session_start();

$ppageName = "pageNum" . strval($action);
$ogetinfo = isset($_SESSION['PageInfo'])?$_SESSION['PageInfo']:null;
$oList = isset($_SESSION['productList'])?$_SESSION['productList']:null;


/*
echo "{$_SESSION['sql']}";
unset($_SESSION['sql']);
*/

echo "<h2>회원정보관리</h2><br/>";

echo "<table border='1'><tr><th>주문순번</th><th>아이디</th><th>상품넘버</th><th>수량</th><th>색상</th><th>결제가격</th><th>결제상태</th></tr>";
if( ! $oList ){
    echo "<tr><td colspan='7'>저장된 데이터가 없습니다</td></tr>";
}else {
    foreach ($oList as $order) {
        echo "<tr>";
        foreach ($order as $oyKey => $oValue) {
            echo "<td>";
            echo "$oValue";
            echo "</td>";
        }
        echo "</tr>";
    }
}

echo "</table>";

if( $oList ){
// 페이지 네비게이션 모듈
    include_once "./pageNavi.php";


    $targetAction = 930;
    pageNavigator( $ogetinfo , $targetAction, $ppageName );
}
//unset($_SESSION['memberList']);