<?php
$notice = isset($_SESSION['notice']) ? $_SESSION['notice'] : null;
if($notice['category'] == "N1"){
    $action = 110;
}else{
    $action = 120;
}
?>


<table border="1" align="center">
    <tr>
        <td>글넘버</td>
        <td><? echo $notice['num'] ?></td>
    </tr>
    <tr>
        <td>분류</td>
        <? if ($notice['category'] == 'N1') { ?>
            <td>공지사항</td>
        <? } else { ?>
            <td>경기정보</td>
        <? } ?>
    </tr>
    <tr>
        <td>작성일자</td>
        <td><? echo $notice['date'] ?></td>
    </tr>
    <tr>
        <td>이름</td>
        <td><? echo $notice['name'] ?></td>
    </tr>
    <tr>
        <td>제목</td>
        <td><? echo $notice['title'] ?></td>
    </tr>
    <tr>
        <td>내용</td>
        <td width="500" height="200"><? echo $notice['note'] ?></td>
    </tr>
    <form action="../controller/MainCTL.php?" method="post">
        <tr>
            <td colspan="2" align="center"><input type="submit" value="목록으로"></td>
            <input type="hidden" name="action" value=<? echo $action ?>>
        </tr>
    </form>
</table>

