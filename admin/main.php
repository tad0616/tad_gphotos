<?php
use Xmf\Request;
use XoopsModules\Tadtools\CategoryHelper;
use XoopsModules\Tadtools\SweetAlert;
use XoopsModules\Tadtools\Utility;
use XoopsModules\Tadtools\Ztree;
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = 'tad_gphotos_admin.tpl';
require_once __DIR__ . '/header.php';
require_once dirname(__DIR__) . '/function.php';

/*-----------執行動作判斷區----------*/
$op = Request::getString('op');
$csn = Request::getInt('csn');

switch ($op) {

    //新增資料
    case 'insert_tad_gphotos_cate':
        $csn = insert_tad_gphotos_cate();
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    //更新資料
    case 'update_tad_gphotos_cate':
        update_tad_gphotos_cate($csn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    //刪除資料
    case 'delete_tad_gphotos_cate':
        delete_tad_gphotos_cate($csn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    //刪除資料
    case 'delete_tad_gphotos':
        delete_tad_gphotos($csn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    //輸入表格
    case 'tad_gphotos_add_cate_form':
        list_tad_gphotos_cate_tree($csn);
        tad_gphotos_cate_form($csn);
        break;

    //預設動作
    default:
        list_tad_gphotos_cate_tree($csn);
        list_tad_gphoto($csn);
        $op = 'list_tad_gphotos_cate';
        break;

}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign("now_op", $op);
require_once __DIR__ . '/footer.php';

/*-----------function區--------------*/

//取得tad_gphotos_cate無窮分類列表
function list_tad_gphotos_cate_tree($show_csn = 0)
{
    global $xoopsTpl, $xoopsDB;
    $categoryHelper = new CategoryHelper('tad_gphotos_cate', 'csn', 'of_csn', 'title');
    $path = $categoryHelper->getCategoryPath($show_csn);
    $path_arr = array_keys($path);
    $count = $categoryHelper->getCategoryCount();

    $sql = 'SELECT `csn`, `of_csn`, `title` FROM `' . $xoopsDB->prefix('tad_gphotos_cate') . '` ORDER BY `sort`';
    $result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    $data[] = "{ id:0, pId:0, name:'All', url:'index.php', target:'_self', open:true}";
    while (list($csn, $of_csn, $title) = $xoopsDB->fetchRow($result)) {
        $font_style = $show_csn == $csn ? ", font:{'background-color':'yellow', 'color':'black'}" : '';
        $open = in_array($csn, $path_arr) ? 'true' : 'false';
        $display_counter = empty($count[$csn]) ? '' : " ({$count[$csn]})";
        $data[] = "{ id:{$csn}, pId:{$of_csn}, name:'{$title}{$display_counter}', url:'main.php?csn={$csn}', target:'_self', open:{$open} {$font_style}}";
    }
    $json = implode(',', $data);

    $Ztree = new Ztree('link_tree', $json, 'save_drag.php', 'save_sort.php', 'of_csn', 'csn');
    $ztree_code = $Ztree->render();
    $xoopsTpl->assign('ztree_code', $ztree_code);
}

//秀出所有分類及相簿
function list_tad_gphoto($csn = '')
{
    global $xoopsDB, $xoopsTpl;

    $and_csn = !empty($csn) ? "and `csn`='{$csn}'" : '';
    $sql = 'select * from  ' . $xoopsDB->prefix('tad_gphotos') . " where 1 $and_csn order by `album_sort`";
    //getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    $PageBar = Utility::getPageBar($sql, 10, 10);
    $bar = $PageBar['bar'];
    $sql = $PageBar['sql'];
    $total = $PageBar['total'];
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    $i = 0;
    $gphotos = [];
    $categoryHelper = new CategoryHelper('tad_gphotos_cate', 'csn', 'of_csn', 'title');
    while (false !== ($data = $xoopsDB->fetchArray($result))) {
        $gphotos[$i] = $data;
        $gphotos[$i]['cate'] = $categoryHelper->getCategory($data['csn']);
        $gphotos[$i]['photo_num'] = tad_gphotos_images_num($data['album_sn']);
        $i++;
    }
    $xoopsTpl->assign('gphotos', $gphotos);
    $xoopsTpl->assign('bar', $bar);
    $xoopsTpl->assign('total', $total);
    $cate = '';
    if ($csn) {
        $cate = $categoryHelper->getCategory($csn);
    }
    $xoopsTpl->assign('cate', $cate);
    $xoopsTpl->assign('csn', $csn);

    Utility::get_jquery(true);

    $SweetAlert = new SweetAlert();
    $SweetAlert->render('delete_tad_gphotos_cate_func', 'main.php?op=delete_tad_gphotos_cate&csn=', 'csn');

    //刪除相簿
    $SweetAlert2 = new SweetAlert();
    $SweetAlert2->render('delete_tad_gphotos_func', 'main.php?op=delete_tad_gphotos&csn=', 'csn');
}

function delete_tad_gphotos_cate($csn)
{
    global $xoopsDB;
    $categoryHelper = new CategoryHelper('tad_gphotos_cate', 'csn', 'of_csn', 'title');
    $album = $categoryHelper->getCategoryCount();
    if ($album[$csn]) {
        redirect_header($_SERVER['PHP_SELF'], 3, sprintf(_MA_TADGPHOTOS_HAVE_ALBUM, $album[$csn]));
    }

    $sub_cate = $categoryHelper->getSubCategories($csn);
    if ($sub_cate) {
        redirect_header($_SERVER['PHP_SELF'], 3, sprintf(_MA_TADGPHOTOS_HAVE_SUB_CATE, sizeof($sub_cate)));
    }

    $sql = 'DELETE FROM `' . $xoopsDB->prefix('tad_gphotos_cate') . '` WHERE `csn`=?';
    Utility::query($sql, 'i', [$csn]) or Utility::web_error($sql, __FILE__, __LINE__);

}
