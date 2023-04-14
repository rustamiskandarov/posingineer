<?php

namespace App\controllers;

use App\Helper;
use App\services\UserService;
use Aura\SqlQuery\Exception;
use Delight\Auth\Auth;
use League\Plates\Engine;
use function Tamtamchik\SimpleFlash\flash;

class UserController
{
    private UserService $userService;
    private Engine $template;
    private Auth $auth;

    /**
     * @param UserService $userService
     * @param Engine $template
     * @param Auth $auth
     */
    public function __construct(UserService $userService, Engine $template, Auth $auth)
    {
        $this->userService = $userService;
        $this->template = $template;
        $this->auth = $auth;
    }

    public function index()
    {
        $orderBy=$_POST['order_by'];
        if ($orderBy==''){
            $orderBy = 'id DESC';
        }
        $users = $this->userService->getAllUser($orderBy);

        echo $this->template->render('users/index', ['users'=>$users]);
    }


}