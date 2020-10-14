<?php
/**
 * Created by PhpStorm.
 * User: jwb
 * Date: 2020/4/30
 * Time: 15:34
 */
include "wechat.class.php";

function wechat(){
    $options = array(
        'appid'=>'wx6753a14b1217f788', //填写你设定的key
        'appsecret'=>'62433b0e110dd34b762049eadf169a82' //填写加密用的EncodingAESKey，如接口为明文模式可忽略
    );
    return new Wechat($options);
}