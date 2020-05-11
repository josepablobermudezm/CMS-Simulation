<?php

class Admin_model extends CI_Model
{

	//Se utiliza el algoritmo de encriptación nativo de PHP password_hash('contraseña', PASSWORD_BCRYPT) para encriptar.
	//Para verificar la contraseña se utiliza password_verify('contraseña','passw de la BD')
	public function login($data)
	{
		$userExists = $this->get_user_information($data['username']);

		//Se compara el password que viene por POST con el encriptado de la BD por medio de password_verify()
		if ($userExists != false && password_verify($data['password'], $userExists[0]->password)) {
			return true; //Existe: autenticado
		} else {
			return false; //No autenticado
		}
	}

	//Retorna los datos del usuario indicado por parámetro
	public function get_user_information($username)
	{

		$query = $this->db->query("SELECT users.* from users WHERE users.username = '$username'");

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function delete_Image($id)
    {
        $this->db->delete('imagenes', array('id_imagen' => $id));
    }

	public function delete_service($id){
		$this->db->delete('servicio', array('id_servicio' => $id));
	}

	public function get_Section($id)
	{

		$query = $this->db->query("SELECT secciones.* from secciones WHERE secciones.id_secciones = '$id'");

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function get_Service($id)
	{

		$query = $this->db->query("SELECT servicio.* from servicio WHERE servicio.id_servicio = '$id'");

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function add_Seccion($params)
	{
		$this->db->insert('secciones', $params);
		return $this->db->insert_id();
	}

	public function add_Image($params)
	{
		$this->db->insert('imagenes', $params);
		return $this->db->insert_id();
	}

	public function add_Service($params)
	{
		$this->db->insert('servicio', $params);
		return $this->db->insert_id();
	}

	public function edit_Section($params)
	{
		return $this->db->query("UPDATE secciones SET secciones.imagen = '" . $params['imagen'] . "', secciones.detalle = '" . $params['detalle'] . "', secciones.titulo = '" . $params['titulo'] . "' WHERE secciones.id_secciones = " . $params['id_secciones']);
	}

	public function edit_Services($params)
	{
		return $this->db->query("UPDATE servicio SET servicio.titulo = '" . $params['titulo'] . "', servicio.detalle = '" . $params['detalle'] . "', servicio.descripcion = '" . $params['descripcion'] . "' WHERE servicio.id_servicio = " . $params['id_servicio']);
	}

	public function count_images(){
		$query = $this->db->query("SELECT imagenes.* from imagenes");

		if ($query->num_rows() < 10) {
			return true;
		} else {
			return false;
		}
	}
}
