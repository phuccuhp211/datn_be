<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected $response;

    public function __construct()
    {
        $this->response = ['status' => false, 'message'=> '', 'data' => []];
    }
}
