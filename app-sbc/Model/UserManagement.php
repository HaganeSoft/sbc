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

	function getAdminUsers() {
		$users = $this->db->query('SELECT u.user, u.user_type, a.* FROM User as u JOIN Administrador as a WHERE a.idUser = u.id');

		return $users;
	}

	function getClientUsers() {
		$users = $this->db->query('SELECT u.user, u.user_type, r.*, c.nombre as empresa
			FROM User as u JOIN Responsable as r JOIN Cliente as c
			WHERE r.idUser = u.id
			AND r.idCliente = c.id');

		return $users;
	}

	function setCliente($data = array()) {
		$this->db->insert('INSERT INTO Cliente SET nombre=:nombre, rfc=:rfc, calle=:calle, num_exterior=:num_exterior, num_interior=:num_interior,colonia=:colonia,cp=:cp ', $data);
	}

	function updateCliente($data = array()) {
		$this->db->query('UPDATE Cliente SET nombre=:nombre, rfc=:rfc, calle=:calle, num_exterior=:num_exterior, num_interior=:num_interior,colonia=:colonia,cp=:cp WHERE id=:id', $data);
	}

	function getEmpresas() {
		$empresas = $this->db->query('SELECT * FROM Cliente');

		return $empresas;
	}

	function setResponsable($data = array()) {
		$lastid = $this->db->insert('INSERT INTO User SET user=:user, password=:password, user_type=:user_type ', $data);

		$data['idUser'] = $lastid;
		$this->db->insert('INSERT INTO Responsable SET nombre=:nombre, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, idCliente=:idCliente, idUser=:idUser ', $data);
	}

	function updateResponsable($data = array()) {
		$userData = array(
			'idUser' => $data['idUser'],
			'user' => $data['user'],
			'user_type' => 'Cliente'
		);

		if (isset($data['password'])) {
			$userData['password'] = $data['password'];
			$this->db->query('UPDATE User SET user=:user, password=:password, user_type=:user_type WHERE id=:idUser', $userData);

		} else {
			$this->db->query('UPDATE User SET user=:user, user_type=:user_type WHERE id=:idUser', $userData);
		}

		$responsableData = array(
			'nombre' => $data['nombre'],
			'apellido_paterno' => $data['apellido_paterno'],
			'apellido_materno' => $data['apellido_materno'],
			'idCliente' => $data['idCliente'],
			'idUser' => $data['idUser']
		);
		$this->db->query('UPDATE Responsable SET nombre=:nombre, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, idCliente=:idCliente WHERE idUser=:idUser', $responsableData);
	}

	function setAdmin($username, $password, $nombre, $ap, $am) {
		$data = array('user' => $username,
					'user_type' => 'Administrador',
					'password' => $password);
		$lastid = $this->db->insert('INSERT INTO User SET user=:user, password=:password, user_type=:user_type ', $data);

		$data = array('nombre' => $nombre,
					'apellido_paterno' => $ap,
					'apellido_materno' => $am,
					'idUser' => $lastid);
		$this->db->insert('INSERT INTO Administrador SET nombre=:nombre, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, idUser=:idUser ', $data);
	}

	function setDoctor($username, $password, $nombre, $ap, $am, $cedula) {
		$data = array('user' => $username,
					'user_type' => 'Doctor',
					'password' => $password);
		$lastid = $this->db->insert('INSERT INTO User SET user=:user, password=:password, user_type=:user_type ', $data);

		$data = array('nombre' => $nombre,
					'apellido_paterno' => $ap,
					'apellido_materno' => $am,
					'cedula' => $cedula,
					'idUser' => $lastid);
		$this->db->insert('INSERT INTO Doctor SET nombre=:nombre, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, cedula=:cedula, idUser=:idUser ', $data);
	}

	function getDoctorUsers() {
		$users = $this->db->query('SELECT u.user, u.user_type, d.* FROM User as u JOIN Doctor as d WHERE d.idUser = u.id');

		return $users;
	}
}

?>