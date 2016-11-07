<?php
?>
<form action="../controller/MainCTL.php" method="post">
    <table border="1">
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
            <td><input type="text" name="title"></td>
        </tr>
        <tr>
            <td>내용</td>
            <td><textarea name="note" style="resize: none; width: 800px; height: 500px;"></textarea></td>
        </tr>
    </table>

    <input type="submit" value="전송">
    <input type="hidden" name="action" value="610">
</form>

<!--readonly="true"-->