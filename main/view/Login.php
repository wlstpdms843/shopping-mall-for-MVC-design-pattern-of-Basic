<table>

<?php if( $loginID ){ // 로그인 상태라면... ?>

<tr><td><?=$loginID?> 님(레벨 : <?= $userLevel ?>) 로그인</td><td> 
	<form name='logout' action='../controller/MainCTL.php'>
	    <input type='hidden' name='action' value='12'/>
		<input type='submit' value='로그아웃'/>
	</form>
</td></tr>

<?php }else{ // 로그아웃 상태라면... ?>

<tr><td>
	<form name='logout' action='../controller/MainCTL.php'>
	    <input type='hidden' name='action' value='11'/>
	    <input type='text' name='id' placeholder='아이디'/>
	    <input type='text' name='password' placeholder='비밀번호'/>
		<input type='submit' value='로그인'/>
	</form>
</td><td>
	<form name='memberJoin' action='../controller/MainCTL.php'>
	    <input type='hidden' name='action' value='13'/>
		<input type='submit' value='회원가입'/>
	</form>
</td></tr>

<?php } ?>

</table>