<?php

include_once "../model/memberDAO.php";
include_once "../model/productDAO&notice.php";
include_once "../model/commonLIB.php";

function adminController($action)
{
    //session_start();

    switch ($action) {


        case 600://관리자가 글쓰기를 누르는 순간.

            header("location:../view/MainView.php?action=$action");
            break;

        case 610://글쓰기 입력 처리
            $notice['name'] = "관리자";
            $notice['title'] = isset($_REQUEST['title']) ? $_REQUEST['title'] : null;
            $notice['note'] = isset($_REQUEST['note']) ? $_REQUEST['note'] : null;
            $notice['category'] = isset($_REQUEST['category']) ? $_REQUEST['category'] : null;


            insertNotice($notice);

            if ($notice['category'] == "N1") {
                $action = 110;
            } else if ($notice['category'] == "N2") {
                $action = 120;
            }

            header("location:../controller/MainCTL.php?action=$action");
            break;
        case 611://글 수정뷰
            $num = $_REQUEST['num'];
            $notice = selectNoticeByNum($num);
            $_SESSION['notice'] = $notice;


            $action = 612;  //수정처리 뷰로 리다이렉트

            header("location:../controller/MainCTL.php?action=$action");
            break;

        case 613://수정처리
            $notice['name'] = "관리자";
            $notice['title'] = isset($_REQUEST['title']) ? $_REQUEST['title'] : null;
            $notice['note'] = isset($_REQUEST['note']) ? $_REQUEST['note'] : null;
            $notice['category'] = isset($_REQUEST['category']) ? $_REQUEST['category'] : null;
            $notice['num'] = isset($_REQUEST['num']) ? $_REQUEST['num'] : null;


            $result = updateNoitceByNum($notice);

            if ($notice['category'] == "N1") {
                $action = 110;
            } else if ($notice['category'] == "N2") {
                $action = 120;
            }


            $productPageInfo = $_SESSION['PageInfo'];
            $npageNum = $productPageInfo['currentPageNum'];
            $npageParaName = "pageNum" . strval($action);
            header("location:./MainCTL.php?action=$action&$npageParaName=$npageNum");
            break;
        case 614: //공지 게시글 삭제
            $num = isset($_REQUEST['num']) ? $_REQUEST['num'] : null;
            $category = isset($_REQUEST['category']) ? $_REQUEST['category'] : null;

            deleteNoitceByNum($num);

            if ($category == "N1") {
                $action = 110;
            } else if ($category == "N2") {
                $action = 120;
            }

            $productPageInfo = $_SESSION['PageInfo'];
            $npageNum = $productPageInfo['currentPageNum'];
            $npageParaName = "pageNum" . strval($action);
            header("location:../controller/MainCTL.php?action=$action&$npageParaName=$npageNum");

            break;

        case 615: //게시글 상세 View 요청
            $num = $_REQUEST['num'];
            $notice = selectNoticeByNum($num);
            $_SESSION['notice'] = $notice;

            $hitTureFalse = isset($_REQUEST['hitTureFalse']) ? $_REQUEST['hitTureFalse'] : 0;//hit수를 늘릴경우, 리다이렉트 카운트 방지를 위해
            //hit수의 증감을 위해.
            if ($hitTureFalse == 1) {
                cntuphit($num);
            }


            header("location:../view/MainView.php?action=$action");
            break;


        case  910: // 회원관리 처리 액션
            $action = 913; // 콘크롤러로 리다이렉트
            header("location:../controller/MainCTL.php?action=$action");
            break;

        case 911:
            header("location:../view/MainView.php?action=$action");
            break;

        case  912:  // 회원정보 입력 처리
            $data['id'] = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
            $data['password'] = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;
            $data['name'] = isset($_REQUEST['name']) ? $_REQUEST['name'] : null;
            $data['tel'] = isset($_REQUEST['id']) ? $_REQUEST['tel'] : null;

            $result = insertMember($data);
            if ($result) {
                $action = 918; //성공메시지 뷰로 리다이렉트
            } else {
                $action = 919; //다시 입력하도록 실패메시지 뷰로 리다이렉트
            }
            header("location:../view/MainView.php?action=$action");
            break;

        case  913: // 회원리스트 보기 처리

            $pageName = "ppageNum" . strval($action);

            if (!$_SESSION[$pageName]) {
                $mpageNum = isset($_REQUEST['mpageNum']) ? $_REQUEST['mpageNum'] : 1;
            } else {
                $mpageNum = isset($_REQUEST['mpageNum']) ? $_REQUEST['mpageNum'] : $_SESSION[$pageName];
            }

            $MCLPP = 10;
            $MCPPB = 10;

            $cnt = getMemberCount(); // member테이블 레코드 갯수 조회
            $memberPageInfo = getPageInfo($mpageNum, $cnt, $MCLPP, $MCPPB);
            $memberList = selectMemberListWithPageInfo($memberPageInfo);

            $_SESSION['memberPageInfo'] = $memberPageInfo;
            $_SESSION['memberList'] = $memberList;
            header("location:../view/MainView.php?action=$action");
            break;

        case 914: // 데이터 수정 처리
            $data['num'] = isset($_REQUEST['num']) ? $_REQUEST['num'] : null;
            $data['id'] = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
            $data['password'] = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;
            $data['name'] = isset($_REQUEST['name']) ? $_REQUEST['name'] : null;
            $data['tel'] = isset($_REQUEST['tel']) ? $_REQUEST['tel'] : null;
            $data['level'] = isset($_REQUEST['level']) ? $_REQUEST['level'] : null;


            $result = updateMemberByNum($data);
            if (!$result) {
                $action = 919;
            }
            $action = 913;

            $memberPageInfo = $_SESSION['memberPageInfo'];
            $mpageNum = $memberPageInfo['currentPageNum'];
            header("location:./MainCTL.php?action=$action&mpageNum=$mpageNum");  //콘트롤러 재호출
            break;

        case 916: //수정요구 처리
            $num = $_REQUEST['num'];
            $member = selectMemberByNum($num);
            if (!$member) {
                $action = 919;
            } else {
                $_SESSION['member'] = $member;
                $action = 915;  //수정처리 뷰로 리다이렉트
            }
            header("location:../view/MainView.php?action=$action");
            break;

        case 917: // 삭제요구 처리


            $num = $_REQUEST['num'];
            $result = deleteMemberByNum($num);
            if (!$result) {
                $action = 919;
            } else {
                $action = 913;
            }
            header("location:./MainCTL.php?action=$action&mpageNum={$_REQUEST['mpageNum']}");  //콘트롤러 재호출
            break;


        case  920: // 상품관리 처리 액션
            $action = 923;
            header("location:../controller/MainCTL.php?action=$action");
            break;

        case 921:
            header("location:../view/MainView.php?action=$action");
            break;

        case  922:  // 상품정보 입력 처리

            // 이미지 저장 디렉터리
            $productImgSavePath = "../../img/product/";
            $thumbnailImgSavePath = "../../img/product_s/";
            $thumbnailImgHeight = 150;
            $fileMaxSize = 2000000;


            $data['pcategory'] = isset($_REQUEST['pcategory']) ? $_REQUEST['pcategory'] : null;
            $data['pcode'] = $data['pcategory'] . strval($getPnum); // pnum값을 이용하여 pcode값 생성
            $data['pname'] = isset($_REQUEST['pname']) ? $_REQUEST['pname'] : null;
            $data['pstock'] = isset($_REQUEST['pstock']) ? $_REQUEST['pstock'] : null;
            $data['pprice'] = isset($_REQUEST['pprice']) ? $_REQUEST['pprice'] : null;
            $data['pfimage'] = isset($_REQUEST['pfimage']) ? $_REQUEST['pfimage'] : null;
            $data['psimage'] = isset($_REQUEST['psimage']) ? $_REQUEST['psimage'] : null;

            $retArr = insertProduct($data);

            if (!$retArr['result']) {
                $action = 919; //다시 입력하도록 실패메시지 뷰로 리다이렉트
                header("location:../view/MainView.php?action=$action");
            } else {

                $getPnum = $retArr['autoPnum']; // 자동 입력된 pnum 값을 가져온다.

                // 이미지 정보 로드
                $upImgFileInfo['name'] = isset($_FILES['pfimage']['name']) ? $_FILES['pfimage']['name'] : null;
                $upImgFileInfo['tmp_name'] = isset($_FILES['pfimage']['tmp_name']) ? $_FILES['pfimage']['tmp_name'] : null;
                $upImgFileInfo['type'] = isset($_FILES['pfimage']['type']) ? $_FILES['pfimage']['type'] : null;
                $upImgFileInfo['size'] = isset($_FILES['pfimage']['size']) ? $_FILES['pfimage']['size'] : null;
                $upImgFileInfo['error'] = isset($_FILES['pfimage']['error']) ? $_FILES['pfimage']['error'] : null;

                // 파일 업로드를 시도했고 오류가 없다면.
                if ($upImgFileInfo['name'] && $upImgFileInfo['error'] == 0) {
                    // 이미지 업로드 실행
                    $imgFileType = pathinfo($upImgFileInfo['name'], PATHINFO_EXTENSION); //이미지 파일 확장자 추출

                    $saveFileName = $data['pcategory'] . strval($getPnum);
                    $saveFileNameWithExt = $saveFileName . "." . strval($imgFileType);
                    $thumbnailFileNameWithExt = $saveFileName . "_S" . "." . strval($imgFileType);

                    $retArr2 = singleFileUpload($upImgFileInfo, $productImgSavePath, $saveFileNameWithExt, $fileMaxSize);  // commonLIB.php 포함 함수

                    if ($retArr2['uploadOk']) { // 업로드가 성공 했다면.
                        $data['pfimage'] = $saveFileNameWithExt; // pfimage 값 설정

                        if ($imgFileType == "jpg" || $imgFileType == "jpeg" || $imgFileType == "png" || $imgFileType == "gif") {
                            $src = $productImgSavePath . strval($saveFileNameWithExt);
                            $dest = $thumbnailImgSavePath . strval($thumbnailFileNameWithExt);
                            makeThumbnailImage($src, $dest, $thumbnailImgHeight, $imgFileType);

                            $data['psimage'] = $thumbnailFileNameWithExt; // psimage 값 설정

                        }
                    }
                }

                $data['pnum'] = $getPnum;
                $data['pcategory'] = isset($_REQUEST['pcategory']) ? $_REQUEST['pcategory'] : null;
                $data['pcode'] = $data['pcategory'] . strval($getPnum); // pnum값을 이용하여 pcode값 생성
                $data['pname'] = isset($_REQUEST['pname']) ? $_REQUEST['pname'] : null;
                $data['pstock'] = isset($_REQUEST['pstock']) ? $_REQUEST['pstock'] : null;
                $data['pprice'] = isset($_REQUEST['pprice']) ? $_REQUEST['pprice'] : null;

                // 기존에 입력된 데이터를 새로운 정보로 수정한다.
                $result = updateProductByNum($data);
                if ($result) {
                    $action = 923; // 입력 성공후 상품리스트 보기 콘트롤로 리다이렉트
                    header("location:../controller/MainCTL.php?action=$action");
                } else {
                    $action = 919; //다시 입력하도록 실패메시지 뷰로 리다이렉트
                    header("location:../view/MainView.php?action=$action");
                }
            }
            break;

        case  923: // 상품리스트 보기 처리

            $ppageName = "pageNum" . strval($action);
            if (!$_SESSION[$ppageName]) {
                $ppageNum = isset($_REQUEST[$ppageName]) ? $_REQUEST[$ppageName] : 1;
            } else {
                $ppageNum = isset($_REQUEST[$ppageName]) ? $_REQUEST[$ppageName] : $_SESSION[$ppageName];
            }
            if ($ppageNum == 0) $ppageNum = 1;

            $PCLPP = 10;
            $PCPPB = 10;

            $cnt = getProductCount(); // product 테이블 레코드 갯수 조회
            $productPageInfo = getPageInfo($ppageNum, $cnt, $PCLPP, $PCPPB);
            $productList = selectProductListWithPageInfo($productPageInfo);

            $_SESSION['cnt'] = $cnt;
            $_SESSION['PageInfo'] = $productPageInfo;
            $_SESSION['productList'] = $productList;
            header("location:../view/MainView.php?action=$action");
            break;

        case 924: // 데이터 수정 처리

            // 이미지 저장 디렉터리
            $productImgSavePath = "../../img/product/";
            $thumbnailImgSavePath = "../../img/product_s/";
            $thumbnailImgHeight = 150;
            $fileMaxSize = 2000000;

            $data['pnum'] = isset($_REQUEST['pnum']) ? $_REQUEST['pnum'] : null;
            $data['pcategory'] = isset($_REQUEST['pcategory']) ? $_REQUEST['pcategory'] : null;
            $data['pcode'] = isset($_REQUEST['pcode']) ? $_REQUEST['pcode'] : null;
            $data['pname'] = isset($_REQUEST['pname']) ? $_REQUEST['pname'] : null;
            $data['pstock'] = isset($_REQUEST['pstock']) ? $_REQUEST['pstock'] : null;
            $data['pprice'] = isset($_REQUEST['pprice']) ? $_REQUEST['pprice'] : null;
            $data['pfimage'] = isset($_REQUEST['pfimage']) ? $_REQUEST['pfimage'] : null;
            $data['psimage'] = isset($_REQUEST['psimage']) ? $_REQUEST['psimage'] : null;

            $getPnum = $data['pnum'];

            $upImgFileInfo['name'] = isset($_FILES['update_img']['name']) ? $_FILES['update_img']['name'] : null;
            $upImgFileInfo['tmp_name'] = isset($_FILES['update_img']['tmp_name']) ? $_FILES['update_img']['tmp_name'] : null;
            $upImgFileInfo['type'] = isset($_FILES['update_img']['type']) ? $_FILES['update_img']['type'] : null;
            $upImgFileInfo['size'] = isset($_FILES['update_img']['size']) ? $_FILES['update_img']['size'] : null;
            $upImgFileInfo['error'] = isset($_FILES['update_img']['error']) ? $_FILES['update_img']['error'] : null;



            // 파일 업로드를 시도했고 오류가 없다면.
            if ($upImgFileInfo['name'] && $upImgFileInfo['error'] == 0) {

                $filedir = "../../img/product/";//파일경로 지정
                $filedirs = "../../img/product_s/";//파일경로 지정

                if (($data['pfimage'] && $filedir) && ($data['psimage'] && $filedirs)) {
                    fileDelete($data['pfimage'], $filedir);
                    fileDelete($data['psimage'], $filedirs);
                }

                // 이미지 업로드 실행
                $imgFileType = pathinfo($upImgFileInfo['name'], PATHINFO_EXTENSION); //이미지 파일 확장자 추출


                $saveFileName = $data['pcategory'] . strval($getPnum);
                $saveFileNameWithExt = $saveFileName . "." . strval($imgFileType);
                $thumbnailFileNameWithExt = $saveFileName . "_S" . "." . strval($imgFileType);

                $retArr2 = singleFileUpload($upImgFileInfo, $productImgSavePath, $saveFileNameWithExt, $fileMaxSize);  // commonLIB.php 포함 함수
                /*exit(var_dump($retArr2));*/

                if ($retArr2['uploadOk']) { // 업로드가 성공 했다면.
                    $data['pfimage'] = $saveFileNameWithExt; // pfimage 값 설정

                    if ($imgFileType == "jpg" || $imgFileType == "jpeg" || $imgFileType == "png" || $imgFileType == "gif") {
                        $src = $productImgSavePath . strval($saveFileNameWithExt);
                        $dest = $thumbnailImgSavePath . strval($thumbnailFileNameWithExt);
                        makeThumbnailImage($src, $dest, $thumbnailImgHeight, $imgFileType);

                        $data['psimage'] = $thumbnailFileNameWithExt; // psimage 값 설정

                    }
                }
            }


            $result = updateProductByNum($data);
            if (!$result) {
                $action = 919;
            }
            $action = 923;
            $productPageInfo = $_SESSION['PageInfo'];
            $ppageNum = $productPageInfo['currentPageNum'];
            $pageParaName = "pageNum" . strval($action);
            header("location:./MainCTL.php?action=$action&$pageParaName=$ppageNum");  //콘트롤러 재호출
            break;

        case
        926: //수정요구 처리
            $num = $_REQUEST['num'];
            $product = selectProductByNum($num);
            if (!$product) {
                $action = 919;
            } else {
                $_SESSION['product'] = $product;
                $action = 925;  //수정처리 뷰로 리다이렉트
            }
            header("location:../view/MainView.php?action=$action");
            break;

        case 927: // 삭제요구 처리
            $pfimage = isset($_REQUEST['pfimage']) ? $_REQUEST['pfimage'] : null;
            $psimage = isset($_REQUEST['psimage']) ? $_REQUEST['psimage'] : null;

            $filedir = "../../img/product/";//파일경로 지정
            $filedirs = "../../img/product_s/";//파일경로 지정

            if (($pfimage && $filedir) && ($psimage && $filedirs)) {
                fileDelete($pfimage, $filedir);
                fileDelete($psimage, $filedirs);
            }

            $num = $_REQUEST['num'];
            $result = deleteProductByNum($num);
            if (!$result) {
                $action = 919;
            } else {
                $action = 923;
            }

            $productPageInfo = $_SESSION['PageInfo'];
            $ppageNum = $productPageInfo['currentPageNum'];
            $pageParaName = "pageNum" . strval($action);
            header("location:./MainCTL.php?action=$action&$pageParaName={$ppageNum}");  //콘트롤러 재호출
            break;

        case 928: //상세페이지 보기 처리
            $num = $_REQUEST['num'];
            $retaction = isset($_REQUEST['retaction']) ? $_REQUEST['retaction'] : null;
            $product = selectProductByNum($num);
            if (!$product) {
                $action = 919;
            } else {
                $_SESSION['product'] = $product;
                $action = 928;  //수정처리 뷰로 리다이렉트
            }
            header("location:../view/MainView.php?action=$action&retaction=$retaction");
            break;

        case 930:  // 결제관리 처리 액션
            $ppageName = "pageNum" . strval($action);

            if (!$_SESSION[$ppageName]) {
                $ppageNum = isset($_REQUEST[$ppageName]) ? $_REQUEST[$ppageName] : 1;
            } else {
                $ppageNum = isset($_REQUEST[$ppageName]) ? $_REQUEST[$ppageName] : $_SESSION[$ppageName];
            }
            if ($ppageNum == 0) $ppageNum = 1;

            $PCLPP = 10;
            $PCPPB = 10;

            $cnt = getProductCount(); // product 테이블 레코드 갯수 조회
            $productPageInfo = getPageInfo($ppageNum, $cnt, $PCLPP, $PCPPB);
            $productList = selectProductorderListWithPageInfo($productPageInfo);

            $_SESSION[$ppageName] = $ppageNum;
            $_SESSION['PageInfo'] = $productPageInfo;
            $_SESSION['productList'] = $productList;

            header("location:../view/MainView.php?action=$action");
            break;


        case 940: // 배송관리 처리 액션
            header("location:../view/MainView.php?action=$action");
            break;

        case 950: // 매출관리 처리 액션
            header("location:../view/MainView.php?action=$action");
            break;

        case 960: // 게시판관리 처리 액션
            header("location:../view/MainView.php?action=$action");
            break;

        case 970: // 고객이 상품 구매하기 버튼을 눌렀을 경우 ~ 결제
            $productoption['id'] = isset($_SESSION['loginID'])?$_SESSION['loginID']:"비회원";
            $productoption['size'] = isset($_REQUEST['size'])?$_REQUEST['size']:null;
            $productoption['color'] = isset($_REQUEST['color'])?$_REQUEST['color']:null;
            $productoption['cnt'] = isset($_REQUEST['cnt'])?$_REQUEST['cnt']:null;
            $productoption['pnum'] = isset($_REQUEST['pnum'])?$_REQUEST['pnum']:null;
            $productoption['pname'] = isset($_REQUEST['pname'])?$_REQUEST['pname']:null;
            $productoption['pprice'] = isset($_REQUEST['pprice'])?$_REQUEST['pprice']:null;
            $productoption['totalprice'] = $productoption['cnt'] * $productoption['pprice'];
            $productoption['creditstate'] = "미결제";

            $_SESSION['productoption'] = $productoption;


            header("location:../view/MainView.php?action=$action");
            break;

        case 971:
            $creditstate = isset($_REQUEST['creditstate'])?$_REQUEST['creditstate']:null;//결제페이지로 부터 넘어온 결제 상태
            $productoption = isset($_SESSION['productoption'])?$_SESSION['productoption']:null;

            if($creditstate == 1){$productoption['creditstate'] = "결제완료";}


            $result = insertorder($productoption);

            $action = 972;



            header("location:../view/MainView.php?action=$action&resultNum=$result");
            break;

        default:
            header("location:../view/MainView.php?action=$action");
            break;
    }

}


