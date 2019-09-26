<{if $smarty.session.tad_gphotos_adm}>
    <{$delete_tad_gphotos_func}>
<{/if}>
<h2>
    <div class="pull-right">
        <{if $smarty.session.tad_gphotos_adm}>
            <a href="javascript:delete_tad_gphotos_func(<{$album_sn}>);" class="btn btn-danger"><{$smarty.const._TAD_DEL}></a>
            <a href="<{$xoops_url}>/modules/tad_gphotos/index.php?op=tad_gphotos_form&album_sn=<{$album_sn}>" class="btn btn-warning"><{$smarty.const._TAD_EDIT}></a>
            <a href="<{$xoops_url}>/modules/tad_gphotos/index.php?op=tad_gphotos_form" class="btn btn-primary"><{$smarty.const._TAD_ADD}></a>
        <{/if}>
    </div>

    <a href="<{$album_url}>" target="_blank"><{$album_name}></a><small style="color:gray;"><{$smarty.const._MA_TADGPHOTOS_IMAGE_TOTAL|sprintf:$total}></small>
</h2>


<{includeq file="$xoops_rootpath/modules/$xoops_dirname/templates/op_tad_gphotos_images_list.tpl"}>
