<?php

class ProductListController extends BaseController {

    public function getAllPrints() {
        $pictures = $this->model->getAllPrints();
        $template = $this->templateEngine->loadTemplate('test.twig');
        $template->display(array(
            'pictures' => $pictures
        ));
    }
}