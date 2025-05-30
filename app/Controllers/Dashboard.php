<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        $session = session();
        $data['username'] = $session->get('username');
        echo view('dashboard', $data);
    }
}
