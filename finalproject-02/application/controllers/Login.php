<?php

namespace FP2\Controllers;

use FP2\Models\User;

class Login extends Controller
{
    private $model;

    public function index()
    {
        $this->view->render('login');
    }

    public function authorization()
    {
        require_once __DIR__ . '/../models/User.php';
        $this->model = new User();
        $this->model->authorizeUser(
            $_POST['login'],
            $_POST['password']
        );
        if ($this->model->success) {
            session_start();
            $_SESSION['access'] = 'granted';
            $data['message'] = $this->model->message;
            $this->view->render('message', $data);
        } else {
            $data['message'] = $this->model->message;
            $this->view->render('login', $data);
        }
    }

    public function logout()
    {
        session_start();

        $_SESSION = [];
        unset($_COOKIE[session_name()]);
        session_destroy();
        header("Location: /login/");
        exit();
    }
}
