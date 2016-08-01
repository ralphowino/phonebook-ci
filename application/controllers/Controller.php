<?php

class Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->user = $this->user->fromUser($this->ion_auth->user()->row());
    }

    public function view($view, $data = [])
    {
        $data['user'] = $this->user;
        $data['content'] = $view;
        $this->load->view('layouts/app', $data);
    }
}