<?php

namespace views\View;

use \Twig\Environment;
use \Twig\Loader\FilesystemLoader;
use \Twig\Error\Error as TwError;

class View
{
    const PATH_TO_TEMPLATES = ROOT_DIR . '/views/templates';
    private $templateEngine;

    public function __construct()
    {
        $this->templateEngine = new Environment(new FilesystemLoader(self::PATH_TO_TEMPLATES), [
            'cache' => false,
        ]);
    }

    public function render($path, $data = [])
    {
        try {
            $path = (stristr($path, '.html')) ? $path : "$path.html";
            $result = $this->templateEngine->render($path, !empty($data) ? $data : []);
        } catch (TwError $exception) {
            $result = $exception->getMessage();
        }
        return $result;
    }
}
