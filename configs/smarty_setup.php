<?php

define('SMARTY_DIR', $_SERVER['DOCUMENT_ROOT'] . '/' . 'libs/');

// load Smarty library
require_once(SMARTY_DIR . 'Smarty.class.php');


class Blog_Item extends Smarty {

    function __construct(){
        // Class Constructor.
        // These automatically get set with each new instance.

        parent::__construct();

        $this->setTemplateDir('templates/');
        $this->setCompileDir('templates_c/');
        $this->setConfigDir('configs/');
        //$this->setCacheDir('cache/');
        //$this->caching = Smarty::CACHING_LIFETIME_CURRENT;
        $this->assign('app_name', 'Blog');
    }
}

?>
