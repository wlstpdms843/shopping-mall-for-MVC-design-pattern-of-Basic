

<script>
	$(document).ready(function(){

		$("#adminButton").click(function(){
			$("#adminMenu").animate({left: "700px"})
		});
	});
</script>



<?php

/*관리자용 메인메뉴 구성을 위한 페이지*/

$menuName = array("회원관리","상품관리","구매관리","결제관리","배송관리","매출관리");
/*메인메뉴의 나열은 배열로 저장하여 관리*/
if($action >= 900)
$actionIndex = ($action/10)%10 -1; // 액션코드에 따른 메뉴 인덱스 계산
else
$actionIndex = $action;


?>
<table>
	<tr>
		<td><div id="adminButton"><img src="Img/admin.png"></div></td>
<?php for( $cnt = 0; $cnt < count($menuName); $cnt++ ) { //반복문의 제한은 배열의 count수 만큼
		$actionCode = 900 + ($cnt+1) * 10; //각 메뉴의 액션값은 현재 cnt에 1을 더해 10을 곱하고 900을 더한다.
											//즉 회원관리의 액션값은 910번.
 ?>
		<td><div id="adminMenu"><a href='../controller/MainCTL.php?action=<?=$actionCode?>' style='text-decoration:none'>
			<?=($cnt==$actionIndex)?'[':null?>
			<?=$menuName[$cnt] ?>
			<?=($cnt==$actionIndex)?']':null?></a></div></td>
<?php } ?>
	</tr>
</table>