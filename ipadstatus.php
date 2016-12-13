<?php
error_reporting(0);
define('URL_PREFIX', 'http://innopac.lib.xjtu.edu.cn/search~S3*chx?/c//,,,/holdings&b');
define('URL_1', URL_PREFIX . 'ipad');
define('URL_2', URL_PREFIX . 'ipad0083');
define('URL_3', URL_PREFIX . 'mini');
define('URL_4', URL_PREFIX . 'mini0057');
define('URL_5', URL_PREFIX . 'imac');
define('CACHE_FILE', "cache.js");
date_default_timezone_set("Asia/Shanghai");
header('Content-Type: application/javascript; charset=UTF-8');
echo get();
if (isset($_GET['t']))
    echo 'i();';
function writeCache($cache) {
    $file = fopen(CACHE_FILE, "w");
    fwrite($file, $cache);
    fclose($file);
}
function readCache() {
    return file_get_contents(CACHE_FILE);
}
function get() {
    if (($re1 = getOneURL(URL_1)) && ($re2 = getOneURL(URL_2)) && ($re3 = getOneURL(URL_3)) && ($re4 = getOneURL(URL_4)) && ($re5 = getOneURL(URL_5))) {
        $re = date("Y-m-d H:i:s") . '";var iPadStatus=[' . $re1 . ',' . $re2 . ',' . $re3 . ',' . $re4 . ',' . $re5 . '];';
        writeCache('var reStat="数据来源：<span style=\"background-color:red;\">服务器缓存</span>&nbsp;数据时间：' . $re);
        return 'var reStat="数据来源：<span style=\"background-color:lime\">在线</span>&nbsp;数据时间：' . $re;
    } else {
        if ($cache = readCache())
            return $cache;
        else
            return 'var reStat="<span style=\"background-color:red\">连接INNOPAC系统失败，并且服务器上没有缓存文件</span>";var iPadStatus=[];';
    }
}
function getOneURL($url) {
    if (!($html = file_get_contents($url)))
        return false;
    $re = '';
    if(preg_match_all('/<!-- field 1 -->&nbsp;\\s*?(\\S.*?)\\s*?\\n[\\s\\S]+?browse">\\s*?(\\S.*?)\\s*?<\/a>[\\s\\S]+?<!-- field % -->&nbsp;\\s*?(\\S.*?)\\s*?<\/td>/', $html, $matches) || preg_match_all('/<!-- field 1 -->&nbsp;\\s*?(\\S.*?)\\s*?\\n[\\s\\S]+?<!-- field C -->(.*?)<!-- field v -->[\\s\\S]+?<!-- field % -->&nbsp;\\s*?(\\S.*?)\\s*?<\/td>/', $html, $matches)) {
        for ($i = 0; $i < count($matches[0]) - 1; ++$i)
            $re .= makeI($matches, $i) . ',';
        $re .= makeI($matches, $i);
    }
    return $re;
}
function makeI($matches, $i) {
    return make($matches[2][$i], $matches[3][$i], $matches[1][$i]);
}
function make($id, $status, $site) {
    if (0 === strpos($site, 'iLibrary Space2')) {
        $site = 'IPAD';
    } elseif (0 === strpos($site, 'PBL')) {
        $site = 'PBL';
    } elseif (0 === strpos($site, 'MINI')) {
        $site = 'MINI';
    } elseif (0 === strpos($site, 'iLibrary Space')) {
        $site = 'IMAC';
    }
    return '{id:"' . $id . '",status:"' . $status . '",site:"' . $site . '"}';
}