<?php
/**
 * Created by PhpStorm.
 * User: mfgoreva
 * Date: 17.03.2019
 * Time: 18:03
 */

namespace models\File;

use models\Model;
use helpers\UploadFileHelper;

class Files extends Model
{
    protected $fillable = ['name', 'user_id'];

//    public function __construct($fileData)
//    {
//        $this->name = $fileData['name'];
//        $this->user_id = $fileData['userId'];
//    }

    /** Функция загрузки файлов на сервер, сохраняет информацию о файле в БД после загрузки
     *
     * @param int $userId - id пользователя, загружаюшего файл
     * @param array $file - информация о загружаемом файле
     * @throws FileException
     */
    public static function upload(int $userId, array $file)
    {
        if (empty($userId)) {
            $userId = $_SESSION['user_id'];
        }
        if (UploadFileHelper::upload($file)) {
            $file = new Files(['name' => $file['name'], 'userId' => $userId]);
            $file->save();
        } else {
            throw new FileException('Не удалось записать файл.');
        }
    }

    public static function getAll(int $userId = 0, string $sort = 'desc')
    {
        if (!empty($userId)) {
            $files = self::where('user_id', $userId)->orderBy('name', $sort)->get()->toArray();
            if (empty($files)) {
                $files = [];
            }
        } else {
            $files = self::orderBy('name', $sort)->get();
        }
        return $files;

    }
}