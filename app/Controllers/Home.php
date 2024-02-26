<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function add_employee()
    {
        echo "Add Employee Data with Employee Id";
    }
}
