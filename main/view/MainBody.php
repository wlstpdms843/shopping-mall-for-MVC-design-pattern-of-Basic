<?php


$mainMenuShortNum = intval($action/100);//액션값을 가져와 100으로 나누고 소숫점을 버린다.
$codeNum = $mainMenuShortNum * 100;


if($codeNum==100)//처음 100번대 페이지는 공지사항 및 경기정보를 출력
    $codeNum = 100;
else if( $codeNum >= 200 && $codeNum < 500 )//200~400번은 상품의 정보를 출력
    $codeNum = 200;
else if($codeNum >=500 && $codeNum < 600) //500번대는 기타정보에 대한 정보를 출력
    $codeNum = 500;
else if($codeNum == 600)
    $codeNum = 600;


include "./body/BodyPage".strval($codeNum).".php";/*900번이거나 100번 이하일 경우는 바로 해당 페이지로 넘어간다.*/

?>

