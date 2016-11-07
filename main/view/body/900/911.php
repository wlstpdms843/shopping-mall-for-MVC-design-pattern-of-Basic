
<?php
  // 회원정보 입력 처리 뷰
?>

<h2>회원가입</h2><br/>
<form name="memberJoin" action="../controller/MainCTL.php" method="post">
    <input type="hidden" name="action" value="912">
    <input type="text" name="id"  placeholder="아이디"><br/>
    <input type="text" name="password"  placeholder="패스워드"><br/>
    <input type="text" name="name"  placeholder="성명"><br/>
    <input type="text" name="tel"  placeholder="전화번호"><br/>
    <input type="reset" value="취소">
    <input type="submit" value="가입"><br/>
</form>
