<?php
$helpView = isset($_SESSION['helpView']) ? $_SESSION['helpView'] : null;
?>


<form action="../controller/MainCTL.php" method="post">
    <table border="1">
        <tr>
            <td>제목</td>
            <td><input type="text" name="title" value="<?=$helpView['title']?>"></td>
        </tr>
        <tr>
            <td>내용</td>
            <td><textarea name="note" style="resize: none; width: 800px; height: 500px;"><?=$helpView['note']?></textarea></td>

        </tr>
        <tr>
            <td colspan='2' align='center'>
                <input type="submit" value="수정">
                <input type="hidden" name="action" value="515">
                <input type="hidden" name="num" value=<?echo $helpView['num']?>>
        </tr>

    </table>
</form>


