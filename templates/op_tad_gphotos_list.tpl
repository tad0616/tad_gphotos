<{$breadcrumb|default:''}>
<h2 class="sr-only visually-hidden"><{$smarty.const._MD_TADGPHOTOS_HOME}></h2>

<{foreach from=$all_cate item=cate}>
    <div id="csn_<{$cate.csn}>" class="polaroid-cate" style="width: <{$config.polaroid_width}>px; height: <{$config.polaroid_height}>px; margin: <{$config.polaroid_margin_y}>px <{$config.polaroid_margin_x}>px;" data-toggle="tooltip">
        <a href="index.php?csn=<{$cate.csn}>" style="color: transparent; ">
            <{if $cate.albums_num==0}>
                    <img src="https://fakeimg.pl/<{$config.polaroid_width}>x<{$img_height|default:''}>/?retina=1&text=<{$smarty.const._MD_TADGPHOTOS_NO_ALBUM_YET}>&font=noto" style="width: <{$config.polaroid_width}>px; height: <{$img_height|default:''}>px;" class="thumb-cate-img" alt="no"><span class="sr-only visually-hidden"><{$smarty.const._MD_TADGPHOTOS_NO_ALBUM_YET}></span>
            <{elseif $cate.albums_num==1}>
                <{if $cate.albums.1.image_url}>
                    <img src="<{$cate.albums.1.image_url}>" class="thumb-cate-img" style="margin:4px; width: <{$config.polaroid_width-8}>px; height: <{$img_height-8}>px; " alt="<{$cate.albums.1.image_sn}>"><span class="sr-only visually-hidden"><{$cate.title}></span>
                <{/if}>
            <{elseif $cate.albums_num==2}>
                <{if $cate.albums.1.image_url}>
                    <img src="<{$cate.albums.1.image_url}>" class="thumb-cate-img" style="margin:4px 4px 3px 4px; width: <{$config.polaroid_width-8}>px; height: <{$img_height/2-6}>px; " alt="<{$cate.albums.1.image_sn}>"><span class="sr-only visually-hidden"><{$cate.title}></span>
                <{/if}>
                <{if $cate.albums.2.image_url}>
                    <img src="<{$cate.albums.2.image_url}>" class="thumb-cate-img" style="margin:0px 4px 3px 4px; width: <{$config.polaroid_width-8}>px; height: <{$img_height/2-6}>px;" alt="<{$cate.albums.2.image_sn}>"><span class="sr-only visually-hidden"><{$cate.title}></span><br>
                <{/if}>
            <{elseif $cate.albums_num==3}>
                <{if $cate.albums.1.image_url}>
                    <img src="<{$cate.albums.1.image_url}>" class="thumb-cate-img" style="margin:4px 0px 3px 4px; width: <{$config.polaroid_width/2-6}>px; height: <{$img_height/2-6}>px; " alt="<{$cate.albums.1.image_sn}>"><span class="sr-only visually-hidden"><{$cate.title}></span>
                <{/if}>
                <{if $cate.albums.2.image_url}>
                    <img src="<{$cate.albums.2.image_url}>" class="thumb-cate-img" style="margin:4px 3px 3px 0px; width: <{$config.polaroid_width/2-6}>px; height: <{$img_height/2-6}>px;" alt="<{$cate.albums.2.image_sn}>"><span class="sr-only visually-hidden"><{$cate.title}></span><br>
                <{/if}>
                <{if $cate.albums.3.image_url}>
                    <img src="<{$cate.albums.3.image_url}>" class="thumb-cate-img" style="margin:0px 4px 3px 4px; width: <{$config.polaroid_width-8}>px; height: <{$img_height/2-6}>px;" alt="<{$cate.albums.3.image_sn}>"><span class="sr-only visually-hidden"><{$cate.title}></span>
                <{/if}>
            <{elseif $cate.albums_num>=4}>
                <{if $cate.albums.1.image_url}>
                    <img src="<{$cate.albums.1.image_url}>" class="thumb-cate-img" style="margin:4px 0px 3px 4px; width: <{$config.polaroid_width/2-7}>px; height: <{$img_height/2-7}>px; " alt="<{$cate.albums.1.image_sn}>"><span class="sr-only visually-hidden"><{$cate.title}></span>
                <{/if}>
                <{if $cate.albums.2.image_url}>
                    <img src="<{$cate.albums.2.image_url}>" class="thumb-cate-img" style="margin:4px 3px 3px 0px; width: <{$config.polaroid_width/2-7}>px; height: <{$img_height/2-7}>px;" alt="<{$cate.albums.2.image_sn}>"><span class="sr-only visually-hidden"><{$cate.title}></span><br>
                <{/if}>
                <{if $cate.albums.3.image_url}>
                    <img src="<{$cate.albums.3.image_url}>" class="thumb-cate-img" style="margin:0px 0px 3px 4px; width: <{$config.polaroid_width/2-7}>px; height: <{$img_height/2-7}>px; " alt="<{$cate.albums.3.image_sn}>"><span class="sr-only visually-hidden"><{$cate.title}></span>
                <{/if}>
                <{if $cate.albums.4.image_url}>
                    <img src="<{$cate.albums.4.image_url}>" class="thumb-cate-img" style="margin:0px 3px 3px 0px; width: <{$config.polaroid_width/2-7}>px; height: <{$img_height/2-7}>px; " alt="<{$cate.albums.4.image_sn}>"><span class="sr-only visually-hidden"><{$cate.title}></span>
                <{/if}>
            <{/if}>
        </a>
        <div class="polaroid-container">
            <div>
                <a href="index.php?csn=<{$cate.csn}>"><{$cate.title}></a>
            </div>
        </div>
    </div>
