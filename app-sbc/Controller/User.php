<?php
namespace Hagane\Controller;

class User extends AbstractController{
	function _init() {
		echo $this->db->database_log['error'];
	}

	function index() {
	}

	function auth() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$this->auth->authenticate($_POST['user'], $_POST['password']);
			if ($this->auth->isAuth()) {
				header("Location:" . $this->config['document_root'] . "Admin/index");
				die();
			}
		}
	}

	function logout() {
		$this->auth->logout();
		header("Location:" . $this->config['document_root']);
		die();
	}
}

?>
