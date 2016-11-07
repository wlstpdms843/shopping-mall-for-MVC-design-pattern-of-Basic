    <?php
?>
<style>
    label {
        float: left;
        width: 100px;
    }
</style>
<table border=0 align=center>
    <tr>
        <td>
            <form action='../Controller/MainCTL.php' method="post">
                <label>ID: </label>
                <input type='text' name='loginID'><br><br>
                <label>PassWord : </label>
                <input type='password' name='loginPasswd'>
        </td>
    </tr>
    <tr>
        <td align="center">
            <input type='submit' value='login'>
            <input type='hidden' name='action' value=11>
            </form>
            <hr>
            <h3>회원이 아니세요?</h3>

            <form action='../Controller/MainCTL.php' method="post">
                <input type='submit' value='join'>
                <input type='hidden' name='action' value=13>
            </form>
        </td>
    </tr>
</table>



