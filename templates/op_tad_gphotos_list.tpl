<{if $all_tad_gphotos}>
    <{if $smarty.session.tad_gphotos_adm}>
        <{$delete_tad_gphotos_func}>
    <{/if}>

    <div id="tad_gphotos_save_msg"></div>
    <div id="sort">
        <{foreach from=$all_tad_gphotos item=data}>
            <div id="album_sn_<{$data.album_sn}>" class="polaroid" style="width: <{$config.polaroid_width}>px; height: <{$config.polaroid_height}>px; margin: <{$config.polaroid_margin_y}>px <{$config.polaroid_margin_x}>px;">
                <a href="index.php?album_sn=<{$data.album_sn}>">
                    <img src="<{$data.cover.image_url}>" id="tr_<{$data.album_sn}>" class="thumb-img" style="height: <{$img_height}>px;" alt="<{$data.album_name}>">
                </a>
                <div class="polaroid-container">
                    <p>
                        <{$data.album_name}>
                    </p>
                </div>
            </div>
        <{/foreach}>
    </div>

    <{if $smarty.session.tad_gphotos_adm}>
        <div class="text-right">
            <a href="<{$xoops_url}>/modules/tad_gphotos/index.php?op=tad_gphotos_form" class="btn btn-info"><{$smarty.const._TAD_ADD}></a>
        </div>
    <{/if}>

    <{$bar}>
<{else}>
    <div class="jumbotron text-center">
        <{if $smarty.session.tad_gphotos_adm}>
            <a href="<{$xoops_url}>/modules/tad_gphotos/index.php?op=tad_gphotos_form" class="btn btn-info"><{$smarty.const._TAD_ADD}></a>
        <{else}>
            <h3><{$smarty.const._TAD_EMPTY}></h3>
        <{/if}>
    </div>
<{/if}>

<{if $create_album}>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#sort').sortable({ opacity: 0.6, cursor: 'move', update: function() {
                var order = $(this).sortable('serialize')+'&op=save_sort';
                console.log(order);
                $.post('ajax.php', order, function(theResponse){
                    console.log(theResponse);
                    $('#tad_gphotos_save_msg').html(theResponse);
                });
            }
            });
        });
    </script>
<{/if}>