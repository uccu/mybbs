<?php
/**
 * Created by PhpStorm.
 * User: ZhuXueSong
 * Date: 2016/10/17
 * Time: 下午1:22
 */

require ("common.php");
require ("weiXinLogin.class.php");
$_SESSION['firstUrl'] = $_SERVER['HTTP_REFERER'];
$wx = new weiXinLogin();
$wx->get_code();