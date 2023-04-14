<?php

namespace App\controllers;


use App\Helper;
use Delight\Auth\Auth;
use League\Plates\Engine;

class HomeController
{
    private $templates;
    private $auth;

    /**
     * @param $templates
     */
    public function __construct(Engine $templates, Auth $auth)
    {
        $this->templates = $templates;
        $this->auth = $auth;
    }

    public function index(){
        //echo $this->templates->render('homepage', ['name'=>$data]);
        echo $this->templates->render('homepage', ['user'=>$this->auth->getUsername()]);
    }
}