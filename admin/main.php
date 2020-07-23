<?php
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = "sumistdiden_adm_main.tpl";
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

function stdkind_list()
{
    global $xoopsDB, $xoopsTpl, $isAdmin;
    $myts   = MyTextSanitizer::getInstance();
    $sql    = "select * from `" . $xoopsDB->prefix("sumi_stdkind") . "` order by `sn`";
    $result = $xoopsDB->query($sql) or web_error($sql);

    $all_content = array();
    $i           = 0;
    while ($all = $xoopsDB->fetchArray($result)) {
//以下會產生這些變數： $usn, $unit, $unit_code, $sort
        foreach ($all as $k => $v) {
            $$k = $v;
        }

//過濾讀出的變數值
        $stdkind          = $myts->htmlSpecialChars($stdkind);
        $kind_description = $myts->htmlSpecialChars($kind_description);
        $memo             = $myts->htmlSpecialChars($memo);

        $all_content[$i]['sn']               = $sn;
        $all_content[$i]['stdkind']          = $stdkind;
        $all_content[$i]['kind_description'] = $kind_description;
        $all_content[$i]['memo']             = $memo;
        $i++;
    }
    $xoopsTpl->assign('all_content', $all_content);
}

/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$sn = system_CleanVars($_REQUEST, 'sn', 0, 'int');

switch ($op) {

    case "stdkind_list":
        stdkind_list();
        $op = "stdkind_list";

        header("location:{$_SERVER['PHP_SELF']}");
        exit;

    default:
        show_content();

        break;
}

$xoopsTpl->assign('now_op', $op);
include_once 'footer.php';
