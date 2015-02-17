<?php

require_once 'BaseController.php';

/**
 * Class IndexController
 */
class IndexController extends BaseController {

    /**
     * Renders the default template
     */
    public function showStart() {
        $template = $this->templateEngine->loadTemplate('start.twig');
        $template->display(array());
    }

    /**
     * Unset and destroy the session.
     */
    public function nuke() {
        // TODO remove this function for production
        session_unset();
        session_destroy();
        $template = $this->templateEngine->loadTemplate('nuke.twig');
        $template->display(array());
    }
}