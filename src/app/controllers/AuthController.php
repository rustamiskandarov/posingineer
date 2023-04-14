<?php

namespace App\controllers;

use App\Helper;
use Delight\Auth\Auth;
use League\Plates\Engine;
use SimpleMail;
use function Tamtamchik\SimpleFlash\flash;

class AuthController
{
    private $auth;
    private $templates;

    /**
     * @param $auth
     * @param $db
     */
    public function __construct(Engine $templates, Auth $auth, SimpleMail $mailer)
    {
        $this->mailer = $mailer;
        $this->templates = $templates;
        $this->auth = $auth;
    }


    public function login()
    {
        try {
            $this->auth->login($_POST['email'], $_POST['password']);
            flash()->success('Успешный вход');
            Helper::redirect('',200);

        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            flash()->error('Не правильный адрес эл. почты');
            Helper::redirect('signin',400);

        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            flash()->error('Не правильный пароль');
            Helper::redirect('signin',400);
        }
        catch (\Delight\Auth\EmailNotVerifiedException $e) {
            flash()->error('Пользователь не потвердил почту');
            Helper::redirect('signin',400);
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error('Слишком много попыток входа, попробуйте позже');
            Helper::redirect('',400);
        }

    }

    public function signin()
    {
        echo $this->templates->render('auth/signin');
    }
    public function signup()
    {
        echo $this->templates->render('auth/signup');
    }

    public function register()
    {
        try {
            $userId = $this->auth->register($_POST['email'], $_POST['password'], $_POST['username'], function ($selector, $token) {
                $this->sendMail($_POST['email'], '', '',$selector.' '.$token);
                flash()->success('Пользователь успешно зарегистрирован, потвердите перейдя по ссылки в вашей почте');
                Helper::redirect('',200);
            });

        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            flash()->error('Не правильный адрес эл. почты');
            Helper::redirect('signup',400);
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            flash()->error('Не правильный пароль');
            Helper::redirect('signup',400);
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            flash()->error('Пользователь с таким адресом эл.почты существует');
            Helper::redirect('signup',400);
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            flash()->error('Слишком много попыток регистрации, попробуйте позже');
            Helper::redirect('',400);
        }
    }

    public function logout()
    {
        if (!$this->auth->isLoggedIn()){
            flash()->error('Ошибка выхода, вы не в системе');
            Helper::redirect('',401);
        }
        try {
            $this->auth->logOut();
        }
        catch (\Delight\Auth\NotLoggedInException $e) {
            flash()->error('Ошибка выхода');
            Helper::redirect('',401);;
        }
        flash()->success('Вы вышли из системы');
        Helper::redirect('',200);

    }

    public function logoutEverywhere()
    {
        try {
            $this->auth->logOutEverywhereElse();
        }
        catch (\Delight\Auth\NotLoggedInException $e) {
            flash()->error('Ошибка выхода');
            Helper::redirect('',400);
        }
        flash()->success('Вы вышли из системы со всех устройств');
        Helper::redirect('',200);
    }


    private function sendMail($email, $name, $thema, $message){
        SimpleMail::make()
            ->setTo($email, $name)
            ->setFrom('marlin3oop@rustisk.ru', 'RustIsk')
            ->setSubject($thema)
            ->setMessage($message)
            ->send();
    }

}