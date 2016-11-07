<?php

$msg = isset($_SESSION['msg'])?$_SESSION['msg']:"메시지 없음";

$sql = isset($_SESSION['sql'])?$_SESSION['sql']:"메시지 없음";
$sql2 = isset($_SESSION['sql2'])?$_SESSION['sql2']:"메시지 없음";


echo "상태 메시지 : $msg <br/>";

echo "<hr/>";
echo "디버깅 메시지<br/><br/>";

echo " SQL1 : $sql<br/>";
echo " SQL2 : $sql2<br/> ";

//echo "<hr/>";
//var_dump($_SESSION);

unset($_SESSION['msg']);
unset($_SESSION['sql']);
unset($_SESSION['sql2']);

