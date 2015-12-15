<?php
namespace Hagane\Controller;

class Index extends AbstractController{

	function _init() {
	}

	function index() {
		$this->custom_template = 'sbc';
	}
}

?>