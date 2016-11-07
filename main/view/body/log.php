<?php

$msg = isset($_SESSION['msg'])?$_SESSION['msg']:"메시지 없음";

echo "<h1>상태 메시지 :</h1> $msg <br/>";

unset($_SESSION['msg']);



?>