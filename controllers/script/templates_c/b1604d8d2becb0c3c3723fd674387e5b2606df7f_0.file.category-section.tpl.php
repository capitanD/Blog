<?php
/* Smarty version 3.1.30, created on 2017-07-26 23:53:35
  from "/Users/Davide/Desktop/Eitfabis-Blog/templates/category-section.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59790f5fc77f00_55945949',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b1604d8d2becb0c3c3723fd674387e5b2606df7f' => 
    array (
      0 => '/Users/Davide/Desktop/Eitfabis-Blog/templates/category-section.tpl',
      1 => 1501105745,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59790f5fc77f00_55945949 (Smarty_Internal_Template $_smarty_tpl) {
?>

<!-- Category piece -->
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'category');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
?>
    <div class="col-lg-3 col-md-4 col-xs-6">
        <a class="category-box" href="?section=category&name=<?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
" onClick="go_to_articles(this, event)">
            <img class="img-responsive" src="<?php echo $_smarty_tpl->tpl_vars['category']->value['background'];?>
" alt="">
            <span>
                <strong><?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</strong>
                <small><?php echo $_smarty_tpl->tpl_vars['category']->value['description'];?>
</small>
            </span>
        </a>
    </div>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

<?php }
}
