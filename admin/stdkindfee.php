<?php
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = "sumistdiden_adm_fee.tpl";
include_once "header.php";
include_once "../function.php";

/*-----------function區--------------*/

//顯示預設頁面內容
function show_content()
{
    global $xoopsTpl;

    $main = "後台頁面開發中";
    $xoopsTpl->assign('content', $main);
}
/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$sn = system_CleanVars($_REQUEST, 'sn', 0, 'int');

switch ($op) {

    /*case "stdkind_list":
    stdkind_list();
    $op = "stdkind_list";

    header("location:{$_SERVER['PHP_SELF']}");
    exit;
     */

    default:
        show_content();
        $xoopsTpl->assign('content', $main);
        break;
}

$xoopsTpl->assign('now_op', $op);
include_once 'footer.php';
