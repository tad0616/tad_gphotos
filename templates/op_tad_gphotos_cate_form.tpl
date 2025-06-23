
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
                    <span <{if $cate.count > 0 or $cate.sub_cate|@count > 0}>data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MA_TADGPHOTOS_HAVE_SOMETHING|sprintf:$cate.sub_cate:$cate.count}>"<{/if}>>
                        <a href="javascript:delete_tad_gphotos_cate_func(<{$cate.csn}>);" class="btn btn-sm btn-danger <{if $cate.count > 0 or $cate.sub_cate|@count > 0}>disabled<{/if}>" ><i class="fa fa-trash" aria-hidden="true"></i> <{$smarty.const._TAD_DEL}></a>
                    </span>
                    <a href="main.php?op=tad_gphotos_add_cate_form&csn=<{$csn|default:''}>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> <{$smarty.const._MD_TADGPHOTOS_CATE_FORM}></a>
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
                    <input type="text" name="title" value="<{$title|default:''}>" id="title" class="validate[required] form-control">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group row mb-3">
                <label class="control-label col-form-label">
                    <{$smarty.const._MD_TADGPHOTOS_OF_CSN}>
                </label>
                <div class="">
                    <select name="of_csn" id="of_csn" class="form-control form-select">
                        <option value="">/</option>
                        <{$cate_options|default:''}>
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
            <{$editor|default:''}>
        </div>
    </div>


    <div class="form-group row mb-3">
        <label class="control-label col-form-label">
            <{$smarty.const._MD_TADGPHOTOS_SORT}>
        </label>
        <div class="">
            <{$sort_form|default:''}>
        </div>
    </div>


    <div class="bar">
        <input type="hidden" name="csn" value="<{$csn|default:''}>">
        <input type="hidden" name="sort" value="<{$sort|default:''}>">
        <input type="hidden" name="op" value="<{$next_op|default:''}>">
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-disk" aria-hidden="true"></i> <{$smarty.const._TAD_SAVE}></button>
    </div>

</form>