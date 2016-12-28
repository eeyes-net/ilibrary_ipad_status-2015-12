<?php
error_reporting(0);

define('ID', [
    'ipad',
    'ipad0083',
    'mini',
    'mini0057',
    'imac',
]);

function &get_one($id)
{
    $html = file_get_contents('http://innopac.lib.xjtu.edu.cn/search~S3*chx?/c//,,,/holdings&b' . strtolower($id));
    if (!$html) {
        return false;
    }
    preg_match_all('/<!-- field 1 -->&nbsp;\\s*?(\\S.*?)\\s*?\\n[\\s\\S]+?browse">\\s*?(\\S.*?)\\s*?<\/a>[\\s\\S]+?<!-- field % -->&nbsp;\\s*?(\\S.*?)\\s*?<\/td>/', $html, $matches, PREG_SET_ORDER)
        || preg_match_all('/<!-- field 1 -->&nbsp;\\s*?(\\S.*?)\\s*?\\n[\\s\\S]+?<!-- field C -->(.*?)<!-- field v -->[\\s\\S]+?<!-- field % -->&nbsp;\\s*?(\\S.*?)\\s*?<\/td>/', $html, $matches, PREG_SET_ORDER);
    $data = [];
    foreach ($matches as &$item) {
        $data[] = [
            'id' => $item[2],
            'site' => $item[1],
            'state' => $item[3],
        ];
    }
    return $data;
}

$msg = '获取实时数据成功';
$level = 'success';
$data = [];
foreach (ID as &$id) {
    $one_data = get_one($id);
    if (false === $one_data) {
        $msg = '部分数据读取失败！';
        $level = 'warning';
    } else {
        $data = array_merge($data, get_one($id));
    }
}
if (empty($data)) {
    $msg = '数据读取失败！';
    $level = 'danger';
}

header('Content-Type: application/json; charset=UTF-8');
echo json_encode([
    'data' => $data,
    'msg' => [
        'level' => $level,
        'content' => $msg,
    ],
], JSON_UNESCAPED_UNICODE);