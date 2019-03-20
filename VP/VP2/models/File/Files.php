<?php

namespace models\File;

use models\Model;
use helpers\UploadFileHelper;

class Files extends Model
{
    protected $fillable = ['name', 'user_id'];
    protected $guarded = ['created_at', 'updated_at'];

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
        if (UploadFileHelper::upload($file)) {
            $file = new Files(['name' => $file['name'], 'userId' => $userId]);
            $file->attributes['user_id'] = $userId;
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