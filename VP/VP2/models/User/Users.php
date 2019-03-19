<?php

namespace models\User;

use Illuminate\Database\QueryException;
use models\File\Files;
use models\Model;

class Users extends Model
{
    const ADULT_AGE = 18;
    protected $table = 'users';
    protected $fillable = ['email', 'name', 'description', 'password', 'age', 'avatar'];

    /** Создает запись о пользователе в базе
     * @param $userData
     * @return Users
     * @throws UserException
     */
    public static function create($userData)
    {
        $user = new self();
        $user->email = $userData['email'];
        $user->name = !empty($userData['name']) ? $userData['name'] : '';
        $user->description = $userData['description'];
        $user->password = $userData['password'];
        $user->age = $userData['age'];
        try{
            $user->save();
            self::setAvatar($userData['avatar'], $user);
            return $user;
        } catch (QueryException $exception){
            throw new UserException($exception->getMessage());
        }
    }

    public static function getAll($desc = true)
    {

        $users = self::all()->sortBy('age', SORT_REGULAR, $desc ? 1 : 0);
        foreach ($users as $user) {
            $user->adult = self::isAdult($user->age) ? 'Совершеннолетний' : 'Несовершеннолетний';
            //$user->cntFls = self::countFiles($user->id);
        }
        //var_dump($users);
        $users = $users->toArray();
        return $users;
    }

    private static function isAdult($age)
    {
        return $age >= self::ADULT_AGE;
    }

    public static function login($login, $password)
    {
        return self::where([
                ['email', '=', $login],
                ['password', '=' , $password]
            ]
        )->get()[0];
    }

    public static function setAvatar(array $avatarFile, $user)
    {
        if(!empty($_FILES['avatar'])) {
            Files::upload($user->id, $avatarFile);
            $user->avatar = "/upload/{$_FILES['avatar']['name']}";
            $user->save();
        }
    }

    public function isAuthorized()
    {
        return $_SESSION['auth'] == 1 && $_SESSION['isAdmin'];
    }
}