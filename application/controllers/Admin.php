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
		$data['_view'] = $view;
		$this->load->view('layouts/main', $data);
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
			$data = array('upload_data' => $this->upload->data());
			$params = array(
				'photo' => $this->upload->data('file_name')
			);

			$this->session->set_flashdata('success', "Archivo cargado al sistema exitosamente.");

			if ($this->form_validation->run() && $_POST['titulo'] != "" && $_POST['descripcion'] != "") {
				if ($_POST['secciones'] == "0") {
					$params = array(
						'imagen' => $this->upload->data('file_name'),
						'titulo' => $this->input->post('titulo'),
						'detalle' => $this->input->post('descripcion')
					);
					$this->Admin_model->add_Seccion($params);
				}else{
					echo $_POST['secciones'];
					$params = array(
						'id_secciones' => $this->input->post('secciones'),
						'imagen' => $this->upload->data('file_name'),
						'titulo' => $this->input->post('titulo'),
						'detalle' => $this->input->post('descripcion')
					);
					$this->Admin_model->edit_Section($params);
				}
			}
		}
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
				$this->load->view('admin/login');
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
						'photo' => $result[0]->photo,
					);

					// Agregamos la infomación del usuario en forma de arreglo a la Variable de Sesion con nombre logged_in
					$this->session->set_userdata('logged_in', $session_data);
					//Función propia para cargar la vista indicada con datos precargados
					//redirect('admin/administrador', 'refresh'); //redireccionamos a la URL raíz para evitar que nos quede auth/login/ en la URL
					$this->load_data_view('admin/administrador'); //luego cargamos la vista
				}
			} else { //Si No autenticamos regreamos a la vista Login con un mensaje de error seteado
				$data = array(
					'error_message' => 'Usuario o Contraseña incorrectos'
				);

				$this->load->view('admin/login', $data);
			}
		}
	}

	//Proceso de Logout 
	public function logout()
	{

		// Removemos los datos de la sesion
		$sess_array = array(
			'logged_in' => FALSE,
			'username' => '',
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$this->session->sess_destroy();
		$data['message_display'] = 'Has cerrado tu sesión de forma exitosa.';
		$this->load->view('admin/login', $data);
	}
}
