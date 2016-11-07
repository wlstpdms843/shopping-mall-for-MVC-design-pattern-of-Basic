<?php
$productoption = isset($_SESSION['productoption'])?$_SESSION['productoption']:null;


echo "<h1>결제 화면</h1>";



echo "고객 아이디 : ".$productoption['id']."<br>";
echo "상품 일련번호 : ".$productoption['pnum']."<br>";
echo "상품명 : ".$productoption['pname']."<br>";
echo "주문 갯수 : ".$productoption['cnt']."<br>";
echo "결제 가격 : ".$productoption['totalprice']."원";

echo "<hr>";
echo "<a href='../controller/MainCTL.php?action=971&creditstate=1'>카드결제 </a>";
echo "<a href='../controller/MainCTL.php?action=971&creditstate=0'>무통장입금 </a>";


?>





