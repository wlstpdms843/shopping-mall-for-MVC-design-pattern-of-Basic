<?php

function connectDB()
{
    $dbInfo['hostname'] = "localhost";
    $dbInfo['username'] = "root";
    $dbInfo['password'] = "";

    $dbConnection = mysql_pconnect($dbInfo['hostname'], $dbInfo['username'], $dbInfo['password']) or die("db connect error");
    mysql_query("SET NAMES utf8");
    mysql_select_db("myshopb", $dbConnection);

    return $dbConnection;
}


function getPageInfo($pageNum, $cnt, $clpp, $cppb){

    $CLPP = isset($clpp)?$clpp:10;
    $CPPB = isset($cppb)?$cppb:10;

    $countWholeRecord = $cnt;   //전체 레코드 갯수
    $countWholePage = ceil($countWholeRecord/$CLPP);  //전체 페이지 갯수
    $countWholeBlock = ceil($countWholePage/$CPPB); // 전체 블럭 갯수

    $currentBlockNum = ceil($pageNum/$CPPB); // 현재 페이지가 포함된 블럭 넘버
    $pageCountInlastBlock = $countWholePage - (($countWholeBlock -1) * $CPPB); //마지막 블럭에 포함된 페이지 갯수

    $pageInfo['firstPage'] = ($pageNum == 1)?false:true; //처음 페이지 표시 여부
    $pageInfo['lastPage'] = ($pageNum == $countWholePage)?false:true; // 마지막 페이지 표시 여부 
    $pageInfo['startPageNumInBlock'] = ($currentBlockNum-1) * $CPPB + 1; // 현재 블럭에서 시작 페이지 번호
    $pageInfo['preBlock'] = ($pageNum <= $CPPB)?0:$pageInfo['startPageNumInBlock']-$CPPB; // 이전블럭 가기 표시 여부
    $pageInfo['nextBlock'] = ($currentBlockNum >= $countWholeBlock)?0:$pageInfo['startPageNumInBlock']+$CPPB; // 다음블럭 가기 표시 여부
    $pageInfo['currentPageNum'] = ($pageNum <= $countWholePage)?$pageNum:$pageNum-1; // 현재 페이지 번호
    $pageInfo['countPageInBlock'] = ($currentBlockNum != $countWholeBlock)?$CPPB:$pageCountInlastBlock; // 현재 블럭에 표시할 페이지 갯수

    $pageInfo['CLPP'] = $CLPP;
    $pageInfo['CPPB'] = $CPPB;

    $pageInfo['countWholeRecord'] = $countWholeRecord;
    $pageInfo['countWholePage'] = $countWholePage;
    $pageInfo['countWholeBlock'] = $countWholeBlock;

    $pageInfo['currentBlockNum'] = $currentBlockNum;
    $pageInfo['pageCountInlastBlock'] = $pageCountInlastBlock;

    return $pageInfo;
}

// 파일 업로드 처리 함수
function singleFileUpload($uploadFileInfo, $uploadPath, $saveFileName, $fileMaxSize){

    $targetDir = $uploadPath; //경로
    $targetFile = $targetDir.basename($saveFileName);//이름까지 붙은 경로
    $imageFileType = pathinfo($targetFile,PATHINFO_EXTENSION);//확장자


    // 이미지 파일이 가짜 이미지 파일 인지 확인 
    $check = getimagesize($uploadFileInfo["tmp_name"]);
    if($check != false) {
         $returnArr['msg'][0] = "File is an image - " . $check["mime"] . ".";
         $returnArr['uploadOk'] = 1;
    } else {
         $returnArr['msg'][0] = "File is not an image.";
         $returnArr['uploadOk'] = 0;
    }


    if (file_exists($targetFile)) {
        $returnArr['msg'][1] = "Sorry, file already exists.";
        $returnArr['uploadOk'] = 0;
    }
    

    if ($uploadFileInfo["size"] > $fileMaxSize) {
        $returnArr['msg'][2] = "Sorry, your file is too large.";
        $returnArr['uploadOk'] = 0;
     }


    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $returnArr['msg'][3] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $returnArr['uploadOk'] = 0;
    }


    if ($returnArr['uploadOk'] == 0) {
        $returnArr['msg'][4] = "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($uploadFileInfo["tmp_name"], $targetFile)) {
            $returnArr['msg'][5] = "The file ". basename( $uploadFileInfo["name"]). " has been uploaded.";
        } else {
            $returnArr['msg'][5] = "Sorry, there was an error uploading your file.";
        }
    }

    return $returnArr;
}

// 썸네일 이미지 생성 함수
function makeThumbnailImage($src, $dest, $desiredHeight, $imgFileType) {

    // 이미지 소스 파일을 읽어 온다.
    if( $imgFileType == "jpg" || $imgFileType == "jpeg"){
        $sourceImage = imagecreatefromjpeg($src);
    }elseif ( $imgFileType == "png") {
        $sourceImage = imagecreatefrompng($src);
    }else{
        $sourceImage = imagecreatefromgif($src);
    }

    $width = imagesx($sourceImage);
    $height = imagesy($sourceImage);
    

    $desiredWidth = floor($width * ($desiredHeight / $height));
    

    $virtualImage = imagecreatetruecolor($desiredWidth, $desiredHeight);
    

    imagecopyresampled($virtualImage, $sourceImage, 0, 0, 0, 0, $desiredWidth, $desiredHeight, $width, $height);
    

    if( $imgFileType == "jpg" || $imgFileType == "jpeg"){
        imagejpeg($virtualImage, $dest);
    }elseif ( $imgFileType == "png") {
        imagepng($virtualImage, $dest);
    }else{
        imagegif($virtualImage, $dest);;
    }

}


