<{if $smarty.session.tad_gphotos_adm or ($create_album and $now_uid==$uid)}>
    <{$delete_tad_gphotos_func}>
<{/if}>
<h2>
    <a href="<{$album_url}>" target="_blank"><{$album_name}></a><small style="color:gray;"><{$smarty.const._MA_TADGPHOTOS_IMAGE_TOTAL|sprintf:$total}></small>
</h2>
<div>
    <{if $smarty.session.tad_gphotos_adm or $create_album}>
        <{if $smarty.session.tad_gphotos_adm or ($create_album and $now_uid==$uid)}>
            <a href="javascript:delete_tad_gphotos_func(<{$album_sn}>);" class="btn btn-danger"><{$smarty.const._TAD_DEL}></a>
            <a href="<{$xoops_url}>/modules/tad_gphotos/index.php?op=tad_gphotos_form&album_sn=<{$album_sn}>" class="btn btn-warning"><{$smarty.const._TAD_EDIT}></a>
            <a href="<{$xoops_url}>/modules/tad_gphotos/index.php?op=re_get_tad_gphotos&album_sn=<{$album_sn}>" class="btn btn-info"><{$smarty.const._MD_TADGPHOTOS_RE_GET}></a>

        <{/if}>
        <a href="<{$xoops_url}>/modules/tad_gphotos/index.php?op=tad_gphotos_form" class="btn btn-primary"><{$smarty.const._MD_TADGPHOTOS_ADD}></a>
    <{/if}>
</div>
<div class="clearfix"></div>

<{includeq file="$xoops_rootpath/modules/$xoops_dirname/templates/op_tad_gphotos_images_list.tpl"}>
