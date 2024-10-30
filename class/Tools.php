<?php
namespace XoopsModules\Tad_gphotos;

use XoopsModules\Tadtools\Utility;

/**
 * Class Tools
 */
class Tools
{

    public static function chk_permission($mode = '')
    {
        global $xoopsTpl, $xoopsUser;
        $create_album = Utility::power_chk("tad_gphotos", 1, 0, true, 'tad_gphotos');
        if ($mode == 'return') {
            $uid = $xoopsUser ? $xoopsUser->uid() : '';
            if ($xoopsTpl) {
                $xoopsTpl->assign('now_uid', $uid);
                $xoopsTpl->assign('create_album', $create_album);
            }
            return $create_album;
        }
        if (!$create_album) {
            redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
        }
    }

}
