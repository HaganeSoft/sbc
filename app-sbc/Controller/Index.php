<?php
namespace Hagane\Controller;

class Index extends AbstractController{

	function _init() {
		include_once($this->config['appPath'].'Model/PublicModel.php');
		echo $this->db->database_log['error'];
	}

	function index() {
		$this->custom_template = 'sbc';
	}

	function uploadForm() {
		$this->sendJson = true;
		$this->print_template = false;

		$target_path = 'uploads/';

		$timestamp = time();
		$salt = mt_rand(1,500);
		$ext = substr(strrchr($_FILES['file']['name'], '.'), 1);
		$target_path = $target_path . $timestamp . '-' . $salt . '.' . $ext;

		//$target_path = $target_path . basename( $_FILES['file']['name']);
		if(!move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
			$data['message'] = 'error al subir el archivo';
			echo json_encode($data);
			die();
		}
		if (substr($target_path, 0, 1) == '/') {
			$target_path = substr($target_path, 1);
		}

		$this->publicMan = new \Hagane\Model\PublicMod($this->db);
		print_r($_POST);
		$data = array(
			'nombre' => $_POST['nombre'],
			'apellidos' => $_POST['apellidos'],
			'edad' => $_POST['edad'],
			'residencia' => $_POST['residencia'],
			'sexo' => $_POST['sexo'],
			'telefono' => $_POST['telefono'],
			'email' => $_POST['email'],
			'carrera' => $_POST['carrera'],
			'inst_carrera' => $_POST['inst_carrera'],
			'maestria' => (isset($_POST['maestria'])) ? $_POST['maestria'] : '',
			'inst_maestria' => (isset($_POST['inst_maestria'])) ? $_POST['inst_maestria'] : '',
			'ingles' => $_POST['ingles'],
			'otros_idiomas' => $_POST['otros_idiomas'],
			'ultimo_puesto' => (isset($_POST['ultimo_puesto'])) ? $_POST['ultimo_puesto'] : '',
			'empresa' => (isset($_POST['empresa'])) ? $_POST['empresa'] : '',
			'rango_sueldo' => $_POST['rango_sueldo'],
			'area1' => $_POST['area1'],
			'tiempo1' => $_POST['tiempo1'],
			'area2' => $_POST['area2'],
			'tiempo2' => $_POST['tiempo2'],
			'area3' => (isset($_POST['area3'])) ? $_POST['area3'] : '',
			'tiempo3' => (isset($_POST['tiempo3'])) ? $_POST['tiempo3'] : '',
			'file_path' => $target_path
		);
		echo json_encode($this->publicMan->setCV($data));
	}
}

?>