<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perfex_calls extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('perfex_calls_model');
    }

}
