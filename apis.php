<?php
require '../../init.php';
if (!defined('SYSTEM_ROOT') || ROLE != 'admin') {
    die('Insufficient Permissions');
}
if (!empty($_POST)) {
    //将贴吧和等级存为数组，吧名为键，等级为值
    $ary = explode("\n", $_POST['mustTieba']);
    $mustTieba = Array();
    foreach ($ary as $value) {
        $t = explode(' ', $value);
        if (count($t) == 2) {
            $mustTieba[$t[0]] = textMiddle($t[1], '<', '>');
        }
    }

    $ary = explode("\n", $_POST['optionTieba']);
    $optionTieba = Array();
    foreach ($ary as $value) {
        $t = explode(' ', $value);
        if (count($t) == 2) {
            $optionTieba[$t[0]] = textMiddle($t[1], '<', '>');
        }
    }

    $ary = array('mustTieba' => $mustTieba, 'optionTieba' => $optionTieba, 'error' => Array($_POST['error']));
    option::set('mok_follow', serialize($ary));
    Redirect('../../index.php?mod=admin:setplug&plug=mok_follow&save=ok');
}