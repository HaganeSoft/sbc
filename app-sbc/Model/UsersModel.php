<?php
namespace Hagane\Model;

/**
* Usuarios
*/
class Users{
	private $db;
	private $auth;

	function __construct(&$auth, &$db) {
		$id = $auth->isAuth();
		if (!empty($id)) {
			$data = array('id' => $id);
			$userArray = $db->getRow('SELECT * from Users where Users.id = :id', $data);
			$this->db = $db;
			$this->auth = $auth;
		}
	}

	function getUsers() {
		$users = $this->db->query('SELECT * FROM Users');
		return $users;
	}

	function setUsers($data = array()) {
		$this->db->insert('INSERT INTO Users 
			SET name=:name, 
				country=:country,
		 		email=:email, 
		 		address=:address, 
		 		university=:university,
		 		phone=:phone,
		 		degree=:degree ', $data);
	}

	function updateUsers($data = array()) {
		$this->db->query('UPDATE Users 
			SET name=:name, 
				country=:country, 
				email=:email, 
				address=:address, 
				university=:university,
				phone=:phone,
				degree=:degree WHERE id=:id', $data);
	}
}
?>