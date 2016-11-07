<img src="../view/MainView.php"

<?php

include_once "../model/memberDAO.php";
include_once "../model/productDAO&notice.php";
include_once "../model/commonLIB.php";

function loginController( $action ){

    switch( $action ){

        case 10: // 로그인 관련 처리 액션
            header("location:../view/MainView.php?action=$action");  //콘트롤러 재호출
            break;

        case 11: // 로그인 처리 액션
            $userID = isset($_REQUEST['loginID'])?$_REQUEST['loginID']:null;
            $userPW = isset($_REQUEST['loginPasswd'])?$_REQUEST['loginPasswd']:null;

            $resultArr = loginCheck( $userID, $userPW );

            if( $resultArr['code'] == 1 ){
                $_SESSION['loginID'] = $userID;
                $_SESSION['memberName'] = $resultArr['name'];
                $_SESSION['level'] = $resultArr['level'];
                $msg = "로그인 성공";
                $action = 110;
            }else if( $resultArr['code'] == -1 ){
                $msg = "비밀번호 입력 오류";
                $action = 92;
            }else if( $resultArr['code'] == -2 ){
                $msg = "아이디 입력 오류";
                $action = 92;
            }else{
                $msg = "로그인 실패";
                $action = 92;
            }


            $_SESSION['msg'] = $msg;

            header("location:./MainCTL.php?action=$action");
            break;

        case 12: // 로그아웃 처리 액션
            unset($_SESSION['loginID']);
            unset($_SESSION['userLevel']);
            session_destroy();
            header("location:./MainCTL.php?action=110");
            break;

        case 13: // 회원정보 입력 뷰로 디다이렉트
            header("location:../view/MainView.php?action=$action");
            break;


        case  14:  // 회원정보 입력 처리 액션
            $data['id'] = isset($_REQUEST['id'])?$_REQUEST['id']:null;
            $data['password'] = isset($_REQUEST['password'])?$_REQUEST['password']:null;
            $data['name'] = isset($_REQUEST['name'])?$_REQUEST['name']:null;
            $data['tel'] = isset($_REQUEST['tel'])?$_REQUEST['tel']:null;
            $data['address'] = isset($_REQUEST['address'])?$_REQUEST['address']:null;

            $result = insertMember($data);
            if( $result ){
                $msg = "회원정보를 정상적으로 입력 하였습니다.";
            }else{
                $msg = "회원정보 입력에 오류가 발생 하였습니다.";
            }

            $_SESSION['msg'] = $msg;
            var_dump($_SESSION['msg']);

            $action = 92;
            header("location:../view/MainView.php?action=$action");
            break;

        default:
            header("location:../view/MainView.php?action=$action");
            break;
    }
}
