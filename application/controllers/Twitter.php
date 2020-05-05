<?php

class Twitter extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('Twitter_model');
        $this->load->library('session');
    }

	function index($tweets_data = array())
	{
        /*if($tweets_data == null)
            $data['tweets'] = $this->Twitter_model->get_all_tweets();
        else
            $data['tweets'] = $tweets_data;*/

		$data['_view'] = 'twitter/index';
        $this->load->view('layouts/main',$data);
	}

    /*function process()
    {
        if($this->input->post('btn_save')){ 
            $this->add();
        } 

        if($this->input->post('btn_search')){ 
            $this->search();
        }
    }

	function add()
    {   
        $this->load->library('form_validation');
		$this->form_validation->set_rules('txt_post','Post/Tweet','required|max_length[128]');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'post' => $this->input->post('txt_post'),
                'date' => date('Y-m-d H:i:s'),
                'users_id' => $this->session->userdata['logged_in']['users_id'],
            );

            $this->Twitter_model->add_tweet($params);
        }

        $this->index();
    }

    function edit($id)
    {   
        $data['tweet'] = $this->Twitter_model->get_data_tweet($id);

        if(isset($data['tweet']['tweets_id']) && $this->session->userdata['logged_in']['users_id'] == $data['tweet']['users_id'])
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('txt_post','Post/Tweet','required|max_length[128]');
            
            if($this->form_validation->run())     
            {   
                $params = array(
                    'tweets_id' => $id,
                    'post' => $this->input->post('txt_post'),
                );

                $this->Twitter_model->edit_tweet($params);

                redirect('twitter/index');

            } else {       
                $data['_view'] = 'twitter/edit';
                $this->load->view('layouts/main',$data);
            }

        } else {       
            $this->index();
        }
    }

    function search()
    {   
        $result = $this->Twitter_model->search_tweets($this->input->post('txt_post'));
        $this->index($result);
    } 

    function delete($id)
    {   
        $data['tweet'] = $this->Twitter_model->get_data_tweet($id);

        if($this->session->userdata['logged_in']['users_id'] == $data['tweet']['users_id'])      
            $this->Twitter_model->delete_tweet($id);

        $this->index();
    }*/

}
