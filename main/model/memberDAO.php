<?php

include_once "commonLIB.php";

function loginCheck($id, $password){

    connectDB();
    $sql = "SELECT * FROM member WHERE id = '".strval($id)."' AND password = '".strval($password)."'";
    $sql2 = "SELECT * FROM member WHERE id = '".strval($id)."'";


    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    if( $row['id'] && $row['id'] == $id && $row['password'] == $password){
            $returnArr['level'] = $row['level'];
            $returnArr['name'] = $row['name'];
            $returnArr['code'] = 1; // 로그인 성공 코드 리턴
    }
    else{
       $result = mysql_query($sql2); 
       $row = mysql_fetch_array($result);
       if( $row['id'] && $row['id'] == $id ) $returnArr['code'] = -1; // 비밀번호 입력 오류 코드 리턴
       else $returnArr['code'] = -2; // 아이디 입력 오류 코드 리턴
    }
    mysql_close();
    return $returnArr;
}

function selectAllMember(){

    connectDB(); // DB연결
    $sql = "SELECT * FROM member ORDER BY num DESC; ";
    $result = mysql_query($sql);

    $cnt = 0;
    while( $row = mysql_fetch_array($result)){
        $memberList[$cnt]['num'] = $row['num'];
        $memberList[$cnt]['id'] = $row['id'];
        $memberList[$cnt]['password'] = $row['password'];
        $memberList[$cnt]['name'] = $row['name'];
        $memberList[$cnt]['tel'] = $row['tel'];
        $memberList[$cnt]['level'] = $row['level'];

        $cnt++;
    }

    mysql_close();
     return $memberList;
}

function selectMemberByNum($num){

    connectDB();
    $sql = "SELECT * FROM member WHERE num = ".strval($num);
    $result = mysql_query($sql);

    if( $result ){
        $row = mysql_fetch_array($result);
        $member['num'] = $row['num'];
        $member['id'] = $row['id'];
        $member['password'] = $row['password'];
        $member['name'] = $row['name'];
        $member['tel'] = $row['tel'];
        $member['level'] = $row['level'];
    }else{
        $member = null;
    }

    mysql_close();
    return $member;
}

function selectMemberListWithPageInfo($pageInfo){//회원관리

    connectDB();

    $CLPP = isset($pageInfo['CLPP'])?$pageInfo['CLPP']:10;
    $limitFirstNum = ($pageInfo['currentPageNum'] - 1) * $CLPP;

    $sql = "SELECT * FROM member ORDER BY num DESC limit ".strval($limitFirstNum).",".strval($CLPP);
    $result = mysql_query($sql);

    $cnt = 0;
    while( $row = mysql_fetch_array($result)){
        $memberList[$cnt]['num'] = $row['num'];
        $memberList[$cnt]['id'] = $row['id'];
        $memberList[$cnt]['password'] = $row['password'];
        $memberList[$cnt]['name'] = $row['name'];
        $memberList[$cnt]['tel'] = $row['tel'];
        $memberList[$cnt]['level'] = $row['level'];

        $cnt++;
    }

    mysql_close();
    return $memberList;
}


function insertMember($data){

    connectDB();
    $sql = " INSERT INTO member(id,password,name,tel) ";
    $sql.=" VALUES('";
    $sql.=strval($data['id'])."','".strval($data['password'])."','".strval($data['name'])."','".strval($data['tel'])."')";

    $result = mysql_query($sql);

    mysql_close();
    return $result;
}

function updateMemberByNum( $data ){

    connectDB();
    $sql = " UPDATE member SET ";
    $sql.= " id = '".strval($data['id'])."',"."password = '".strval($data['password'])."',name = '".strval($data['name'])."',tel = '".strval($data['tel'])."',level = '".strval($data['level'])."'";
    $sql.= " WHERE num = ".strval($data['num']);

    var_dump($sql);
    echo "<br>";
    $result = mysql_query($sql);

    var_dump($result);

    mysql_close();
    return $result;
}

function updateNoitceByNum( $data ){

    connectDB();
    $sql = " UPDATE notice SET ";
    $sql.= " title = '".strval($data['title'])."',"."note = '".strval($data['note'])."',category = '".strval($data['category'])."'";
    $sql.= " WHERE num = ".strval($data['num']);


    $result = mysql_query($sql);


    mysql_close();
    return $result;
}


function deleteMemberByNum($num){

    connectDB();
    $sql = "DELETE FROM member WHERE num = ".strval($num);
    $result = mysql_query($sql);

    mysql_close();
    return $result;
}

function getMemberCount(){ // member데이블 레코드 갯수 확인 

    connectDB();
    $sql = " SELECT count(*) FROM member; ";
    $result = mysql_query($sql);
    $count = mysql_result($result, 0, 0);

    mysql_close();
    return $count;
}
