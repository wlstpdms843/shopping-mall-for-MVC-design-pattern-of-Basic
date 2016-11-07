<?php



session_start();

$loginID = isset($_SESSION['loginID'])?$_SESSION['loginID']:null;

// 엑션파라미터 처리
$action = isset($_REQUEST['action'])?$_REQUEST['action']:110;

$mainMenuShortNum = intval($action/100);



switch( $mainMenuShortNum ){

    case  0: // 100번 이하 엑션 일때 LoginCTL.php로 제어를 넘긴다.
        include_once "LoginCTL.php";
        loginController($action);
        break;

    case  1:  // 100번대 action을 선택 했을때 ProductCTL로 제어를 넘긴다, 공지사항 관련
        include_once "Product&noticeCTL.php";
        productAndNoticeController($action);
        break;

    case  2: // 200번대 action을 선택 했을때 ProductCTL로 제어를 넘긴다.
        include_once "Product&noticeCTL.php";
        productAndNoticeController($action);
        break;
    
    case  3: // 300번대 action을 선택 했을때 ProductCTL로 제어를 넘긴다.
        include_once "Product&noticeCTL.php";
        productAndNoticeController($action);
        break;

    
    case  4: // 400번대 action을 선택 했을때 ProductCTL로 제어를 넘긴다.
        include_once "Product&noticeCTL.php";
        productAndNoticeController($action);
        break;
    
    case  5: // 500번대 action을 선택 했을때 ProductCTL로 제어를 넘긴다.
        include_once "help.php";
        HelpListController($action);
        break;

    case 6: //공지사항 관련 글 등록 삭제 등.
    case 9: // 900또는 600번대 action을 선택 했을때 AdminCTL로 제어를 넘긴다, 관리자용 처리
        include_once "AdminCTL.php";
        adminController($action);
        break;

    default:
        header("location:../view/MainView.php?action=$action");
        break;
 }



