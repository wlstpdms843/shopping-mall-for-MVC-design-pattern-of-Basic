<?php
$parentView = isset($_SESSION['replyView']) ? $_SESSION['replyView'] : null;

?>

<form action="../controller/MainCTL.php?" method="post">
    <table border="1">
        <? echo $_SESSION['loginID'] ?>
        <tr>
            <td>제목</td>
            <td><input type="text" name="title" value="[re]<? echo $parentView['title'] ?>"></td>
        </tr>
        <tr>
            <td>내용</td>
            <td><textarea name="note" style="resize: none; width: 800px; height: 500px;"></textarea></td>
        </tr>
    </table>
    <input type="submit" value="완료">
    <input type="hidden" name="action" value="502">
    <input type="hidden" name="num" value=<? echo $parentView['num'] ?>>
</form>
