<?php
/* Smarty version 3.1.30, created on 2017-08-04 15:28:20
  from "/Users/Davide/Desktop/Eitfabis-Blog/templates/home.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5984767429f9e2_02004252',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8ff960029094de7a9e9a0f5ec447e516905f09aa' => 
    array (
      0 => '/Users/Davide/Desktop/Eitfabis-Blog/templates/home.tpl',
      1 => 1501797477,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5984767429f9e2_02004252 (Smarty_Internal_Template $_smarty_tpl) {
?>

<!-- Main content: Home page that contains the articles list -->
<div class="row" id="articles" <?php if (isset($_smarty_tpl->tpl_vars['home_style']->value)) {?> <?php echo $_smarty_tpl->tpl_vars['home_style']->value;?>
 <?php }?>>
    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['articles']->value, 'article');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['article']->value) {
?>
            <?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['list_of_articles']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

            <hr style="margin-bottom:50px;">
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


        <?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['page_navigation']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

    </div>
</div>
<?php }
}
