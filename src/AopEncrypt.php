<?php
/**
 * Author:  Yejia
 * Email:   ye91@foxmail.com
 */


/**
 * 加密方法
 *
 * @param $string
 * @param $key
 *
 * @return string
 */
function encrypt($string, $key)
{
    $encrypt_str = openssl_encrypt($string, 'AES-128-ECB', $key, OPENSSL_RAW_DATA);
    return base64_encode($encrypt_str);
}

function decrypt($string, $key)
{
    return openssl_decrypt(base64_decode($string), 'AES-128-ECB', $key, OPENSSL_RAW_DATA);
}

//function encrypt2($str, $screct_key)
//{
//    //AES, 128 模式加密数据 CBC
//    $screct_key = base64_decode($screct_key);
//    $str = trim($str);
//    $str = addPKCS7Padding($str);
//
//    //设置全0的IV
//    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
//    $iv = str_repeat("\0", $iv_size);
//
//    $encrypt_str = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $screct_key, $str, MCRYPT_MODE_CBC, $iv);
//    return base64_encode($encrypt_str);
//}
//
///**
// * 解密方法
// *
// * @param $str
// * @param $screct_key
// *
// * @return string
// */
//function decrypt2($str, $screct_key)
//{
//    //AES, 128 模式加密数据 CBC
//    $str = base64_decode($str);
//    $screct_key = base64_decode($screct_key);
//
//    //设置全0的IV
//    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
//    $iv = str_repeat("\0", $iv_size);
//
//    $decrypt_str = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $screct_key, $str, MCRYPT_MODE_CBC, $iv);
//    $decrypt_str = stripPKSC7Padding($decrypt_str);
//    return $decrypt_str;
//}
//
///**
// * 填充算法
// *
// * @param $source
// *
// * @return string
// */
//function addPKCS7Padding($source)
//{
//    $source = trim($source);
//    $block = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
//
//    $pad = $block - (strlen($source) % $block);
//    if ($pad <= $block) {
//        $char = chr($pad);
//        $source .= str_repeat($char, $pad);
//    }
//    return $source;
//}
//
///**
// * 移去填充算法
// *
// * @param string $source
// *
// * @return string
// */
//function stripPKSC7Padding($source)
//{
//    $char = substr($source, -1);
//    $num = ord($char);
//    if ($num == 62) return $source;
//    $source = substr($source, 0, -$num);
//    return $source;
//}