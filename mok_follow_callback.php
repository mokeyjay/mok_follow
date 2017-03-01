<?php
if (!defined('SYSTEM_ROOT')) {
    die('Insufficient Permissions');
}

function callback_init()
{
    //一些初始化数据
    $ary = Array('mustTieba' => Array(), 'optionTieba' => Array(), 'error' => Array('不关注xx贴吧不给绑定插件提醒您：您的账号未达到绑定要求<br/>请向本站管理员咨询'));
    option::set('mok_follow', serialize($ary));
}

function callback_remove()
{
    option::del('mok_follow');
}