<?php


if( $action == 900){
    echo "Body Page Number $action";
}else if($action == 600){
    include_once  "./body/600/".strval($action).".php";
}else
    include_once  "./body/900/".strval($action).".php";
?>
