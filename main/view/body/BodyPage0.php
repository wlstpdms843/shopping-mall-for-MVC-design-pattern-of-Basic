<?php
//100번 이하의 값, 즉 로그인과 관련된 페이지.

if($action == 10){//action이 10일 경우 로그인 페이지를 띄어준다.
    include(dirname(__FILE__) . "/../Body/login.php");//현재 위치와 현재 파일 이름

}else if($action == 13){//action이 13일 경우 회원가입 페이지를 만들어준다.
    include(dirname(__FILE__) . "/../Body/join.php");

}else if($action == 92){//92번 관련 코드는 log.php로 보내준다.
    include(dirname(__FILE__) . "/../Body/log.php");
}