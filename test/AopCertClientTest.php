<?php

/**
 * Author:  Yejia
 * Email:   ye91@foxmail.com
 */

use cium1\alipayaop\AopCertClient;
use cium1\alipayaop\request\AlipayFundTransUniTransferRequest;

$aop = new AopCertClient();
//应用证书路径（要确保证书文件可读），例如：/home/admin/cert/appCertPublicKey.crt
$appCertPath = __DIR__ . "storage/appCertPublicKey.crt";
//支付宝公钥证书路径（要确保证书文件可读），例如：/home/admin/cert/alipayCertPublicKey_RSA2.crt
$alipayCertPath = __DIR__ . "storage/alipayCertPublicKey_RSA2.crt";
//支付宝根证书路径（要确保证书文件可读），例如：/home/admin/cert/alipayRootCert.crt
$rootCertPath = __DIR__ . "storage/alipayRootCert.crt";
//网关
$aop->gatewayUrl = 'https://openapi.alipaydev.com/gateway.do';
//你的appid
$aop->appId = '2016101200666234';
//你的应用私钥
$aop->rsaPrivateKey = trim(file_get_contents(__DIR__ . "storage/privateKey.txt"));
//调用getPublicKey从支付宝公钥证书中提取公钥
$aop->alipayrsaPublicKey = $aop->getPublicKey($alipayCertPath);
$aop->signType = 'RSA2';
$aop->format = 'json';
//是否校验自动下载的支付宝公钥证书，如果开启校验要保证支付宝根证书在有效期内
$aop->isCheckAlipayPublicCert = true;
//调用getCertSN获取证书序列号
$aop->appCertSN = $aop->getCertSN($appCertPath);
//调用getRootCertSN获取支付宝根证书序列号
$aop->alipayRootCertSN = $aop->getRootCertSN($rootCertPath);
//请求
$request = new AlipayFundTransUniTransferRequest();
$request->setBizContent(json_encode([
    'out_biz_no'   => time(),
    'trans_amount' => '88.88',
    "product_code" => "TRANS_ACCOUNT_NO_PWD",
    "biz_scene"    => "DIRECT_TRANSFER",
    "payee_info"   => [
        "identity"      => "irtegm4753@sandbox.com",
        "identity_type" => "ALIPAY_LOGON_ID",
        "name"          => "沙箱环境",
    ],
]));
try {
    $result = $aop->execute($request);
    var_export($result);
} catch (\Exception $e) {
    throw $e;
}