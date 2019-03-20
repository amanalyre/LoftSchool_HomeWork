<?php

namespace controllers;

use models\User\Users;
use models\User\UserException;

class AdminEditController extends Controller
{
    protected $email;

    public function index()
    {
        $user = (new Users)->getUserByEmail($email);
        $this->renderView('adminEdit', ['user' => $user]);
        $this->status = true;
    }
}