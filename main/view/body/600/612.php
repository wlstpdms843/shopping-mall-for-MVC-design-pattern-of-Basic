<?php
$notice = isset($_SESSION['notice'])?$_SESSION['notice']:null;
?>


<form action="../controller/MainCTL.php?" method="post">
    <table border="1" align="center">
        <tr>
            <td>글넘버</td>
            <td><?echo $notice['num']?></td>
        </tr>
        <tr>
            <td>분류 :</td>
            <td><select name="category" placeholder="notice 분류">
                    <option value="N1">공지사항</option>
                    <option value="N2">경기정보</option>
                </select></td>
        </tr>
        <tr>
            <td>아이디</td>
            <td><?php echo $memberName."(".$loginID.")"; ?></td>
        </tr>
        <tr>
            <td>제목</td>
            <td><input type="text" name="title" value="<?= $notice['title']?>"></td>
        </tr>
        <tr>
            <td>내용</td>
            <td><textarea name="note" style="resize: none; width: 800px; height: 500px;"><?= $notice['note']?></textarea></td>
        </tr>
    </table>
    <input type="submit" value="수정">
    <input type="hidden" name="action" value="613">
    <input type="hidden" name="num" value=<?echo $notice['num']?>>
</form>
