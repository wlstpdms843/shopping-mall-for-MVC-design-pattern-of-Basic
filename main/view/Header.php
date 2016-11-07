<!--메인메뉴에 공통적으로 선언될 코드들을 모아서 구성-->


<?php

session_start();

// 로그인, 유저레벨(관리자 여부 등) 정보
$loginID = isset($_SESSION['loginID'])?$_SESSION['loginID']:null;
$userLevel = isset($_SESSION['level'])?$_SESSION['level']:null;

// 엑션파라미터 처리
$action = isset($_REQUEST['action'])?$_REQUEST['action']:100;
$mainMenuShortNum = intval($action/100);

$subMenuShortNum = intval($action%100);
$memberName = isset($_SESSION['memberName'])?$_SESSION['memberName']:null;
//회원의 이름을 판단

