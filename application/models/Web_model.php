<?php

class Web_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    public function get_All_Sections(){
        return $this->db->query("SELECT secciones.id_secciones, secciones.imagen, secciones.titulo, secciones.detalle, secciones.nombre
                                FROM secciones
                                ORDER BY secciones.id_secciones ASC")->result_array();
    }

    public function get_All_Services(){
        return $this->db->query("SELECT servicio.id_servicio, servicio.descripcion, servicio.titulo, servicio.detalle
                                FROM servicio
                                ORDER BY servicio.id_servicio ASC")->result_array();
    }
        
    /*public function add_tweet($params)
    {
        $this->db->insert('tweets',$params);
        return $this->db->insert_id();
    }

    public function edit_tweet($params)
    {
        return $this->db->query("UPDATE tweets SET tweets.post = '". $params['post'] ."' WHERE tweets.tweets_id = " . $params['tweets_id']);
    }

    public function delete_tweet($id)
    {
        $this->db->delete('tweets', array('tweets_id' => $id));
    }

    function get_all_tweets()
    {
        return $this->db->query("SELECT tweets.tweets_id, tweets.post, tweets.date, users.users_id, users.username, users.realname, users.photo
                                FROM tweets, users
                                WHERE tweets.users_id = users.users_id
                                ORDER BY tweets.tweets_id DESC")->result_array();

    }

    function search_tweets($data)
    {
        return $this->db->query("SELECT tweets.tweets_id, tweets.post, tweets.date, users.users_id, users.username, users.realname, users.photo
                                FROM tweets, users
                                WHERE tweets.users_id = users.users_id
                                AND tweets.post LIKE '%" . $data . "%'
                                ORDER BY tweets.tweets_id DESC")->result_array();

    }

    function get_data_tweet($id)
    {
        return $this->db->query("SELECT tweets.tweets_id, tweets.post, users.users_id
                                FROM tweets, users
                                WHERE tweets.users_id = users.users_id
                                AND tweets.tweets_id = " .$id)->row_array();

    }*/
}
