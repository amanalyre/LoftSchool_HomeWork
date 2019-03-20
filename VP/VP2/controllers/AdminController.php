<?php

namespace controllers;

use models\File\Files;
use models\User\Users;
use models\User\UserException;

class AdminController extends Controller
{
    public function index()
    {
        if((new Users)->isAuthorized()){
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

    public function createUser()
    {
        if (empty($this->userData['email'] || $this->userData['password'])) {
            return $this->status;
        }
        if (!empty($_FILES['avatar'])) {
            $this->userData['avatar'] = $_FILES['avatar'];
        }
        try {
            $user = Users::create($this->userData);
            $message = 'Регистрация прошла успешно. Можете ';
        } catch (UserException $exception) {
            $message = 'Не удалось зарегистрироваться из-за ошибки: ' . $exception->getMessage();
        } finally {
            $this->renderView('adminRegistration', [
                    'message' => !empty($message) ? $message : ''
            ]);
        }

    }

    public function editUser()
    {
        $params = $this->userData;
        if (empty($this->userData['email'] || $this->userData['password'])) {
            return $this->status;
        }

        $values = ['name' => $this->userData['name'], 'age' => $this->userData['age'], 'description' => $this->userData['description']];
        $user = new Users;
        $user->getUserByEmail($this->userData['email']);
        $user->update($values, $params);

        $this->renderView('adminEdit', [
                'message' => !empty($message) ? $message : ''
        ]);

    }
}