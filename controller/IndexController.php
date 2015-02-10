<?php

require_once 'BaseController.php';

class IndexController extends BaseController {

    public function showStart() {
        $template = $this->templateEngine->loadTemplate('start.twig');
        $template->display(array());
    }

    public function nuke() {
        session_unset();
        session_destroy();
    }
}