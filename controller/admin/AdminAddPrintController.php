<?php

require_once 'controller/BaseController.php';

class AdminAddPrintController extends BaseController {

    public function addPrint() {
        $template = $this->templateEngine->loadTemplate('admin/admin_add_print.twig');
        $template->display(array());
    }

}
