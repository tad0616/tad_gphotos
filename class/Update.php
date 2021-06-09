<?php
namespace XoopsModules\Tad_gphotos;

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

/**
 * Class Update
 */
class Update
{

    //data_center 加入 sort
    public static function chk_dc_sort()
    {
        global $xoopsDB;
        $sql = 'select count(`sort`) from ' . $xoopsDB->prefix('tad_gphotos_data_center');
        $result = $xoopsDB->query($sql);
        if (empty($result)) {
            return true;
        }

        return false;
    }

    public static function go_dc_sort()
    {
        global $xoopsDB;
        $sql = 'ALTER TABLE ' . $xoopsDB->prefix('tad_gphotos_data_center') . " ADD `sort` mediumint(9) unsigned COMMENT '顯示順序' after `col_id`";
        $xoopsDB->queryF($sql) or redirect_header(XOOPS_URL . '/modules/tad_gphotos/admin/index.php', 30, $xoopsDB->error());
    }

    public static function chk_1()
    {
        global $xoopsDB;
        $sql = 'SELECT count(*) FROM ' . $xoopsDB->prefix('tad_gphotos_cate');
        $result = $xoopsDB->query($sql);
        if (empty($result)) {
            return true;
        }

        return false;
    }

    public static function go_1()
    {
        global $xoopsDB;
        $sql = 'CREATE TABLE `' . $xoopsDB->prefix('tad_gphotos_cate') . "` (
            `csn` smallint(5) unsigned NOT NULL  auto_increment,
            `of_csn` smallint(5) unsigned NOT NULL default 0 ,
            `sort` smallint(5) unsigned NOT NULL default 0 ,
            `title` varchar(255) NOT NULL default '' ,
            `description` text NOT NULL ,
            PRIMARY KEY  (`csn`)
        ) ENGINE=MyISAM";
        $xoopsDB->queryF($sql);
    }

    public static function chk_2()
    {
        global $xoopsDB;
        $sql = 'SELECT count(csn) FROM ' . $xoopsDB->prefix('tad_gphotos');
        $result = $xoopsDB->query($sql);
        if (empty($result)) {
            return true;
        }

        return false;
    }

    public static function go_2()
    {
        global $xoopsDB;
        $sql = 'ALTER TABLE ' . $xoopsDB->prefix('tad_gphotos') . ' ADD `csn` smallint(5) unsigned NOT NULL default 0';
        $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    }

}
