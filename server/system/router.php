<?php

class Router {

    private $uri;

    private $controller;
	
	private $model;

    private $id;

    public function __construct($uri) {
        $this->uri = $uri;
    }

    public function map() {

        if (empty($this->uri[0])) {
            $this->controller = 'index';
			$this->model      = 'default';
            $this->id = null;
        } else {
            $this->controller = $this->uri[0];
			$this->model      = $this->uri[0];
            if (empty($this->uri[1])) {
                $this->id = null;
            } else {
                $this->id = $this->uri[1];
            }
        }
    }

    public function getController() {
        return $this->controller;
    }

	public function getModel() {
        return $this->model;
    }
	
    public function getId() {
        return $this->id;
    }
}

/* End of file Router.php */