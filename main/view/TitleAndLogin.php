


<?php


if($loginID) {
    echo "<form name='logout' action='../Controller/MainCTL.php'>";
    echo  $loginID . "(" .$memberName . ")" . "님 환영합니다 ";
    echo "<input type='submit' name='logout' value='로그아웃'>";
    echo "<input type='hidden' name='action' value=12>";
    echo "</form>";
}else{
    echo "<a href='../Controller/MainCTL.php?action=10'><img src='Img/login.png' height='40'></a>";
}


echo "<a href='../controller/MainCTL.php?action=100' border='0'> <img src='./Img/Title.PNG' width='1600' height='200'></a>";



?>