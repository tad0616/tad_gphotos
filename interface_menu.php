<?php
//判斷是否對該模組有管理權限
if (!isset($_SESSION['tad_gphotos_adm'])) {
    $_SESSION['tad_gphotos_adm'] = ($xoopsUser) ? $xoopsUser->isAdmin() : false;
}

$interface_menu[_MD_TADGPHOTOS_HOME] = "index.php";
$interface_icon[_MD_TADGPHOTOS_HOME] = "fa-chevron-right";

if (chk_permission('return')) {
    $interface_menu[_MD_TADGPHOTOS_ADD] = "index.php?op=tad_gphotos_form";
    $interface_icon[_MD_TADGPHOTOS_ADD] = "fa-plus";
    $interface_menu[_MD_TADGPHOTOS_ADD_CATE] = "index.php?op=tad_gphotos_cate_form";
    $interface_icon[_MD_TADGPHOTOS_ADD_CATE] = "fa-plus";
}

if ($_SESSION['tad_gphotos_adm']) {
    $interface_menu[_TAD_TO_ADMIN] = "admin/main.php";
    $interface_icon[_TAD_TO_ADMIN] = "fa-sign-in";
}
