<?php
/*
Plugin Name: 不关注xx贴吧不给绑定
Version: 1.1
Plugin URL: http://www.mokeyjay.com
Description: 禁止没有关注指定贴吧并达到x级的账号绑定
Author: mokeyjay
Author Email: i@mokeyjay.com
Author URL: http://www.mokeyjay.com
For: V3.4+
*/
if (!defined('SYSTEM_ROOT') && !defined('ROLE')) {
    die('Insufficient Permissions');
}

/**
 * 获取贴吧等级
 * @param string $tieba
 * @return int
 */
function mok_follow_get_tieba_level($tieba)
{
    global $bduss; // 获取云签过滤后的bduss

    $c = new wcurl('http://tieba.baidu.com/mo/m?kw=' . urlencode($tieba), array('User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36', 'Cookie:BDUSS=' . $bduss));
    $t = $c->get();
    $c->close();
    return (int)textMiddle($t, '&#160;(等级', ')');
}

function mok_follow_check()
{
    if(ROLE != 'admin' && ROLE != 'vip'){
        $opt = unserialize(option::get('mok_follow'));

        foreach ($opt['mustTieba'] as $tb => $lv) {
            if (mok_follow_get_tieba_level($tb) < $lv) {
                msg($opt['error'][0]);
            }
        }
        if (count($opt['optionTieba']) > 0) {
            $check = false;
            foreach ($opt['optionTieba'] as $tb => $lv) {
                if (mok_follow_get_tieba_level($tb) >= $lv) {
                    $check = true;
                    break;
                }
            }
            if ($check == false) {
                msg($opt['error'][0]);
            }
        }
    }
}

addAction('baiduid_set_2', 'mok_follow_check');