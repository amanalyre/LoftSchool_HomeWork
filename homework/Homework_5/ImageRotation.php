<?php

namespace Homework_5;

require __DIR__ . '/../../vendor/autoload.php';

use Intervention\Image\ImageManagerStatic as IImage;

class Image
{
    protected $origin = __DIR__.'\example.jpg';
    protected $result = __DIR__.'\resultImage.jpg';


    /**
     * Поворачивает на 45 гр. и ресайзит картинку
     */
    public function change()
    {
        $watermark = IImage::make('wm.png');
        IImage::make($this->origin)
                ->resize(200, null)
                ->rotate(45)
                ->insert($watermark, 'bottom-right', 10, 10)
                ->save($this->result);
    }


}