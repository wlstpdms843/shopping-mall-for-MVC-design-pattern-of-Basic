<?php
$replyView = isset($_SESSION['replyView']) ? $_SESSION['replyView'] : null;
$commentList = isset($_SESSION['commentList']) ? $_SESSION['commentList'] : null;
?>

<!--답글은 부모 게시물의 정보를 가져와 제목과 내용을 입력한다.-->
<!--답글에도 댓글이 필요하므로 commentList를 적어준다.-->


<form action="../controller/MainCTL.php?" method="post">
    <table width="1000" hei border="1">
        <tr>
            <td width="200">작성일자</td>
            <td><? echo $replyView['replyDate'] ?></td>
        </tr>
        <tr>
            <td>ID</td>
            <td><? echo $replyView['id'] ?></td>
        </tr>
        <tr>
            <td>제목</td>
            <td><? echo $replyView['title'] ?></td>
        </tr>
        <tr>
            <td>내용</td>
            <td width="500" height="200"><? echo $replyView['note'] ?></td>
        </tr>

        <tr>
            <td colspan='2' align='center'>
                <? if ($replyView['id'] == $_SESSION['loginID'] || $_SESSION['loginID'] == "admin") { ?>
                    <? if ($replyView['id'] == $_SESSION['loginID']) { ?>
                        <a href='../controller/MainCTL.php?action=504&replynum=<? echo $replyView['replyNum'] ?>'>수정</a>
                    <? } ?>
                    <a href='../controller/MainCTL.php?action=506&replyNum=<? echo $replyView['replyNum'] ?>'>삭제</a>
                <? } ?>
                <? if ($replyView['depth'] < 2) { ?>
                    <a href='../controller/MainCTL.php?action=501&replyNum=<? echo $replyView['replyNum'] ?>&ord=<? echo $replyView['ord'] ?>&depth=<? echo $replyView['depth'] ?>'>답글달기</a>
                <? } ?>
                <a href='../controller/MainCTL.php?action=510'>목록으로</a>
            </td>
        </tr>
    </table>
</form>


