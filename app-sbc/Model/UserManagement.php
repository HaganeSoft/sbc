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

	function getUsers() {
		$users = $this->db->query('SELECT u.user, u.user_type FROM User as u');

		return $users;
	}

	function setResponsable($data = array()) {
		$lastid = $this->db->insert('INSERT INTO User SET user=:user, password=:password, user_type=:user_type ', $data);

		$data['idUser'] = $lastid;
		$this->db->insert('INSERT INTO Responsable SET nombre=:nombre, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, idCliente=:idCliente, idUser=:idUser ', $data);
	}

}

?>