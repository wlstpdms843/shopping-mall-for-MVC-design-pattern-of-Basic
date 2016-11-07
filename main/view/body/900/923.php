<?php

// 회원리스트 보기 뷰

//session_start();

$productList = isset($_SESSION['productList'])?$_SESSION['productList']:null;
$productPageInfo = isset($_SESSION['PageInfo'])?$_SESSION['PageInfo']:null;

echo "<a href='../controller/MainCTL.php?action=921'>상품정보입력</a><hr/>";

echo "<h2>상품정보관리</h2><br/>";

echo "<table border='1'><tr><th>순번</th><th>카테고리</th><th>코드</th><th>상품명</th><th>재고량</th><th>가격</th><th>이미지명</th><th>썸네일명</th><th>수정</th><th>삭제</th></tr>";
if( ! $productList ){
    echo "<tr><td colspan='10'>저장된 데이터가 없습니다</td></tr>";
}else {
    foreach ($productList as $product) {
        echo "<tr>";
        foreach ($product as $myKey => $myValue) {
            echo "<td>";
            echo "$myValue";
            echo "</td>";
        }
        echo "<td><a href='../controller/MainCTL.php?action=926&num={$product['pnum']}'>UPD</a></td>";
        echo "<td><a href='../controller/MainCTL.php?action=927&num={$product['pnum']}&ppageNum={$productPageInfo['currentPageNum']}&pfimage={$product['pfimage']}&psimage={$product['psimage']}'>DEL</a></td>";
        echo "</tr>";
    }
}

echo "</table>";

if( $productList ){
    // 페이지 네비게이션 모듈
    include_once "./pageNavi.php";

    $action = 923;
    $pageNumParaName = "pageNum".strval($action);
    pageNavigator( $productPageInfo, $action, $pageNumParaName );
}
?>