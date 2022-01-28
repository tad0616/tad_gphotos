<style type="text/css">
    .GP_div {
        height: <{$block.height}>px;
        margin: 0 auto;
        overflow: hidden;
        white-space: nowrap;
    }

    .GP_div img {
        height: <{$block.height}>px;
        margin: auto 0px
    }

    #GP_begin<{$block.album_sn}>, #GP_end<{$block.album_sn}>, #GP_begin<{$block.album_sn}> ul, #GP_end<{$block.album_sn}> ul, #GP_begin<{$block.album_sn}> ul li, #GP_end<{$block.album_sn}> ul li {
        display: inline;
    }
</style>
<script language="javascript">
    $(function() {
        var width=$('#google_photo_scrolldiv<{$block.album_sn}>').width();
        $('#GP_div<{$block.album_sn}>').css('width',width+'px');
    });

    function GP_ScrollImgLeft<{$block.album_sn}>(){
        var speed = '<{$block.speed}>';
        var GP_begin = document.getElementById("GP_begin<{$block.album_sn}>");
        var GP_end = document.getElementById("GP_end<{$block.album_sn}>");
        var GP_div = document.getElementById("GP_div<{$block.album_sn}>");
        GP_end.innerHTML=GP_begin.innerHTML
        function Marquee(){
            if(GP_end.offsetWidth-GP_div.scrollLeft<=0)
            GP_div.scrollLeft-=GP_begin.offsetWidth
            else
            GP_div.scrollLeft++
        }
        var MyMar=setInterval(Marquee,speed)
        GP_div.onmouseover=function() {clearInterval(MyMar)}
        GP_div.onmouseout=function() {MyMar=setInterval(Marquee,speed)}
    }
</script>

<div id="google_photo_scrolldiv<{$block.album_sn}>">
    <div id="GP_div<{$block.album_sn}>" class="GP_div">
        <div id="GP_begin<{$block.album_sn}>">
            <ul style="list-style: none;">
                <{foreach from=$block.content item=data}>
                    <li>
                        <a href="<{$data.image_link}>" data-photo="<{$data.image_link}>" data-sn="<{$data.image_sn}>" target="_blank" style=" color: transparent;">
                            <img src="<{$data.image_url}>" alt="img_<{$data.image_sn}>"><span class="sr-only visually-hidden"><{if $data.image_description}><{$data.image_description}><{else}><{$block.album_name}><{/if}></span>
                        </a>
                    </li>
                <{/foreach}>
            </ul>
        </div>
        <div id="GP_end<{$block.album_sn}>"></div>
    </div>
</div>
<!--gundong-->
<script type="text/javascript">GP_ScrollImgLeft<{$block.album_sn}>();</script>
<div class="text-right text-end">
    <span class="badge">
        <a href="<{$xoops_url}>/modules/tad_gphotos/index.php?album_sn=<{$block.album_sn}>">more...</a>
    </span>
</div>