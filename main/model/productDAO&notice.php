<?php

include_once "commonLIB.php";

function selectAllProduct()
{

    connectDB(); // DB연결
    $sql = "SELECT * FROM product ORDER BY pnum DESC; ";
    $result = mysql_query($sql);

    $cnt = 0;
    while ($row = mysql_fetch_array($result)) {
        $productList[$cnt]['pnum'] = $row['pnum'];
        $productList[$cnt]['pcategory'] = $row['pcategory'];
        $productList[$cnt]['pcode'] = $row['pcode'];
        $productList[$cnt]['pname'] = $row['pname'];
        $productList[$cnt]['pstock'] = $row['pstock'];
        $productList[$cnt]['pprice'] = $row['pprice'];
        $productList[$cnt]['pfimage'] = $row['pfimage'];
        $productList[$cnt]['psimage'] = $row['psimage'];
        $cnt++;
    }

    mysql_close();
    return $productList;
}

// 향후 이 함수를 selectAllProduct() 함수와 통합 관리 할 수 있도록 한다.
function selectAllProductWithPcategory($pcategory)
{

    connectDB(); // DB연결
    $sql = "SELECT * FROM product WHERE pcategory = " . strval($pcategory) . " ORDER BY pnum DESC; ";
    $result = mysql_query($sql);

    $cnt = 0;
    while ($row = mysql_fetch_array($result)) {
        $productList[$cnt]['pnum'] = $row['pnum'];
        $productList[$cnt]['pcategory'] = $row['pcategory'];
        $productList[$cnt]['pcode'] = $row['pcode'];
        $productList[$cnt]['pname'] = $row['pname'];
        $productList[$cnt]['pstock'] = $row['pstock'];
        $productList[$cnt]['pprice'] = $row['pprice'];
        $productList[$cnt]['pfimage'] = $row['pfimage'];
        $productList[$cnt]['psimage'] = $row['psimage'];
        $cnt++;
    }

    mysql_close();
    return $productList;
}

function selectProductByNum($pnum)
{

    connectDB();
    $sql = "SELECT * FROM product WHERE pnum = " . strval($pnum);
    $result = mysql_query($sql);

    if ($result) {
        $row = mysql_fetch_array($result);
        $product['pnum'] = $row['pnum'];
        $product['pcategory'] = $row['pcategory'];
        $product['pcode'] = $row['pcode'];
        $product['pname'] = $row['pname'];
        $product['pstock'] = $row['pstock'];
        $product['pprice'] = $row['pprice'];
        $product['pfimage'] = $row['pfimage'];
        $product['psimage'] = $row['psimage'];
    } else {
        $product = null;
    }

    mysql_close();
    return $product;
}

function selectProductListWithPageInfo($pageInfo)
{

    connectDB();

    $CLPP = isset($pageInfo['CLPP']) ? $pageInfo['CLPP'] : 10;
    $limitFirstNum = ($pageInfo['currentPageNum'] - 1) * $CLPP;

    $sql = "SELECT * FROM product ORDER BY pnum DESC limit " . strval($limitFirstNum) . "," . strval($CLPP);
    $result = mysql_query($sql);

    $cnt = 0;
    while ($row = mysql_fetch_array($result)) {
        $productList[$cnt]['pnum'] = $row['pnum'];
        $productList[$cnt]['pcategory'] = $row['pcategory'];
        $productList[$cnt]['pcode'] = $row['pcode'];
        $productList[$cnt]['pname'] = $row['pname'];
        $productList[$cnt]['pstock'] = $row['pstock'];
        $productList[$cnt]['pprice'] = $row['pprice'];
        $productList[$cnt]['pfimage'] = $row['pfimage'];
        $productList[$cnt]['psimage'] = $row['psimage'];

        $cnt++;
    }

    mysql_close();
    return $productList;
}

function selectProductorderListWithPageInfo($pageInfo) {
    connectDB();

    $CLPP = isset($pageInfo['CLPP']) ? $pageInfo['CLPP'] : 10;
    $limitFirstNum = ($pageInfo['currentPageNum'] - 1) * $CLPP;

    $sql = "SELECT * FROM productorder ORDER BY ordernum DESC limit " . strval($limitFirstNum) . "," . strval($CLPP);
    $result = mysql_query($sql);

    $cnt = 0;
    while ($row = mysql_fetch_array($result)) {
        $productList[$cnt]['orderNum'] = $row['orderNum'];
        $productList[$cnt]['orderid'] = $row['orderid'];
        $productList[$cnt]['pnum'] = $row['pnum'];
        $productList[$cnt]['ordercnt'] = $row['ordercnt'];
        $productList[$cnt]['ordercolor'] = $row['ordercolor'];
        $productList[$cnt]['totalprice'] = $row['totalprice'];
        $productList[$cnt]['creditstate'] = $row['creditstate'];

        $cnt++;
    }

    mysql_close();
    return $productList;
}

