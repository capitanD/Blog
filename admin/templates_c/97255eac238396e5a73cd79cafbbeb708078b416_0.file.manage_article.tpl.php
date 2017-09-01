<?php
/* Smarty version 3.1.30, created on 2017-08-08 10:23:18
  from "/Users/Davide/Desktop/Eitfabis-Blog/admin/templates/manage_article.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_598974f6354660_56104026',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '97255eac238396e5a73cd79cafbbeb708078b416' => 
    array (
      0 => '/Users/Davide/Desktop/Eitfabis-Blog/admin/templates/manage_article.tpl',
      1 => 1502180570,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_598974f6354660_56104026 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- Article management -->
<div class="row">
    <div class="col-md-12">

        <!-- Article Panel -->
        <div class="x_panel" >
            <div class="x_title">
                <h2>Manage dataTable<small>List of articles</small> </h2>
                <div class="clearfix"></div>
            </div>
            <div id="table_container" class="x_content">
                <div class="table-responsive">
                    <?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['tables']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <span style="padding-left:5px; padding-bottom:5px;">
                        <u>NOTE 1</u>:
                        The undo button is disable in this section.
                    </span></br>
                    <span style="padding-left:5px; padding-bottom:5px;">
                        <u>NOTE 2</u>:
                        Deleting an article, will be deleted all linking with category and tags that cannot be restored with the undo operation.
                    </span>
                </div>
                <div class="col-md-12">
                    <hr class="subscribers-footer-line">
                    <button id="delete_selected" class="btn btn-sm btn-default" type="button" onClick="delete_selected(event)"><i class="fa fa-trash"></i> Delete</button>
                    <button id="show_comments" class="btn btn-sm btn-primary" type="button" onClick="show_comments()"><i class="fa fa-comments-o"></i> Show Comments</button>
                    <button id="save" class="btn btn-sm btn-success pull-right" type="button" onClick="save_changes(event)"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
        <!-- /Article Panel -->

        <!-- Comment Panel -->
        <div class="x_panel" >
            <div class="x_title">
                <h2>Manage Comments<small>List of comments of an article</small> </h2>
                <div class="clearfix"></div>
            </div>

            <div id="table_basic_container" class="x_content">
                <div id="comments_table" class="table-responsive">
                    <!-- Comments -->
                </div>
            </div>

            <div id="no_comments" class="no-comments-present active-elem">
                <p> Select an article and view its comments </p>
            </div>

            <input id="membership_article" type="hidden" value="0"/>

            <div class="row">
                <div class="col-md-12">
                    <hr class="subscribers-footer-line">
                    <button id="back_table" class="btn btn-sm btn-success" type="button" onClick="remove_table()"><i class="fa fa-arrow-left"></i> Back </button>
                    <button id="delete_all" class="btn btn-sm btn-default" type="button" onClick="delete_all()"><i class="fa fa-trash"></i> Delete All </button>
                </div>
            </div>
        </div>
        <!-- /Comment Panel -->

    </div>
</div>
<?php }
}
