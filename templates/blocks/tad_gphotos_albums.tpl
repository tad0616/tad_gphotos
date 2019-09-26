<{$block.css}>
<{if $block.display=='cover'}>
    <{foreach from=$block.content item=data}>
        <div class="polaroid" style="width: <{$block.width}>px; height: <{$block.height}>px; margin: 8px;">
            <a href="index.php?album_sn=<{$data.album_sn}>">
                <img src="<{$data.cover.image_url}>" class="thumb-img" style="height: <{$block.img_height}>px;" alt="<{$data.album_name}>" title="<{$data.album_name}>">
            </a>
            <div class="polaroid-container">
                <p>
                    <{$data.album_name}>
                </p>
            </div>
        </div>
    <{/foreach}>
<{else}>
    <div class="vertical_menu">
        <{foreach from=$block.content item=data}>
            <li>
                <a href="<{$xoops_url}>/modules/tad_gphotos/index.php?album_sn=<{$data.album_sn}>"><{$data.album_name}></a>
            </li>
        <{/foreach}>
    </div>
<{/if}>
<div class="text-right">
    <span class="badge">
        <a href="<{$xoops_url}>/modules/tad_gphotos/index.php">more...</a>
    </span>
</div>