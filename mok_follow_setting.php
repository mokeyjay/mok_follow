<?php
if (!defined('SYSTEM_ROOT')) {
    die('Insufficient Permissions');
}
$opt = unserialize(option::get('mok_follow'));
$mustTieba='';
foreach($opt['mustTieba'] as $key=>$value){
    $mustTieba.=$key.' <'.$value.'>'."\n";
}
$optionTieba='';
foreach($opt['optionTieba'] as $key=>$value){
    $optionTieba.=$key.' <'.$value.'>'."\n";
}
?>
<div>
    <?php if($_GET['save'] == 'ok'): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>保存设置成功！</strong>
        </div>
    <?php endif; ?>
    <form action="plugins/mok_follow/apis.php" method="post">
        <table class="table table-striped">
            <thead>
            <tr>
                <th style="width:40%">参数</th>
                <th style="width:60%">值</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>必须关注的贴吧<br/><br/>格式：贴吧名[空格]<等级><br/><br/>例如：<br/>女孩 <4><br/>显卡 <10><br/>一行一个<br/>达到该等级或该等级以上才能够在本站绑定百度账号</td>
                <td>
                    <textarea name="mustTieba" class="form-control" style="height:200px"><?php echo $mustTieba; ?></textarea>
                </td>
            </tr>
            <tr>
                <td>至少关注其中一个的贴吧<br/><br/>格式：同上<br/><br/>达到该等级或该等级以上才能够在本站绑定百度账号</td>
                <td>
                    <textarea name="optionTieba" class="form-control" style="height:200px"><?php echo $optionTieba; ?></textarea>
                </td>
            </tr>
            <tr>
                <td>错误提示语<br/><br/>当用户没有满足上面条件时会被禁止绑定账号并显示该错误提示语</td>
                <td>
                    <textarea name="error" class="form-control" style="height:200px"><?php echo $opt['error'][0]; ?></textarea>
                </td>
            </tr>
            </tbody>
        </table>
        <input type="submit" class="btn btn-primary" value="保存设置">
    </form>
</div>