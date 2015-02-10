<?php

class Route {

    private $_uri = array();

    //Interna URLer att leta efter
    public function add($uri) {
        $this->_uri[] = $uri;
    }

    public function submit() {
        $_REQUEST['uri'];
    }

}