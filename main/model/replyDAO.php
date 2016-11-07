<?php
include_once "commonLIB.php";

function insertreply($data)
{

    connectDB();


    $sql = " INSERT INTO reply(group_num,depth,ord,id,title,note,replyDate)";
    $sql .= " VALUES('";
    $sql .= strval($data['groupNum']) . "','" . strval($data['depth']) . "','" . strval($data['ord']) . "','" . strval($data['id']) . "','" . strval($data['title']) . "','" . strval($data['note']) . "',now() )";


    $result = mysql_query($sql);

    if (!$result) {
        exit(var_dump($sql));
    }

    mysql_close();
    return $result;

}

function getReplyList()
{
    connectDB();

    $sql = "select * from reply";

    $result = mysql_query($sql);

    if (!$result) {
        exit(var_dump($sql));
    }


    $cnt = 0;
    while ($row = mysql_fetch_array($result)) {
        $replyList[$cnt]['replyNum'] = $row['replyNum'];
        $replyList[$cnt]['group_num'] = $row['group_num'];
        $replyList[$cnt]['depth'] = $row['depth'];
        $replyList[$cnt]['ord'] = $row['ord'];
        $replyList[$cnt]['id'] = $row['id'];
        $replyList[$cnt]['title'] = $row['title'];
        $replyList[$cnt]['note'] = $row['note'];
        $replyList[$cnt]['replyDate'] = $row['replyDate'];
        $replyList[$cnt]['hit'] = $row['hit'];
        $cnt++;
    }

    mysql_close();
    return $replyList;
}

function selectReplyByNum($num)
{

    connectDB();
    $sql = "SELECT * FROM reply WHERE replyNum = " . strval($num);
    $result = mysql_query($sql);

    if ($result) {
        $row = mysql_fetch_array($result);
        $reply['replyNum'] = $row['replyNum'];
        $reply['group_num'] = $row['group_num'];
        $reply['depth'] = $row['depth'];
        $reply['ord'] = $row['ord'];
        $reply['id'] = $row['id'];
        $reply['title'] = $row['title'];
        $reply['note'] = $row['note'];
        $reply['replyDate'] = $row['replyDate'];
        $reply['hit'] = $row['hit'];
    } else {
        $reply = null;
    }


    mysql_close();
    return $reply;
}

function updateReplyByNum($data)
{

    connectDB();
    $sql = " UPDATE reply SET ";
    $sql .= " title = '" . strval($data['title']) . "'," . "note = '" . strval($data['note']) . "'";
    $sql .= " WHERE replyNum = " . strval($data['replyNum']);


    $result = mysql_query($sql);

    mysql_close();
    return $result;
}

function deleteReplyByNum($num)
{

    connectDB();
    $sql = "DELETE from reply WHERE replyNum = '" . strval($num) . "'";

    $result = mysql_query($sql);

    mysql_close();
    return $result;
}

function deleteReplyByGroupNum($num)
{

    connectDB();
    $sql = "DELETE from reply WHERE group_num = '" . strval($num) . "'";

    $result = mysql_query($sql);
    mysql_close();
    return $result;
}

function cntuphitforReply($num)
{

    connectDB();
    $sql = "select * from reply WHERE replyNum = '" . strval($num) . "'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);

    $hitup = $row['hit'] + 1;
    $sql = " UPDATE reply SET ";
    $sql .= " hit = $hitup";
    $sql .= " WHERE replyNum = " . strval($num);
    if (!$result = mysql_query($sql)) {
        exit($sql);
    }

    mysql_close();
    return $result;
}

?>

