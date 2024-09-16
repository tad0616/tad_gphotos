<{$block.css}>
<div id="tad_gphotos_images_sort">
    <{foreach from=$block.content item=data}>
        <div class="polaroid" style="width: <{$block.width}>px; height: <{$block.height}>px; margin: 8px;">
            <a href="<{$data.image_link}>" target="_blank" style="color: transparent;">
                <img src="<{$data.image_url}>" id="img_<{$data.image_sn}>" class="thumb-img" style="height: <{$block.height}>px;" alt="img_<{$data.image_sn}>"><span class="sr-only visually-hidden"><{if $data.image_description|default:false}><{$data.image_description}><{else}><{$album_name}><{/if}></span>
            </a>
        </div>
    <{/foreach}>
</div>
<div class="text-right text-end">
    <a href="<{$xoops_url}>/modules/tad_gphotos/index.php?album_sn=<{$block.album_sn}>">
        <span class="badge badge-info">more...</span>
    </a>
</div>