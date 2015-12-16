<?php
namespace Hagane\Model;

class UserManagement {
	private $db;
	private $auth;

	function __construct(&$auth, &$db) {
		$id = $auth->isAuth();
		if (!empty($id)) {
			$data = array('id' => $id);
			$userArray = $db->getRow('SELECT * from Administrador join User where User.id = Administrador.idUser AND User.id = :id', $data);
			$this->db = $db;
			$this->auth = $auth;
		}

	}

	function getPersonas() {
		$users = $this->db->query('SELECT * FROM Persona');

		return $users;
	}
}

?>