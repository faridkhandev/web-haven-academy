<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Creatorzone extends Frontend_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['page'] = 'creator-zone';

        $this->load->view('front/creator-zone', $data);
    }
}