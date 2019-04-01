<?php

namespace helpers;


class UploadFileHelper
{
    public static function upload($file = [], $uploadDir = '/upload/')
    {
        $uploadPath = ROOT_DIR . $uploadDir . $file['name'];
        return move_uploaded_file($file['tmp_name'], $uploadPath);
    }
}