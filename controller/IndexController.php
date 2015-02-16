<?php

require_once 'BaseController.php';

class IndexController extends BaseController {

    public function showStart() {
        $template = $this->templateEngine->loadTemplate('start.twig');
        $template->display(array());
    }

    /**
     * Unsets and destroys the session.
     */
    public function nuke() {
        // TODO remove this function for production
        session_unset();
        session_destroy();
    }
}