<?php

require_once 'BaseController.php';

class PrintInfoController extends BaseController {

    public function printInfo($printID) {
        $printInfo = $this->model->getPrint($printID);
        $frames = $this->model->getAllFrames();
        $sizes = $this->model->getSizeForPrint($printID);
        $template = $this->templateEngine->loadTemplate('print_info.twig');
        $template->display(array(
            'print' => $printInfo,
            'frames' => $frames,
            'sizes' => $sizes
        ));
    }
}