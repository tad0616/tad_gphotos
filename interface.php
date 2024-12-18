<?php
use XoopsModules\Tad_gphotos\Tools;
if (!class_exists('XoopsModules\Tad_gphotos\Tools')) {
    require XOOPS_ROOT_PATH . '/modules/tad_gphotos/preloads/autoloader.php';
}

//判斷是否對該模組有管理權限
if (!isset($tad_gphotos_adm)) {
    $tad_gphotos_adm = isset($xoopsUser) && \is_object($xoopsUser) ? $xoopsUser->isAdmin() : false;
}

$interface_menu[_MD_TADGPHOTOS_HOME] = "index.php";
$interface_icon[_MD_TADGPHOTOS_HOME] = "fa-image";

if (Tools::chk_permission('return') or $_SERVER['PHP_SELF'] == '/admin.php') {
    $interface_menu[_MD_TADGPHOTOS_ADD] = "index.php?op=tad_gphotos_form";
    $interface_icon[_MD_TADGPHOTOS_ADD] = "fa-plus";

    $interface_menu[_MD_TADGPHOTOS_ADD_CATE] = "index.php?op=tad_gphotos_cate_form";
    $interface_icon[_MD_TADGPHOTOS_ADD_CATE] = "fa-square-plus";
}
