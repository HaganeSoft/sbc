<?php
namespace Hagane\Model;

class PublicMod {
	private $db;

	function __construct(&$db) {
			$this->db = $db;
	}

	function setCV($data = array()) {
		$this->db->insert('INSERT INTO Persona SET nombre=:nombre, apellidos=:apellidos, edad=:edad, residencia=:residencia, sexo=:sexo, telefono=:telefono, email=:email, carrera=:carrera, inst_carrera=:inst_carrera, maestria=:maestria, inst_maestria=:inst_maestria, ingles=:ingles, otros_idiomas=:otros_idiomas, ultimo_puesto=:ultimo_puesto, empresa=:empresa, rango_sueldo=:rango_sueldo, area1=:area1, tiempo1=:tiempo1, area2=:area2, tiempo2=:tiempo2, area3=:area3, tiempo3=:tiempo3, file_path=:file_path ', $data);

		$data['message'] = "Se ha guardado correctamente";
		$data['success'] = true;
		return $data;
	}

}

?>