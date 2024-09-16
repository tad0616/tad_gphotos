
<{if $csn!=""}>
    <div class="row">
        <div class="col-sm-4">
            <h3>
                <{$cate.title}>
            </h3>
        </div>
        <div class="col-sm-8 text-right text-end">
            <div style="margin-top: 10px;">
                <{if $now_op!="tad_gphotos_add_cate_form" and $csn}>
                    <span <{if $cate.count > 0 or $cate.sub_cate > 0}>data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MA_TADGPHOTOS_HAVE_SOMETHING|sprintf:$cate.sub_cate:$cate.count}>"<{/if}>>
                        <a href="javascript:delete_tad_gphotos_cate_func(<{$cate.csn}>);" class="btn btn-sm btn-danger <{if $cate.count > 0 or $cate.sub_cate > 0}>disabled<{/if}>" ><i class="fa fa-trash-o" aria-hidden="true"></i> <{$smarty.const._TAD_DEL}></a>
                    </span>
                    <a href="main.php?op=tad_gphotos_add_cate_form&csn=<{$csn}>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <{$smarty.const._MD_TADGPHOTOS_CATE_FORM}></a>
                <{/if}>
            </div>
        </div>
    </div>

    <{if $cate.description|default:false}>
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-success"><{$cate.description}></div>
            </div>
        </div>
    <{/if}>
<{/if}>

<h3><{$smarty.const._MD_TADGPHOTOS_CATE_FORM}></h3>

<form action="<{$smarty.server.PHP_SELF}>" method="post" id="myForm" enctype="multipart/form-data" role="form">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group row mb-3">
                <label class="control-label col-form-label">
                    <{$smarty.const._MD_TADGPHOTOS_CATE_TITLE}>
                </label>
                <div class="">
                    <input type="text" name="title" value="<{$title}>" id="title" class="validate[required] form-control">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group row mb-3">
                <label class="control-label col-form-label">
                    <{$smarty.const._MD_TADGPHOTOS_OF_CSN}>
                </label>
                <div class="">
                    <select name="of_csn" id="of_csn" class="form-control">
                        <option value="">/</option>
                        <{$cate_options}>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row mb-3">
        <label class="control-label col-form-label">
            <{$smarty.const._MD_TADGPHOTOS_CATE_DESCRIPTION}>
        </label>
        <div class="">
            <{$editor}>
        </div>
    </div>


    <div class="form-group row mb-3">
        <label class="control-label col-form-label">
            <{$smarty.const._MD_TADGPHOTOS_SORT}>
        </label>
        <div class="">
            <{$sort_form}>
        </div>
    </div>


    <div class="bar">
        <input type="hidden" name="csn" value="<{$csn}>">
        <input type="hidden" name="sort" value="<{$sort}>">
        <input type="hidden" name="op" value="<{$next_op}>">
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> <{$smarty.const._TAD_SAVE}></button>
    </div>

</form>