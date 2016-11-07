<?php

$MainMenuName = array("Home","Shoes","Uniform","Ball","Help");
//H,S,U,B,P
//이 부분을 배열로 통합 처리하는 이유,
//추후 페이지네이션, 페이지네비 작업 시, 한 테이블로 여러 서브메뉴의 판단 기준을 선정해주어야 하는데,
//이때 현재 사용자가 어느 메뉴를 보고 있는지에 대한 확인이 필요하다.
//이때 메인메뉴에 해당하는 배열의 값을 가져와 그 값을 활용한다면,
//페이지가 순환하면서 해당 값을 항상 유지하는데 필요하다.

/*배열로 메뉴를 구성하여, 선택시 마다 활용되는 것은 배열의 인덱스 값이지만
표시 할 경우에만 이미지를 출력하도록 한다.*/


$actionIndex = ($action/100)-1;

for($cnt = 0; $cnt<count($MainMenuName); $cnt++){
    $codeNum = ($cnt+1) * 100;
    echo "<a href='../Controller/MainCTL.php?action=$codeNum' style='text-decoration:none'>";
    if($cnt == $actionIndex ){
        echo "<img src='./Img/ReMenu{$cnt}.jpg' width='320' height='60'border='0'>";
    }
    else{
        echo "<img src='./img/Menu{$cnt}.jpg' width='320' height='60' border='0'>";
    }
    echo "</a>";
}
?>