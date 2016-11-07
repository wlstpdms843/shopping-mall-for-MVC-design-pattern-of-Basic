<?php
$helpView = isset($_SESSION['helpView']) ? $_SESSION['helpView'] : null;
$commentList = isset($_SESSION['commentList']) ? $_SESSION['commentList'] : null;
?>

<!--답글은 부모 게시물의 정보를 가져와 제목과 내용을 입력한다.-->
<!--답글에도 댓글이 필요하므로 commentList를 적어준다.-->


<form action="../controller/MainCTL.php?" method="post">
    <table width="1000" hei border="1">
        <tr>
            <td width="200">작성일자</td>
            <td><? echo $helpView['date'] ?></td>
        </tr>
        <tr>
            <td>ID</td>
            <td><? echo $helpView['id'] ?></td>
        </tr>
        <tr>
            <td>제목</td>
            <td><? echo $helpView['title'] ?></td>
        </tr>
        <tr>
            <td>내용</td>
            <td width="500" height="200"><? echo $helpView['note'] ?></td>
        </tr>
        <tr>
            <td colspan='2' align='center'>
                <? if ($helpView['id'] == $_SESSION['loginID'] || $_SESSION['loginID'] == "admin") { ?>
                    <? if ($helpView['id'] == $_SESSION['loginID']) { ?>
                        <a href='../controller/MainCTL.php?action=514&num=<? echo $helpView['num'] ?>'>수정</a>
                    <? } ?>
                    <a href='../controller/MainCTL.php?action=516&num=<? echo $helpView['num'] ?>'>삭제</a>
                <? } ?>
                <a href='../controller/MainCTL.php?action=501&num=<? echo $helpView['num'] ?>'>답글달기</a>
                <a href='../controller/MainCTL.php?action=510'>목록으로</a>
            </td>
        </tr>
    </table>
    <table bgcolor="#f0ffff" border="1" width="1000">
        <tr>
            <form action="../controller/MainCTL.php?" method="post">
                <td colspan="2"><textarea name="comment" style="resize: none; width: 800px; height: 50px;"
                                          required></textarea></td>
                <td width="80" align="center"><input type="submit" value="댓글 등록"></td>
                <input type="hidden" name="action" value="517">
                <input type="hidden" name="id" value="<? echo $_SESSION['loginID'] ?>">
                <input type="hidden" name="num" value="<? echo $helpView['num'] ?>">
                <input type="hidden" name="category" value="<? echo $helpView['category'] ?>">
            </form>
        </tr>
        <? if (!$commentList) { ?><!--댓글테이블 유무 확인-->
        <tr>
            <td bgcolor="#6495ed" colspan="2">댓글 없음</td>
        </tr>
        <? }
        else {
            for ($cnt = 0; $cnt < count($commentList); $cnt++) {
                echo "<tr>";
                echo "<td width='150'>" . $commentList[$cnt]['id'] . "</td>";
                echo "<td>" . $commentList[$cnt]['note'] . "</td>";
                echo "<td width='600'>" . $commentList[$cnt]['commentDate'] . "</td>";
                if ($_SESSION['loginID'] == $commentList[$cnt]['id']) {
                    echo "<td><a href='../controller/MainCTL.php?action=518&num={$helpView['num']}&cnt={$commentList[$cnt]['cnt']}'>삭제</a> </td>";
                }                       /*삭제를 눌렀을 경우, 해당 댓글의 유니크 값인 num값과, DB테이블에서의 해당 댓글 위치인 cnt값을 준다.*/
                echo "</tr>";
            }
        }
        ?>
    </table>
</form>


