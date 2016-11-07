<?php

//session_start();

$member = isset($_SESSION['member'])?$_SESSION['member']:null;

if( ! $member ){
    echo "수정하고자 하는 데이터를 가져올 수 없습니다.<br/>";
    echo "<a href='../controller/MainCTL.php?action=913'>회원보기</a>";
}else{  ?>
    <form name="mem_modify" method="post" action="../controller/MainCTL.php">
        <input type="hidden" name="action" value="914">
        <table>
            <tr>
                <td>순번</td><td><input readonly="true" type="text" name="num" value="<?= $member['num'] ?>"></td>
            </tr>
            <tr>
                <td>아이디</td><td><input readonly="true" type="text" name="id"  value="<?= $member['id'] ?>"></td>
            </tr>
            <tr>
                <td>비밀번호</td><td><input type="text" name="password"  value="<?= $member['password'] ?>"></td>
            </tr>
            <tr>
                <td>성명</td><td><input type="text" name="name"  value="<?= $member['name'] ?>"></td>
            </tr>
            <tr>
                <td>전화번호</td><td><input type="text" name="tel"  value="<?= $member['tel'] ?>"></td>
            </tr>
            <tr>
                <td>등급</td><td><input type="text" name="level"  value="<?= $member['level'] ?>"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="reset" value="취소"><input type="submit" value="전송"></td>
            </tr>
        </table>
    </form>


<?php } ?>