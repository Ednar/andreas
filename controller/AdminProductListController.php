<?php

require_once 'BaseController.php';

class AdminProductListController extends BaseController {
    public function getAllPrints() {
        $prints = $this->model->getAllPrints();
        $template = $this->templateEngine->loadTemplate('admin/admin_print_list.twig');
        $template->display(array(
            'prints' => $prints
        ));
    }
}