function selectProductListWithPageInfoAndPcategory($pageInfo, $pcategory)
{

    connectDB();

    $CLPP = isset($pageInfo['CLPP']) ? $pageInfo['CLPP'] : 10;
    $limitFirstNum = ($pageInfo['currentPageNum'] - 1) * $CLPP;


    if ($pcategory == "N1" || $pcategory == "N2" || $pcategory == "H") {
        $sql = "SELECT * FROM notice WHERE category like '" . strval($pcategory) . "' ORDER BY num DESC limit " . strval($limitFirstNum) . "," . strval($CLPP);
    } else {
        $sql = "SELECT * FROM product WHERE pcategory like '" . strval($pcategory) . "' ORDER BY pnum DESC limit " . strval($limitFirstNum) . "," . strval($CLPP);
    }


    $result = mysql_query($sql);


    if ($pcategory == "N1" || $pcategory == "N2" || $pcategory == "H") {
        $cnt = 0;
        while ($row = mysql_fetch_array($result)) {
            $productList[$cnt]['num'] = $row['num'];
            $productList[$cnt]['name'] = $row['name'];
            $productList[$cnt]['title'] = $row['title'];
            $productList[$cnt]['date'] = $row['date'];
            $productList[$cnt]['hit'] = $row['hit'];
            $productList[$cnt]['category'] = $row['category'];

            $cnt++;
        }
    } else {
        $cnt = 0;
        while ($row = mysql_fetch_array($result)) {
            $productList[$cnt]['pnum'] = $row['pnum'];
            $productList[$cnt]['pcategory'] = $row['pcategory'];
            $productList[$cnt]['pcode'] = $row['pcode'];
            $productList[$cnt]['pname'] = $row['pname'];
            $productList[$cnt]['pstock'] = $row['pstock'];
            $productList[$cnt]['pprice'] = $row['pprice'];
            $productList[$cnt]['pfimage'] = $row['pfimage'];
            $productList[$cnt]['psimage'] = $row['psimage'];

            $cnt++;
        }
    }


    mysql_close();
    return $productList;
}


function insertProduct($data)
{

    connectDB();
    $sql = " INSERT INTO product(pcategory,pcode,pname,pstock,pprice,pfimage,psimage) ";
    $sql .= " VALUES('";
    $sql .= strval($data['pcategory']) . "','" . strval($data['pcode']) . "','" . strval($data['pname']) . "','" . strval($data['pstock']) . "','" . strval($data['pprice']) . "','" . strval($data['pfimage']) . "','" . strval($data['psimage']) . "')";


    $result = mysql_query($sql);
    $autoPnum = mysql_insert_id();

    $retArr['result'] = $result;
    $retArr['autoPnum'] = $autoPnum;

    mysql_close();
    return $retArr;
}

function insertorder($data)
{

    connectDB();
    $sql = " INSERT INTO productorder (orderid,pnum,ordercnt,ordercolor,totalprice,creditstate) ";
    $sql .= " VALUES('";
    $sql .= strval($data['id']) . "','" . strval($data['pnum']) . "','" . strval($data['cnt']) . "','" . strval($data['color']) . "','" . strval($data['totalprice']) . "','" . strval($data['creditstate']) . "')";

    $result = mysql_query($sql);
    if(!$result){
        var_dump($sql);
        exit();
    }

    $autoPnum = mysql_insert_id();
    $retNum = $autoPnum;





    mysql_close();
    return $retNum;
}

function insertNotice($data)
{

    connectDB();
    $sql = " INSERT INTO notice(name,title,note,date,category)";
    $sql .= " VALUES('";
    $sql .= strval($data['name']) . "','" . strval($data['title']) . "','" . strval($data['note']) . "',now(),'" . strval($data['category']) . "')";


    $result = mysql_query($sql);

    if (!$result) {
        exit(var_dump($sql));
    }


    mysql_close();
    return $result;
}

