<?php
/**
 * Tad Gphotos module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright  The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license    http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package    Tad Gphotos
 * @since      2.5
 * @author     tad
 * @version    $Id $
 **/

include_once "../../mainfile.php";
include_once "function.php";
//判斷是否對該模組有管理權限
if (!isset($_SESSION['tad_gphotos_adm'])) {
    $_SESSION['tad_gphotos_adm'] = ($xoopsUser) ? $xoopsUser->isAdmin() : false;
}

$interface_menu[_MD_TADGPHOTOS_HOME] = "index.php";
$interface_icon[_MD_TADGPHOTOS_HOME] = "fa-picture-o";

if (chk_permission('return')) {
    $interface_menu[_MD_TADGPHOTOS_ADD] = "index.php?op=tad_gphotos_form";
    $interface_icon[_MD_TADGPHOTOS_ADD] = "fa-plus";
    $interface_menu[_MD_TADGPHOTOS_ADD_CATE] = "index.php?op=tad_gphotos_cate_form";
    $interface_icon[_MD_TADGPHOTOS_ADD_CATE] = "fa-plus-square-o";
}
