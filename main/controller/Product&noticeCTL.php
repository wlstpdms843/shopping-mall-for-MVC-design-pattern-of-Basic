<?php

include_once "../model/productDAO&notice.php";



// 100, 200, 300, 400, 500번 단위 액션을 동시에 처리하도록 구성
function productAndNoticeController( $action ){
	if($action == 100){
		$action = 110;
	}

	//session_start();

	$pcategoryArr = array(
		array("N1","N2"),//Notice1
		array("S1","S2","S3","S4"),
		array("U1","U2"),
		array("B1","B2","B3","B4")
		);

    // 카테고리별 상품 페이징 CLPP, CPPB 값 설정
	$clppAndCppbArr = array(
		array(10,5),   // 공지
		array(4,5),   // 신발
		array(4,5),   // 유니폼
		array(4,5));   // 공

		$actionIndex = floor($action/100) - 1; // 액션코드에 따른 메뉴 인덱스 계산
		$actionIndex2 = floor($action/10)%10 -1; // 액션코드에 따른 서브메뉴 인텍스 계산

		if( $action%100 != 0 ){//x10번대 액션이 들어올 경우.
			$pcategory = $pcategoryArr[$actionIndex][$actionIndex2];
		}else{
			$pcategory = substr($pcategoryArr[$actionIndex][0], 0, 1); // 해당카테고리 첫번째 글자로 설정
			$pcategory = "%" . $pcategory . "%";
		}

		$pageName = "pageNum".strval($action);
		if( !$_SESSION[$pageName] ) // 기존 페이지정보 객체가 없다면
			$pageNum = isset($_REQUEST[$pageName])?$_REQUEST[$pageName]:1;
		else
			$pageNum = isset($_REQUEST[$pageName])?$_REQUEST[$pageName]:$_SESSION[$pageName];



		$cnt = getProductCountWithPcategory( $pcategory ); // product 테이블의 카테고리 레코드 갯수 조회
		$productPageInfo = getPageInfo($pageNum, $cnt, $clppAndCppbArr[$actionIndex][0], $clppAndCppbArr[$actionIndex][1]);
		$productList = selectProductListWithPageInfoAndPcategory($productPageInfo, $pcategory );


		$_SESSION[$pageName] = $pageNum;
		$_SESSION['PageInfo'] = $productPageInfo;
		$_SESSION['productList'] = $productList;

		header("location:../view/MainView.php?action=$action");
}
