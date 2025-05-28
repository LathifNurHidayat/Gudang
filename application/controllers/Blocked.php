<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blocked extends CI_Controller
{
    public function index()
    {
        $this->load->view('blocked/view_blocked');
    }
}