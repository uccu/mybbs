<?php
/**
 * Created by PhpStorm.
 * User: ZhuXueSong
 * Date: 2016/9/28
 * Time: 下午1:40
 */

//ini_set( 'display_errors', 0 );
error_reporting(0);
session_start();

function curl_request($url, $data = array(), $curl_type = 'GET') {
    //初始化
    $ch = curl_init();
    $header = array("content-type: application/x-www-form-urlencoded;charset=UTF-8");
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $curl_type);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $temp = curl_exec($ch);
    return $temp;
}

function curl_xml($url, $xml){
    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_POST, true );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $xml );
    $data = curl_exec ( $ch );
    curl_close ( $ch );
    return $data;
}

function p($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    exit();
}