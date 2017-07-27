<?php
/* Smarty version 3.1.30, created on 2017-07-27 16:43:55
  from "/Users/Davide/Desktop/Eitfabis-Blog/admin/templates/categories.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5979fc2b20d1d7_16043304',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c865f3de6de778b071fad1d7aa41a276866e1b15' => 
    array (
      0 => '/Users/Davide/Desktop/Eitfabis-Blog/admin/templates/categories.tpl',
      1 => 1501166586,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5979fc2b20d1d7_16043304 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- Categories management -->
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Add new category<small>Set background, name and brief description</small></h2>
                <?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?><h2 id="error_field" class="pull-right"><small class="error-field"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</small></h2><?php }?>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <form id="addCategory-form" enctype="multipart/form-data" action="controllers/category_service.php" method="POST">
                    <div class="row">
                        <!-- Background -->
                        <div class="col-md-5">
                            <div class="panel-body">
                                <div class="x_title">
                                    <h4>Background</h4>
                                </div>
                                <button id="background_category" class="btn btn-sm btn-default" type="button" ><i class="fa fa-picture-o"></i>&nbsp Select</button>
                                <input id="set_category_bg" class="set-category-bg" maxlength="128" value="" required="Mandatory field"> </input>
                                <input id="bg_file" name="bg_file" type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" style="display: none;"/>
                                <img id="bg_fake" src="" style="display:none;">
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <!-- Name -->
                        <div class="col-md-6">
                            <div class="panel-body">
                                <div class="x_title">
                                    <h4>Name</h4>
                                </div>
                                <input id="set_category_name" class="set-article-title" name="setCategoryName" maxlength="128" required="Mandatory field"></input>
                            </div>
                        </div>
                        <!-- Description -->
                        <div class="col-md-6">
                            <div class="panel-body">
                                <div class="x_title">
                                    <h4>Description</h4>
                                </div>
                                <textarea id="set_category_description" name="setCategoryDescription" class="set-article-subtitle" rows="4" maxlength="500" required="Mandatory field"> </textarea>
                            </div>
                        </div>

                        <!-- Add button -->
                        <div class="row">
                            <div class="col-md-12">
                                <hr class="blog-footer-line">
                                <div class="panel-body">
                                    <button id="add-new-cateogry" name="addNewCategory" class="btn btn-sm btn-success pull-right" type="submit" onClick="add_newCategory(event)"><i class="fa fa-plus"></i> Add New</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="x_panel">
            <div class="x_title">
                <h2>Manage<small>List of categories</small> </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table">
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'category');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
?>
                            <tr>
                                <td class="box-category">
                                    <input id="category_name" class="box-category-name" value="<?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
" maxlength="32" readonly></input>
                                </td>
                                <td class="box-category">
                                    <input id="category_description" class="box-category-description" maxlength="128" value="<?php echo $_smarty_tpl->tpl_vars['category']->value['description'];?>
" readonly/>
                                </td>
                                <td class="box-category">
                                    <div class="pull-right" style="margin-top:5px;">
                                        <button id="edit_category" class="btn btn-sm btn-success" onClick="edit_category(<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
)"><i class="fa fa-pencil"></i> Edit</button>
                                        <button id="delete_category" class="btn btn-sm btn-default" onClick="delete_category(<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
)"><i class="fa fa-trash"></i> Delete</button>
                                    </div>
                                </td>
                            </tr>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php }
}
