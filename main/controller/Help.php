<?php

include_once "../model/memberDAO.php";
include_once "../model/productDAO&notice.php";
include_once "../model/commonLIB.php";
include_once "../model/replyDAO.php";

function HelpListController($action)
{
    switch ($action) {

        case 501: //답글을 등록하고 싶다는 요청
            $num = isset($_REQUEST['num']) ? $_REQUEST['num'] : null;
            $replyNum = isset($_REQUEST['replyNum']) ? $_REQUEST['replyNum'] : null;


            if($num != null){//부모글에 답글을 추가하는 경우
                $_SESSION['replyView'] = selectNoticeByNum($num);

            }else if($replyNum != null){//답글에 답글을 추가하는 경우.
                $_SESSION['re_replyView'] = selectReplyByNum($replyNum);
                $action=507;
            }

            if($_SESSION['loginID'] == null){
                exit("login Plz");
            }

            header("location:../view/MainView.php?action=$action");
            break;

        case 502: //답글 DB처리.
            $replyInsertDate['depth'] = isset($_REQUEST['depth']) ? $_REQUEST['depth'] : 0;
            $replyInsertDate['ord'] = isset($_REQUEST['ord']) ? $_REQUEST['ord'] : 0;
            $replyInsertDate['groupNum'] = isset($_REQUEST['num']) ? $_REQUEST['num'] : null;
            $replyInsertDate['id'] = $_SESSION['loginID'];
            $replyInsertDate['title'] = isset($_REQUEST['title']) ? $_REQUEST['title'] : null;
            $replyInsertDate['note'] = isset($_REQUEST['note']) ? $_REQUEST['note'] : null;

            if($replyInsertDate['depth'] == 0){//메인 글로부터 답글을 요청하는 경우
                $replyInsertDate['depth'] = 1;
            }else if($replyInsertDate['depth'] == 1){  //답글에 답글을 요청하는 경우.
                $replyInsertDate['depth'] = 2;
            }else{
                exit("There is no way anymore.");
            }

            insertreply($replyInsertDate);

            $pageName = "pageNum510";
            $HpageInfo = $_SESSION['HpageInfo'];
            $HPageNum = $HpageInfo['currentPageNum'];

            header("location:../controller/MainCTL.php?action=510&$pageName=$HPageNum");
            break;

        case 503: //답글 상세보기
            $replyNum = isset($_REQUEST['replynum'])?$_REQUEST['replynum']:null;
            $_SESSION['replyView'] = selectReplyByNum($replyNum);

            $hitTureFalse = isset($_REQUEST['hitTureFalse'])?$_REQUEST['hitTureFalse']:0;//hit수를 늘릴경우, 리다이렉트 카운트 방지를 위해
            //hit수의 증감을 위해.
            if($hitTureFalse == 1){
                cntuphitforReply($replyNum);
            }

            header("location:../view/MainView.php?action=$action");
            break;

        case 504: //답글 수정 요청
            $replyNum = isset($_REQUEST['replynum'])?$_REQUEST['replynum']:null;
            $replyView = selectReplyByNum($replyNum);
            $_SESSION['replyView'] = $replyView;


            header("location:../view/MainView.php?action=$action");
            break;

        case 505://답글 수정 처리
            $updateReply['replyNum'] = isset($_REQUEST['replyNum'])?$_REQUEST['replyNum']:null;
            $updateReply['title'] = isset($_REQUEST['title'])?$_REQUEST['title']:null;
            $updateReply['note'] = isset($_REQUEST['note'])?$_REQUEST['note']:null;


            updateReplyByNum($updateReply);

            $pageName = "pageNum510";
            $HpageInfo = $_SESSION['HpageInfo'];
            $HPageNum = $HpageInfo['currentPageNum'];

            header("location:../controller/MainCTL.php?action=510&$pageName=$HPageNum");
            break;

        case 506://답글 삭제 처리
            $updateReply = isset($_REQUEST['replyNum'])?$_REQUEST['replyNum']:null;
            deleteReplyByNum($updateReply);

            $pageName = "pageNum510";
            $HpageInfo = $_SESSION['HpageInfo'];
            $HPageNum = $HpageInfo['currentPageNum'];

            header("location:../controller/MainCTL.php?action=510&$pageName=$HPageNum");
            break;



        case 510:
            $category = "H";

            $clpp = 5;
            $cppb = 10;

            $pageName = "pageNum" . strval($action);
            if (!$_SESSION[$pageName]) {
                $pageNum = isset($_REQUEST[$pageName]) ? $_REQUEST[$pageName] : 1;
            } else {
                $pageNum = isset($_REQUEST[$pageName]) ? $_REQUEST[$pageName] : $_SESSION[$pageName];
            }

            $cnt = getProductCountWithPcategory($category);
            $HpageInfo = getPageInfo($pageNum, $cnt, $clpp, $cppb);
            $HpageList = selectProductListWithPageInfoAndPcategory($HpageInfo, $category);
            $getReplyList = getReplyList();

            $_SESSION['getReplyList'] = $getReplyList;;
            $_SESSION[$pageName] = $pageNum;
            $_SESSION['HpageInfo'] = $HpageInfo;
            $_SESSION['HpageList'] = $HpageList;

            header("location:../view/MainView.php?action=$action");
            break;

        case 511://Q&A페이지 글쓰기 요청
            if ($_SESSION['loginID'])
                header("location:../view/MainView.php?action=$action");
            else
                echo " You need a login in order service....";
            break;

        case 512://글을 작성하고 완료버튼을 눌렀을 때
            $helpData['name'] = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
            $helpData['title'] = isset($_REQUEST['title']) ? $_REQUEST['title'] : null;
            $helpData['note'] = isset($_REQUEST['note']) ? $_REQUEST['note'] : null;
            $helpData['category'] = "H";

            insertNotice($helpData);


            header("location:../controller/MainCTL.php?action=510");
            break;

        case 513://상세 뷰 요청

            $num = $_REQUEST['num'];
            $commentNum = "H" . strval($num);
            $helpView = selectNoticeByNum($num);
            $_SESSION['helpView'] = $helpView;
            $_SESSION['commentList'] = getComment($commentNum);//댓글 갱신

            $hitTureFalse = isset($_REQUEST['hitTureFalse'])?$_REQUEST['hitTureFalse']:0;//hit수를 늘릴경우, 리다이렉트 카운트 방지를 위해
            //hit수의 증감을 위해.
            if($hitTureFalse == 1){
                cntuphit($num);
            }


            header("location:../view/MainView.php?action=$action");
            break;

        case 514://수정 요청, 수정처리 뷰로 보내준다.
            $num = $_REQUEST['num'];
            $helpView = selectNoticeByNum($num);
            $_SESSION['helpView'] = $helpView;

            header("location:../view/MainView.php?action=$action");
            break;

        case 515://데이터 수정 처리
            $helpData['num'] = isset($_REQUEST['num']) ? $_REQUEST['num'] : null;
            $helpData['title'] = isset($_REQUEST['title']) ? $_REQUEST['title'] : null;
            $helpData['note'] = isset($_REQUEST['note']) ? $_REQUEST['note'] : null;
            $helpData['category'] = "H";

            updateNoitceByNum($helpData);

            $pageName = "pageNum510";
            $HpageInfo = $_SESSION['HpageInfo'];
            $HPageNum = $HpageInfo['currentPageNum'];

            header("location:../controller/MainCTL.php?action=510&$pageName=$HPageNum");
            break;

        case 516://삭제 요청

            $num = isset($_REQUEST['num']) ? $_REQUEST['num'] : null;
            $commentNum = "H".strval($num);



            deleteNoitceByNum($num);
            deleteReplyByGroupNum($num);
            deleteCommentBycommentNum($commentNum);

            $pageName = "pageNum510";
            $HpageInfo = $_SESSION['HpageInfo'];
            $HPageNum = $HpageInfo['currentPageNum'];
            header("location:../controller/MainCTL.php?action=510&$pageName=$HPageNum");
            break;

        case 517://댓글 등록
            $cnum1 = isset($_REQUEST['category']) ? $_REQUEST['category'] : null;
            $cnum2 = isset($_REQUEST['num']) ? $_REQUEST['num'] : null;
            //해당 댓글이 위치한 글의 번호와 카테고리를 가져옴


            $ifm['num'] = strval($cnum1) . strval($cnum2);//가져온 두 변수를 더하여 하나의 코드(유니크값)를 만들어냄
            $ifm['comment'] = isset($_REQUEST['comment']) ? $_REQUEST['comment'] : null;
            $ifm['id'] = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

            if ($ifm['id'])//만약 해당 로그인이 되어있지 않으면, 댓글 등록 불가
                insertComment($ifm);
            else
                exit("After a login to your advantage");


            header("location:../controller/MainCTL.php?action=513&num={$cnum2}");
            break;

        case 518://댓글 삭제 요청
            $commentNum = isset($_REQUEST['num']) ? $_REQUEST['num'] : null;//해당 댓글의 유니크 값과
            $commentCnt = isset($_REQUEST['cnt']) ? $_REQUEST['cnt'] : null;//DB테이블에서의 레코드 위치값



            deleteCommentByNum($commentCnt);

            header("location:../controller/MainCTL.php?action=513&num={$commentNum}");
            break;


        default:
            header("location:../view/MainView.php?action=$action");
            break;
    }


}

?>