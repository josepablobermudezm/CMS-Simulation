<?php

class Web extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Web_model');
        $this->load->library('session');
    }
    public $correo = false;

    function index($sections_data = array())
    {
        if ($sections_data == null)
            $data['sections'] = $this->Web_model->get_All_Sections();
        else
            $data['sections'] = $sections_data;
        $data['servicios'] = $this->Web_model->get_All_Services();
        $data['images'] = $this->Web_model->get_All_Images();
        $data['quienesSomos'] = $this->Web_model->get_QuienesSomos();
        $data['inicio'] = $this->Web_model->get_Inicio();
        if ($this->correo) {
            $data['message_display'] = 'Correo electrónico enviado exitosamente';
        }
        $data['_view'] = 'web/index';
        $this->load->view('layouts/main', $data);
    }

    function correo()
    {
        $this->correo = false;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Post/email', 'required|max_length[100]');
        $this->form_validation->set_rules('name', 'Post/name', 'required|max_length[50]');
        $this->form_validation->set_rules('message', 'Post/message', 'required|max_length[2000]');

        if ($this->form_validation->run()) {
            $params = array(
                'nombre' => $this->input->post('name'),
                'correo' => $this->input->post('email'),
                'mensaje' => $this->input->post('message'),
            );

            $this->Web_model->add_email($params);
            $this->correo = true;
        }
        redirect('/web', 'refresh');
    }
}
