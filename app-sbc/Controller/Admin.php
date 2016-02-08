<?php
namespace Hagane\Controller;

class Admin extends AbstractController{

	function _init() {
		if (!$this->auth->isAuth()) {
			header("Location:" . $this->config['document_root'] . "User");
			die();
		}
		include_once($this->config['appPath'].'Model/UserManagement.php');
		echo $this->db->database_log['error'];
	}

	function index() {
	}

	function personaDialog() {
		$this->print_template = false;
	}

	function ajaxGetPersonas() {
		$this->sendJson = true;
		$this->print_template = false;
		$this->userManager = new \Hagane\Model\UserManagement($this->auth, $this->db);
		echo json_encode($this->userManager->getPersonas());
	}

	function ajaxGetPersonasAreas() {
		$this->sendJson = true;
		$this->print_template = false;
		$request = json_decode(file_get_contents("php://input"));

		$this->userManager = new \Hagane\Model\UserManagement($this->auth, $this->db);
		$data = array(
			'area' => $request->area1
			);
		echo json_encode($this->userManager->getPersonasAreas($data));
	}
}

?>
