
<?php
$SubMenuName = array(
    array("공지사항","게임정보"),
    array("Nike","adidas","Reebok","Jordan"),
    array("Nomal","team"),
    array("Nike","Star","Spalding","wilson"),
    array("Q&A","내정보 관리","전화상담 안내"),
);

//$MainMenuName = array("Shoes","Uniform","Ball");
//H,S,U,B,P

//우선 모든 메뉴의 모든 서브 메뉴를 2차원배열에 넣어준다.

$SubIndex = floor($action/100) - 1;
$SubIndex2 = floor($action/10)%10 - 1;

//그 모든 인덱스를 선택을 위해 사용되는 인자값을 변수로 선언하여 유기적으로 움직이게 만든다.


for($cnt=0; $cnt<count($SubMenuName[$SubIndex]); $cnt++){
    $codeNum = ($SubIndex+1)*100 + ($cnt+1)*10;

    echo "<a href='../Controller/MainCTL.php?action=$codeNum' style='text-decoration:none'>";
    if($cnt == $SubIndex2 ){
        echo "<img src='./Img/sub/Re$codeNum.png' width='200' height='80'border='0'>";
    }
    else{
        echo "<img src='./img/sub/$codeNum.png' width='200' height='80' border='0'>";
    }
    echo "</a>";


    echo "</a><br>";

}





?>