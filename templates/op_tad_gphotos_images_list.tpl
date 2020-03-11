<{if $all_tad_gphotos_images}>
    <{if $smarty.session.tad_gphotos_adm or $create_album}>
        <{$delete_tad_gphotos_images_func}>
    <{/if}>

    <div id="tad_gphotos_images_sort">
        <{foreach from=$all_tad_gphotos_images item=data}>
            <div class="polaroid" style="width: <{$config.polaroid_width}>px; height: <{$config.polaroid_height}>px; margin: <{$config.polaroid_margin_y}>px <{$config.polaroid_margin_x}>px;">
                <a href="<{$data.image_link}>" target="_blank">
                    <img src="<{$data.image_url}>" id="tr_<{$data.image_sn}>" class="thumb-img"  style="height: <{$img_height}>px;" alt="<{if $data.image_description}><{$data.image_description}><{else}><{$album_name}><{/if}>" <{if $data.image_description}>title="<{$data.image_description}>"<{/if}>>
                </a>
                <div class="polaroid-container">
                    <p id="gphoto<{$data.image_sn}>"><{$data.image_description}></p>
                </div>
            </div>
        <{/foreach}>
    </div>

    <div style="margin: 30px auto;"><{$bar}></div>
<{else}>
    <div class="jumbotron text-center">
        <{if $smarty.session.tad_gphotos_adm or $create_album}>
            <a href="<{$xoops_url}>/modules/tad_gphotos/index.php?op=tad_gphotos_form" class="btn btn-info"><{$smarty.const._TAD_ADD}></a>
        <{else}>
            <h3><{$smarty.const._TAD_EMPTY}></h3>
        <{/if}>
    </div>
<{/if}>
