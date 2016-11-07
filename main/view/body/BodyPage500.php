<?php


if($action!=500){
include_once  "./body/500/".strval($action).".php";
}
else {
    echo "<h1 align='center'>고객 지원 페이지</h1>";
    echo "<hr>";
    echo "<h2><ol>
        <li>홈페이지 이용 시 문제가 발생 할 경우 우선 Q&A게시판에 문제점을 남겨주세요.</li>
        <li>관리자의 댓글 답변으로도 해결이 되지 않을 경우, 전화상담을 통해 해결 할 수 있습니다.</li>
        <li>회원 탈퇴 및 수정은 '내정보'란에서 처리 가능합니다.</li>
      </ol></h2>";
    echo "<br><br><br>";
}

?>