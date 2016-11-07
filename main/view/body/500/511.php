<?php
$notice = isset($_SESSION['notice'])?$_SESSION['notice']:null;
var_dump($_SESSION['loginID']);
?>


<form action="../controller/MainCTL.php?" method="post">
    <table border="1">
        <tr>
            <td>제목</td>
            <td><input type="text" name="title"></td>
        </tr>
        <tr>
            <td>내용</td>
            <td><textarea name="note" style="resize: none; width: 800px; height: 500px;"></textarea></td>
        </tr>
    </table>
    <input type="submit" value="완료">
    <input type="hidden" name="action" value="512">
</form>
