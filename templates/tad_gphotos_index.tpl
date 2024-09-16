<{$toolbar}>
<{if $now_op|default:false}>
    <{include file="$xoops_rootpath/modules/tad_gphotos/templates/op_`$now_op`.tpl"}>
<{/if}>

<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>