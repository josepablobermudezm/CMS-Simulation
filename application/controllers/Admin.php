<?php

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Admin_model');
	}

	//Muestra la vista del Login
	public function index()
	{
		$this->load->view('admin/login');
	}


	function load_data_view($view)
	{
		//precarga todos los datos con los que la vista debe iniciar
		$this->load->model('Web_model');
		$data['sections'] = $this->Web_model->get_All_Sections();
		$data['servicios'] = $this->Web_model->get_All_Services();
		$data['_view'] = $view;
		$data['images'] = $this->Web_model->get_All_Images();
		$data['users'] = $this->Admin_model->get_all_users();
		$this->load->view('layouts/main', $data);
	}



	//Proceso de autenticación Login
	public function login()
	{

		$this->form_validation->set_rules('txt_username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txt_password', 'Password', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE) { //Si No se cumple la validación

			//Si autenticamos vamos a la vista principal
			//Sino nos devielve al login
			//Esto es para el caso de si la sesión aún está activa
			if (isset($this->session->userdata['logged_in'])) {
				//Función propia para cargar la vista indicada con datos precargados
				$this->load_data_view('admin/administrador');
				
			} else {
				$this->load->view('admin/administrador');
			}
		} else {

			//Si se cumple la validación procedemos a comprobar la autenticación
			$data = array(
				'username' => $this->input->post('txt_username'),
				'password' => $this->input->post('txt_password')
			);

			$result = $this->Admin_model->login($data); //Función login del Modelo Auth

			if ($result == TRUE) { //Si autenticamos

				$username = $this->input->post('txt_username');
				$result = $this->Admin_model->get_user_information($username); //Función read_user_information del Modelo Auth

				//leemos los datos del usuario auntenticado y los ingresamos en las Variables de Sesion
				if ($result != false) {
					$session_data = array(
						'logged_in' => TRUE,
						'users_id' => $result[0]->users_id,
						'username' => $result[0]->username,
						'realname' => $result[0]->realname,
						'correo' => $result[0]->correo,
					);

					// Agregamos la infomación del usuario en forma de arreglo a la Variable de Sesion con nombre logged_in
					$this->session->set_userdata('logged_in', $session_data);
					//Función propia para cargar la vista indicada con datos precargados
					//redireccionamos a la URL raíz para evitar que nos quede auth/login/ en la URL					
					redirect('admin/administrador', 'refresh'); 
				}
			} else { //Si No autenticamos regreamos a la vista Login con un mensaje de error seteado
				$data = array(
					'error_message' => 'Usuario o Contraseña incorrectos'
				);

				$this->load->view('admin/Login', $data);
			}
		}
	}

	public function administrador(){
		$this->load_data_view('admin/administrador'); //luego cargamos la vista
	}

	public function obtenerTituloServicio($id)
	{
		$data['services'] = $this->Admin_model->get_Service($id);
		$array = json_decode(json_encode($data['services'][0]), true);
		print_r($array['titulo']);
	}

	public function obtenerDetalleServicio($id)
	{
		$data['services'] = $this->Admin_model->get_Service($id);
		$array = json_decode(json_encode($data['services'][0]), true);
		print_r($array['descripcion']);
	}


	public function obtenerDescripcionServicio($id)
	{
		$data['services'] = $this->Admin_model->get_Service($id);
		$array = json_decode(json_encode($data['services'][0]), true);
		print_r($array['detalle']);
	}

	//Proceso de Logout 
	public function logout()
	{
		$sess_array = array(
			'logged_in' => FALSE,
			'username' => '',
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$this->session->sess_destroy();
		$data['message_display'] = 'Has cerrado tu sesión de forma exitosa.';
		$this->load->view('admin/login', $data);
	}

	public function obtenerImagen($id)
	{
		$data['sections'] = $this->Admin_model->get_Section($id);
		$array = json_decode(json_encode($data['sections'][0]), true);
		print_r($array['imagen']);
	}

	public function obtenerDetalle($id)
	{
		$data['sections'] = $this->Admin_model->get_Section($id);
		$array = json_decode(json_encode($data['sections'][0]), true);
		print_r($array['detalle']);
	}

	public function obtenerTitulo($id)
	{
		$data['sections'] = $this->Admin_model->get_Section($id);
		$array = json_decode(json_encode($data['sections'][0]), true);
		print_r($array['titulo']);
	}

	public function obtenerCorreo($id)
	{
		$data['user'] = $this->Admin_model->get_user($id);
		$array = json_decode(json_encode($data['user'][0]), true);
		print_r($array['correo']);
	}

	public function obtenerUserName($id)
	{
		$data['user'] = $this->Admin_model->get_user($id);
		$array = json_decode(json_encode($data['user'][0]), true);
		print_r($array['username']);
	}

	public function obtenerRealName($id)
	{
		$data['user'] = $this->Admin_model->get_user($id);
		$array = json_decode(json_encode($data['user'][0]), true);
		print_r($array['realname']);
	}



	public function EliminarImagen($id)
	{
		$this->Admin_model->delete_Image($id);
	}

	function upload_photo()
	{
		$config['upload_path']          = './resources/photos/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 10000; //10MB
		$config['overwrite']            = true;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('txt_file1')) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error', $error['error']);
		} else {
			$data = array('upload_data' => $this->upload->data());

			$this->session->set_flashdata('success', "Archivo cargado al sistema exitosamente.");

			$params = array(
				'post' => $this->upload->data('file_name'),
				'date' => date('Y-m-d H:i:s'),
				'users_id' => $this->session->userdata['logged_in']['users_id'],
			);
			$this->Twitter_model->add_tweet($params);
		}
		$this->index();
	}

	function editarGuardar()
	{
		$config['upload_path']          = './resources/photos/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 2000; //2MB
		$config['overwrite']            = true;
		$this->load->library('form_validation');
		$this->form_validation->set_rules('titulo', 'Post/name', 'required|max_length[50]');
		$this->form_validation->set_rules('descripcion', 'Post/message', 'required|max_length[10000]');

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('txt_file')) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error', $error['error']);
		} else {
			if (isset($_POST['estandar'])) { //sección normal
				$params = array(
					'imagen' => $this->upload->data('file_name'),
					'titulo' => $this->input->post('titulo'),
					'detalle' => $this->input->post('detalle')
				);
				$this->Admin_model->add_Seccion($params);
			} else if (isset($_POST['galeria'])) { //galería

				$params = array(
					'imagen' => $this->upload->data('file_name'),
					'descripcion' => $this->input->post('detalle')
				);
				if ($this->Admin_model->count_images()) {
					$this->Admin_model->add_Image($params);
				}
			} else if (isset($_POST['servicios'])) { //servicios

				if ($_POST['servicio'] == "0") {
					$params = array( // se agregan servicios
						'descripcion' => $this->input->post('detalleS'),
						'detalle' => $this->input->post('descripcionS'),
						'titulo' => $this->input->post('tituloS'),
					);
					$this->Admin_model->add_Service($params);
					$params = array( //se edita la imagen 
						'id_secciones' => $this->input->post('secciones'),
						'titulo' => "Servicios",
						'detalle' => "detalle",
						'imagen' => $this->upload->data('file_name'),
					);
					$this->Admin_model->edit_Section($params);
				} else {
					$params = array( // se editan servicios
						'id_servicio' => $this->input->post('servicio'),
						'descripcion' => $this->input->post('detalleS'),
						'detalle' => $this->input->post('descripcionS'),
						'titulo' => $this->input->post('tituloS'),
					);
					$this->Admin_model->edit_Services($params);
					$params = array( //se edita la imagen 
						'id_secciones' => $this->input->post('secciones'),
						'titulo' => "Servicios",
						'detalle' => "detalle",
						'imagen' => $this->upload->data('file_name'),
					);
					$this->Admin_model->edit_Section($params);
				}
			} else {
				$params = array(
					'id_secciones' => $this->input->post('secciones'),
					'imagen' => $this->upload->data('file_name'),
					'titulo' => $this->input->post('titulo'),
					'detalle' => $this->input->post('detalle')
				);
				$this->Admin_model->edit_Section($params);
			}
		}
		$this->load_data_view("admin/administrador");
	}

	function guardarUsuario()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt_clave', 'Clave', 'required|max_length[128]');
		$this->form_validation->set_rules('txt_usuario', 'Usuario', 'required|max_length[64]');
		$this->form_validation->set_rules('txt_nombre', 'Nombre', 'required|max_length[64]');
		$this->form_validation->set_rules('txt_correo', 'Correo', 'required|max_length[50]');
		
		if ($this->form_validation->run()) {

			if ($_POST['usuarios'] == 0) {
				$params = array(
					'username' => $this->input->post('txt_usuario'),
					'password' => password_hash($this->input->post('txt_clave'), PASSWORD_BCRYPT),
					'realname' => $this->input->post('txt_nombre'),
					'correo' => $this->input->post('txt_correo'),
				);
				$this->Admin_model->add_User($params);
				
			} else {
				$params = array(
					'users_id' => $_POST['usuarios'],
					'username' => $this->input->post('txt_usuario'),
					'password' => password_hash($this->input->post('txt_clave'), PASSWORD_BCRYPT),
					'realname' => $this->input->post('txt_nombre'),
					'correo' => $this->input->post('txt_correo'),
				);
				
				$this->Admin_model->edit_User($params);
			}
		} else {
			
		}
	}
	public function EliminarServicio($id)
	{
		$this->Admin_model->delete_service($id);
	}
}