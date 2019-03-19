<?php

namespace controllers;

use models\File\Files;
use models\User\Users;
use models\User\UserException;

class AdminController extends Controller
{
    public function index()
    {
        if($_SESSION['auth'] == 1 && $_SESSION['isAdmin']){
            $this->renderView('admin');
        } else {
            $this->renderView('index');
        }
    }

    public function allUsers($desc = 0)
    {
        if($_SESSION['auth'] == 1 && $_SESSION['isAdmin']) {
            $users = Users::getAll($desc);
            //var_dump($users);
            $this->renderView('adminUsers', ['users' => $users]);
        }
    }

    public function allUserFiles($user_id_param)
    {

        $user_id = implode($user_id_param);
        if((new Users)->isAuthorized()) {

            $files = Files::getAll($user_id);
            //var_dump($files);
            $this->renderView('adminFiles', ['files' => $files]);
        }
    }
}