<?php
include "wechat.class.php";
function mytest(){
    file_put_contents('ttttttttttttttttt.txt',1);
}
$options = array(
    'appid'=>'wx6753a14b1217f788', //填写你设定的key
    'appsecret'=>'62433b0e110dd34b762049eadf169a82' //填写加密用的EncodingAESKey，如接口为明文模式可忽略
);
$openId = 'osAu71dNhOWQEIyGf_H3pFN2vINY';
$weObj = new Wechat($options);

$res= $weObj->sendCustomMessage([
    'touser'=>$openId,
    'msgtype'=>"text",
    "text"=>["content"=>"222"]
]);
print_r($res);
exit;




$options = array(
		'token'=>'tokenaccesskey', //填写你设定的key
        'encodingaeskey'=>'encodingaeskey' //填写加密用的EncodingAESKey，如接口为明文模式可忽略
	);
$weObj = new Wechat($options);
$weObj->valid();//明文或兼容模式可以在接口验证通过后注释此句，但加密模式一定不能注释，否则会验证失败
$type = $weObj->getRev()->getRevType();
switch($type) {
	case Wechat::MSGTYPE_TEXT:
			$weObj->text("hello, I'm wechat")->reply();
			exit;
			break;
	case Wechat::MSGTYPE_EVENT:
			break;
	case Wechat::MSGTYPE_IMAGE:
			break;
	default:
			$weObj->text("help info")->reply();
}