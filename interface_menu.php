<?php
//判斷是否對該模組有管理權限
if (!isset($_SESSION['tad_gphotos_adm'])) {
    $_SESSION['tad_gphotos_adm'] = ($xoopsUser) ? $xoopsUser->isAdmin() : false;
}

$interface_menu[_TAD_TO_MOD]="index.php";
$interface_icon[_TAD_TO_MOD]="fa-chevron-right";


if ($_SESSION['tad_gphotos_adm']) {
    $interface_menu[_TAD_TO_ADMIN] = "admin/main.php";
    $interface_icon[_TAD_TO_ADMIN] = "fa-sign-in";
}
