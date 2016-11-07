<?
$resultNum = isset($_REQUEST['resultNum'])?$_REQUEST['resultNum']:null;
echo "<h1> 상품 주문 완료!</h1>";

if(!$_SESSION['loginID'])
    echo "비회원님의 주문번호는".$resultNum."입니다.";
?>


