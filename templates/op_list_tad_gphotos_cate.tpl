<div id="save_msg"></div>
<div class="row">
    <div class="col-sm-3">
        <{$ztree_code}>

        <{if $cate|default:false}>
            <div>
                <h3><{$cate.title}></h3>
                <ul>
                    <li style="line-height:2;"><{$smarty.const._MA_TADGPHOTOS_COUNT}><{$smarty.const._TAD_FOR}><{$total}></li>
                </ul>
            </div>
        <{/if}>

        <div class="text-center d-grid gap-2">
            <a href="main.php?op=tad_gphotos_add_cate_form" class="btn btn-info btn-block"><i class="fa fa-plus" aria-hidden="true"></i> <{$smarty.const._MA_TADGPHOTOS_ADD_CATE}></a>
        </div>
    </div>
    <div class="col-sm-9">
        <{if $cate|default:false}>
            <div class="row">
                <div class="col-sm-4">
                    <h3>
                        <{$cate.title}>
                    </h3>
                </div>
                <div class="col-sm-8 text-right text-end">
                    <div style="margin: 10px 0px;">
                        <{if $now_op!="tad_gphotos_add_cate_form" and $csn}>
                        <span <{if $cate.count > 0 or $cate.sub_cate > 0}>data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MA_TADGPHOTOS_HAVE_SOMETHING|sprintf:$cate.sub_cate:$cate.count}>"<{/if}>>
                                <a href="javascript:delete_tad_gphotos_cate_func(<{$cate.csn}>);" class="btn btn-sm btn-danger <{if $cate.count > 0 or $cate.sub_cate > 0}>disabled<{/if}>"><i class="fa fa-trash-o" aria-hidden="true"></i> <{$smarty.const._TAD_DEL}></a>
                            </span>
                            <a href="main.php?op=tad_gphotos_add_cate_form&csn=<{$csn}>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <{$smarty.const._TAD_EDIT}></a>
                        <{/if}>
                    </div>
                </div>
            </div>

            <{if $cate.description|default:false}>
                <div class="row"">
                    <div class="col-sm-12">
                        <div class="alert alert-success"><{$cate.description}></div>
                    </div>
                </div>
            <{/if}>
        <{/if}>

        <{if $gphotos|default:false}>
            <div id="save_msg"></div>
            <form action="main.php" method="post" role="form">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th nowrap><{$smarty.const._MA_TADGPHOTOS_TITLE}></th>
                        <th nowrap class="c"><{$smarty.const._MD_TADGPHOTOS_NUMBER_OF_PHOTOS}></th>
                        <th nowrap class="c"><{$smarty.const._MD_TADGPHOTOS_CREATE_DATE}></th>
                        <th nowrap class="c"><{$smarty.const._TAD_FUNCTION}></th>
                    </tr>
                    <tbody id="sort">
                        <{foreach from=$gphotos item=album}>
                            <tr id="album_sn_<{$album.album_sn}>">
                                <td class="m">
                                    <a href="<{$xoops_url}>/modules/tad_gphotos/index.php?album_sn=<{$album.album_sn}>"><{$album.album_name}></a>
                                </td>
                                <td class="c"><{$album.photo_num}></td>
                                <td class="c"><{$album.create_date}></td>
                                <td class="c">
                                    <a href="javascript:delete_tad_gphotos_func(<{$album.album_sn}>);" class="btn btn-sm btn-xs btn-danger" id="del<{$album.album_sn}>"><i class="fa fa-trash-o" aria-hidden="true"></i> <{$smarty.const._TAD_DEL}></a>
                                    <a href="<{$xoops_url}>/modules/tad_gphotos/index.php?op=tad_gphotos_form&album_sn=<{$album.album_sn}>" class="btn btn-sm btn-xs btn-info" id="update<{$album.album_sn}>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <{$smarty.const._TAD_EDIT}></a>
                                </td>
                            </tr>
                        <{/foreach}>
                    </tbody>
                </table>
                <{$bar}>
            </form>
            <script type="text/javascript">
                $(document).ready(function(){
                    $('#sort').sortable({ opacity: 0.6, cursor: 'move', update: function() {
                        var order = $(this).sortable('serialize')+'&op=save_sort';
                        $.post('../ajax.php', order, function(theResponse){
                            $('#save_msg').html(theResponse);
                        });
                    }
                    });
                });
            </script>
        <{else}>
            <div class="alert alert-danger text-center">
                <h3><{$smarty.const._MA_TADGPHOTOS_NO_GPHOTOS}></h3>
            </div>
        <{/if}>
    </div>
</div>