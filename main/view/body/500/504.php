<?php
$replyView = isset($_SESSION['replyView']) ? $_SESSION['replyView'] : null;
?>


<form action="../controller/MainCTL.php" method="post">
    <table border="1">
        <tr>
            <td>제목</td>
            <td><input type="text" name="title" value="<?=$replyView['title']?>"></td>
        </tr>
        <tr>
            <td>내용</td>
            <td><textarea name="note" style="resize: none; width: 800px; height: 500px;"><?=$replyView['note']?></textarea></td>

        </tr>
        <tr>
            <td colspan='2' align='center'>
                <input type="submit" value="수정">
                <input type="hidden" name="action" value="505">
                <input type="hidden" name="replyNum" value=<?echo $replyView['replyNum']?>>
        </tr>

    </table>
</form>


