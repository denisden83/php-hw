<?php

namespace FP2\Controllers;

use \FP2\Models\User;

class Users extends Controller
{
    private $model;

    public function index($order = null)
    {
        if ($this->access() === 'denied') {
            $data['message'] = 'Доступ только для авторизованых пользователей';
            $this->view->render('message', $data);
            return;
        }
        require_once __DIR__ . '/../models/User.php';
        $this->model = new User;
        $this->model->loadAllUsers($order);
        $this->view->render('list-of-users', $this->model->table);
    }

    public function ascending()
    {
        $this->index('ASC');
    }

    public function descending()
    {
        $this->index('DESC');
    }
}
