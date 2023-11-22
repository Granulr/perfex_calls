<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Perfex_calls_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  none
     * @return object
     * Get all calls entries for the client
     */
    public function get_calls($clientid){
        $this->db->where('company', 'ASC');
        $data = $this->db->get(db_prefix().'calls')->result_array();

        return $data;
    }



}
