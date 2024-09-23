<div id="save_msg"></div>
<div class="row">
    <div class="col-sm-3">
        <{$ztree_code|default:''}>
        <div class="text-center d-grid gap-2">
            <a href="main.php?op=tad_gphotos_add_cate_form" class="btn btn-info btn-block"><i class="fa fa-plus" aria-hidden="true"></i> <{$smarty.const._MA_TADGPHOTOS_ADD_CATE}></a>
        </div>
    </div>
    <div class="col-sm-9">
        <{include file="$xoops_rootpath/modules/tad_gphotos/templates/op_tad_gphotos_cate_form.tpl"}>
    </div>
</div>