<?php
/**
 * Author:  Yejia
 * Email:   ye91@foxmail.com
 */

namespace Cium\AlipayAop;


class RequestBase
{
    protected $bizContent;

    protected $apiParas = array();

    protected $terminalType;

    protected $terminalInfo;

    protected $prodCode;

    protected $apiVersion = "1.0";

    protected $notifyUrl;

    protected $returnUrl;

    protected $needEncrypt = false;
}