<{/foreach}>



<{if $all_tad_gphotos }>
    <{if $smarty.session.tad_gphotos_adm or $create_album}>
        <{$delete_tad_gphotos_func|default:''}>
    <{/if}>

    <div id="tad_gphotos_save_msg"></div>
    <div id="sort">
        <{foreach from=$all_tad_gphotos item=data}>
            <div id="album_sn_<{$data.album_sn}>" class="polaroid" style="width: <{$config.polaroid_width}>px; height: <{$config.polaroid_height}>px; margin: <{$config.polaroid_margin_y}>px <{$config.polaroid_margin_x}>px;">
                <a href="index.php?album_sn=<{$data.album_sn}>">
                    <img src="<{$data.cover.image_url|default:'https://fakeimg.pl/220x190/?retina=1&text=Empty&font=noto'}>" id="tr_<{$data.album_sn}>" class="thumb-img" style="height: <{$img_height|default:''}>px;" alt="<{$data.album_sn}>"><span class="sr-only visually-hidden"><{$data.album_name}></span>
                </a>
                <div class="polaroid-container">
                    <p>
                        <{$data.album_name}>
                    </p>
                </div>
            </div>
        <{/foreach}>
    </div>

    <{if $smarty.session.tad_gphotos_adm or $create_album}>
        <div class="text-right text-end">
            <{if $smarty.get.csn|default:false}>
                <a href="<{$xoops_url}>/modules/tad_gphotos/admin/main.php?op=tad_gphotos_add_cate_form&csn=<{$smarty.get.csn|intval}>" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <{$smarty.const._MD_TADGPHOTOS_CATE_FORM}></a>
            <{/if}>
            <a href="<{$xoops_url}>/modules/tad_gphotos/index.php?op=tad_gphotos_form&csn=<{$smarty.get.csn|intval}>" class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i> <{$smarty.const._MD_TADGPHOTOS_ADD}></a>
        </div>
    <{/if}>

    <{$bar|default:''}>
<{else}>
    <div class="text-right text-end">
        <a href="<{$xoops_url}>/modules/tad_gphotos/index.php?op=tad_gphotos_form&csn=<{$smarty.get.csn|intval}>" class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i> <{$smarty.const._MD_TADGPHOTOS_ADD}></a>
    </div>
<{/if}>

<{if $create_album|default:false}>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#sort').sortable({ opacity: 0.6, cursor: 'move', update: function() {
                var order = $(this).sortable('serialize')+'&op=save_sort';
                $.post('ajax.php', order, function(theResponse){
                    console.log(theResponse);
                    $('#tad_gphotos_save_msg').html(theResponse);
                });
            }
            });
        });
    </script>
<{/if}>