function selectNoticeByNum($num){

    connectDB();
    $sql = "SELECT * FROM notice WHERE num = ".strval($num);
    $result = mysql_query($sql);

    if( $result ){
        $row = mysql_fetch_array($result);
        $notice['num'] = $row['num'];
        $notice['id'] = $row['name'];
        $notice['title'] = $row['title'];
        $notice['note'] = $row['note'];
        $notice['category'] = $row['category'];
        $notice['date'] = $row['date'];
    }else{
        $notice = null;
    }

    mysql_close();
    return $notice;
}


function insertComment($data)
{

    connectDB();
    $sql = " INSERT INTO comment(commentNum,id,note,commentDate)";
    $sql .= " VALUES('";
    $sql .= strval($data['num']) . "','" . strval($data['id']) . "','" . strval($data['comment']) . "',now() )";


    $result = mysql_query($sql);

    if (!$result) {
        exit(var_dump($sql));
    }


    mysql_close();
    return $result;
}

function deleteNoitceByNum($num){

    connectDB();
    $sql = "DELETE FROM notice WHERE num = ".strval($num);
    $result = mysql_query($sql);

    mysql_close();
    return $result;
}


function deleteCommentByNum($cnt)
{

    connectDB();
    $sql = "DELETE FROM comment WHERE cnt = '" . strval($cnt) . "'";
    $result = mysql_query($sql);

    mysql_close();
    return $result;
}

function deleteCommentBycommentNum($cnt)
{

    connectDB();
    $sql = "DELETE FROM comment WHERE commentNum = '" . strval($cnt) . "'";
    $result = mysql_query($sql);


    mysql_close();
    return $result;
}


function getComment($commentNum)
{
    connectDB();
    $sql = "select * from comment WHERE commentNum = '" . strval($commentNum) . "'";
    $result = mysql_query($sql);

    if (!$result) {
        exit(var_dump($sql));
    }

    $cnt = 0;
    while ($row = mysql_fetch_array($result)) {
        $commentList[$cnt]['cnt'] = $row['cnt'];
        $commentList[$cnt]['id'] = $row['id'];
        $commentList[$cnt]['note'] = $row['note'];
        $commentList[$cnt]['commentDate'] = $row['commentDate'];
        $cnt++;
    }

    return $commentList;
}


function updateProductByNum($data)
{

    connectDB();
    $sql = " UPDATE product SET ";
    $sql .= " pcategory = '" . strval($data['pcategory']) . "'," . "pcode = '" . strval($data['pcode'])
        . "',pname = '" . strval($data['pname']) . "',pstock = '" . strval($data['pstock']) . "',pprice = '"
        . strval($data['pprice']) . "',pfimage = '" . strval($data['pfimage']) . "',psimage = '" . strval($data['psimage']) . "'";
    $sql .= " WHERE pnum = " . strval($data['pnum']);


    $result = mysql_query($sql);

    mysql_close();
    return $result;
}


function cntuphit($num){

    connectDB();
    $sql = "select * from notice WHERE num = '".strval($num)."'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);

    $hitup = $row['hit']+1;
    $sql = " UPDATE notice SET ";
    $sql .= " hit = $hitup";
    $sql .= " WHERE num = " . strval($num);
    if(!$result = mysql_query($sql)){
        exit($sql);
    }

    mysql_close();
    return $result;
}


function deleteProductByNum($pnum)
{

    connectDB();
    $sql = "DELETE FROM product WHERE pnum = '" . strval($pnum) . "'";
    $result = mysql_query($sql);

    mysql_close();
    return $result;
}

function getProductCount()
{ // product데이블 레코드 갯수 확인

    connectDB();
    $sql = " SELECT count(*) FROM productorder; ";
    $result = mysql_query($sql);
    $count = mysql_result($result, 0, 0);

    mysql_close();
    return $count;
}


function getProductCountWithPcategory($pcategory)
{ // product데이블 레코드 갯수 확인

    connectDB();


    if ($pcategory == "N1" || $pcategory == "N2" || $pcategory == "H") {
        $sql = " SELECT count(*) FROM notice WHERE category like '" . strval($pcategory) . "'";
    } else {
        $sql = " SELECT count(*) FROM product WHERE pcategory like '" . strval($pcategory) . "'";
    }
    $result = mysql_query($sql);
    $count = mysql_result($result, 0, 0);

    mysql_close();
    return $count;
}

function fileDelete($filename, $filedir)
{

    if (File_Exists($filedir . $filename)) {
        if (unlink($filedir . $filename)) {
            $result['msg'] = "성공";
            $result['state'] = true;
            return true;
        } else {
            $result['msg'] = "실패";
            $result['state'] = false;
            return false;
        }
    } else {
        $result['msg'] = "경로";
        $result['state'] = false;
        return false;

    }

}
